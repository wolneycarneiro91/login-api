<?php

use App\Http\Utils\DefaultResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::post('users',[App\Http\Controllers\UserController::class,'store']);
Route::prefix('auth')->group(function(){        
    Route::post('login',[App\Http\Controllers\Auth\Api\LoginController::class,'login']);
});
Route::group(['middleware' => 'auth:sanctum'], function () {
    
    Route::post('/produtos', function (DefaultResponse $defaultResponse, Request $request) {
        $request['chaveAPI'] = env('CHAVE_API');        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
        ])->post(config('microservices.avaliable.micro_01.url') . '/api/produtos', $request->all());
        return $defaultResponse->response($response); 
    });
    
    // Route::get('/produtos', function (DefaultResponse $defaultResponse, Request $request) {
    //     $request['chaveAPI'] = env('CHAVE_API');
    //     dd($request);
    //     $response = Http::withHeaders([
    //         'Accept' => 'application/json',
    //     ])->get(config('microservices.avaliable.micro_01.url') . '/api/produtos', $request->all());
    //     return $defaultResponse->response($response); 
    // });    
    Route::post('logout',[App\Http\Controllers\Auth\Api\LoginController::class,'logout']);    


});

Route::get('autenticar',[App\Http\Controllers\Auth\Api\RegisterController::class,'verifyPermission'])->middleware('auth:sanctum');





