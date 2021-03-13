<?php

// include database and object files
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/config/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/firebase/php-jwt/src/admin/user.php/BeforeValidException.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/firebase/php-jwt/src/admin/user.php/ExpiredException.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/firebase/php-jwt/src/admin/user.php/SignatureInvalidException.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/firebase/php-jwt/src/admin/user.php/JWT.php';
require $_SERVER['DOCUMENT_ROOT'] . '/api/vendor/autoload.php';

use \Firebase\JWT\JWT;

class ValidateToken
{
    public $login;
    public $jwt;

    public function __construct()
    {
    }

    public function create()
    {
        $key = SECRET_KEY;
        $issued_at = time();
        $expiration_time = $issued_at + (2592000);
        $token = array("iat" => $issued_at, "exp" => $expiration_time, "data" => array("login" => $this->login));
        // set response code
        http_response_code(200);
        // generate jwt
        $jwt = JWT::encode($token, $key);

        return $jwt;

    }

    public function check()
    {
        if ($this->jwt) 
        {
            // if decode succeed, show user details
            try 
            {
                // decode jwt
                $decoded = JWT::decode($this->jwt,SECRET_KEY, array(ALGORITHM));

                return true;
            }
            // if decode fails, it means jwt is invalid
            catch(Exception $e) 
            {
                return false;
            }
        } 
        else 
        {
            return false;
        }
    }
}
