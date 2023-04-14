<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LoginUserRequest;
use RegisterUserRequest;

class AuthController extends Controller
{
    protected $client;

    public function __construct()
    {
        // create grpc client
        $this->client = new \AuthServiceClient('grpc-server-node:50051', ['credentials' => \Grpc\ChannelCredentials::createInsecure()]);
    }

    public function register(Request $request){
        
        $registerRequest = new RegisterUserRequest();
        $registerRequest->setUsername($request->input('username'));
        $registerRequest->setPassword($request->input('password'));
    
        list($registerResponse, $status) = $this->client->RegisterUser($registerRequest)->wait();
        // dd($status);
        return response()->json([
            'status' => $status->code,
            'message' => $registerResponse->getMessage(),
        ]);
    }

    public function login(Request $request){
        
        $loginRequest = new LoginUserRequest();
        $loginRequest->setUsername($request->input('username'));
        $loginRequest->setPassword($request->input('password'));
    
        list($loginResponse, $status) = $this->client->LoginUser($loginRequest)->wait();
        // dd($status);
        return response()->json([
            'status' => $status->code,
            'token' => $loginResponse->getToken(),
        ]);
    }
}
