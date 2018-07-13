<?php

namespace App\Controllers;

use App\ApiResponse;
use App\Controller;
use Propel\Runtime\ActiveQuery\Criteria;
use Slim\Http\Request;
use Slim\Http\Response;
use User;
use UserQuery;
use Respect\Validation\Validator as v;

/**
 * @property \App\Validation\Validator validator
 */
class UserController extends Controller
{
    use ApiResponse;

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

    public function show(Request $request, Response $response, $id)
    {
        $user = UserQuery::create()
            ->findOneById($id);

        if (is_null($user)) {
            throw new \Exception('empty data');
        }

        return $this->successToJson(
            $user->toArray()
        );
    }

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

        $user = new User();
        $user->setEmail($request->getParam('email'));
        $user->setName($request->getParam('name'));
        $user->setPassword(password_hash($request->getParam('password'), PASSWORD_BCRYPT));
        $user->save();

        return $this->successToJson(
            $user->toArray()
        );
    }

    public function update(Request $request, Response $response, $id)
    {
        //
    }

    public function delete(Request $request, Response $response, $id)
    {
        //
    }
}