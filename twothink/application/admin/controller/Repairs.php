<?php
namespace app\admin\controller;
use think\Validate;

class Repairs extends Admin{
    public function Index(){
       $list=\think\Db::name('repairs')->select();
        $this->assign('list',$list);
        $this->assign('meta_title' , '导航管理');
       return $this->fetch();
    }
    public function Add(){
       if(request()->isPost()){
           $repairs=model('repairs');
           $post_data=\think\request::instance()->post();
           $validate=validate('repairs');
           if(!$validate->check($post_data)){
               return $this->error($validate->getError());
           }
           $post_data['create_time']=time();
           $post_data['odd']='bx'.uniqid();
           $data=$repairs->create($post_data);

           if( $data){
               $this->success('添加成功',url('index'));
           }else{
               $this->error($repairs->getError());
           }
       }else{
       $this->assign('info',null);
        $this->assign('meta_title', '新增报修');
        return $this->fetch('edit');
       }
    }
    public function Edit($id=0){
        if(request()->isPost()){
            $post_data=\think\request::instance()->post();
            $repairs=\think\Db::name('repairs');
            $data=$repairs->update($post_data);
//            var_dump($data);exit;
            if($data!==false){
                $this->success('编辑成功',url('index'));
            }else{
                $this->error('编辑失败');
            }
        }else{

            $info=\think\Db::name('repairs')->find($id);
            $this->assign('info', $info);
            $this->assign('meta_title','编辑报修');
            return $this->fetch('edit');
        }

    }
    public function Del($id){
         if(empty($id)){
             $this->error('请选择');
         }
        $map=array('id'=>array('in',$id));
          $repairs=\think\Db::name('repairs')->where($map);
          $repairs->delete();
        $this->success('删除成功');
    }
    public function status($id){
        $repairs=\think\Db::name('repairs');
       $repairs->update(['id'=>$id,'status'=>1]);
       return $this->success('处理成功',url('index'));

    }
}