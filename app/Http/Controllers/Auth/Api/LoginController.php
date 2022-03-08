<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        //return $this->respondWithToken($user->createAccessToken(), ["user" => $user]);
        $token = $user->createToken('auth_token');
        Log::info('O usuário ' . $user['name'] . ' entrou no sistema');
        return response()->json([
            'data' => [
                'user_key'=> $user['user_key'],
                'token' => $token->plainTextToken
            ]
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        Log::info('O usuário ' . $request->user() . ' foi deslogado no sistema');
        return response()->json(['message' => 'Deslogado'], 201);
    }
    public function logoutAll(User $user)
    {
        $user->tokens()->delete();
        return response()->json(['message' => 'Você foi deslogado de todas as sessões'], 201);
    }
}
