<?php

require_once("/etc/apache2/capstone-mysql/Secrets.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
 $pdo = $secrets->getPdoObject();
//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");
//use Author;

	$authorHash = "hash1235676ghg91238388292hash";

		$authorId = "7b638665-773f-4474-a692-6402c3539b66";

		$authorActivationToken = 'o7AFoTGE9xo7AFoTGE9xo7AFoTGE9x21';

		$authorAvatarUrl = "https://avatars.discourse.org/v4/letter/m/a8b319/45.png";

		$authorUsername = "Username07";
		
		$authorEmail = "ojonahOpeyemei@yahoo.com";

		$author = new OpeyemiJonah\ObjectOriented\Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);
echo var_dump($author);  echo "I am sure it is my email $authorEmail";

$connection = new PDO("mysql:host:localhost")




