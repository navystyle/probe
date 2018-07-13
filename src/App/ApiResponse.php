<?php

namespace App;


use Propel\Runtime\Util\PropelModelPager;
use Slim\Http\Response;

trait ApiResponse
{
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
            'message' => 'OK',
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

        return $this->response->withHeader("Content-Type", "application/json")
            ->withJson($output, 200);
    }

    public function failToJson($message, $code = 500)
    {
        $output = [
            'status' => $code,
            'message' => $message,
        ];

        return $this->response->withHeader("Content-Type", "application/json")
            ->withJson($output, $code);
    }
}