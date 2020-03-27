<?php

require_once("/etc/apache2/capstone-mysql/Secrets.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
 $pdo = $secrets->getPdoObject();
//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");
//use Author;

	$authorHash = "hash1235676ghg91gothamhash";

		$authorId = "0ef7cfc1-25d1-4dbe-801d-368737697fff";

		$authorActivationToken = 'o7AbabijebuasjkGE9xo7AFoTGE9x216';

		$authorAvatarUrl = "https://avars.discourse.org/v4/letter/m/a8b319/54.png";

		$authorUsername = "bet9jaA1";
		
		$authorEmail = "tbetByoy@comcast.com";

		$author = new OpeyemiJonah\ObjectOriented\Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);

		//$author->insert($pdo);
		//$author->delete($pdo);
		//Author::getAllObjects($pdo);
		//$author->getSingleObject($pdo, $authorId);
	$author->getAllObjects($pdo);




