<?php
/**
 * Five zero exception
 * If the API returns a 50- code
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\exceptions;

class FiveZeroException extends \Exception {
	public $responseCode;
	public $responseString;
	
	public function __construct($responseCode, $responseString) {
		$this->responseCode = $responseCode;
		$this->responseString = $responseString;
	}
}
?>