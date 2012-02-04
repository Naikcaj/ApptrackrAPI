<?php
/**
 * Apptrackr Credentials set
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\credentials;

class ApptrackrCredentials {
	
	public $username;
	public $userID;
	public $password;
	public $passhash;
	
	public function __construct($username=false, $password=false) {
		if ($username) {
			$this->username = $username;
			$this->getUserID();
		}
		
		if ($password) {
			$this->password = $password;
			$this->makePasswordHash();
		}
	}
	
	public function getUserID() {
		if ((!$username) || (!$password))
			return;
		
		$this->makePasswordhash();
		
		$r = new UserCheckAuthRequest;
		$r->apptrackrCredentials = $this;
		$r->sendRequest();
		
		$this->userID = $r->userID;
	}
	
	public function makePasswordHash() {
		$this->passhash = md5($password);
	}
}
		