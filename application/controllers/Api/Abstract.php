<?php

use Http\Request;
use Base\Exception;

abstract class Controller_Api_Abstract extends Common\ApiAbstract {

    public $app_key;
    public $app_id;

    public function before() {
        echo Base\Env::$controller;
        //访问频率限制
        $ret = (new Security\Freq())->add('access_times', Base\Env::$controller, 5, 5);
        if (!$ret) {
            throw new Exception('The frequency of access is too fast', 9999999);
        }
    }

    /**
     * 接口权限验证
     *
     * @throws Exception
     */
    public function _auth() {
        //验签参数判断
        if (!Request::get("app_key") || !Request::get('m') || !Request::get('t')) {
            throw new Exception("msg.system.illegal_request");
        }

        //验签参数超时
        if (time() - Request::get('t') > 600) {
            throw new Exception("msg.system.request_expired");
        }

        //app_key验证
        $this->app_key = Request::get("app_key");
        if (!preg_match('/^[a-zA-Z0-9_]{1,32}$/', $this->app_key)) {
            throw new Exception('validate.illegal_app_key');
        }

        $app_info = (new \Data\App\Base())->getInfoByAppKey($this->app_key);
        $this->app_id = $app_info['id'];
        if (!$this->app_id) {
            throw new Exception('error.api.illegal_app_key');
        }

        //签名验证
        $method = strtoupper(Request::getHttpMethod());
        if ($method == 'GET') {
            unset($_GET['app_key'], $_GET['m'], $_GET['t']);
            $param = $_GET;
        } else {
            $param = $_POST;
        }
        ksort($param);
        $encode_param = implode("", $param);
        $sign = false;
        foreach ($app_info['secret'] as $app_secret) {
            if (Request::get('m') == md5($this->app_key . Request::get('t') . $app_secret . $encode_param)) {
                $sign = true;
            }
        }
        if ($sign) {
            throw new Exception('error.api.signature_verification_failed');
        }

        //接口权限验证
        if (!in_array(get_class($this), $app_info['api'])) {
            throw new Exception('error.api.unauthorized_access');
        }
    }
}