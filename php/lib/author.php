<?php

use OpeyemiJonah\ObjectOriented\author;
//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");

function bar() {

		$authorId = "7b638665-773f-4474-a692-6402c3539b66";
		$authorActivationToken = "o7AFoTGE9xjQiHQK6dAa";
		$authorAvatarUrl = "https://avatars.discourse.org/v4/letter/m/a8b319/45.png";
		$authorUsername = "Gabill007";
		$authorEmail = "gabill007.oj@gmail.com";
		$authorHash = "1234hGabill75ighowfangvhg";

		$author = new author($authorId, $authorActivationToken, $authorAvatarUrl, $authorUsername, $authorEmail, $authorHash);
		echo var_dump($author);
	echo "$authorEmail <br> $authorActivationToken <br> $authorHash ";
	}
bar();


