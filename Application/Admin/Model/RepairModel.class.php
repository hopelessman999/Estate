<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/12
 * Time: 15:05
 */

namespace Admin\Model;


use Think\Model;

class RepairModel extends Model
{

    protected $_validate = array(
        array('name', 'require', '姓名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('tel', '/^111(38)*/', '请输入正确的电话号码', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
//        array('name', 'require', '姓名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
//        array('url', 'require', 'URL不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
    array('create_time', NOW_TIME, self::MODEL_INSERT),
    array('number', 'NUM'.NOW_TIME, self::MODEL_INSERT),
    array('status', '1', self::MODEL_INSERT),
);
}