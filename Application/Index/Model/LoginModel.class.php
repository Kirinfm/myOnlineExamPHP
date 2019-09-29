<?php
namespace Index\Model;
use Think\Model;
class LoginModel extends Model {
	protected $tableName = 'user';
	
	public function getUserinfoByno($no){
		$sql = "select * from user where SchoolID = %d ";
		$result = $this->query($sql,array($no));
		return $result;
	}
	
	public function getUserinfo($no,$password){
		$sql = "select * from user where SchoolID = %d and Password = %s";
		$result = $this->query($sql,array($no,$password));
		return $result;
	}
	
	
	
	public function registerUser($no,$name,$password,$telno){
		$sql = "insert into user (SchoolID,Name,Password,TelNo) values (%d,'%s','%s','%s')";
		$result = $this->execute($sql,array($no,$name,$password,$telno));
		return $result;
	}
}