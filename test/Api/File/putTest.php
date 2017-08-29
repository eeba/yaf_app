<?php

/**
 * Created by PhpStorm.
 * User: mfhj-dz-001-279
 * Date: 2017/4/19
 * Time: 下午4:27
 */
class putTest extends \Base\TestCase {

    /**
     * @dataProvider addProvider
     */
    public function testAdd($data) {
        $path = '/api/file/put';
        $ret = $this->request()->request('post', $path, $data);
        print_r(json_decode($ret, true));
    }


    public function addProvider() {
        return array(
            array(
                array(
                    'multipart' => array(
                        array(
                            'name' => 'field_name',
                            'contents' => 'abc'
                        ),
                        array(
                            'name' => 'file_name',
                            'contents' => fopen('/path/to/file', 'r')
                        ),
                        array(
                            'name' => 'other_file',
                            'contents' => 'hello',
                            'filename' => 'filename.txt',
                            'headers' => array(
                                'X-Foo' => 'this is an extra header to include'
                            )
                        )
                    )
                )
            )
        );
    }
}
