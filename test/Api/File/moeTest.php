<?php

/**
 * Created by PhpStorm.
 * User: mfhj-dz-001-279
 * Date: 2017/4/19
 * Time: 下午4:27
 */
class addTest extends \Base\TestCase {

    /**
     * @dataProvider addProvider
     */
    public function testAdd($data){
        $path = '/api/file/moe';
        $ret = $this->request()->request('post',$path, $data);
        print_r(json_decode($ret, true));
    }


    public function addProvider(){
        return array(
            array(
                array(
//                    'page'=>1,
//                    'num'=>20,
//                    'type'=>'gif',
                )
            )
        );
    }
}
