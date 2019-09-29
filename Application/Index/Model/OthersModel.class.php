<?php

namespace Index\Model;

use Think\Model;

class OthersModel extends Model {
	protected $tableName = 'course';
	public function getScore($studentid) {
		$sql = "select DISTINCT c.CourseID,c.CourseName,c.CreateDate,c.DeadLine,c.Context,cs.Score from course c
				left join course_student cs on cs.CourseID = c.CourseID
				right join course_question cq on cq.CourseID = c.CourseID
				where cs.StudentID = %d and cs.IsAnswered = 1";
		$result = $this->query ( $sql, array (
				$studentid 
		) );
		return $result;
	}
	public function getCourse($studentid) {
		$sql = "select c.CourseID,c.CourseName from course c
				where c.CourseID not in (select cs.CourseID from course_student cs where cs.StudentID = %d)";
		$result = $this->query ( $sql, array (
				$studentid 
		) );
		return $result;
	}
	public function pickCourse($courseidarr, $studentid) {
		$this->startTrans ();
		$flag = true;
		foreach ( $courseidarr as $courseid ) {
			$sql = "insert into course_student (CourseID,StudentID) values (%d,%d)";
			$result = $this->execute ( $sql, array (
					$courseid,
					$studentid 
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
	public function updateUserInfo($telno, $psd, $studentid) {
		$sql = "UPDATE user SET TelNO = %s , Password = %s WHERE SchoolID = %d";
		$result = $this->execute($sql,array(
				$telno,
				$psd,
				$studentid
		));
		return $result;
	}
}