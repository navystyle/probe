<?php
namespace App;

use UserQuery;

class Token
{
    public $decoded = null;

    public function populate($decoded)
    {
        $this->decoded = $decoded;
    }

    public function unsetToken()
    {
        $this->decoded = null;
    }

    public function get()
    {
        return $this->decoded;
    }

    public function getUserId()
    {
        $user = self::getUser();
        return $user ? $user->getId() : null;
    }

    public function getUserName()
    {
        $user = self::getUser();
        return $user ? $user->getName() : null;
    }

    public function userLoggedIn()
    {
        return self::getUserId() > 0;
    }

    public function getUser()
    {
        if (!is_null($this->decoded) &&
            ($user = UserQuery::create()->findOneById($this->decoded['id']))
        ) {
            return $user;
        }
        return null;
    }

}