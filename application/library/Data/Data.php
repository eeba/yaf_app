<?php
/**
 * Created by PhpStorm.
 * User: mfhj-dz-001-279
 * Date: 2017/7/3
 * Time: 下午6:44
 */

namespace Data;

use Dao\Db\Db;
use Ramsey\Uuid\Uuid;
use Hautelook\Phpass\PasswordHash;

class Data {

    public function getUuid(){
        return Uuid::uuid4()->toString();
    }

    /**
     * 密码加密
     *
     * @param $password
     * @return string
     */
    public function encryptPass($password){
        $passwordHasher = new PasswordHash(8,false);
        return $passwordHasher->HashPassword($password);
    }

    /**
     * 密码验证
     *
     * @param $password
     * @param $secret_password
     * @return bool
     */
    public function checkPass($password, $secret_password){
        $passwordHasher = new PasswordHash(8,false);
        return $passwordHasher->CheckPassword($password, $secret_password);
    }
}