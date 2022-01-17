<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        $token = auth('api')->attempt($request->all(['email', 'password']));

        if($token) {
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
    }

    public function logout() {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
    public function refresh() {
        $token = auth('api')->refresh();
        return response()->json(['token' => $token], 200);
    }
    public function me() {
        return response()->json(['user' => auth()->user()], 200);
    }
}
