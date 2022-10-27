<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAuthRequest;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request): Response
    {
        if (Auth::attempt($request->validated())) {
            $expiredAt = CarbonImmutable::now()->add(env('API_TOKEN_EXPIRES_IN', '15minute'));
            $result = [
                'token' => Auth::user()->createToken('api', expiresAt: $expiredAt)
                    ->plainTextToken,
                'expired_at' => $expiredAt->toDateTimeString(),
            ];
        }

        return response($result ?? [
            'message' => 'The provided password does not match our records',
        ], isset($result) ? Response::HTTP_OK : Response::HTTP_UNAUTHORIZED);
    }
}
