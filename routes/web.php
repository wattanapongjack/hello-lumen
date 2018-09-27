<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/hello/world', function () {
    return 'Hello world!';
});

$router->get('/hello/{name}', ['middleware' => 'hello', function ($name) {
    return "Hello {$name}";
}]);

$router->get('/request', function (Illuminate\Http\Request $request) {
    return "Hello " . $request->get('name', 'stranger');
});

$router->get('/response', function (Illuminate\Http\Request $request) {
    if ($request->wantsJson()) {
        return response()->json(['greeting' => 'Hello stranger']);
    }

    return (new Illuminate\Http\Response('Hello stranger', 200))
        ->header('Content-Type', 'text/plain');
});

$router->get('/books', 'BooksController@index');
$router->get('/books/{id:[\d]+}', [
    'as' => 'books.show',
    'uses' => 'BooksController@show'
]);
$router->post('/books', 'BooksController@store');
$router->put('/books/{id:[\d]+}', 'BooksController@update');