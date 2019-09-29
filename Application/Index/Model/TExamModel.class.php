<?php

namespace Index\Model;

use Think\Model;

class TExamModel extends Model {
	protected $tableName = 'course';
	public function getCourse($teacherid) {
		$sql = "select DISTINCT c.CourseID,c.CourseName from course c
				left join course_teacher ct on ct.CourseID = c.CourseID
				where ct.TeacherID = %d ";
		$result = $this->query ( $sql, array (
				$teacherid 
		) );
		return $result;
	}
	public function getQuestion($teacherid) {
		$sql = "SELECT ct.CourseID,q.QuestionID,q.Question,q.ChoiceA,q.ChoiceB,q.ChoiceC,q.ChoiceD,q.Answer,q.Score FROM question q 
				LEFT JOIN course_question cq ON cq.QuestionID = q.QuestionID
				LEFT JOIN course c ON c.CourseID = cq.CourseID
				LEFT JOIN course_teacher ct ON ct.CourseID = c.CourseID
				WHERE ct.TeacherID = %d";
		$result = $this->query ( $sql, array (
				$teacherid 
		) );
		return $result;
	}
	public function insertQuestion($courseid, $question) {
		$this->startTrans ();
		$flag = true;
		$sql = "insert into question (Question) values ('" . $question . "')";
		$result = $this->execute ( $sql, null );
		if (! ($result == 1)) {
			$flag = false;
		} else {
			$sql = "select max(QuestionID) AS QuestionID from question";
			$maxidarr = $this->query ( $sql, null );
			$maxid = $maxidarr [0] ["QuestionID"];
			$sql = "insert into course_question (CourseID,QuestionID) values (%d,%d)";
			$result = $this->execute ( $sql, array (
					$courseid,
					$maxid 
			) );
			if (! ($result == 1)) {
				$flag = false;
			}
		}
		if ($flag) {
			$this->commit ();
			return true;
		} else {
			$this->rollback ();
			return false;
		}
	}
	public function getQuestionByID() {
		$sql = "select max(QuestionID) AS QuestionID from question";
		$maxidarr = $this->query ( $sql, null );
		$maxid = $maxidarr [0] ["QuestionID"];
		$sql = "select * from question where QuestionID = " . $maxid;
		$result = $this->query ( $sql, null );
		return $result;
	}
	public function deletequestion($questionid) {
		$sql = "delete from question where QuestionID = %d";
		$result = $this->execute ( $sql, array (
				$questionid 
		) );
		return $result;
	}
	public function updateQuestion($questionid, $question, $choiceA, $choiceB, $choiceC, $choiceD, $Answer, $Score) {
		$sql = "UPDATE question SET Question = '".$question."' ,ChoiceA = '".$choiceA."' ,ChoiceB = '".$choiceB."' ,ChoiceC = '".$choiceC."' ,ChoiceD = '".$choiceD."' ,Answer = '".$Answer."' ,Score = '".$Score."' WHERE QuestionID = ".$questionid;
		$result = $this->execute ( $sql, null );
		return $result;
	}
}