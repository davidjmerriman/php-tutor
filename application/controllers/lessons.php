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

		$input = $this->processInput();

		echo json_encode( $this->grader->test( $_POST['code'], $input ) );
	}

	public function grade($lesson) {
		$this->load->library('Grader');

		// Load lesson data
		$lesson = json_decode( file_get_contents("./lessons/$lesson/$lesson.json" ), true );

		// Evaluate against all datasets, return score and details on which 
		// datasets passed/failed, execution time per dataset, and other information
		echo json_encode( $this->grader->grade( $_POST['code'], $lesson['datasets'] ) );

		// TODO: once we have user profiles, we can log their grades for use
		//       throughout the system
	}

	private function processInput() {
		$___method = $_POST['input']['method'];
		$___input = array();
		if( true == isset( $_POST['input']['names'] ) ) {
			$___names = $_POST['input']['names'];
			$___values = $_POST['input']['values'];

			for( $___i = 0; $___i < count( $___names ); $___i++ ) {
				if( false == empty( $___names[$___i] ) || false == empty( $___values[$___i] ) ) {
					eval( "\${$___names[$___i]} = {$___values[$___i]};" );
				}
			}
			$___input[$___method] = array();
			foreach( get_defined_vars() as $varname => $varvalue ) {
				if( '___' != substr( $varname, 0, 3 ) ) {
					eval( "\$___input['$___method']['$varname'] = \$$varname;" );
				}
			}
		}
		return $___input;
	}
}
