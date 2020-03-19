<?php
namespace OpeyemiJonah\ObjectOriented;

//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");
//use Author;
function bar() {
	$authorHash = "1234hGabill75ighowfangvhg";
		$authorId = "7b638665-773f-4474-a692-6402c3539b66";
		$authorActivationToken = 'o7AFoTGE9xo7AFoTGE9xo7AFoTGE9x21';
		$authorAvatarUrl = "https://avatars.discourse.org/v4/letter/m/a8b319/45.png";
		$authorUsername = "OpeyemOOOH";
		$authorEmail = "jonahopeyemi07.oj@gmail.com";

echo $authorEmail;

	$author = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorUsername, $authorEmail, $authorHash);
		echo var_dump($author);
	echo "$authorEmail <br> $authorActivationToken <br> $authorHash ";
	}
bar();


