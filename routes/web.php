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



//$router->get('user/{id}', 'UserController@show');
$router->get('/api/recipients', 'VoucherController@listRecipients');
$router->post('/api/generateVouchers', 'VoucherController@generateVouchers');


$router->get('/api/recipients2', function () use ($router) {    
    // $recipientList = App\Recipient::all();
    // return $recipientList;
    //var $service = new VoucherService(App\Voucher, App\Offer, App\Recipient);
    
    //$service = App::make('VoucherService');
    //return $service->listRecipients();
});
