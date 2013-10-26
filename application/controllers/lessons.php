<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lessons extends CI_Controller {

	public function index()
	{
		echo "Choose a lesson";
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
