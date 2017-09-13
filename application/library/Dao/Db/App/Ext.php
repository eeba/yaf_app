<?php
namespace Dao\Db\App;

use Dao\Db\Db;

class Ext extends Db {

    protected $table = 'app_ext';

    protected $json_field = ['secret', 'api'];

    /**
     * 添加扩展信息
     *
     * @param $data
     * @return bool|int|null
     */
    public function add($data) {
        foreach ($data as $key => $value) {
            if (in_array($key, $this->json_field)) {
                $data[$key] = json_encode($value);
            }
        }

        return self::db()->insert($this->table, $data);
    }

    /**
     * 取扩展信息
     *
     * @param $app_id
     * @return array
     */
    public function getInfoByAppId($app_id) {
        $ext_info = self::db()->select($this->table, ['app_id' => $app_id]);
        $data = [];
        if ($ext_info) {
            foreach ($ext_info as $info) {
                if (in_array($info['key'], $this->json_field)) {
                    $data[$info['key']] = json_decode($info['value'], true);
                } else {
                    $data[$info['key']] = $info['value'];
                }
            }
        }

        return $data;
    }


}