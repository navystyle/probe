<?php

namespace App\Controllers;

use App\ApiResponse;
use App\Controller;
use DateTime;
use Exception;
use Firebase\JWT\JWT;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;
use UserQuery;
use Util;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, [
            'email' => v::notEmpty(),
            'password' => v::notEmpty(),
        ]);

        if ($validation->failed()) {
            return $this->failToJson($validation->getErrors());
        }

        $user = UserQuery::create()
            ->findOneByEmail($request->getParam('email'));

        if (is_null($user) || !password_verify($request->getParam('password'), $user->getPassword())) {
            return $this->failToJson('아이디 또는 패스워드가 일치하지 않습니다.');
        }

        if (!$user->getActivated()) {
            return $this->failToJson('아직 승인받지 않은 상태입니다. 이메일을 확인해주세요.');
        }

        $token = $this->tokenEncode($user->getId());

        return $response->withHeader("Content-Type", "application/json")
            ->withJson($token, 200);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $confirm_code
     * @return Response
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function confirm(Request $request, Response $response, $confirm_code)
    {
        $user = UserQuery::create()
            ->findOneByConfirmCode($confirm_code);

        if (is_null($user)) {
            return $this->failToJson('승인코드가 존재하지 않거나 일치하지 않습니다.');
        }

        $user->setActivated(true);
        $user->setConfirmCode(null);
        $user->save();

        return $this->successToJson(
            $user->toArray()
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws Exception
     */
    public function tokenRefresh(Request $request, Response $response)
    {
        if (is_null($request->getParam('token'))) {
            return $this->failToJson('갱신하기 위한 토큰이 존재하지 않습니다.');
        }

        $decoded = $this->tokenDecode($request->getParam('token'));
        $token = $this->tokenEncode($decoded['id']);

        return $response->withHeader("Content-Type", "application/json")
            ->withJson($token, 200);
    }

    /**
     * @param $token
     * @return array
     * @throws Exception
     */
    private function tokenDecode($token)
    {
        try {
            $decoded = JWT::decode(
                $token,
                $this->settings['jwt']['secret'],
                (array) $this->settings['jwt']['algorithm']
            );
            return (array) $decoded;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function tokenEncode($userId)
    {
        $now = new DateTime();
        $future = new DateTime("now +{$this->settings['jwt']['ttl']} hours");
        $jti = Util::random(12);

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "id" => $userId,
        ];

        $token = [
            'token' => JWT::encode($payload, $this->settings['jwt']['secret'], $this->settings['jwt']['algorithm'])
        ];

        return $token;
    }

    public function logout()
    {
        $this->token->unsetToken();
    }
}