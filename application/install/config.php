<?php
return array(
    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}',
        // 标签库标签开始标记
        'taglib_begin' => '{',
        // 标签库标签结束标记
        'taglib_end'   => '}',
    ],
    'view_replace_str'       => [
        "__STATIC__" => "/public/static",
        '__COMPANY__'          => '上海绮梦网络科技有限公司',
        '__NAME__'             => 'RhaPHP微信公众号管理系统(开发框架)',
        '__COMPANY_WEBSITE__' => 'www.rhaphp.com',
        '__WEBSITE__' => 'www.rhaphp.com',
    ],
);