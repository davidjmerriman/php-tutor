<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends CI_Controller {

	public function index() {
		// TODO: The code that loads the lessons should be moved to the 
		//       model layer, so we can easily switch to a database at
		//       some point without changing controller code
		$data['lessons'] = json_decode(file_get_contents('./lessons/lessons.json'), true);

		$this->load->view('view_lessons.php', $data);
	}

	public function view($lesson) {
		// TODO: load lesson data through model layer
		$this->load->view('view_lesson.php');
	}

	public function test($lesson) {
		$this->load->library('Grader');

		// TODO: check code against function whitelist!!!

		echo $this->grader->test( $_POST['code'], null );
	}

	public function grade($lesson) {
		// TODO: load lesson data, evaluate against all datasets, return score and
		//       details on which datasets passed/failed, execution time per dataset,
		//       and other information
		echo "Grade $lesson";

		// TODO: once we have user profiles, we can log their grades for use 
		//       throughout the system
	}
}
