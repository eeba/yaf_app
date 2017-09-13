<?php

use Http\Request;

/**
 * @name 用户信息
 */
class Controller_Api_User_Info extends Controller_Api_Abstract {

    public function params() {
        return array(
            'id' => array(
                'value'  => Request::request('id'),
                'rule'   => 'digit',
                'msg'    => 'msg.novel.book_id_error',
            )
        );
    }

    public function action() {
        $id = $this->params['id'];

    }
}