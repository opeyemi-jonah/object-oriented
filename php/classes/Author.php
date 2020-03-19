<?php
namespace OpeyemiJonah\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/*
This is a class made for registering books in a library or book stored
@author Opeyemi Jonah <gavrieljonah@gmail.com>

*/
use validateUuid;
class author {


	/*

	*/

	private $authorId;

	/*

	*/

	private $authorAvatarUrl;

	/*

	*/

	private string $authorActivationToken;

	/*

	*/

	private $authorEmail;

	/*

	*/

	private $authorHash;

	/*

	*/

	private string $authorUsername;

	/*
	 * Making constructors
	 * $newTweetId, $newTweetProfileId, string $newTweetContent, $newTweetDate = null
	 */
	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl = null, string $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setTAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this . $this->setAuthorUsername();
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/*Accessor for Author Id */

	public function getAuthorId(): uuid {
		return ($this->authorId);
	}

// Mutator for Author Id
	public function setAuthorId($newAuthorId) {
		//verify the author id is valid
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/*Accessor for author avatar url */

	public function getAuthorAvatarUrl(): string {
		return ($this->authorAvatarUrl);
	}

	// Mutator for author avatar url
	public function setAuthorAvatarUrl($newAuthorAvatarUrl): void {
		//verify the author url and error handlers
		try {
			$uuid = self::validateUuid($newAuthorAvatarUrl);

		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/* Accessor for Author activation token */

	public function getAuthorActivationToken(): ?string {
		return ($this->authorActivationToken);
	}

	// Mutator for author activation token
	public function setAuthorActivationToken($newAuthorActivationToken): void {
		try {
			$uuid = self::validateUuid($newAuthorActivationToken);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/*Accessor for Author Email*/

	public function getAuthorEmail(): string {
		return $this->authorEmail;
	}

	// Mutator for Author email
	public function setAuthorEmail(string $newAuthorEmail): void {


		//error handlers
		try {
			$uuid = self::validateUuid($newAuthorEmail);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/*Accessor for Author hash from password conversion */

	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	// Mutator for Author hash
	public function setAuthorHash(string $newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw (new \InvalidArgumentException("Please insert the right data!"));
		}
		if(strlen($newAuthorHash) !== 97) {
			throw(new \RangeException("Limit exceeded, please insert something less"));
		}
	}

	/*Accessor for authorUsername */

	public function getAuthorUsername(): string {
		return ($this->authorUsername);
	}


	// Mutator for Author Username
	public function setAuthorUsername(string $newAuthorUsername) {
		//verify the author Username is valid and error handlers
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_QUOTES);
if (empty($newAuthorUsername)=== true){
	throw(new \InvalidArgumentException("username is empty or insecure "));
}
if (strlen($newAuthorUsername)>32){
	throw (new \RangeException("Username is too long. Please use shorter username"));
}
//store the username
		$this->authorUsername = $newAuthorUsername;

	}
}
?>
