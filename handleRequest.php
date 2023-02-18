<?php

require("./Controllers/RequestController.php");
use Controllers\Request;

$request = new Request();

if(isset($_POST["url"])) {
    $url = $_POST["url"];

    $response = $request->makeRequest($url);
    echo $response;
}