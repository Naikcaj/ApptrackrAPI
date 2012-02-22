<?php
/**
 * GenericRequest
 * Any request, can be customized at use time
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\request;

use apptrackr\credentials\ApptrackrCredentials;
use apptrackr\request\ApptrackrRequest;

class GenericRequest extends ApptrackrRequest {
	
	// args
	public $args = array();
	
	// object
	public $objectName;
	
	// action
	public $actionName;
	
	// response
	// nothing
	
	protected function constructObject() {
		$this->request["object"] = $this->objectName;
	}
	
	protected function constructAction() {
		$this->request["action"] = $this->actionName;
	}
	
	protected function constructArgs() {
		$this->request["args"] = $this->args;
	}
	
	protected function parseResponse() {
	}
}
?>