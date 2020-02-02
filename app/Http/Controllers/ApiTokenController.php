<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class ApiTokenController extends Controller
{
    public function show(Request $request, Response $response)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|string|max:256",
            "password" => "required|string|max:256",
        ]);

        $errorBag = new MessageBag();

        if ($validator->fails()) {
            return response()
                ->json([
                    "errors" => $validator->errors()
                ], 422);
        }

        $data = $validator->validated();

        $authIsSuccess = Auth::guard()->attempt([
            "username" => $data["username"],
            "password" => $data["password"],
        ]);

        if (!$authIsSuccess) {
            return response()
                ->json([
                    "errors" => $errorBag->add("username", trans("auth.failed"))
                ], 403);
        }

        /** @var User $user */
        $user = Auth::guard()->user();
        $token = Str::random(60);
        $user->update(["api_token" => hash('sha256', $token)]);

        return [
            "token" => $token,
            "username" => $user->username,
            "name" => $user->name,
        ];
    }
}
