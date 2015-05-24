<?php

use Illuminate\Http\Request;

trait TestHelpersTrait{

    public function callWithAccessToken($accessToken, $uri, $method, $parameters = [], $cookies = [], $files = [],
                                        $server = [], $content = null){
        $server['HTTP_Authorization'] = 'Bearer ' . $accessToken;

        return $this->call($uri, $method, $parameters, $cookies, $files, $server, $content);
    }

    public function authCall(\App\User $user, $uri, $method, $parameters = [], $cookies = [], $files = [],
                             $server = [], $content = null)
    {
        $accessToken = JWTAuth::fromUser($user);

        return $this->callWithAccessToken($accessToken, $uri, $method, $parameters, $cookies, $files,
            $server, $content);
    }

    public function grabJson($json, $jsonPath)
    {
        if(is_string($json)) $json = json_decode($json, true);
        return (new \Flow\JSONPath\JSONPath($json))->find($jsonPath);
    }

    public function matchJson($json, $jsonPath)
    {
        if(is_string($json)) $json = json_decode($json, true);

        $message = 'The given JSON doesn\'t match.'.PHP_EOL.PHP_EOL.'Given =>'.PHP_EOL.json_encode($json);

        return $this->assertTrue(count((new \Flow\JSONPath\JSONPath($json))->find($jsonPath)->data()) > 0, $message);
    }

}