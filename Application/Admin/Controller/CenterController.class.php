<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/12
 * Time: 14:23
 */

namespace Admin\Controller;


use Think\Page;

class CenterController extends AdminController
{
    public function index()
    {
        $Model = M('Repair');
        $count = $Model->count();
        $Page = new Page($count,2);//实例化分页类
        $show = $Page->show(); // 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $Model->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
//        $this->assign('pid', $pid);
        $this->meta_title = '报修管理';
        $this->display();
    }
    public function add()
    {
        if(IS_POST){
            $Repair = D('Repair');
//            var_dump($data);exit;
//            $auto = array (
//                array('create_time', NOW_TIME),
//                array('number', 'NUM'.NOW_TIME),
//                array('status', '1'),
//            );
//            $Repair->setProperty("_auto",$auto);
            $data = $Repair->create();
//            var_dump($data);exit;
            if($data){
                $id = $Repair->add();
                if($id){
                    $this->success('新增成功',U('index'));
                    //记录行为
//                    action_log('update_channel', 'channel', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Repair->getError());
            }
        } else {
//            echo 1; exit;
            /* $pid = i('get.pid', 0);
             //获取父导航
             if(!empty($pid)){
                 $parent = M('Channel')->where(array('id'=>$pid))->field('title')->find();
                 $this->assign('parent', $parent);
             }

             $this->assign('pid', $pid);
             $this->assign('info',null);*/
            $this->meta_title = '新增报修';
            $this->display('add');
        }
    }

    public function edit($id = 0){
        if(IS_POST){
            $Repair = D('Repair');
            $data = $Repair->create();
            if($data){
                if($Repair->save()){
                    //记录行为
                    action_log('update_channel', 'channel', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Repair->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Repair')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }

            $this->assign('info', $info);
            $this->meta_title = '编辑报修';
            $this->display('add');
        }
    }
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Repair')->where($map)->delete()){
            //记录行为
            action_log('update_channel', 'channel', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}