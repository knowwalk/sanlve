<?php
defined('IN_SANLVE') or exit('No permission resources.');
pc_base::load_sys_class('model', '', 0);
class order_content_model extends model {
	function __construct() {
		$this->db_config = pc_base::load_config('database');
		$this->db_setting = 'default';
		$this->table_name = 'order_content';
		parent::__construct();
	} 
}
?>