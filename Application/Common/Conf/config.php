<?php
return array(
  'SITE_NAME' => 'SAE TSHOOT',
	'TMPL_EXCEPTION_FILE'   =>  APP_PATH.'Common/View/Error.tpl',// 异常页面的模板文件
	'COOKIE_PREFIX'         =>  'saetshoot_',      // Cookie前缀 避免冲突
	'URL_MODEL'             =>  2,
	'URL_HTML_SUFFIX'       =>  '',
	'TMPL_TEMPLATE_SUFFIX'  =>  '.tpl',
	'DB_TYPE'               =>  'mysql',     // 数据库类型
	'TMPL_ACTION_ERROR' => APP_PATH.'Common/View/Jump.tpl',
	'TMPL_ACTION_SUCCESS' => APP_PATH.'Common/View/Jump.tpl',
	'SHOW_ERROR_MSG'        =>  true,
	'ERROR_MESSAGE'  =>    '404 Page Not Found',
  'MODULE_DENY_LIST'=>  array('Common','Runtime'),
  'TMPL_EXCEPTION_FILE' => APP_PATH.'Common/View/Exception.tpl',
  'MULTI_MODULE'          =>  false,
  'DEFAULT_MODULE'        =>  'Main',
);