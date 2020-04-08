<?php

use OpeyemiJonah\ObjectOriented\Author;

require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once ("../classes/Author.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
 $pdo = $secrets->getPdoObject();
//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");
//use Author;

$password = "$\skull_skunk_%year";
$authorHash = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 45]);

		$authorId = "3134e90a-e3a5-4df2-abff-7cc7d8324530";

		$authorActivationToken;

		$authorAvatarUrl = "https://avars.discourse.org/v4/letter/m/a8b319/squad4.png";

		$authorUsername = "Andre3000";
		
		$authorEmail = "Aundre@cnm.edu";

		$author = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);

//$author->insert($pdo);
echo " Here"."<br>";
$getSingleObj=$author->getAuthor($pdo,$authorId);

//print_r($getSingleObj);


$email = $author->getAuthorByEmail($pdo,$authorEmail);

echo " this is the result: ".'<br>';

//var_dump($email);
print_r($email);

//$auth = $author->getAuthor($pdo,$authorId);

//$authors = Author::getAllAuthor($pdo);
//$authors =  $author->getAllAuthor($pdo);

		//$author->delete($pdo);
		//Author::getAllAuthor($pdo);
	//$authors->getAllAuthor($pdo);



