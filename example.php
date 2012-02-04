<?php
/**
 * example of using this lib to do a scrape
 */
require_once(__DIR__ . "/apptrackr.inc.php");

use apptrackr\credentials\ApptrackrCredentials;
use apptrackr\request\AppScrapeRequest;
use appptrackr\exceptions\ResponseInvalidException; 

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
catch (ResponseInvalidException $e) {
	echo "Signature verification failed, possible man in the middle attack!";
	die();
}

// echo out name and version
// you can find lists of the properties available in the request files in /request/
echo $r->name . " v" . $r->latestVersion;