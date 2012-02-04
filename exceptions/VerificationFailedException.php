<?php
/**
 * Verification failed exception
 * Responses are verified by checking the signature and public key against
 * the response data. If the verification fails, this exception is thrown
 *
 * No Copyright
 * No Rights Reserved
 */
namespace apptrackr\exceptions;

class VerificationFailedException extends \Exception {
}
?>