<?php

namespace App\Controllers;

use App\ApiResponse;
use App\Controller;
use Propel\Runtime\ActiveQuery\Criteria;
use Slim\Http\Request;
use Slim\Http\Response;
use UserQuery;

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

    public function update(Request $request, Response $response, $id)
    {
        //
    }

    public function delete(Request $request, Response $response, $id)
    {
        //
    }

}