<?php
//初始化
date_default_timezone_set('Asia/Shanghai');
define('APP_START_TIME', microtime(1));
define('EXT', '.php');
define('DEBUG', false);
session_start();

//路径定义
define("DS",            DIRECTORY_SEPARATOR);
define("ROOT_PATH",     dirname(dirname(__FILE__)));
define("APP_PATH",      ROOT_PATH.'/application');
define("CONF_PATH",     ROOT_PATH.'/conf');
define("LOG_PATH",      ROOT_PATH . '/data/logs');
define('LIB',           ROOT_PATH.'/../yaf_lib'); //yaf_lib公用目录
define('VIEW_PATH',     APP_PATH.'/views/');

//应用
define("APP", 'lhxs');//英文标识
define("APP_NAME", 'xxxxx');//不限制
define("HOST", "https://xxx");
define("CDN", "https://cdn.linexuc.com");

// php.ini定义
ini_set('yaf.library', LIB);
ini_set('yaf.use_spl_autoload', 'On');