<?php

namespace Controllers;

require("./vendor/autoload.php");

use WpOrg\Requests\Requests as Req;

class Request
{
    private $access_token;
    private $token_type;

    function __construct()
    {
        $url = "https://api.baubuddy.de/index.php/login";
        $headers = [
            "Authorization" => "Basic QVBJX0V4cGxvcmVyOjEyMzQ1NmlzQUxhbWVQYXNz",
            "Content-Type" => "application/json"
        ];
        $data = "{\"username\":\"365\", \"password\":\"1\"}";

        $response = Req::post($url, $headers, $data);
        $body = json_decode($response->body);

        $this->access_token = $body->oauth->access_token;
        $this->token_type = $body->oauth->token_type;
    }

    public function makeRequest($uri)
    {
        $headers = [
            "Authorization" => "" . $this->token_type . " " . $this->access_token . "",
            "Content-Type" => "application/json",
        ];
        $response = Req::get($uri, $headers);
        $body = $response->body;

        return $body;
    }
}