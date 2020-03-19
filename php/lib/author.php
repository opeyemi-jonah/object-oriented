<?php

use OpeyemiJonah\ObjectOriented\author;

require_once (dirname(__DIR__,1)."\classes\Author.php");

class foo {

	public static function bar() {

		$authorId = "1476a610-69eb-11ea-bc55-0242ac130003";
		$authorAuthorActivationToken = "o7AFoTGE9xjQiHQK6dAa";
		$authorAvatarUrl = "https://avatars.discourse.org/v4/letter/m/a8b319/45.png";
		$authorUsername = "Gabill007";
		$authorEmail = "gabill007.oj@gmail.com";
		$authorHash = "1234hGabill754crashdollarsign";

		$author = new author(authorId, authorActivationToken, authorAvatarUrl, authorUsername, authorEmail, authorHash);
		echo var_dump($authorId);
		echo $authorEmail;
		echo 'i work!';
	}
}