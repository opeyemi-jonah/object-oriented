<?php
namespace OpeyemiJonah\ObjectOriented\Test;

use OpeyemiJonah\ObjectOriented\{Author};
require_once (dirname(__DIR__). "/Test/DataDesignTest.php");
// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");


class AuthorTest extends DataDesignTest {
	private $VALID_ACTIVATION_TOKEN; //this will be done in the setup
	private $VALID_AVATAR_URL = "https://avatar.org";
	private $VALID_AUTHOR_EMAIL = "ojonah@gmail.com";
	private $VALID_AUTHOR_HASH ; //this will be done in the setup
	private $VALID_USERNAME = "ojonah";

	public function setUp(): void {
		parent::setup();

		$password = "skull%candy\'7";
		$this->VALID_AUTHOR_HASH = $authorHash = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 45]);
			$this->VALID_ACTIVATION_TOKEN = $authorActivationToken = bin2hex(random_bytes(16));

	}

	public function testInsertValidAuthor(): void {
		//get count of author records in db before we run the test
		$numRows = $this->getConnection()->getRowCount("author");

		//insert an author record in the db
		$authorId = generateUuidV4()->toString();
		$author = new Author($authorId,
			$this->VALID_ACTIVATION_TOKEN,
			$this->VALID_AVATAR_URL,
			$this->VALID_AUTHOR_EMAIL,
			$this->VALID_AUTHOR_HASH,
		   $this->VALID_USERNAME);

		//check count of author record in the db after the insert

		//get a copy of the record just inserted and validate the values
		// make sure the values that went into the record are the same ones that come out

	}

	public function testUpdateValidAuthor() : void {

	}

	public function testDeletValidAuthor() : void {

	}

	public function testGetValidAuthorByAuthorId(): void {

	}

	public function testGetValidAuthors() : void {

	}
}