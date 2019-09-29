<?php

namespace Index\Controller;

use Index\Model\ExamModel;
use Think\Controller;

class ExamController extends Controller {
	public function index() {
		$exam = new ExamModel ();
		$response = array (
				"error" => false 
		);
		
		if (isset ( $_POST ['SchoolID'] )) {
			$id = $_POST ['SchoolID'];
			$result = $exam->getCourse ( $id );
			if (! empty ( $result )) {
				$response ["error"] = false;
				foreach ( $result as $val ) {
					$response ["examlist"] [] = $val;
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "当前没有课程";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有向服务器传输学号";
		}
		
		echo json_encode ( $response );
	}
	public function getquestion() {
		$exam = new ExamModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['CourseID'] )) {
			$id = $_POST ['CourseID'];
			$result = $exam->getQuestion ( $id );
			if (! empty ( $result )) {
				foreach ( $result as $val ) {
					$response ["questionlist"] [] = $val;
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "当前没有题目";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有课程";
		}
		echo json_encode ( $response );
	}
	public function handleup() {
		$exam = new ExamModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['SchoolID'] ) && isset ( $_POST ['CourseID'] ) && isset ( $_POST ['Score'] )) {
			$schoolid = $_POST ['SchoolID'];
			$courseid = $_POST ['CourseID'];
			$score = $_POST ['Score'];
			$result = $exam->updateCourse ( $score, $schoolid, $courseid );
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