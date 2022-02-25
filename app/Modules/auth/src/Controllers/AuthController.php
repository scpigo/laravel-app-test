<?php

namespace App\Modules\auth\src\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Modules\auth\src\Models\UserRefreshToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register', 'refresh']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'statusText' => $validator->errors(),
                'status' => 'error'
            ], 400);
        }

        $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

        return response()->json([
            'data' => [
                'user_id' => $user->id
            ],
            'statusText' => 'Регистрация прошла успешно',
            'status' => 'ok'
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'data' => [],
                'statusText' => $validator->errors(),
                'status' => 'error'
            ], 422);
        }

        if (!$accessToken = auth()->attempt($validator->validated())) {
            return response()->json([
                'data' => [],
                'statusText' => 'Пользователь не авторизирован',
                'status' => 'error'
            ], 401);
        }

        $user = auth()->user();

        $refreshToken = $this->generateRefreshToken($request, $user);

        return response()->json([
            'data' => [
                'user_id' => $user->id,
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken->token,
            ],
            'statusText' => 'Авторизация прошла успешно',
            'status' => 'ok'
        ], 201);
    }

    public function refresh(Request $request)
    {
        $refreshToken = $request->refresh_token;

        $userRefreshToken = UserRefreshToken::firstOrNew(['token' => $refreshToken]);

        if (isset($userRefreshToken)) {
            $date = gmdate('Y-m-d H:i:s');

            if ($date > $userRefreshToken->expires_at) {
                return response()->json([
                    'data' => [],
                    'statusText' => 'Токен просрочен',
                    'status' => 'error'
                ], 401);
            }

            $user = $userRefreshToken->user;

            $accessToken = auth()->refresh();
            $refreshToken = $this->generateRefreshToken($request, $user);

            $userRefreshToken->delete();

            return response()->json([
                'data' => [
                    'user_id' => $user->id,
                    'access_token' => $accessToken,
                    'refresh_token' => $refreshToken->token,
                ],
                'statusText' => 'Токен обновлен',
                'status' => 'ok'
            ], 201);
        }
        else
        {
            return response()->json([
                'data' => [],
                'statusText' => 'Токен не найден',
                'status' => 'error'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $refreshToken = $request->refresh_token;

        $userRefreshToken = UserRefreshToken::firstOrNew(['token' => $refreshToken]);

        if (isset($userRefreshToken)) {
            $date = gmdate('Y-m-d H:i:s');

            if ($date > $userRefreshToken->expires_at) {
                return response()->json([
                    'data' => [],
                    'statusText' => 'Токен просрочен',
                    'status' => 'error'
                ], 401);
            }

            $userRefreshToken->delete();

            auth()->logout();

            return response()->json([
                'data' => [],
                'statusText' => 'Выход из системы',
                'status' => 'ok'
            ], 201);
        }
        else
        {
            return response()->json([
                'data' => [],
                'statusText' => 'Токен не найден',
                'status' => 'error'
            ], 401);
        }
    }

    public function profile()
    {
        return response()->json([
            'data' => auth()->user(),
            'statusText' => 'Данные о пользователе получены',
            'status' => 'ok'
        ], 201);
        
    }

    protected function generateRefreshToken(Request $request, User $user) {
        $refreshToken = Str::random(200);

        $userRefreshToken = UserRefreshToken::create([
            'user_id' => $user->id,
            'token' => $refreshToken,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'expires_at' => gmdate('Y-m-d H:i:s', strtotime('+ 1 MONTH')),
        ]);

        return $userRefreshToken;
    }
}