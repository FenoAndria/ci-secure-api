<?php

use App\Models\UserModel;
use Config\Services;
use Firebase\JWT\JWT;

function getJWTFromRequest($authenticationHeader)
{
    if (is_null($authenticationHeader)) {
        throw new Exception('Missing or Invalid JWT in request');
    }
    return explode(' ', $authenticationHeader)[1];
}

function validateJWTFromRequest(string $encodeToken)
{
    $key = Services::getSecretKey();
    // return $key;
    $decodedToken = JWT::decode($encodeToken, $key, 'HS256');
    $userModel = new UserModel();
    $userModel->finduserByEmailAddress($decodedToken->email);
}

function getSignedJWTForuser(string $email)
{
    $issuedAtTime = time();
    $tokenTimeToLive = getenv('JWT_TIME_TO_LIVE');
    $tokenExpiration = $issuedAtTime + $tokenTimeToLive;
    $payload = [
        'email' => $email,
        'iat' => $issuedAtTime,
        'exp' => $tokenExpiration,
    ];
    $jwt = JWT::encode($payload, Services::getSecretKey(), 'HS256');
    return $jwt;
}
