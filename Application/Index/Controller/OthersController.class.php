<?php

namespace Index\Controller;

use Index\Model\OthersModel;
use Think\Controller;

class OthersController extends Controller {
	public function getscore() {
		$score = new OthersModel ();
		$response = array (
				"error" => false 
		);
		
		if (isset ( $_POST ['SchoolID'] )) {
			$id = $_POST ['SchoolID'];
			$result = $score->getScore ( $id );
			if (! empty ( $result )) {
				$response ["error"] = false;
				foreach ( $result as $val ) {
					$response ["scorelist"] [] = $val;
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "当前没有成绩";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有向服务器传输学号";
		}
		
		echo json_encode ( $response );
	}
	public function getcourse() {
		$score = new OthersModel ();
		$response = array (
				"error" => false 
		);
		
		if (isset ( $_POST ['SchoolID'] )) {
			$id = $_POST ['SchoolID'];
			$result = $score->getCourse ( $id );
			if (! empty ( $result )) {
				$response ["error"] = false;
				foreach ( $result as $val ) {
					$response ["courselist"] [] = $val;
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "当前没有可选的课程";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有向服务器传输学号";
		}
		
		echo json_encode ( $response );
	}
	public function pick() {
		$score = new OthersModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['SchoolID'] ) && isset ( $_POST ['CourseIDArr'] )) {
			
			$id = $_POST ['SchoolID'];
			$arr = $_POST ['CourseIDArr'];
			$courseidarr = explode ( " ", $arr );
			$result = $score->pickCourse ( $courseidarr, $id );
			if ($result) {
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "选课失败";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有向服务器传输选课信息";
		}
		echo json_encode ( $response );
	}
	public function updateuserinfo() {
		$others = new OthersModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['TelNO'] ) && isset ( $_POST ['Password'] ) && isset ( $_POST ['SchoolID'] )) {
			$telno = $_POST ['TelNO'];
			$psd = $_POST ['Password'];
			$schoolid = $_POST ['SchoolID'];
			
			$result = $others->updateUserInfo ( $telno, $psd, $schoolid );
			if ($result == 1) {
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "向服务器更新失败";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "向服务器提交失败";
		}
		echo json_encode ( $response );
	}
}