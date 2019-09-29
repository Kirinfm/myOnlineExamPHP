<?php
namespace Index\Controller;

use Index\Model\TOthersModel;
use Think\Controller;

class TOthersController extends Controller {
	public function getscore() {
		$score = new TOthersModel ();
		$response = array (
				"error" => false
		);
	
		if (isset ( $_POST ['TeacherID'] )) {
			$id = $_POST ['TeacherID'];
			$result = $score->getScore ( $id );
			if (! empty ( $result )) {
				$response ["error"] = false;
				foreach ( $result as $val ) {
					$response ["scorelist"] [] = $val;
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "当前没有学生选该课程";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有向服务器传输学号";
		}
	
		echo json_encode ( $response );
	}
}