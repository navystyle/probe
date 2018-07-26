<?php

namespace App\Controllers;

use App\ApiResponse;
use App\Controller;
use DateTime;
use Firebase\JWT\JWT;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;
use UserQuery;

/**
 * @property \App\Validation\Validator validator
 */
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

        $now = new DateTime();
        $future = new DateTime("now +2 hours");
        $jti = base64_encode(md5($user->getId()));

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => $jti,
            "id" => $user->getId(),
            "email" => $user->getEmail(),
            "name" => $user->getName(),
        ];

        $token = [
            'token' => JWT::encode($payload, $this->settings['jwt']['secret'], $this->settings['jwt']['algorithm'])
        ];

        return $response->withHeader("Content-Type", "application/json")
            ->withJson($token, 200);
    }
}