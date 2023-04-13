<?php
// GENERATED CODE -- DO NOT EDIT!

namespace ;

/**
 * Simple auth service for register and login
 */
class AuthServiceClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * @param \RegisterUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function RegisterUser(\RegisterUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/AuthService/RegisterUser',
        $argument,
        ['\RegisterUserResponse', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \LoginUserRequest $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function LoginUser(\LoginUserRequest $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/AuthService/LoginUser',
        $argument,
        ['\LoginUserResponse', 'decode'],
        $metadata, $options);
    }

}
