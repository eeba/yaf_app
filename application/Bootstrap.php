<?php
class Bootstrap extends Yaf\Bootstrap_Abstract{

    public function _initPlugin(\Yaf\Dispatcher $dispatcher) {

    }

    /**
     * 在此处注册非YAF的autoload
     */
    public function _initBaseLoader() {
        //引入三方类库
        \Yaf\Loader::import(LIB . '/vendor/autoload.php');
        //注册自动加载类
        spl_autoload_register(array('Base\Loader', 'autoLoader'));
    }

    /**
     * 初始化环境
     * @param \Yaf\Dispatcher $dispatcher
     */
    public function _initEnv(\Yaf\Dispatcher $dispatcher){
        \Base\Env::init($dispatcher->getRequest());
    }

    /**
     * 开启debug
     */
    public function _initBaseDebug(){
        if (DEBUG || (\Base\Env::getEnvName() === APP_ENVIRON_DEV || \Base\Env::getEnvName() === APP_ENVIRON_TEST)) {
//            ini_set('display_errors', true);
//            ini_set('xdebug.var_display_max_depth', 10);
//            error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
        }
    }
}