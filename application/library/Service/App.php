<?php

namespace Service;

use Data\App\Base as DataAppBase;
use Data\App\Ext as DataAppExt;

class App {


    public function getAppInfo($app_key) {
        $base_info = (new DataAppBase())->getInfoByAppKey($app_key);
        $ext_info = (new DataAppExt())->getInfoByAppId($base_info['id']);
        $base_info['ext'] = $ext_info;
        return $base_info;
    }

}