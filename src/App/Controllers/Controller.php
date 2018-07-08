<?php
namespace App\Controllers;

use Ergy\Slim\Annotations\Controller as BaseController;
use Propel\Runtime\Util\PropelModelPager;
use Slim\Http\Response;

class Controller extends BaseController
{
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

    /**
     * @param array $data
     * @param PropelModelPager|null $paginate
     * @param null $offsets
     * @return Response
     */
    public function successToJson($data = [], PropelModelPager $paginate = null, $offsets = null)
    {
        $output = [
            'status' => 200,
            'statusText' => 'OK',
            'data' => $data,
        ];

        if (!is_null($paginate)) {
            $output['paginate'] = [
                'count' => $paginate->count(),
                'firstIndex' => $paginate->getFirstIndex(),
                'firstPage' => $paginate->getFirstPage(),
                'lastIndex' => $paginate->getLastIndex(),
                'lastPage' => $paginate->getLastPage(),
                'links' => $paginate->getLinks(),
                'nbResults' => $paginate->getNbResults(),
                'nextPage' => $paginate->getNextPage(),
                'maxPerPage' => $paginate->getMaxPerPage(),
                'page' => $paginate->getPage(),
                'previousPage' => $paginate->getPreviousPage(),
            ];
        }

        if (!is_null($offsets)) {
            $output['offsets'] = [
                'more' => $offsets['more'],
                'offset' => $offsets['offset']
            ];
        }

        return $this->response->withJson($output, 200);
    }

    /**
     * @param array $error
     * @return Response
     */
    public function failToJson($error = [])
    {
        $output = [
            'status' => 400,
            'statusText' => 'FAIL',
            'error' => $error,
        ];

        return $this->response->withJson($output, 400);
    }
}