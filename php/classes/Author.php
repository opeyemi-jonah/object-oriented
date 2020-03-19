<?php
namespace OpeyemiJonah\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");


use Ramsey\Uuid\Uuid;
/*
This is a class made for registering books in a library or book stored
@author Opeyemi Jonah <gavrieljonah@gmail.com>

*/


class Author implements \JsonSerializable {
	use ValidateUuid;

	/*

	*/

	private $authorId;

	/*

	*/

	private $authorAvatarUrl;

	/*

	*/

	private $authorActivationToken;

	/*

	*/

	private $authorEmail;

	/*

	*/

	private $authorHash;

	/*

	*/

	private $authorUsername;

	/*
	 * Making constructors
	 *
	 */
	public function __construct($newAuthorId, ?string $newAuthorActivationToken, $newAuthorAvatarUrl = null,$newAuthorEmail,string $newAuthorHash,string $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} //determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

	}

	/*Accessor for Author Id */
	private static function validateUuid($newAuthorId) {
		echo "hello";
	}

	public function getAuthorId(): uuid {
		return ($this->authorId);
	}

// Mutator for Author Id
	public function setAuthorId($newAuthorId): void {
		var_dump($newAuthorId);
		//verify the author id is valid
		try {
			$uuid = self::validateUuid($newAuthorId);
			var_dump($uuid);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
$this->authorId= $uuid;
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

		// verify the email is secure
		$newProfileEmail = trim($newAuthorEmail);
		$newProfileEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("Author email is empty or insecure"));
		}

		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("Author email is too large"));
		}

		// store the email
		$this->AuthorEmail = $newAuthorEmail;
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
		//change !== to > for demo sake
		if(strlen($newAuthorHash) > 97) {
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
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING);
if (empty($newAuthorUsername)=== true){
	throw(new \InvalidArgumentException("username is empty or insecure "));
}
if (strlen($newAuthorUsername)>32){
	throw (new \RangeException("Username is too long. Please use shorter username"));
}
//store the username
		$this->authorUsername = $newAuthorUsername;

	}
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["authorId"] = $this->authorId->toString();
		return($fields);
	}

}
?>
