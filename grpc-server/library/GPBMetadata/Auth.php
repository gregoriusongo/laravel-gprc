<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: auth.proto

namespace GPBMetadata;

class Auth
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        $pool->internalAddGeneratedFile(
            '
�

auth.proto"9
RegisterUserRequest
username (	
password (	"8
RegisterUserResponse
success (
message (	"6
LoginUserRequest
username (	
password (	"D
LoginUserResponse
success (
message (	
token (	2�
AuthService=
RegisterUser.RegisterUserRequest.RegisterUserResponse" 4
	LoginUser.LoginUserRequest.LoginUserResponse" bproto3'
        , true);

        static::$is_initialized = true;
    }
}

