<?php

class Controller_Index extends Common\AppAbstract{
    public function params() {
        return [];
    }

    public function action() {
        $list = new Base\Node(ROOT_PATH . '/application/controllers/Api',['Controller_Api_Abstract']);
        foreach ($list->nodeList() as $key =>$value){
            echo $value['name'];
            echo strtolower(str_replace('_','/',$key)) . PHP_EOL;
        }
    }
}