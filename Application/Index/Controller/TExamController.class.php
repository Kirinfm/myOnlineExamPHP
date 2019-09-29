<?php

namespace Index\Controller;

use Index\Model\TExamModel;
use Think\Controller;

class TExamController extends Controller {
	public function getquestion() {
		$question = new TExamModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['TeacherID'] )) {
			$id = $_POST ['TeacherID'];
			$result = $question->getQuestion ( $id );
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
	public function getcourse() {
		$question = new TExamModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['TeacherID'] )) {
			$id = $_POST ['TeacherID'];
			$result = $question->getCourse ( $id );
			if (! empty ( $result )) {
				foreach ( $result as $val ) {
					$response ["course"] [] = $val;
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "当前没有课程";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有课程";
		}
		echo json_encode ( $response );
	}
	public function insertquestion() {
		$question = new TExamModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['Question'] ) && isset ( $_POST ['CourseID'] )) {
			
			$questionstr = $_POST ['Question'];
			$courseid = $_POST ['CourseID'];
			$result = $question->insertQuestion ( $courseid, $questionstr );
			if ($result) {
				$response ["error"] = false;
				$getquestion = $question->getQuestionByID ();
				foreach ( $getquestion as $val ) {
					$response ["question"] [] = $val;
				}
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "增加失败";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "没有向服务器传输信息";
		}
		echo json_encode ( $response );
	}
	public function deletequestion() {
		$question = new TExamModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['QuestionID'] )) {
			$questionid = $_POST ['QuestionID'];
			$result = $question->deletequestion ( $questionid );
			if ($result == 1) {
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "删除失败";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "向服务器提交失败";
		}
		echo json_encode ( $response );
	}
	public function updatequestion() {
		$q = new TExamModel ();
		$response = array (
				"error" => false 
		);
		if (isset ( $_POST ['QuestionID'] )) {
			$questionid = $_POST ['QuestionID'];
			$question = $_POST ['Question'];
			$choiceA = $_POST ['ChoiceA'];
			$choiceB = $_POST ['ChoiceB'];
			$choiceC = $_POST ['ChoiceC'];
			$choiceD = $_POST ['ChoiceD'];
			$Answer = $_POST ['Answer'];
			$Score = $_POST ['Score'];
			$result = $q->updateQuestion ( $questionid, $question, $choiceA, $choiceB, $choiceC, $choiceD, $Answer, $Score );
			if ($result == 1) {
			} else {
				$response ["error"] = true;
				$response ["errormsg"] = "更新失败";
			}
		} else {
			$response ["error"] = true;
			$response ["errormsg"] = "向服务器提交失败";
		}
		echo json_encode ( $response );
	}
}