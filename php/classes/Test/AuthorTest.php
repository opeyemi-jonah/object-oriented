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
		//get a copy of the record just updated and validate the values
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

	public function testDeleteValidAuthor() : void {

		//get count of author records in db before we run the test
		$numRows = $this->getConnection()->getRowCount("author");

		$insertedRow = 3;

		//insert multiple rows for testing
		for ($i=0; $i < $insertedRow; $i++){
			//insert  author record in the db
			$authorId = generateUuidV4()->toString();
			$author = new Author($authorId,
				$this->VALID_ACTIVATION_TOKEN,
				$this->VALID_AVATAR_URL,
				$this->VALID_AUTHOR_EMAIL . $i,
				$this->VALID_AUTHOR_HASH,
				$this->VALID_USERNAME . $i);
			$author->insert($this->getPDO());
		}

		//get a copy of the record just updated and validate the values
		// make sure the values that went into the record are the same ones that come out
		$numRowsAfterInsert = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + $insertedRow, $numRowsAfterInsert);

		//now delete the last record we inserted
		$author->delete($this->getPDO());

		//try to get the last record we inserted. it should not exist.
		$pdoAuthor = Author::getAuthorByAuthorId($this->getPDO(),$author->getAuthorId()->toString());
		//validate that only one record was deleted.
		$numRowsAfterDelete = $this->getConnection()->getRowCount("author");
		self::assertEquals($numRows + $insertedRow - 1, $numRowsAfterDelete);


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


	public function testGetValidAuthors() : void {
		//how many records were in the db before we start?
		$numRows = $this->getConnection()->getRowCount("author");
		$rowsInserted = 5;

		//now insert 5 rows of data
		for ($i=0; $i<$rowsInserted; $i++){
			$authorId = generateUuidV4()->toString();
			$author = new Author($authorId, $this->VALID_ACTIVATION_TOKEN,
				$this->VALID_AVATAR_URL,
				$this->VALID_AUTHOR_EMAIL . $i,
				$this->VALID_AUTHOR_HASH,
				$this->VALID_USERNAME . $i);
			$author->insert($this->getPDO());
		}

		//validate new row count in the table - should be old row count + 1 if insert is successful
		self::assertEquals($numRows + $rowsInserted, $this->getConnection()->getRowCount("author"));

		//validate number of rows coming back from our function.
		self::assertEquals($numRows + $rowsInserted, $author->getAllAuthors($this->getPDO())->count());
	}

}