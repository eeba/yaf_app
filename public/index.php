<?php
header("Content-type:text/html; charset=utf-8");
header('Pragma: no-cache', false);

include dirname(dirname(__FILE__)) . "/conf/init.php";
$app  = new Yaf\Application(CONF_PATH . "/application.ini");
$app->bootstrap()->run();