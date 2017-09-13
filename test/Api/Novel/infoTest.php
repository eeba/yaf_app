<?php

/**
 * Created by PhpStorm.
 * User: mfhj-dz-001-279
 * Date: 2017/4/19
 * Time: 下午4:27
 */
class addTest extends \Base\TestCase {
    public $app_key = '38ca8808';

    /**
     * @dataProvider addProvider
     */
    public function testAdd($data){
        $path = '/api/novel/info';

        $t = time();
        $m = $this->getSign($t, $data);
        $path .= $path . "?t={$t}&m={$m}&app_key=".$this->app_key;
        $ret = $this->request()->request('post',$path, $data);
        print_r(json_decode($ret));
    }

    public function getSign($t, $data){
        ksort($data);
        $app_info = (new \Service\App())->getAppInfo($this->app_key);
        print_r($app_info['ext']['secret'][0]);

    }


    public function addProvider(){
        return array(
            array(
                array(
                    'id'=>'1000'
                )
            )
        );
    }
}
