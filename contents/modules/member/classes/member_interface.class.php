<?php
/**
 * 会员接口
 *
 */
class member_interface {
	//数据库连接
	private $db;
	public function __construct() {
		$this->db = pc_base::load_model('member_model');
	}
	
	/**
	 * 获取用户信息
	 * @param $username 用户名
	 * @param $type {1:用户id;2:用户名;3:email}
	 * @return $mix {-1:用户不存在;userinfo:用户信息}
	 */
	public function get_member_info($mix, $type=1) {
		$mix = safe_replace($mix);
		if($type==1) {
			$userinfo = $this->db->get_one(array('userid'=>$mix));
		} elseif($type==2) {
			$userinfo = $this->db->get_one(array('username'=>$mix));
		} elseif($type==3) {
			if(!$this->_is_email($mix)) {
				return -4;
			}
			$userinfo = $this->db->get_one(array('email'=>$mix));
		}
		if($userinfo) {
			return $userinfo;
		} else {
			return -1;
		}
	}

	/**
	 * 根据uid增加用户积分
	 * @param int $userid	用户id
	 * @param int $point	点数
	 * @return boolean
	 */
	public function add_point($userid, $point) {
		$point = intval($point);
		return $this->db->update(array('point'=>"+=$point"), array('userid'=>$userid));
	}
}