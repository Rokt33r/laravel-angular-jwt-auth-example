<?php
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * @return \Tymon\JWTAuth\JWTAuth
 */
function jwt(){
    return app('Tymon\JWTAuth\JWTAuth');
}

/**
 * @return \App\User
 */
function currentUser(){
    try{
        $user = jwt()->parseToken()->toUser();
    }catch(JWTException $e){
        return null;
    }

    return $user;
}