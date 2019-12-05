<?php

namespace App\Http\Controllers;

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
            $errorBag = $errorBag->merge($validator->errors());

            return [
                "errors" => $errorBag
            ];
        }

        $data = $validator->validated();

        $authIsSuccess = Auth::guard()->attempt([
            "username" => $data["username"],
            "password" => $data["password"],
        ]);

        if (!$authIsSuccess) {
            $errorBag->add("username", trans("auth.failed"));

            return [
                "errors" => $errorBag
            ];
        }

        $token = Str::random(60);

        Auth::guard()->user()->update([
            "api_token" => hash('sha256', $token)
        ]);

        return [
            "token" => $token
        ];
    }
}
