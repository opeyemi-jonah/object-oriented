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
$author->insert($this->getPDO());
		//check count of author record in the db after the insert
		$numRowsAfterInsert = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + 1, $numRowsAfterInsert,"insert checked record count");


		//get a copy of the record just inserted and validate the values
		// make sure the values that went into the record are the same ones that come out
		$pdoAuthor = Author::getAuthorByAuthorId($this->getPDO(), $author->getAuthorId()->getBytes());
		self::assertEquals($authorId,$pdoAuthor->getAuthorId());
		self::assertEquals($this->VALID_ACTIVATION_TOKEN, $pdoAuthor->getAuthorActivationToken());
		self::assertEquals($this->VALID_AVATAR_URL, $pdoAuthor->getAuthorAvatarUrl());
		self::assertEquals($this->VALID_AUTHOR_EMAIL, $pdoAuthor->getAuthorEmail());
		self::assertEquals($this->VALID_AUTHOR_HASH, $pdoAuthor->getAuthorHash());
		self::assertEquals($this->VALID_USERNAME, $pdoAuthor->getAuthorUsername());

	}

	public function testUpdateValidAuthor() : void {
		//get count of author records in db before we run the test
		$numRows = $this->getConnection()->getRowCount("author");

		//update an author record in the db
		$authorId = generateUuidV4()->toString();
		$author = new Author($authorId,
			$this->VALID_ACTIVATION_TOKEN,
			$this->VALID_AVATAR_URL,
			$this->VALID_AUTHOR_EMAIL,
			$this->VALID_AUTHOR_HASH,
			$this->VALID_USERNAME);
		$author->insert($this->getPDO());

		//update a value on the record I just inserted
		$changedAunthorUsername = $this->VALID_USERNAME."changed";
		$author->setAuthorUsername($changedAunthorUsername);
		$author->update($this->getPDO());

		//check count of author record in the db after the insert
		$numRowsAfterInsert = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + 1, $numRowsAfterInsert,"update checked record count");
		//get a copy of the record just inserted and validate the values
		// make sure the values that went into the record are the same ones that come out
		$pdoAuthor = Author::getAuthorByAuthorId($this->getPDO(), $author->getAuthorId()->getBytes());
		self::assertEquals($authorId,$pdoAuthor->getAuthorId());
		self::assertEquals($this->VALID_ACTIVATION_TOKEN, $pdoAuthor->getAuthorActivationToken());
		self::assertEquals($this->VALID_AVATAR_URL, $pdoAuthor->getAuthorAvatarUrl());
		self::assertEquals($this->VALID_AUTHOR_EMAIL, $pdoAuthor->getAuthorEmail());
		self::assertEquals($this->VALID_AUTHOR_HASH, $pdoAuthor->getAuthorHash());
		//verify that the saved username is same as the updated username
		self::assertEquals($changedAunthorUsername, $pdoAuthor->getAuthorUsername());

	}

	public function testDeletValidAuthor() : void {
		//get count of author records in db before we run the test
		$numRows = $this->getConnection()->getRowCount("author");

		//delete an author record in the db
		$authorId = generateUuidV4()->getBytes();
		$author = new Author($authorId,
			$this->VALID_ACTIVATION_TOKEN,
			$this->VALID_AVATAR_URL,
			$this->VALID_AUTHOR_EMAIL,
			$this->VALID_AUTHOR_HASH,
			$this->VALID_USERNAME);
		$author->delete($this->getPDO());
		//check count of author record in the db after the insert
		$numRowsAfterDelete = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + 0, $numRowsAfterDelete,"delete, checked record count");

	}

	public function testGetValidAuthorByAuthorId(): void {
//get count of author records in db before we run the test
		$numRows = $this->getConnection()->getRowCount("author");
		//get an author record in the db by Id
		$authorId = generateUuidV4()->toString();
		$author = new Author($authorId,
			$this->VALID_ACTIVATION_TOKEN,
			$this->VALID_AVATAR_URL,
			$this->VALID_AUTHOR_EMAIL,
			$this->VALID_AUTHOR_HASH,
			$this->VALID_USERNAME);
		$author->insert($this->getPDO());
		$author->getAuthorByAuthorId($this->getPDO(),$authorId);
		//check count of author record in the db after the insert
		$numRowsAfter = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + 1, $numRowsAfter,"checked record count");
	}

/*
	public function testGetValidAuthors() : void {

	}
*/
}