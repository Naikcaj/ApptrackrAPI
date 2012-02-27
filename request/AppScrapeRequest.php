<?php
/**
 * AppScrapeRequest
 * An App::scrape request
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\request;

use apptrackr\credentials\ApptrackrCredentials;
use apptrackr\request\ApptrackrRequest;

class AppScrapeRequest extends ApptrackrRequest {
	
	// args
	public $iTunesURL;
	
	// response
	public $name;
	public $version;
	public $scrapeDate;
	public $appID;
	public $versions = array();
	public $seller;
	public $category;
	public $size;
	public $latestVersion;
	public $releaseDate;
	public $price;
	public $ageRating;
	public $description;
	public $whatsNew;
	public $requirements;
	public $languages;
	public $icons = array();
	
	protected function constructObject() {
		$this->request["object"] = "App";
	}
	
	protected function constructAction() {
		$this->request["action"] = "scrape";
	}
	
	protected function constructArgs() {
		$this->request["args"] = array(
			"itunes_url" => $this->iTunesURL
		);
	}
	
	protected function parseResponse() {
		$this->name = $this->dataBlock->name;
		$this->scrapeDate = $this->dataBlock->scrapedate;
		$this->iTunesURL = $this->dataBlock->itunesurl;
		$this->appID = $this->dataBlock->appid;
		$this->versions = explode(",", $this->dataBlock->allversions);
		$this->seller = $this->dataBlock->seller;
		$this->category = $this->dataBlock->category;
		$this->size = $this->dataBlock->size;
		$this->latestVersion = $this->dataBlock->latest_version;
		$this->releaseDate = $this->dataBlock->release_date;
		$this->price = $this->dataBlock->price;
		$this->ageRating = $this->dataBlock->rating;
		$this->description = $this->dataBlock->description;
		$this->whatsNew = $this->dataBlock->whatsnew;
		$this->requirements = $this->dataBlock->requirements;
		$this->languages = $this->dataBlock->languages;
		
		$this->icon100 = $this->dataBlockArray["icon-100"];
		$this->icon75 = $this->dataBlockArray["icon-75"];
		$this->icon57 = $this->dataBlockArray["icon-57"];
		$this->icon175 = $this->dataBlockArray["icon-175"];
		
	}
}
?>