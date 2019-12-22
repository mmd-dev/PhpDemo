<?php

require 'Request.php';

$payRequest = new PayRequest();

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $payRequest->url());
curl_setopt($curl, CURLOPT_POST, TRUE);
curl_setopt($curl, CURLOPT_POSTFIELDS, $payRequest->requestParams());

$output = curl_exec($curl);
echo $output;
curl_close($curl);