<?php

namespace Index\Model;

use Think\Model;

class ExamModel extends Model {
	protected $tableName = 'course';
	public function getCourse($studentid) {
		$sql = "select DISTINCT c.CourseID,c.CourseName,c.CreateDate,c.DeadLine,c.Context from course c
				left join course_student cs on cs.CourseID = c.CourseID
				right join course_question cq on cq.CourseID = c.CourseID
				where cs.StudentID = %d and cs.IsAnswered = 0";
		$result = $this->query ( $sql, array (
				$studentid 
		) );
		return $result;
	}
	public function getQuestion($courseid) {
		$sql = "SELECT q.QuestionID,q.Question,q.ChoiceA,q.ChoiceB,q.ChoiceC,q.ChoiceD,q.Answer,q.Score FROM question q 
				LEFT JOIN course_question cq ON cq.QuestionID = q.QuestionID
				LEFT JOIN course c ON c.CourseID = cq.CourseID
				WHERE c.CourseID = %d";
		$result = $this->query ( $sql, array (
				$courseid 
		) );
		return $result;
	}
	public function updateCourse($score,$schoolid,$courseid) {
		$sql = "UPDATE course_student SET Score = %d , IsAnswered = 1 WHERE StudentID = %d AND CourseID = %d";
		$result = $this->execute($sql,array(
				$score,
				$schoolid,
				$courseid
		));
		return $result;
	}
}