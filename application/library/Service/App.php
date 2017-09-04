<?php

namespace Service;

use Data\App\Base as DataAppBase;

class App {


    public function getAppInfo($app_key) {
        $base_info = (new DataAppBase())->getInfoByAppKey($app_key);
        //todo 加上扩展信息
        return $base_info;
    }

}