<?php

use OpeyemiJonah\ObjectOriented\Author;
require ("uuid.php");
require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once ("../classes/Author.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
 $pdo = $secrets->getPdoObject();

//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");
//use Author;

$password = "$\skull_skunk_%year";
$authorHash = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 45]);

		$authorId = "3f49fd80-2e13-40f5-bb34-ba5c7359e7b2";

$authorActivationToken = bin2hex(random_bytes(16));

		$authorAvatarUrl = "https://avars.discourse.org/v4/letter/m/a8b319/newHomie90.png";

		$authorUsername = "Ameer";
		
		$authorEmail = "Kilo@gnail.edu";

		$author = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);

$author->getAuthorByUsername($pdo,"A");
echo " Here"."<br>";
echo "hash: ".$author->getAuthorHash();

//print_r($getSingleObj);

/*
$email = $author->getAuthorByEmail($pdo,$authorEmail);

echo " this is the result: ".'<br>';

var_dump($email);
print_r($email);

//$auth = $author->getAuthor($pdo,$authorId);

//$authors = Author::getAllAuthor($pdo);
//$authors =  $author->getAllAuthor($pdo);

		//$author->delete($pdo);
		//Author::getAllAuthor($pdo);
	//$authors->getAllAuthor($pdo);
*/