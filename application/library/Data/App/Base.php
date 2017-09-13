<?php
namespace Data\App;

use Data\Data;
use Dao\Db\App\Base as DbAppBase;
use Dao\Cache\App\Base as CacheAppBase;

class Base extends Data{

    public function getInfoByAppKey($app_key){
        $cache_app_base = new CacheAppBase();
        $info = $cache_app_base->getBaseInfo($app_key);
        if(!$info) {
            $info = (new DbAppBase())->find(['app_key' => $app_key]);
            $cache_app_base->setBaseInfo($app_key, $info);
        }
        return $info;
    }



}