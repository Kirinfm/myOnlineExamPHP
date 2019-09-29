<?php
// 本类由系统自动生成，仅供测试用途
namespace Index\Controller;

use Index\Model\LoginModel;
use Think\Controller;

class IndexController extends Controller {
	public function login() {
		$user = new LoginModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['username'] ) && isset ( $_POST ['password'] )) {
			$no = $_POST ['username'];
			$password = $_POST ['password'];
			$result1 = $user->getUserinfoByno($no);
			$result2 = $user->getUserinfo ( $no, $password );
			if (! empty($result1)){
				if (! empty ( $result2 )) {
					$response ["error"] = false;
					foreach ( $result2[0] as $key => $val ) {
						$response ["userinfo"] [$key] = $val;
					}
				} else {
					$response ["error"] = true;
					$response ["errormsg"] = "密码错误";
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "不存在该账户";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "向服务器提交失败";
		}
		echo json_encode ( $response );
	}
	
	public function register(){
		$user = new LoginModel ();
		$response = array (
				"error" => false
		);
		if (isset ( $_POST ['SchoolID'] )) {
			$no = $_POST ['SchoolID'];
			$name = $_POST ['Name'];
			$password = $_POST ['Password'];
			$telno = $_POST ['Telno'];
			$result1 = $user->getUserinfoByno($no);
			$result2 = $user->registerUser($no, $name, $password, $telno);
			if (empty($result1)){
				if ($result2 == 1) {
					$response ["error"] = false;
				} else {
					$response ["error"] = true;
					$response ["errormsg"] = "注册失败";
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "已存在该账户";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "向服务器提交失败";
		}
		echo json_encode ( $response );
	}
}