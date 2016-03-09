<?php
namespace Common\Model;
use Think\Model;
class UserModel extends Model{
	protected $fields = array('wechat_open_id','official_account','name');
  protected $pk=array('wechat_open_id','official_account');
}