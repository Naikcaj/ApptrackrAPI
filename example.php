<?php
/**
 * example of using this lib to do a scrape
 */
require_once(__DIR__ . "/apptrackr.inc.php");

use apptrackr\credentials\ApptrackrCredentials;
use apptrackr\request\AppScrapeRequest;
use apptrackr\request\LinkSubmitRequest;
use appptrackr\exceptions\VerificationFailedException;
use apptrackr\exceptions\FiveZeroException;

$storeURL = "http://itunes.apple.com/ie/app/flashlight./id285281827?mt=8";

// this will fail authentication since the account doesn't exist,
// but auth isn't required for scraping so the request will still go through
// just thought i should demo how to use auth when needed
$ac = new ApptrackrCredentials;
$ac->username = "Kyek";
$ac->password = "iliekpixarshortbirds";

// construct the request
$r = new AppScrapeRequest;
$r->iTunesURL = $storeURL;
$r->apptrackrCredentials = $ac;

// make the request, wrap it with a try... catch incase sig verification fails
// if sig verification fails, die! our data probably did not originate from apptrackr!
try {
	$r->sendRequest();
}
catch (VerificationFailedException $e) {
	echo "Signature verification failed, possible man in the middle attack!";
	die();
}
catch (FiveZeroException $e) {
	die($e->responseString);
}

// echo out name and version
// you can find lists of the properties available in the request files in /request/
echo $r->name . " v" . $r->latestVersion . "\n";

// now lets do something stupid
// lets submit a link without an auth block :D

$r = new LinkSubmitRequest;
$r->cracker = "Bleh";
try {
	$r->sendRequest();
}
catch (FiveZeroException $e) {
	
	// a 50- exception is a big fat server error, unrecoverable, DIE
	die($e->responseString);
}

// now lets deal with our response codes
switch ($r->responseString) {
	case "ACCEPTED":
		echo "Submitted links accepted into queue";
	break;
	case "PARTIALLY_ACCEPTED":
		echo "Some of submitted links accepted into queue";
	break;
	case "UNACCEPTABLE_DATA":
		echo "No links were submitted";
	break;
	case "UNAUTHORIZED":
		echo "User does not have permission to submit links";
	break;
}