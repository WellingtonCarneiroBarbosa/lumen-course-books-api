<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return response()->json([
        "message" => config('app.name') . " - " . $router->app->version(),
        "status" => 200,
    ], 200);
});
