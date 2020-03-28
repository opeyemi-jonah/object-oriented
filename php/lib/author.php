<?php
require_once("/etc/apache2/capstone-mysql/Secrets.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
 $pdo = $secrets->getPdoObject();
//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");
//use Author;

	$authorHash = "hash1235676ghg91gothamhash";

		$authorId = "f2bcd9cc-3a9c-4584-be68-36085c367803";

		$authorActivationToken = 'o7AbabijebuasjkGE9xo7AFoTGE9x216';

		$authorAvatarUrl = "https://avars.discourse.org/v4/letter/m/a8b319/54.png";

		$authorUsername = "User2007";
		
		$authorEmail = "DeepC@cnm.edu";

		$author = new OpeyemiJonah\ObjectOriented\Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);

//$author->update($pdo);
//$authors = Author::getAllObjects($pdo);
//$authors =  $author->getAllObjects($pdo);
//var_dump($authors);
		//$author->delete($pdo);
		//Author::getAllObjects($pdo);
		//$author->getSingleObject($pdo, $authorId);
	//$authors->getAllObjects($pdo);
var_dump($author->getSingleObject($pdo, $authorId));




