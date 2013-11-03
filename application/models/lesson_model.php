<?php
class Lesson_model extends CI_Model {

	public function __construct() {

	}

	public function fetchLessons() {
		return json_decode(file_get_contents('./lessons/lessons.json'), true);
	}

	public function fetchLesson( $lessonName ) {
		return json_decode(file_get_contents("./lessons/$lessonName/$lessonName.json"), true);
	}

}
?>