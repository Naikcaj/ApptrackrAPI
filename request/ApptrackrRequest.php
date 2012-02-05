<?php
/**
 * ApptrackrRequest
 * A generic abstract apptrackr request
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\request;

use apptrackr\credentials\ApptrackrCredentials;
use apptrackr\exceptions\VerificationFailedException;
use apptrackr\api\APIStatusCodes;
use apptrackr\exceptions\FiveZeroException;

abstract class ApptrackrRequest {
	
	const APIURL = "http://api.apptrackr.org/";
	
	public $apptrackrCredentials;
	
	public $responseCode;
	public $responseString;
	public $signature;
	public $jsonDataBlock;
	public $dataBlock;
	
	public $legitimate;
	
	public $request = array();
	
	protected function constructAuth() {
		
		if (($this->apptrackrCredentials->userID) && ($this->apptrackrCredentials->passhash)) {
			$this->request["auth"] = array(
				'id' => $this->apptrackrCredentials->userID,
				'passhash' => $this->apptrackrCredentials->passhash
			);
		}
		else if (($this->apptrackrCredentials->username) && ($this->apptrackrCredentials->password)) {
			$this->apptrackrCredentials->makePasswordHash();
			$this->apptrackrCredentials->getUserID();
			
			$this->request["auth"] = array(
				'id' => $this->apptrackrCredentials->userID,
				'passhash' => $this->apptrackrCredentials->passhash
			);
		}
	}
	
	abstract protected function constructArgs();
	
	abstract protected function constructObject();
	
	abstract protected function constructAction();
	
	public function sendRequest() {
		
		$this->constructAuth();
		$this->constructArgs();
		$this->constructObject();
		$this->constructAction();
		
		$wrapper = array(
			'request' => json_encode($this->request)
		);
		
		$wrapper = urlencode(json_encode($wrapper));
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, static::APIURL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "request=$wrapper");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		curl_close($ch);
		
		$working = json_decode($data);
			
		$this->responseCode = $working->code;
		$this->responseString = APIStatusCodes::codeToString($this->responseCode);
		$this->jsonDataBlock = $working->data;
		$this->signature = $working->signature;	
		$this->dataBlock = json_decode($this->jsonDataBlock);
		
		$this->verifyResponse();
		$this->parseResponse();
		$this->processResponseCode();
	}
	
	protected function verifyResponse() {
		
		if (!$this->jsonDataBlock)
			return;
		
		$key = <<<'EOF'
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCxyZS+9iSODM7uiv4g1CNV36xg
zHsEgZaFxcy88BibdUxAEFwr0CgCy1TrnTMe87PmAElCmatPpGUSYmFQtM7YEsPf
UNfB/8q/dEeHXAH2I93PGN3wdLicY9K2SOz6GbkAkoEnpGSYwOKIBBsKi4/wZ33W
UcFkpmqMMlaiSc0zjwIDAQAB
-----END PUBLIC KEY-----
EOF;
		
		$apptrackrPublicKey = openssl_pkey_get_public($key);
		
		if (!openssl_verify($this->jsonDataBlock, base64_decode($this->signature), $apptrackrPublicKey)) {
			$legitimate = false;
			throw new VerificationFailedException;
		}
		else {
			$legitimate = true;
		}
	}
	
	abstract protected function parseResponse();
	
	protected function processResponseCode() {
		$codeAsString = (string)$this->responseCode;
		$splitCode = str_split($codeAsString);
		
		if ($splitCode[0] == "5")
			throw new FiveZeroException($this->responseCode, $this->responseString);
	}
}
?>