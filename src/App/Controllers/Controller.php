<?php
namespace App\Controllers;

use Ergy\Slim\Annotations\Controller as BaseController;
use Propel\Runtime\Util\PropelModelPager;
use Slim\Http\Response;

class Controller extends BaseController
{
    public $validator;

    public function __construct()
    {
        $this->validator = $this->__get('validator');
    }

    /**
     * @param $key
     * @param null $default
     * @return mixed
     */
    public function getRequest($key, $default = null)
    {
        return $this->request->getParam($key) ?: $default;
    }

    public function getSettings($key)
    {
        return $this->settings[$key];
    }
}