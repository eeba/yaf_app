<?php
namespace Data\App;

use Data\Data;
use Dao\Db\App\Base as DbAppBase;

class Base extends Data{

    public function getInfoByAppKey($app_key){

        $info = (new DbAppBase())->find(['app_key' => $app_key]);

        return $info;

    }



}