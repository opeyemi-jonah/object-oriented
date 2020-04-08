<?php
namespace OpeyemiJonah\ObjectOriented;

 require_once("autoload.php");


use http\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use http\Encoding\Stream;
use TypeError;

/*
This is a class made for registering books in a library or book stored
@author Opeyemi Jonah <gavrieljonah@gmail.com>
*/


class Author implements \JsonSerializable  {
	use ValidateUuid;



	/**
	 * id for this Tweet; this is the primary key
	 * @var Uuid $authorId
	 **/
	private $authorId;

	/*
	 * Avatar Url for Author
	 * @var string $authorAvatarUrl
	 **/


	private $authorAvatarUrl;

	/*
	 * Activation Token
	 * @var string $authorActivationToken
	*/

	private $authorActivationToken;

	/*
	 * Author Email
	 * @var string $authorEmail
	*/

	private $authorEmail;

	/*
	 * password hash
	 * @var string $authorHash
	*/

	private $authorHash;

	/*
	 * Author username
	 * @var string $authorUsername
	*/

	private $authorUsername;

	/**
	 * constructor for this Tweet
	 *
	 * @param string|Uuid $newAuthorId id of the author
	 * @param string $newAuthorActivationToken string containing Activation token
	 * @param string $newAuthorAvatarUrl string containing avatar url
	 * @param string $newAuthorEmail string containing email
	 * @param string $newAuthorHash string containing hash for password
	 * @param string $newAuthorUsername string containing username
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */
	public function __construct($newAuthorId, ?string $newAuthorActivationToken,?string $newAuthorAvatarUrl,string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorUsername($newAuthorUsername);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
		} catch(\InvalidArgumentException | \RangeException |TypeError | \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * Accessor for author id
	 *
	 * @return uuid
	 */

	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}


	/**
	 *Mutator for author id
	 * @param Uuid|string $newAuthorId new value of author id
	 * @throws \RangeException  if $newAuthorId range is more than 16
	 * @throws \InvalidArgumentException if $newAuthorId data type is Invalid
	 * @throws TypeError if $newAuthorId is not a uuid or string
	 */
	public function setAuthorId($newAuthorId): void {

		//verify the author id is valid
		try {
			$uuid = self::validateUuid($newAuthorId);

		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//store value into a uuid format
		$this->authorId= $uuid;
	}

	/*
	 * Accessor for author avatar url
	 * @returns a string value for the Author avatar url
	 *  */

	public function getAuthorAvatarUrl(): ?string {
		return ($this->authorAvatarUrl);
	}

	/**
	 *Mutator for author Avatar url
	 * @param string $newAuthorAvatarUrl new value of author avatar url
	 * @throws \RangeException  if $newAuthorAvatarUrl range is over 255
	 * @throws \InvalidArgumentException if $newAuthorAvatarUrl data type is Invalid
	 * @throws TypeError if $newAuthorAvatar is not a string
	 */

	public function setAuthorAvatarUrl(?string $newAuthorAvatarUrl) : void {
		try {
			// Making sure there are no whitespaces
			$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
			$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

			// verify the avatar URL will fit in the database
			if(strlen($newAuthorAvatarUrl) > 255) {
				throw(new \RangeException("image content too large"));
			}
		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		// store the image cloudinary content
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}

	/* Accessor for Author activation token */

	public function getAuthorActivationToken(): ?string {
		return ($this->authorActivationToken);
	}

	/**
	 * @param string|null $newAuthorActivationToken
	 * @param string $newAuthorActivationToken new value of author id
	 * @throws \RangeException  if $newAuthorActivationToken range is not equal to 32
	 * @throws \InvalidArgumentException if $newAuthorActivationToken data type is Invalid
	 * @throws TypeError if $newAuthorActivationToken is not a string
	 */

	public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
try{

	if($newAuthorActivationToken === null) {
		$this->authorActivationToken = null;
		return;
	}
	//Verifying field is not empty
	if(ctype_xdigit($newAuthorActivationToken)===false){
		throw (new \InvalidArgumentException("Not token"));
	}
	//Making sure the input matches the database character length
	if (strlen($newAuthorActivationToken)!==32){
		throw (new \RangeException("Must be 32 characters"));
	}
} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
	$exceptionType = get_class($exception);
	throw(new $exceptionType($exception->getMessage(), 0, $exception));
}
			//store object value based on new input from a user
		$this->authorActivationToken = $newAuthorActivationToken;
	}

	/*Accessor for Author Email
	*
	 * @return string value for author email
	 */


	public function getAuthorEmail(): string {
		return $this->authorEmail;
	}

	/**
	 * @param string $newAuthorEmail new value of author id
	 * @throws \RangeException  if $newAuthorEmail range
	 * @throws \InvalidArgumentException if $newAuthorEmail data type is Invalid or insecure
	 * @throws \TypeError if $newAuthorEmail is not a string
	 */

	public function setAuthorEmail(string $newAuthorEmail): void {
try{
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
} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
	$exceptionType = get_class($exception);
	throw(new $exceptionType($exception->getMessage(), 0, $exception));
}


		// store the email
		$this->authorEmail = $newAuthorEmail;
	}

/*Accessor for Author hash from password conversion
*
 * @returns string value for Author hash
 * */

	public function getAuthorHash(): string {
		return ($this->authorHash);
	}

	/**
	 * @param $newAuthorHash
	 * @throws \RangeException  if $newAuthorHash range is greater that 97
	 * @throws \InvalidArgumentException if $newAuthorHash data type is Invalid
	 * @throws \TypeError if $newAuthorHash is not a string
	 */

	public function setAuthorHash($newAuthorHash): void {

		try{
			//enforce that the hash is properly formatted
			$newAuthorHash = trim($newAuthorHash);
			if(empty($newAuthorHash) === true) {
				throw (new \InvalidArgumentException("Not a valid hash"));
			}


			//enforce the hash is really an Argon hash
			$authorHashInfo = password_get_info($newAuthorHash);
			if($authorHashInfo["algoName"] !== "argon2i") {
				throw(new \InvalidArgumentException("profile hash is not a valid hash"));
			}

			//enforce that the hash is exactly 97 characters.
			if(strlen($newAuthorHash)>97){
				throw (new \RangeException("Must be 97 character"));
			}

		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}

		//store the hash
		$this->authorHash = $newAuthorHash;
	}

	/*Accessor for authorUsername
	*
	*@returns string value for Author username
	*/

	public function getAuthorUsername(): string {
		return ($this->authorUsername);
	}


	/*Mutator for Author Username
	 * @param $newAuthorUsername
	 * @throws \RangeException  if $newAuthorUsername range
	 * @throws \InvalidArgumentException if $newAuthorHash data type is Invalid
	 * @throws \TypeError if $newAuthorUsername is not a string
	 */

	public function setAuthorUsername(string $newAuthorUsername): void {

		try{
			$newAuthorUsername = trim($newAuthorUsername);
			$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(strlen($newAuthorUsername) > 32) {
				throw (new \RangeException("Username is too long"));
			}
			if(empty($newAuthorUsername) === true) {
				throw (new \InvalidArgumentException("Not a secure username or it is empty"));
			}
		}
		catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//store the username
		$this->authorUsername = $newAuthorUsername;
	}


	/**
	 * inserts into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo) : void  {


		// create query template
		$query = "INSERT INTO author(authorId,authorActivationToken, authorAvatarUrl, authorEmail, authorHash,authorUsername) 
						VALUES(:authorId,:authorActivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
		$statement = $pdo->prepare($query);

		//binding table attributes to placeholders
		$parameters = ["authorId" => $this->authorId->getBytes(),"authorActivationToken"=>$this->authorActivationToken,"authorAvatarUrl"=>$this->authorAvatarUrl,"authorEmail"=>$this->authorEmail,
								"authorHash"=>$this->authorHash, "authorUsername"=>$this->authorUsername];
		$statement->execute($parameters);
	}


	/**
	 * deletes this attributes from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// create query template
		$query = "DELETE FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);

		$parameters = ["authorId" =>$this->authorId->getBytes()];
		$statement ->execute($parameters);
	}

	/**
	 * updates author into SQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// create query template
		$query = "UPDATE author SET
 	authorActivationToken =:authorActivationToken,
 	authorAvatarUrl  = :authorAvatarUrl, 
 	authorEmail = :authorEmail,
  	authorHash = :authorHash, 
	authorUsername = :authorUsername
 					WHERE authorId = :authorId";

		$statement = $pdo->prepare($query);


//binds class objects to sql placeholders
		$parameters = ["authorId"=> $this->authorId->getBytes(),
							"authorActivationToken"=>$this->authorActivationToken,
							"authorAvatarUrl"=>$this->authorAvatarUrl,
							"authorEmail"=>$this->authorEmail,
							"authorHash"=>$this->authorHash,
							"authorUsername"=>$this->authorUsername];

		$statement->execute($parameters);
	}

	/**
	 * pulls all Author data from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray
	 * @throws \PDOException when mySQL related errors occur
	 * @throws TypeError if $pdo is not a PDO connection object
	 **/

	public function getAllAuthor(\PDO $pdo) {
		// create query template
		$query= "SELECT * FROM author";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of author
		$authors = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$author = new Author($row["authorId"],$row["authorActivationToken"],$row["authorAvatarUrl"],$row["authorEmail"],$row["authorHash"],$row["authorUsername"]);
				//To know the length of an array when you have no clue what's in it
				$authors[$authors->key()] = $author;
				$authors->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}

		return ($authors);

		//Fetch all authors from database
		//$row = $statement->fetchAll();

		//returned Array of author
		//return $row;

	}

	/**
	 * gets a single data from the Author table in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @return Author|null
	 * @throws \PDOException when mySQL related errors occur
	 * @throws TypeError if $pdo is not a PDO connection object
	 **/
	public function getAuthor(\PDO $pdo, $authorId): ?Author {
		//create query template
		$query = "SELECT authorId,
		authorActivationToken,
		authorAvatarUrl,
		authorEmail,
		authorHash,
		authorUsername 
		FROM author WHERE authorId = :authorId";
		$statement = $pdo->prepare($query);
		try {
			$authorId = self::validateUuid($authorId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		//bind the objects to their respective placeholders in the table
		$parameters = ["authorId" => $authorId->getBytes()];
		$statement->execute($parameters);

		//grab author from database

			$author = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false){
				//instantiate author object and push data into it
				$author = new Author($row["authorId"],
					$row["authorActivationToken"],
					$row["authorAvatarUrl"],
					$row["authorEmail"],
					$row["authorHash"],
					$row["authorUsername"]);
			}
			return ($author);


	}
//get author by Email

	/**
	 * gets author by Email from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param $authorEmail
	 * @return Author
	 */
	public function getAuthorByEmail(\PDO $pdo, $authorEmail): Author {

//create query template
		$query = "SELECT authorId,
		authorActivationToken,
		authorAvatarUrl,
		authorEmail,
		authorHash,
		authorUsername 
		FROM author 
		 WHERE authorEmail = :authorEmail";
		$statement = $pdo->prepare($query);

		//bind the objects to their respective placeholders in the table
		$parameters = ["authorEmail" => $authorEmail];
		$statement->execute($parameters);

		//grab author from database

		$author = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false){
			//instantiate author object and push data into it
			$author = new Author($row["authorId"],
				$row["authorActivationToken"],
				$row["authorAvatarUrl"],
				$row["authorEmail"],
				$row["authorHash"],
				$row["authorUsername"]);
		}
		return ($author);

	}


	/**
	 * converts uuid to human readable format
	 * @return array of strings
	 **/

	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["authorId"] = $this->authorId->toString();
		return($fields);
		unset($fields[$authorActivationToken]);
		unset($fields[$authorHash]);
		return ($fields);
	}

}


