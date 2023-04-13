<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LoginUserRequest;

class AuthController extends Controller
{
    public function register(){
        return response()->json(["status" => "ok"]);
    }

    public function login(Request $request){
        $client = new \AuthServiceClient('localhost/server', ['credentials' => \Grpc\ChannelCredentials::createDefault()]);
    
        $loginRequest = new LoginUserRequest();
        $loginRequest->setUsername($request->input('username'));
        $loginRequest->setPassword($request->input('password'));
    
        list($loginResponse, $status) = $client->LoginUser($loginRequest)->wait();
    
        return response()->json([
            'status' => $status->code,
            'token' => $loginResponse->getToken(),
        ]);

        return response()->json(["status" => "ok"]);
    }
}
