<?php
// +----------------------------------------------------------------------
// | [RhaPHP System] Copyright (c) 2017 http://www.rhaphp.com/
// +----------------------------------------------------------------------
// | [RhaPHP] 并不是自由软件,你可免费使用,未经许可不能去掉RhaPHP相关版权
// +----------------------------------------------------------------------
// | Author: Geeson <qimengkeji@vip.qq.com>
// +----------------------------------------------------------------------


namespace app\common\model;


use think\Model;

class MpMsg extends Model
{

    public function messageListByGroup($mid,$status=0)
    {
        $msgList = $this->where(['status' => $status, 'mpid' => $mid])->field('openid,count(msg_id) as msg_total')->group('openid')->paginate(15);
        foreach ($msgList as $key => $val) {
            $msgContent = $this->where(['openid' => $val['openid']])->order('msg_id DESC')->field('type,content,create_time as time')->find();
            switch ($msgContent['type']) {
                case 'voice':
                    $msgList[$key]['content'] = '[语音消息]';
                    break;
                case 'video':
                    $msgList[$key]['content'] = '[视频消息]';
                    break;
                default:
                    $msgList[$key]['content'] = $msgContent['content'];
                    break;
            }
            $msgList[$key]['create_time'] = $msgContent['time'];
            $member = getMemberInfo($val['openid'], ['headimgurl', 'nickname']);
            $msgList[$key]['headimgurl'] = $member['headimgurl'];
            $msgList[$key]['nickname'] = $member['nickname'];
        }
        return $msgList;
    }
    public function getFriendMsgList($openid, $mid)
    {
        $msgContent = $this->alias('a')->where(['a.openid' => $openid, 'a.mpid' => $mid])
            ->order('a.create_time DESC')
            ->join('__MP_FRIENDS__ b', 'a.openid=b.openid')
            ->field('a.*,b.nickname,b.headimgurl')
            ->paginate(15);
        $mpInfo=getMpInfo($mid);
        foreach ($msgContent as $key =>$val) {
            switch ($val['type']) {
                case 'voice':
                    $msgContent[$key]['content'] = '[语音消息]';
                    break;
                case 'video':
                    $msgContent[$key]['content'] = '[视频消息]';
                    break;
                case 'image':
                    $msgContent[$key]['content'] = "<img onclick='openMsgImsg(this)'  class='msg_image' src=\"{$val['content']}\">";
                    break;
                default:
                    break;
            }
            if($val['is_reply']==1){
                $msgContent[$key]['nickname']=$mpInfo['name'];
                    $msgContent[$key]['headimgurl']=$mpInfo['logo'];
            }

        }
        return $msgContent;

    }

    public function getMsgTotal($openid='',$mid='',$status='0'){
        $mid?$where['mpid']=$mid:'';
        $openid?$where['openid']:'';
        $where['status']=$status;
        return $this->where($where)->count();
    }
}