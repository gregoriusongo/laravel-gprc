<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(){
        return response()->json(["status" => "ok"]);
    }

    public function login(){
        return response()->json(["status" => "ok"]);
    }
}
