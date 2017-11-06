<?php
// +----------------------------------------------------------------------
// | [RhaPHP System] Copyright (c) 2017 http://www.rhaphp.com/
// +----------------------------------------------------------------------
// | [RhaPHP] 并不是自由软件,你可免费使用,未经许可不能去掉RhaPHP相关版权
// +----------------------------------------------------------------------
// | Author: Geeson <qimengkeji@vip.qq.com>
// +----------------------------------------------------------------------


namespace app\admin\controller;

use think\Cache;
use think\Db;
use think\Request;
use think\Session;

class System extends Base
{

    public function _initialize()
    {

        parent::_initialize();

    }

    public function index()
    {
        $this->redirect('mp/index/mplist');
        return view();
    }

    public function menuList()
    {
        $allMenu = Db::name('menu')->order('sort ASC')->select();
        $menuList=\Tree::makeTree($allMenu);
        $this->assign('menuList', $menuList);

        return view();
    }

    public function addMenu()
    {
        if (Request::instance()->isPost()) {
            $_data = input('post.');
            unset($_data['mid']);
            if (Db::name('menu')->insert($_data)) {
                ajaxMsg(1, '增加成功');
            } else {
                ajaxMsg(0, '增加失败');
            }
        } else {
            $menu = Db::name('menu')->select();
            $tree = \Tree::makeTree($menu);
            $this->assign('menu_cate', $tree);
            return view('add_menu');
        }
    }

    public function delMenu($id)
    {
        if (Request::instance()->isAjax()) {
            Db::name('menu')->where(['id' => $id])->delete();
            ajaxMsg('1', '成功删除');
        }
    }

    public function updateMenu($id)
    {
        $this->assign('menu_title', '更改菜单');
        if (Request::instance()->isAjax()) {
            Db::name('menu')->where(['id' => $id])->update(input('post.'));
            ajaxMsg(1, '更新成功');

        } else {
            $meu = Db::name('menu')
                ->where(['id' => $id])->find();
            $menu = Db::name('menu')->select();
            $tree = \Tree::makeTree($menu);
            $this->assign('meu', $meu);
            $this->assign('menu_cate', $tree);
            return view();
        }
    }

    public function updateSort()
    {
        if (Request::instance()->isAjax()) {
            $_data = input();
            foreach ($_data as $key => $val) {
                if (!empty($_V = explode('_', $key))) {
                    Db::name('menu')->where(['id' => $_V[0]])->update(['sort' => $val]);
                }
            }
            ajaxMsg('1', '更新成功');
        }
    }

    public function AdminMember()
    {
        $admin = Db::name('admin')->where('admin_id', 'eq', $this->admin_id)->select();
        $this->assign('adminList', $admin);
        return view();
    }

    public function addAdminMember()
    {
        if (Request::instance()->isAjax()){
            $_data = input();
            if ($_data['password'] != $_data['repassword']) {
                ajaxMsg(0, '两次密码不匹配');
            }
            $S=getAdmin();
            if ($S['id'] != $this->admin_id) {
                ajaxMsg('0', '你无权操作');
            }
            if (!$result = Db::name('admin')->where('admin_name', 'eq', $_data['admin_name'])
                ->find()) {

                $rand_str = rand_string();
                $password = md5($_data['password'] . $rand_str);
                $data['admin_name']=$_data['admin_name'];
                $data['password']=$password;
                $data['rand_str']=$rand_str;
                $data['admin_id']=$this->admin_id;
                if(Db::name('admin')->insert($data)){
                    ajaxMsg(1, '操作成功');
                }else{
                    ajaxMsg(0, '操作失败');
                }
            } else {
                ajaxMsg(0, '登录账户已经存在');
            }
        }else{
            return view();
        }

    }

    public function disabledAdmin($id, $status = '')
    {
        if ($result = Db::name('admin')->where('id', 'eq', $id)->find()) {
            if ($result['admin_id'] == $id) {
                ajaxMsg('0', '不能禁用超级管理员');
            }
            if ($result['admin_id'] != $this->admin_id) {
                ajaxMsg('0', '你无权操作');//禁用成员不属于当前管理员
            }
//            if ($result['id'] != $this->admin_id) {
//                ajaxMsg('0', '你无权操作1');//禁用成员不属于当前管理员
//            }
        }
        if (Db::name('admin')->where(['id' => $id, 'admin_id' => $this->admin_id])->update(['status' => $status])) {
            ajaxMsg(1, '操作成功');
        } else {
            ajaxMsg(0, '操作失败');
        }

    }

    public function updatePwd($id)
    {
        if (Request::instance()->isAjax()) {
            $_data = input();
            if ($_data['password'] != $_data['repassword']) {
                ajaxMsg(0, '两次密码不匹配');
            }
            if ($result = Db::name('admin')->where('id', 'eq', $id)
                ->where('admin_id', 'eq', $this->admin_id)
                ->find()) {
                if ($result['admin_id'] != $this->admin_id) {
                    ajaxMsg('0', '你无权操作');//禁用成员不属于当前管理员
                }
                $S_admin=getAdmin();
                if($S_admin['id']!=$this->admin_id){//不是超级管理员
                    if($id!=$S_admin['id']){
                        ajaxMsg('0', '只能超级管理员更改其它成员密码');
                    }
                }
                $rand_str = rand_string();
                $password = md5($_data['password'] . $rand_str);
                if(Db::name('admin')->where(['id' => $id, 'admin_id' => $this->admin_id])->update(['password' => $password,'rand_str'=>$rand_str])){
                    ajaxMsg(1, '操作成功');
                }else{
                    ajaxMsg(0, '操作失败');
                }

            } else {
                ajaxMsg(0, '没有此成员');
            }
        } else {

            return view();
        }
    }

    public function cacheClear(){
        Cache::clear();
        if($this->clearDir()==false){
            ajaxMsg(0, '清空缓存失败，请检查runtime目录是否有删除权限。');
        }else{
            ajaxMsg(1, '清空缓存成功');
        }

    }
    private function clearDir($path=RUNTIME_PATH){
        $handle = opendir($path);
        while(($item = readdir($handle)) !== false){
            if($item != '.' and $item != '..'){
                if(is_dir($path.'/'.$item)){
                    $this->clearDir($path.'/'.$item);
                }else{
                    if(!unlink($path.'/'.$item)){
                        return false;
                    }
                }
            }
        }
        closedir( $handle );
        return rmdir($path);
    }

}