
<?php

use OpeyemiJonah\ObjectOriented\author;
//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,2)."\php\classes\Author.php");


function bar() {

		$authorId = "1476a610-69eb-11ea-bc55-0242ac130003";
		$authorActivationToken = "o7AFoTGE9xjQiHQK6dAa";
		$authorAvatarUrl = "https://avatars.discourse.org/v4/letter/m/a8b319/45.png";
		$authorUsername = "Gabill007";
		$authorEmail = "gabill007.oj@gmail.com";
		$authorHash = "1234hGabill75ighowfan";

		$author = new author($authorId, $authorActivationToken, $authorAvatarUrl, $authorUsername, $authorEmail, $authorHash);
		echo var_dump($author);
	echo "$authorEmail $authorActivationToken $authorHash ";


	}
bar();


