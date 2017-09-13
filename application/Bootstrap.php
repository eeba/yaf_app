<?php
class Bootstrap extends Yaf\Bootstrap_Abstract{

    public function _initPlugin(\Yaf\Dispatcher $dispatcher) {
        $dispatcher->registerPlugin(new Plugin_Session());
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

}