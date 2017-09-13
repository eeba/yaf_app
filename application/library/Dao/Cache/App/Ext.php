<?php
namespace Dao\Cache\App;

use Dao\Cache\Cache;

class Ext extends Cache{

    public function __construct(){
        $this->setConfig('ExtInfo', strtoupper(APP.'_EXT_INFO'));
    }
}