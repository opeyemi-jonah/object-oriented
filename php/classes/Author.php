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
// I
		if(empty($newAuthorEmail) === true) {
			throw (new \InvalidArgumentException("Author email is empty or insecure"));
		}

		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw (new \RangeException("Author email is too large"));
		}

		// store the email
		$this->authorEmail = $newAuthorEmail;
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
	/**
	 * inserts this Tweet into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo) : void {

		// create query template
		$query = "INSERT INTO author(authorId,authorActivationToken, authorAvatarUrl, authorEmail, authorHash,authorUsername) VALUES(:authorId,:authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holders in the template

		$parameters = ["authorId" => $this->autorId->getBytes(), "authorActivationToken"=> $this->authorActivationToken->getBytes(),
			"authorAvatarUrl" => $this->authorAvatarUrl->getBytes(), "authorEmail" => $this->authorEmail->getBytes(), "authorHash"=>$this->authorHash->getBytes(),
			"authorUsername"=>$this->authorUsername->getBytes()];
		$statement->execute($parameters);
	}


	/**
	 * deletes this attributes from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["authorId" => $this->authorId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this Tweet in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE author SET :authorId,:authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername";
		$statement = $pdo->prepare($query);



		$parameters = ["authorId" => $this->autorId->getBytes(), "authorActivationToken"=> $this->authorActivationToken->getBytes(),
			"authorAvatarUrl" => $this->authorAvatarUrl->getBytes(), "authorEmail" => $this->authorEmail->getBytes(), "authorHash"=>$this->authorHash->getBytes(),
			"authorUsername"=>$this->authorUsername->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * gets the author by authorId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorId author id to search for
	 * @return author |null Tweet found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getAuthorbyAuthorId(\PDO $pdo, $authorId) : ?Author {
		// sanitize the tweetId before searching
		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT authorId,authorActivationToken, authorAvatarUrl, authorEmail, authorHash,authorUsername FROM tweet WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		// bind the author id to the place holder in the template
		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);

		// grab the author from mySQL
		try {
			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$author = new Tweet($row["authorId"], $row["tweetProfileId"], $row["tweetContent"], $row["tweetDate"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return($author);
	}

	/**
	 * gets author by author Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $authorEmail profile id to search by
	 * @return \SplFixedArray SplFixedArray of Tweets found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAuthorByAuthorEmail(\PDO $pdo, $authorEmail) : \SplFixedArray {

		try {
			$authorEmail = self::validateUuid($authorEmail);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}//????What's going on here
		// create query template
		$query = "SELECT authorId, authorEmail, tweetContent, tweetDate FROM tweet WHERE tweetProfileId = :tweetProfileId";
		$statement = $pdo->prepare($query);
		// bind the tweet profile id to the place holder in the template
		$parameters = ["tweetProfileId" => $tweetProfileId->getBytes()];
		$statement->execute($parameters);
		// build an array of tweets
		$tweets = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$tweet = new Tweet($row["tweetId"], $row["tweetProfileId"], $row["tweetContent"], $row["tweetDate"]);
				$tweets[$tweets->key()] = $tweet;
				$tweets->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($tweets);
	}

	/**
	 * gets the Tweet by content
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param string $tweetContent tweet content to search for
	 * @return \SplFixedArray SplFixedArray of Tweets found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAuthorByUsername(\PDO $pdo, string $authorUsername) : \SplFixedArray {
		// sanitize the description before searching
		$tweetContent = trim($authorUsername);
		$tweetContent = filter_var($authorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($authorUsername) === true) {
			throw(new \PDOException("tweet content is invalid"));
		}

		// escape any mySQL wild cards
		$tweetContent = str_replace("_", "\\_", str_replace("%", "\\%", $tweetContent));

		// create query template
		$query = "SELECT authorId,authorEmail, authorUsername FROM author WHERE authorUsername";
		$statement = $pdo->prepare($query);

		// bind the tweet content to the place holder in the template
		$tweetContent = "%$tweetContent%";
		$parameters = ["tweetContent" => $tweetContent];
		$statement->execute($parameters);

		// build an array of authors
		$tweets = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$author= new author($row["authorId"], $row["authorEmail"], $row["authorUsername"]);
				$author[$author->key()] = $author;
				$author->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($author);
	}

	/**
	 * gets all Tweets
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Tweets found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllTweets(\PDO $pdo) : \SPLFixedArray {
		// create query template
		$query = "SELECT tweetId, tweetProfileId, tweetContent, tweetDate FROM tweet";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of authors
		$tweets = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$author= new author($row["authorId"], $row["authorEmail"], $row["authorUsername"]);
				$author[$author->key()] = $author;
				$author->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($author);
	}


	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["authorId"] = $this->authorId->toString();
		return($fields);
	}

}
?>

