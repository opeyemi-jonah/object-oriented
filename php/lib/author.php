<?php
use OpeyemiJonah\ObjectOriented\Author;
require ("uuid.php");
require_once("/etc/apache2/capstone-mysql/Secrets.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
 $pdo = $secrets->getPdoObject();

require_once (dirname(__DIR__,1)."/classes/Author.php");

$password = "funny";
$authorHash = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 45]);

		$authorId = "f8817c2f-a6c5-433b-99e6-78b53ed8d4e8";

$authorActivationToken = bin2hex(random_bytes(16));

		$authorAvatarUrl = "https://strapss.discourse.org/v4/letter/m/a8b319/newHomie90.png";

		$authorUsername = "zilo";
		
		$authorEmail = "zilowo@gnail.edu";

		$author = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);

print_r($author->getAuthorByUsername($pdo,"z"));
//$author->insert($pdo);
echo " Here"."<br>";
echo "hash: ".$author->getAuthorHash();

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