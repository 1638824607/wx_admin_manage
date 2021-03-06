<?php
namespace addons\touPiao\controller;


use addons\touPiao\model\VoteBaoming;
use think\Db;
use think\Request;

class Vote extends Common
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    public function index(){

        if(Db::name('vote_view')->where('mpid','=',$this->mid)->find()){
            Db::name('vote_view')->where('mpid','=',$this->mid)->setInc('view');
        }else{
            Db::name('vote_view')->where('mpid','=',$this->mid)->insert(['view'=>1,'mpid'=>$this->mid]);
        }
        $this->assign('end_time',$this->info['mp_config']['end_time']);
        $this->fetch();

    }

    public function getBmlist(){
        $bmModel = new VoteBaoming();
        $searchWhere=[];
        if($keyword=input('keyword')){
            $result=$bmModel
                ->where(['mpid'=>$this->mid,'status'=>1])
                ->where('bm_id|username','like','%'.$keyword.'%')
                ->field('bm_id,username,cover,description,vote_total')
                ->order('bm_id DESC')
                ->paginate(10);
        }else{
            $result=$bmModel
                ->where(['mpid'=>$this->mid,'status'=>1])
                ->field('bm_id,username,cover,description,vote_total')
                ->order('bm_id DESC')
                ->paginate(10);
        }

        ajaxReturn($result);
    }

    public function toVote(){
        if(Request::instance()->isAjax()){
            $input = input();
            $today=strtotime('today');
            if (time() < strtotime($this->info['mp_config']['start_time'])) {
                return ajaxMsg(0,'活动还没有开始');
            }
            if (time() > strtotime($this->info['mp_config']['end_time'])) {
                return ajaxMsg(0,'活动已经结束');
            }
            if($this->openid){
                $vote_count=Db::name('vote_record')
                    ->where(['openid'=>$this->openid,'bm_id'=>$input['bm_id'],'time'=>$today,'mpid'=>$this->mid])
                    ->count('id');
                if($vote_count>=$this->info['mp_config']['number_of_times']){
                    return ajaxMsg(0,'此号选手你已经投满了'.$this->info['mp_config']['number_of_times'].'票');
                }else{
                    $model =new VoteBaoming();
                    $model->where('bm_id','=',$input['bm_id'])->setInc('vote_total');
                    Db::name('vote_record')->insert(['openid'=>$this->openid,'bm_id'=>$input['bm_id'],'time'=>$today,'mpid'=>$this->mid]);
                    return ajaxMsg(1,'投票成功');
                }
            }else{
                //游客身份
                return ajaxMsg(-2,'请返回公众号菜单进入');
            }
        }
    }

    public function baoMing(){
        if(Request::instance()->isAjax()){
            $input=input();
            if(!$this->openid){
                return ajaxMsg(-2,'请返回公众号菜单进入');
            }
            $input['mpid']=$this->mid;
            if (time() < strtotime($this->info['mp_config']['start_time'])) {
                return ajaxMsg(0,'活动还没有开始');
            }
            if (time() > strtotime($this->info['mp_config']['end_time'])) {
                return ajaxMsg(0,'活动已经结束');
            }
            $input['create_time']=time();
            $input['openid']=$this->openid;
            if(!isMobileNumber($input['phone'])){
                return ajaxMsg(0,'手机号不正确');
            }
            $baomingModel= new VoteBaoming();
            if($baomingModel->where(['openid'=>$this->openid,'mpid'=>$this->mid])->find()){
                return ajaxMsg(0,'你已经报名了');
            }
            if($baomingModel->allowField(true)->save($input)){
                return ajaxMsg(1,'报名成功');
            }else{
                return ajaxMsg(0,'报名失败');
            }
        }else{

            $this->fetch();
        }
    }

    public function ranking(){

        $this->fetch();
    }

    public function getRanking(){
        $bmModel = new VoteBaoming();
        $result=$bmModel
            ->where(['mpid'=>$this->mid,'status'=>1])
            ->field('bm_id,username,cover,description,vote_total')
            ->order('vote_total DESC')
            ->paginate(20);
        ajaxReturn($result);
    }

    public function rule(){

        $this->fetch();
    }

    public function search(){
        $keyword=input('keyword');
        $this->assign('keyword',$keyword);
        $this->fetch();
    }

}