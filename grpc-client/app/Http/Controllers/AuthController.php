<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Library\AuthServiceClient;
use LoginUserRequest;

class AuthController extends Controller
{
    public function register(){
        return response()->json(["status" => "ok"]);
    }

    public function login(){
        $client = new AuthServiceClient('localhost/server', [
            'credentials' => ChannelCredentials::createInsecure(),
        ]);
    
        $loginRequest = new LoginUserRequest();
        $loginRequest->setUsername($request->input('username'));
        $loginRequest->setPassword($request->input('password'));
    
        list($loginResponse, $status) = $client->login($loginRequest)->wait();
    
        return response()->json([
            'status' => $status->code,
            'token' => $loginResponse->getToken(),
        ]);

        return response()->json(["status" => "ok"]);
    }
}
