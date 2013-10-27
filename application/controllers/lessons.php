<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends CI_Controller {

	public function index() {
		$data['lessons'] = json_decode(file_get_contents('./lessons/lessons.json'), true);

		$this->load->view('lessons.php', $data);
	}

	public function view($lesson) {
		echo "View $lesson";
	}

	public function test($lesson) {
		echo "Test $lesson";
	}

	public function grade($lesson) {
		echo "Grade $lesson";
	}
}
