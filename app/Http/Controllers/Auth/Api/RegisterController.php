<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    public function autenticado()
    {
         $user_key = Auth::user()->user_key;
         return response()->json(['message'=>"autenticado","user_key"=> $user_key],200) ;
           
    }        

}
