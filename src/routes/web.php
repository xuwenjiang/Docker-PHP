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

    /**
     * Document [Configuration] Play with configurations.
     */
    echo env('MYNAME') . '<br/>';
    echo config('test.test_key') . '<br/>';
    echo app()->environment() . '<br/>';

    return $router->app->version();
});

$router->get('about', function () {
    return 'about';
});

/**
 * Document [Routing]
 *
 * $router->get($uri, $callback);
 * $router->post($uri, $callback);
 * $router->put($uri, $callback);
 * $router->patch($uri, $callback);
 * $router->delete($uri, $callback);
 * $router->options($uri, $callback);
 */
$router->get('guitar', function () {
    return 'you call get guitar';
});

$router->get('guitar/{id}', function ($id) {
    return 'you call get guitar with id: ' . $id;
});

$router->post('guitar/{guitarId}/review/{reviewId}', function ($guitarId, $reviewId) {
    return 'you call get guitar with id: ' . $guitarId . ' and review id: ' . $reviewId;
});

/**
 * Document [Routing]
 * additional parameter. Interesting is it does not conflict with 1st get, only 2nd above
 */
//$router->get('guitar[/{s}]', function ($name = null) {
//    return $name;
//});

/**
 * Document [Routing]
 * regular expression
 */
$router->get('regular/{param:[A-Za-z]+}', function ($param = null) {
    return 'character param: '. $param;
});

$router->get('regular/{param:[0-9]+}', function ($param = null) {
    return 'number param: '. $param;
});

/**
 * Document [Routing]
 * named
 */
$router->get('hello', ['as' => 'greeting', function () {
    return 'hello world';
}]);

$router->get('www', function () {
    return redirect()->route('greeting');
});