<?php
namespace Job\Daemon\Img;

use Thread\Utils;

class UploadQiniu extends \Thread\Worker{
    protected $whileSleep = 10;
    public function process(){
        Utils::echoInfo(time() . '??');
    }
}