<?php
/**
 * LinkSubmitRequest
 * A Link::submit request
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\request;

use apptrackr\credentials\ApptrackrCredentials;
use apptrackr\request\ApptrackrRequest;

class LinkSubmitRequest extends ApptrackrRequest {
	
	// args
	public $iTunesURL;
	public $version;
	public $cracker;
	public $links = array();
	
	// response
	// no response data for this request
	
	protected function constructObject() {
		$this->request["object"] = "Link";
	}
	
	protected function constructAction() {
		$this->request["action"] = "submit";
	}
	
	protected function constructArgs() {
		$this->request["args"]["itunes_url"] = $this->iTunesURL;
		$this->request["args"]["version"] = $this->version;
		$this->request["args"]["cracker"] = $this->cracker;
		$this->request["args"]["links"] = $this->links;
	}
	
	protected function parseResponse() {
	}
}
?>