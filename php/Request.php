<?php

include_once 'AES.php';

class Request {
    public $mKey = "b823de815c791ec1d3906f6bc7fbc50e";
    public $mMerchantCode = "52302";
    public $mCharacter = "UTF-8";

    public function url() {
        return "";
    }

    public function requestParams() {
        $params = $this->makeRequestParams();
        var_dump($params);
        $sign = $this->generateSign($params);
        $params['sign'] = $sign;
        return $params;
    }

    protected function makeRequestParams() {
        return array();
    }

    private function generateSign($params) {
        $str = "";
        ksort($params);
        foreach($params as $key => $value) {
            $str = $str."&".$key."=".$value;
        }
        $str = substr($str, 1);
        $str = $str."&key=".$this->mKey;
        return md5($str);
    }
}

class PayRequest extends Request {

    public function url() {
        return "http://pay.longpay188.com/create.html";
    }

    protected function makeRequestParams() {
        $milliseconds = round(microtime(true) * 1000);
        return array(
            'inform_url' => 'http://www.abc.com',
            'input_charset' => 'UTF-8',
            'merchant_code' => $this->mMerchantCode,
            'order_amount' => AES::encrypt("90.00", $this->mKey),
            'order_no' => $milliseconds,
            'order_time' => '2019-12-20 18:38:11',
            'pay_type' => '1'
        );
    }
}

class QueryMoneyRequest extends Request {

    public function url() {
        return "http://pay.longpay188.com/queryMoney.html";
    }

    protected function makeRequestParams() {
        return array(
            'input_charset' => 'UTF-8',
            'merchant_code' => $this->mMerchantCode,
            'query_time' => '2019-12-20 18:38:11'
        );
    }
}
