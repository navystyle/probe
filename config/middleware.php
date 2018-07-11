<?php

$app->add(new \Tuupola\Middleware\JwtAuthentication([
    'path' => '/api',
//    'ignore' => ['/api/token', '/admin/ping'],
//    'logger' => $logger, // get container['logger']
    'attribute' => 'decoded_token_data',
    'secret' => $conf['jwt.secret'],
    'secure' => true,
    'relaxed' => ['localhost', $conf['app.host']],
    'algorithm' => [
        $conf['jwt.algorithm']
    ],
    'error' => function ($response, $args) {
        $data["status"] = "error";
        $data["message"] = $args["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    },
]));