<?php
/**
 * Apptrackr API Status Codes + an array
 * Code by Kyek. We love you, man.
 */
namespace apptrackr\api;

class APIStatusCodes {
	
        // Request was successful, nothing was created or accepted for review
        const OK = 200;
        // Request was successful and submission has been instantly posted
        const CREATED = 201;
        // Request was successful and submission has been accepted for review
        const ACCEPTED = 202;
        // Request was successful, but part or all of the submission already existed. Any unique content has been created.
        const PARTIALLY_CREATED = 206;
        // Request was successful, but part or all of the submission already existed. Any unique content has been accepted.
        const PARTIALLY_ACCEPTED = 207;
        // Request was badly formatted or improperly submitted
        const BAD_REQUEST = 400;
        // Request requires a user's authentication, or the provided authentication was bad
        const UNAUTHORIZED = 401;
        // User authentication was accepted, but user does not have permission to perform the requested action
        const USER_NOT_PERMITTED = 402;
        // The API profile being used does not exist or is not activated.
        const FORBIDDEN = 403;
        // Request was made to an object that does not exist
        const OBJECT_NOT_FOUND = 404;
        // The API profile being used does not have permission to call this action
        const ACTION_NOT_ALLOWED = 405;
        // Request's format is either invalid or is not allowed for this type of request
        const FORMAT_NOT_ACCEPTED = 406;
        // Submitted data was in some way invalid, and no part of it could be accepted.
        const UNACCEPTABLE_DATA = 407;
        // Request's format or requested action is deprecated
        const DEPRECATED = 408;
        // Request referenced an external resource that could not be found
        const RESOURCE_NOT_FOUND = 410;
        // Request failed at no fault of the requesting party.
        const INTERNAL_SERVER_ERROR = 500;
        // Request called an action that either does not exist or is not yet available
        const NOT_IMPLEMENTED = 501;
        // The API is temporarily unavailable
        const SERVICE_UNAVAILABLE = 503;
        // The request triggered a call to an external resource that has stopped responding
        const RESOURCE_TIMEOUT = 504;
		
		protected static $statusCodesToStatusStrings = array(
			200 => "OK",
			201 => "CREATED",
			202 => "ACCEPTED",
			206 => "PARTIALLY_CREATED",
			207 => "PARTIALLY_ACCEPTED",
			400 => "BAD_REQUEST",
			401 => "UNAUTHORIZED",
			402 => "USER_NOT_PERMITTED",
			403 => "FORBIDDEN",
			404 => "OBJECT_NOT_FOUND",
			405 => "ACTION_NOT_ALLOWED",
			406 => "FORMAT_NOT_ACCEPTED",
			407 => "UNACCEPTABLE_DATA",
			408 => "DEPRECATED",
			410 => "RESOURCE_NOT_FOUND",
			500 => "INTERNAL_SERVER_ERROR",
			501 => "NOT_IMPLEMENTED",
			503 => "SERVICE_UNAVAILABLE",
			504 => "RESOURCE_TIMEOUT"
		);
		
		public function codeToString($code) {
			if (self::$statusCodesToStatusStrings[$code])
				return self::$statusCodesToStatusStrings[$code];
			else
				return "UNKNOWN_ERROR";
		}
}