<?php

include_once 'Request.php';

class Http {
    public static function post(Request $request) {
        $curl = curl_init();
        
        curl_setopt($curl, CURLOPT_URL, $request->url());
        curl_setopt($curl, CURLOPT_POST, TRUE);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $request->requestParams());

        $output = curl_exec($curl);
        echo $output;
        curl_close($curl);
    }
}
