<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\RegisterResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated             = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json([
            'message'     => 'User created successfully',
            'status_code' => Response::HTTP_CREATED,
            'data'        => new RegisterResource($user),
        ], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (! Auth::attempt($credentials)) {
            return response()->json([
                'message'     => 'Invalid credentials',
                'status_code' => Response::HTTP_UNAUTHORIZED,
            ], Response::HTTP_UNAUTHORIZED);
        }
        $user  = Auth::user();
        $token = $user->createToken('AccessToken')->plainTextToken;

        return response()->json([
            'message'     => 'User logged in successfully',
            'token_type'  => 'Bearer',
            'token'       => $token,
            'status_code' => Response::HTTP_OK,
            'data'        => new LoginResource($user),
        ], Response::HTTP_OK)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ]);
    }
}
