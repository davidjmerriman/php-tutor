<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grader {

	protected $m_fltElapsedTime;
	protected $m_strOutput;
	protected $m_intGrade;

	public function __construct() {
		$this->m_fltElapsedTime = 0.0;
		$this->m_strOutput = '';
		$this->m_intGrade = 0;
	}

	/* Executes $code against $input, storing output and elapsed time */
	public function test( $code, $input, $timeLimit = 5 ) {
		$syntaxErrors = $this->checkSyntax( $code );
		if( !empty( $syntaxErrors ) ) {
			$this->m_strOutput = $syntaxErrors;
		} else {
			$this->runCodeAgainstInput( $code, $input, $timeLimit );
		}

		return array( 'time' => $this->m_fltElapsedTime, 'output' => $this->m_strOutput );
	}

	public function grade( $code, $dataSet ) {

	}

	private function checkSyntax( $code ) {
		// Generate temporary filename
		$filename = tempnam("/tmp", "temp") . ".php";

		// TODO: check code against function whitelist!!!

		// Write code to file for syntax check
		$file = fopen( $filename, 'w' );
		fprintf( $file, '%s', $code );
		fclose( $file );

		// Check syntax
		$output = exec( "php -l $filename 2>&1", $errorList );

		unlink($filename);

		if( "No syntax errors detected in $filename" == $output ) {
			return false;
		} else {
			return implode("\n", array_filter(array_slice($errorList, 0, -1)));
		}
	}

	private function runCodeAgainstInput( $code, $input, $timeLimit = 5 ) {
		// Generate temporary filename
		$filename = tempnam("/tmp", "temp") . ".php";

		// Build getlist
		$gets = array();
		if( true == isset( $input['GET'] ) ) {
			$gets = $input['GET'];
		}
		$getlist = var_export( $gets, true );

		// Build getlist
		$posts = array();
		if( true == isset( $input['POST'] ) ) {
			$posts = $input['POST'];
		}
		$postlist = var_export( $posts, true );

		// Write code to file for execution
		$file = fopen($filename, "w");
		fprintf($file,
<<<'CODEBLOCK'
<?php
	// Set up input arrays to mimic desired GET, POST, COOKIE, etc.
	unset($_GET);
	$_GET = %s;

	unset($_POST);
	$_POST = %s;

	// Register shutdown function for error handling
	function shutdown() {
		$error=error_get_last();
		if( false == is_null( $error ) ) {
			echo($error['message']);
		}
	}
	register_shutdown_function('shutdown');

	// Disable error display
	ini_set( 'display_errors', false );

	// Set time limit
	set_time_limit(%d);

	// Mark time, begin output buffering
	$___tic = microtime( true );
	ob_start();

	// USER CODE BEGIN
?>
%s
<?php
	// Remove time limit
	set_time_limit(0);

	// Mark time, stop output buffering
	$___toc = microtime( true );
	$___out = ob_get_contents();
	ob_end_clean();

	// Return echo results as JSON array
	echo json_encode( array( 'output' => $___out, 'time' => $___toc - $___tic ) );

	// TODO: Evaluate post conditions
?>
CODEBLOCK
, $getlist, $postlist, $timeLimit, $code);

		fclose($file);

		// Execute file
		unset($output);
		exec("php $filename", $output, $exitcode);

		// Delete file
		unlink($filename);
		$jsonOutput = implode("\n", array_filter( $output ) );

		// Collect results
		$data = json_decode( $jsonOutput, true );
		$this->m_fltElapsedTime = $data['time'];
		$this->m_strOutput = $data['output'];
	}
}