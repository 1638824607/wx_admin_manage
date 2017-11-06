<?php
// +----------------------------------------------------------------------
// | [RhaPHP System] Copyright (c) 2017 http://www.rhaphp.com/
// +----------------------------------------------------------------------
// | [RhaPHP] 并不是自由软件,你可免费使用,未经许可不能去掉RhaPHP相关版权
// +----------------------------------------------------------------------
// | Author: Geeson <qimengkeji@vip.qq.com>
// +----------------------------------------------------------------------


namespace app\admin\controller;

use think\Config;
use think\Controller;
use think\Db;
use think\Loader;
use think\Request;

class Base extends Controller
{
    public $admin_id;
    public function _initialize()
    {
        if (!is_file(APP_PATH . '/database.php') || !is_file(APP_PATH . '/install.lock')) {
            return $this->redirect('install/index/index');
        }
        $admin=getAdmin();
        if (empty($admin)) {
            $this->redirect('admin/Login/index');
        }else{
            $this->admin_id=$admin['admin_id'];
        }
        $node = MODULE_NAME . '/' . CONTROLLER_NAME . '/' . ACTION_NAME;
        $t_menu = Db::name('menu')->where('pid', 0)->order('sort ASC')->select();
        $allMenu = Db::name('menu')->order('sort ASC')->select();
        $nowMenu = Db::name('menu')->where('url', $node)->order('sort ASC')->find();
        $topNode = null;
        $menu2 = null;
        $menu_title='';
        if (!empty($nowMenu)) {
            foreach ($t_menu as $key => $val) {//处理顶级菜单高亮
                if ($val['url'] == $nowMenu['url']) {
                    $menu2 = $this->getSon($allMenu,$val['url']);
                    $topNode = $val['url'];
                    break;
                } else {
                    $parent = \Tree::getParents($allMenu, $nowMenu['id']);
                    if (isset($parent['0']['url'])) {
                        if ($parent['0']['url'] == $val['url']) {
                            $menu2 = $this->getSon($allMenu,$val['url']);
                            $topNode = $val['url'];
                            break;
                        }
                    }
                }
            }
            $parent=\Tree::getParents($allMenu,$nowMenu['id']);
            $tree=tree_to_list($menu2,'child');
            if($tree){
                foreach ($tree as $key =>$val){
                    foreach ($parent as $key2=>$val2){
                        if($tree[$key]['id']==$parent[$key2]['id']){
                            $tree[$key]['shows']=1;
                            $menu_title=$val2['name'];
                            break;
                        }
                    }
                }
                $menu2=\Tree::getTreeNoFindChild($tree);
            }
        }
        if(MODULE_NAME . '/' . CONTROLLER_NAME=='mp/app'){
            $topNode='mp/mp/index';
        }
        $this->mpListByMenu();
        $config=Config::load(APP_PATH.'copyright.php');
        $this->assign('t_menu', $t_menu);
        $this->assign('topNode', $topNode);
        $this->assign('menu_title', $menu_title);
        $this->assign('node', $node);
        $this->assign('menu', $menu2);
        $this->assign('controller_name', CONTROLLER_NAME);
        $this->assign('action_name', ACTION_NAME);
        $this->assign('admin',$admin);
        $this->assign('mpInfo',session('mpInfo'));
        $this->assign('copy',$config['copyright']);

    }

    public function getSon($allMenu=[],$node){
        $menu = Db::name('menu')->where(['pid'=>0,'url'=>$node])->order('sort ASC')->find();
        return  \Tree::makeTree($allMenu,$menu['id']);


    }

    public function mpListByMenu(){
        $list = Db::name('mp')->where(['user_id' => $this->admin_id, 'status' => '1'])->select();
        $this->assign('mpByMenu',$list);
    }

}
