<?php

namespace App\Controllers;

use App\ApiResponse;
use App\Controller;
use App\Mailable\JoinConfirmMailable;
use Map\UserTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\Propel;
use Slim\Http\Request;
use Slim\Http\Response;
use Symfony\Component\Config\Definition\Exception\Exception;
use User;
use UserQuery;
use Respect\Validation\Validator as v;
use Util;

/**
 * @property \App\Validation\Validator validator
 */
class UserController extends Controller
{
    use ApiResponse;

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = UserQuery::create()
            ->orderById(Criteria::DESC)
            ->paginate($request->getParam('page', 1), $request->getParam('limit', $this->settings['default_limit']));

        return $this->successToJson(
            $users->toArray(),
            $users
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param $id
     * @return Response
     */
    public function show(Request $request, Response $response, $id)
    {
        $user = UserQuery::create()
            ->findOneById($id);

        if (is_null($user)) {
            return $this->failToJson('empty data');
        }

        return $this->successToJson(
            $user->toArray()
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function post(Request $request)
    {
        $validation = $this->validator->validate($request, [
            'email' => v::notEmpty()->noWhitespace()->email(),
            'name' => v::notEmpty()->stringType()->length(4, 20)->alnum(),
            'password' => v::notEmpty()->length(4, null),
        ]);

        if ($validation->failed()) {
            return $this->failToJson($validation->getErrors());
        }

        $count = UserQuery::create()
            ->filterByEmail($request->getParam('email'))
            ->count();

        if ($count > 0) {
            return $this->failToJson('해당 이메일은 이미 존재합니다.');
        }

        $con = Propel::getWriteConnection(UserTableMap::DATABASE_NAME);
        $con->beginTransaction();

        try {
            $confirmCode = Util::random(60);
            $user = new User();
            $user->setEmail($request->getParam('email'));
            $user->setName($request->getParam('name'));
            $user->setPassword(password_hash($request->getParam('password'), PASSWORD_BCRYPT));
            $user->setConfirmCode($confirmCode);
            $user->save($con);
            $user->reload();

            $this->mailer->setTo($user->getEmail(), $user->getName())->sendMessage(new JoinConfirmMailable($user));

            $con->commit();
        } catch (Exception $e) {
            $con->rollBack();
        }

        return $this->successToJson(
            $user->toArray()
        );

        // todo: jwt auth 적용해서 App::getUser() 비롯한 메소드 실행 가능하게 하기
    }

    public function update(Request $request, Response $response, $id)
    {
        //
    }

    public function delete(Request $request, Response $response, $id)
    {
        //
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
            return $this->failToJson('invalid confirm code');
        }

        $user->setActivated(true);
        $user->setConfirmCode(null);
        $user->save();

        return $this->successToJson(
            $user->toArray()
        );
    }
}