<?php
/**
 * UserCheckAuthRequest
 * A User::checkAuth request
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\request;

use apptrackr\credentials\ApptrackrCredentials;
use apptrackr\request\ApptrackrRequest;

class UserCheckAuthRequest extends ApptrackrRequest {
	
	// args
	// no args for this request
	
	// response
	public $userID;
	
	protected function constructObject() {
		$this->request["object"] = "User";
	}
	
	protected function constructAction() {
		$this->request["action"] = "checkAuth";
	}
	
	protected function constructAuth() {
		$this->request["auth"] = array(
			"username" => $this->apptrackrCredentials->username,
			"passhash" => $this->apptrackrCredentials->passhash);
	}
	
	protected function constructArgs() {
	}
	
	protected function parseResponse() {
		$this->userID = $this->dataBlock->userid;
	}
}
?>