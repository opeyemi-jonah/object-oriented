<?php
namespace OpeyemiJonah\ObjectOriented;
require_once(dirname(__DIR__) . "/vendor/autoload.php");
use ramsey\Uuid\Uuid;

class Author implements \JsonSerializable{
	use ValidateUuid;
	/**
	 * id for this author; this is the primary key
	 * @var Uuid $profileId
	 **/
	/*
	 * create table author(
  authorId binary(16) not null,
  authorActivationToken char(32),
  authorAvatarUrl varchar(255),
  authorEmail varchar(128) not null,
  authorHash char(97) not null,
  authorUsername varchar(32) not null,
  unique(authorEmail),
  unique(authorUsername),
  primary key(authorId)
);
	 */

	private $authorId;

	private $authorActivationToken;

	private $authorAvatarUrl;

	private $authorEmail;

	private $authorHash;

	private $authorUsername;

	/*
	 * Constructors
	 */
	public function __construct($newAuthorId, ?string $newAuthorActivationToken,string $newAuthorAvatarUrl, string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {
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

	/*
	 * Getters for attributes
	 */

	/**
	 * @return Uuid
	 */
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}

	/**
	 * @return mixed
	 */
	public function getAuthorActivationToken() :?string {
		return ($this->authorActivationToken);
	}

	/**
	 * @return mixed
	 */
	public function getAuthorUsername() : string {
		return ($this->authorUsername);
	}

	/**
	 * @param mixed $authorAvatarUrl
	 */
	public function getAuthorAvatarUrl($authorAvatarUrl): void {
		$this->authorAvatarUrl = $authorAvatarUrl;
	}

	/**
	 * @return mixed
	 */
	public function getAuthorEmail():string {
		return ($this->authorEmail);
	}

	/**
	 * @return mixed
	 */
	public function getAuthorHash() : string {
		return ($this->authorHash);
	}
	/*
	 * Mutator
	 */

	/**
	 * @param Uuid $newAuthorId
	 */
	public function setAuthorId(Uuid $newAuthorId): void {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->authorId = $newAuthorId;
	}

	/**
	 * @param mixed $authorActivationToken
	 */
	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
		if($newAuthorActivationToken===null){
			throw (new \InvalidArgumentException("Not token"));
		}
		if (strlen($newAuthorActivationToken)!==32){
			throw (new \RangeException("Must be 32 characters"));
		}

		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/**
	 * @param string $newAuthorUsername
	 */
	public function setAuthorUsername(string $newAuthorUsername): void {
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername,FILTER_SANITIZE_STRING,FILTER_FLAG_NO_ENCODE_QUOTES);
		if(strlen($newAuthorUsername)>32){
			throw (new \RangeException("Username is too long"));
		}
		if(empty($newAuthorUsername)===true){
			throw (new \InvalidArgumentException("Not a secure username or it is empty"));
		}
		$this->authorUsername = $newAuthorUsername;
	}

	/**
	 * @return mixed
	 */
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

	/**
	 * @param mixed $authorEmail
	 */
	public function setAuthorEmail(string $newAuthorEmail): void {
		$newAuthorEmail= trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail)===true){
			throw (new \InvalidArgumentException("Please make sure it is an email"));
		}
		if(strlen($newAuthorEmail)>128){
			throw (new \RangeException("Email is too long"));
		}
		$this->authorEmail = $newAuthorEmail;
	}

	/**
	 * @param mixed $authorHash
	 */
	public function setAuthorHash($newAuthorHash): void {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash)===true){
			throw (new \InvalidArgumentException("Not a valid hash"));
		}
		if(strlen($newAuthorHash)!==97){
			throw (new \RangeException("Must be 97 character"));
		}
		$this->authorHash = $newAuthorHash;
	}

	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["authorId"] = $this->authorId->toString();
		unset($fields["authorActivationToken"]);
		unset($fields["authorHash"]);
		return ($fields);

	}


}