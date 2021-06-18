<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return response()->json([
        "message" => config('app.name') . " - " . $router->app->version(),
        "status" => 200,
    ], 200);
});

/**
 * Books Routes
 *
 */
$router->group(['prefix' => 'books'], function () use ($router) {
    $router->get("/", "BooksController@index");
    $router->post("/", "BooksController@store");

    // Author id prefix routes
    $router->group(['prefix' => "{author}"], function () use ($router) {
        $router->get("/", "BooksController@show");
        $router->put("/", "BooksController@update");
        $router->delete("/", "BooksController@destroy");
    });
});
