<?php

class Controller_Main extends Common\AdminAbstract {

    /**
     * @name 首页
     * @return bool
     */
    public function indexAction() {
        if($_SESSION['app_info']['is_admin'] ==1){
            $this->redirect('/admin/novel/list');
            return true;
        }
        $today_register_user = (new \Data\Novel\WeChatMember())->getCountByCTime(date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59'));
        $month_register_user = (new \Data\Novel\WeChatMember())->getCountByCTime(date('Y-m-01 00:00:00'),date('Y-m-d 23:59:59'));
        $total_register_user = (new \Data\Novel\WeChatMember())->getCountByCTime(date('Y-07-01 00:00:00'),date('Y-m-d 23:59:59'));
        $today_recharge = (new \Data\Novel\RechargeLog())->getCountByCTime(date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59'));
        $month_recharge = (new \Data\Novel\RechargeLog())->getCountByCTime(date('Y-m-01 00:00:00'),date('Y-m-d 23:59:59'));
        $total_recharge = (new \Data\Novel\RechargeLog())->getCountByCTime(date('Y-07-01 00:00:00'),date('Y-m-d 23:59:59'));
        $today_consume = (new \Data\Novel\ConsumeLog())->getCountByCTime(date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59'));
        $month_consume = (new \Data\Novel\ConsumeLog())->getCountByCTime(date('Y-m-01 00:00:00'),date('Y-m-d 23:59:59'));
        $total_consume = (new \Data\Novel\ConsumeLog())->getCountByCTime(date('Y-07-01 00:00:00'),date('Y-m-d 23:59:59'));
        $this->response['today_register_user'] = $today_register_user?:0;
        $this->response['month_register_user'] = $month_register_user?:0;
        $this->response['total_register_user'] = $total_register_user?:0;
        $this->response['today_recharge'] = $today_recharge?:0;
        $this->response['month_recharge'] = $month_recharge?:0;
        $this->response['total_recharge'] = $total_recharge?:0;
        $this->response['today_consume'] = $today_consume?:0;
        $this->response['month_consume'] = $month_consume?:0;
        $this->response['total_consume'] = $total_consume?:0;
        $this->response['chart'] = json_encode((new \Service\Statistics())->getAdStatisticsThisMonth());
    }
}