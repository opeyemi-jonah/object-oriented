<?php
namespace OpeyemiJonah\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");


use http\Encoding\Stream;
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
	public function __construct($newAuthorId, ?string $newAuthorActivationToken,string $newAuthorAvatarUrl,string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorUsername($newAuthorUsername);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
		} catch(\InvalidArgumentException | \RangeException |\TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/*Accessor for Author Id */

	public function getAuthorId(): uuid {
		return ($this->authorId);
	}

// Mutator for Author Id
	public function setAuthorId($newAuthorId): void {

		//verify the author id is valid
		try {
			$uuid = self::validateUuid($newAuthorId);

		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}var_dump($newAuthorId);
		$this->authorId= $uuid; echo "$uuid";

	}

	/*Accessor for author avatar url */

	public function getAuthorAvatarUrl(): string {
		return ($this->authorAvatarUrl);
	}

	// Mutator for author avatar url
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) : void {

		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		// verify the avatar URL will fit in the database
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("image content too large"));
		}
		// store the image cloudinary content
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/* Accessor for Author activation token */

	public function getAuthorActivationToken(): ?string {
		return ($this->authorActivationToken);
	}

	// Mutator for author activation token
	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
		if($newAuthorActivationToken===null){
			throw (new \InvalidArgumentException("Not token"));
		}
		if (strlen($newAuthorActivationToken)!==32){
			throw (new \RangeException("Must be 32 characters"));
		}

		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/*Accessor for Author Email*/

	public function getAuthorEmail(): string {
		return $this->authorEmail;
	}

	// Mutator for Author email
	public function setAuthorEmail(string $newAuthorEmail): void {

		// verify the email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL,FILTER_FLAG_EMAIL_UNICODE);
		var_dump($newAuthorEmail);

		if($newAuthorEmail === "") {
			throw (new \InvalidArgumentException("Author email is empty or insecure"));
		}

		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw (new \RangeException("Author email is too large"));
		}

		// store the email
		$this->authorEmail = $newAuthorEmail;echo "this i --->$newAuthorEmail".var_dump($newAuthorEmail);
	}

/*Accessor for Author hash from password conversion */

	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	// Mutator for Author hash
	public function setAuthorHash($newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash)===true){
			throw (new \InvalidArgumentException("Not a valid hash"));
		}
		if(strlen($newAuthorHash)>97){
			throw (new \RangeException("Must be 97 character"));
		}
		$this->authorHash = $newAuthorHash;
	}

	/*Accessor for authorUsername */

	public function getAuthorUsername(): string {
		return ($this->authorUsername);
	}


	// Mutator for Author Username
	public function setAuthorUsername(string $newAuthorUsername): void {
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(strlen($newAuthorUsername) > 32) {
			throw (new \RangeException("Username is too long"));
		}
		if(empty($newAuthorUsername) === true) {
			throw (new \InvalidArgumentException("Not a secure username or it is empty"));
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

