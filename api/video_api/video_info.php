<?php
defined('IN_SANLVE') or exit('No permission resources.'); 

/**
 * 
 * 视频状态接收接口 vms系统收到ku6系统中视频状态改变时post到cms系统中，此接口负责接收数据改变视频库中视频的状态
 * 
 * @author				chenxuewang
 * @link				http://www.contents.cn http://www.ku6.cn
 * @copyright			版权所有©CopyRight @南京三略建筑科技有限公司 2016
 * @license			http://www.contents.cn/license/
 * ---------------------------------------------------------------------
 * 参数说明
 * vid, picpath, size, timelen, status
 * 
 * vid，视频vid，视频的唯一的标示符。区分视频
 * 
 * picpath 视频缩略图
 * 
 * size 视频大小
 * 
 * timelen 视频播放时长
 * 
 * status 视频目前的状态
 */

$video_setting = getcache('video');
pc_base::load_app_func('global', 'video');

pc_base::load_app_class('ku6api', 'video', 0);
$ku6api = new ku6api($video_setting['skey'], $video_setting['sn']);

$msg = $ku6api->update_video_status_from_vms();
exit($msg);
?>