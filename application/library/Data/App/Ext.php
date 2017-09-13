<?php
namespace Data\App;

use Data\Data;
use Dao\Db\App\Ext as DbAppExt;
use Dao\Cache\App\Ext as CacheAppExt;

class Ext extends Data {

    public function getInfoByAppId($app_id) {
        $cache_app_base = new CacheAppExt();
        $info = $cache_app_base->getExtInfo($app_id);
        if(!$info) {
            $info = (new DbAppExt())->getInfoByAppId($app_id);
            $cache_app_base->setExtInfo($app_id, $info);
        }
        return $info;
    }


}