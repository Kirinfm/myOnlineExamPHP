<?php

namespace Index\Model;

use Think\Model;

class TOthersModel extends Model {
	protected $tableName = 'course';
	public function getScore($teacherid) {
		$sql = "SELECT cs.StudentID,cs.Score,u.`Name` FROM course_student cs 
				LEFT JOIN `user` u ON u.SchoolID = cs.StudentID
				LEFT JOIN course_teacher ct ON ct.CourseID = cs.CourseID
				WHERE ct.TeacherID = %d";
		$result = $this->query ( $sql, array (
				$teacherid
		) );
		return $result;
	}
}