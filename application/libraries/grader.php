<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Grader {

	/* Executes $code against $input, returning the output */
	public function test( $code, $input ) {
		$syntaxErrors = $this->checkSyntax( $code );
		if( !empty( $syntaxErrors ) ) {
			return $syntaxErrors;
		}
		return 'No errors';
	}

	private function checkSyntax( $code ) {
		// Generate temporary filename
		$filename = tempnam("/tmp", "temp") . "php";

		// Write code to file for syntax check
		$file = fopen( $filename, 'w' );
		fprintf( $file, '%s', $code );
		fclose( $file );

		// Check syntax
		$output = exec( "php -l $filename 2>&1", $errorList );

		//unlink($filename);

		if( "No syntax errors detected in $filename" == $output ) {
			return false;
		} else {
			return implode("\n", array_filter(array_slice($errorList, 0, -1)));
		}
	}
}