<?php
namespace Dao\Db;

use Http\Request;

class Db {
    protected static $db = '';
    protected $table = '';
    protected $field = [];

    public static function db() {
        if (!self::$db) {
            self::$db = new \Db\MySQL();
        }
        return self::$db;
    }

    /**
     * 特殊字符转义
     *
     * @param $data
     * @return mixed
     */
    public function security($data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars($value);
        }
        return $data;
    }

    /**
     * 特殊字符反转义
     *
     * @param $data
     * @return mixed
     */
    public function deSecurity($data) {
        foreach ($data as &$value) {
            $value = htmlspecialchars_decode($value);
        }
        return $data;
    }

    public function filter_filed($data) {
        if ($data && $this->field) {
            foreach ($data as $key => $value) {
                if (!in_array($key, $this->field)) {
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }

    public function begin() {
        self::db()->begin();
    }

    public function commit() {
        self::db()->commit();
    }

    public function rollback() {
        self::db()->rollback();
    }

    /**
     * 添加
     *
     * @param $data
     * @return bool|int|null
     */
    public function add($data) {
        return self::db()->insert($this->table, $this->filter_filed($data));
    }

    public function update($data, $where) {
        return self::db()->update($this->table, $this->filter_filed($data), $this->filter_filed($where));
    }

    public function findById($id) {
        return self::db()->find($this->table, ['id' => $id]);
    }

    public function find($data = []){
        return self::db()->find($this->table, $data);
    }

    public function getList($data = [], $cols='*'){
        return self::db()->select($this->table, array_filter($data), $cols);
    }

    public function dataTable($param = [], $order = [], $cols = '*') {
        $param = array_filter($param);
        $sql = "select {$cols} from {$this->table} where ";
        $count_sql = "select count(1) num from {$this->table} where ";
        $where = $params = [];
        $where[] = 1;
        foreach ($param as $key => $value) {
            if (is_array($value)) {
                if (isset($value['start']) || isset($value['end'])) {
                    if ($value['start']) {
                        $where[] = "{$key} >= {$value['start']}";
                        $params[] = $key;
                        $params[] = $value['start'];
                    }
                    if ($value['end']) {
                        $where[] = "{$key} <= {$value['end']}";
                        $params[] = $key;
                        $params[] = $value['end'];
                    }
                } elseif (isset($value['like'])) {
                    $where[] = "{$key} like '%{$value['like']}%'";
                } elseif (isset($value['neq'])) {
                    $where[] = "{$key} != '{$value['neq']}'";
                } else {
                    $where[] = "{$key} in (" . implode(',', $value) . ")";
                    $params = array_merge($params, $value);
                }
            } else {
                $where[] = "{$key} = {$value}";
                $params[] = $value;
            }
        }
        $sql .= implode(' and ', $where);
        $count_sql .= implode(' and ', $where);
        $count = self::db()->query($count_sql, $params);
        $count = $count[0]['num'];

        if (!empty($order)) {
            $order_sql = [];
            foreach ($order as $key => $value) {
                $order_sql[] = " {$key} {$value}";
            }
            $sql .= " order by " . implode(',', $order_sql);
        }

        $start = Request::request('start', 0);
        $length = Request::request('length', 10);
        $sql .= " limit {$start},{$length}";

        $data['data'] = self::db()->query($sql, $params);
        $data['draw'] = Request::request('draw');
        $data['iTotalRecords'] = $count;
        $data['iTotalDisplayRecords'] = $count;

        return $data;
    }

}