<?php

namespace App\Controllers;

use Propel\Runtime\ActiveQuery\Criteria;
use UserQuery;

/**
 * @RoutePrefix("/users")
 */
class UserController extends Controller
{
    /**
     * @Route("", methods={"GET"}, name="users")
     */
    public function indexAction()
    {
        $users = UserQuery::create()
            ->orderById(Criteria::DESC)
            ->paginate($this->getRequest('page', 1), $this->getRequest('limit', $this->getSettings('default_limit')));

        return $this->successToJson(
            $users->toArray(),
            $users
        );
    }

    /**
     * @Route("/{id:[0-9]+}", methods={"GET"}, name="users.show")
     * @param $id
     * @return \Slim\Http\Response
     */
    public function showAction($id)
    {
        $user = UserQuery::create()
            ->findOneById($id);

        /*if (is_null($user)) {
            $this->halt(500, "not valid");
            exit;
        }*/

        return $this->successToJson(
            $user->toArray()
        );
    }

    /**
     * @Route("", methods={"POST"}, name="users.post")
     */
    public function postAction()
    {
        print_r($this->getRequest('name'));
    }
}