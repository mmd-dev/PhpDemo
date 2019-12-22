<?php

include_once 'Request.php';
include_once 'Http.php';

$payRequest = new PayRequest();
$response = Http::post($payRequest);