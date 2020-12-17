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



$router->get('/', ['middleware' => 'auth', function () {
    return "hello world";
}]);


$router->group(['middleware' => 'auth'], function () use ($router) {

    $router->get('user/show', 'UserController@show');
    $router->put('user/update', 'UserController@update');
    $router->delete('user/delete', 'UserController@destroy');

    // Product routes
    $router->get('products', 'ProductController@index');
    $router->get('products/{id}', 'ProductController@show');
    
    // Category routes
    $router->get('categories', 'CategoryController@index');

    // Orders routes
    $router->get('orders', 'OrderController@index');
    $router->get('orders/create', 'OrderController@store');

    // Order Items routes
    $router->get('orderitems', 'OrderItemsController@index');
    
});


// Reset de senha
$router->post('sendforgotpasswordmail', 'ResetPasswordController@sendForgotPasswordMail');
$router->get('forgotpassword', 'ResetPasswordController@create');
$router->post('resetpassword', [
    'as' => 'resetpassword', 'uses' => 'ResetPasswordController@resetPassword'
]);

// Autenticação, envio de confrimação e reenvio 
$router->post('user/signin', ['middleware' =>  'verify_email', 'uses' => 'RegisterController@signIn']);
$router->post('user/signup', 'RegisterController@signUp');
$router->get('user/verifyemail', 'VerifyEmailController@verifyEmail');
$router->get('user/resendmail', 'VerifyEmailController@resendMail');

