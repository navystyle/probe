<?php
/**
 * Created by PhpStorm.
 * User: ys-a06
 * Date: 2018. 7. 12.
 * Time: AM 10:44
 */

namespace App;

use Monolog\Logger;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Handlers\AbstractError;
use Throwable;

final class ApiErrorHandler extends AbstractError
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(Request $request, Response $response, Throwable $throwable)
    {
        $this->logger->critical($throwable->getMessage(), [
            'exception' => [
                'code' => $throwable->getCode(),
                'file' => $throwable->getFile(),
                'line' => $throwable->getLine(),
                'trace' => explode("\n", $throwable->getTraceAsString()),
            ],
        ]);

        $status = $throwable->getCode() ?: 500;

        $body = json_encode([
            'status' => $status,
            'message' => $throwable->getMessage(),
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        return $response
            ->withStatus($status)
            ->withHeader("Content-type", "application/json")
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->write($body);
    }
}