<?php 
/**
 *  index.php API 入口
 *
 * @copyright			(C) 2016-2017 SANLVE
 * @license				http://www.contents.cn/license/
 * @lastmodify			2010-7-26
 */
define('SL_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);
include SL_PATH.'contents/base.php';
$param = pc_base::load_sys_class('param');
$_userid = param::get_cookie('_userid');
if($_userid) {
	$member_db = pc_base::load_model('member_model');
	$_userid = intval($_userid);
	$memberinfo = $member_db->get_one(array('userid'=>$_userid),'islock');
	if($memberinfo['islock']) exit('<h1>Bad Request!</h1>');
}
$op = isset($_GET['op']) && trim($_GET['op']) ? trim($_GET['op']) : exit('Operation can not be empty');
if (isset($_GET['callback']) && !preg_match('/^[a-zA-Z_][a-zA-Z0-9_]+$/', $_GET['callback']))  unset($_GET['callback']);
if (!preg_match('/([^a-z_]+)/i',$op) && file_exists(SL_PATH.'api/'.$op.'.php')) {
	include SL_PATH.'api/'.$op.'.php';
} else {
	exit('API handler does not exist');
}
?>