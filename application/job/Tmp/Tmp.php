<?php
namespace Job\Tmp;

/**
 * 临时脚本
 * @package Job\Once
 */
class Tmp{

    public function action(){
        \Msg\Msg::getInstance()->send('xxx@xxx.com', '测试', '<h1>这是一封测试邮件</h1>');
    }
}
