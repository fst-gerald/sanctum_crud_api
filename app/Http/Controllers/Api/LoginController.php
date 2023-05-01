<?php

namespace App\Http\Controllers\Api;

use App\Events\LoginHistory;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginController extends Controller
{
    public function getSanctumTokenFromCredentials(Request $request)
    {
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
            'device_id' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            $message = ['message' => 'The provided credentials are incorrect.'];

            return response()->json($message, ResponseAlias::HTTP_BAD_REQUEST);
        }

        $user->tokens()->where('name', $request->device_id)->delete();

        event(new LoginHistory($user));

        return $user->createToken($request->device_id)->plainTextToken;
    }
}
