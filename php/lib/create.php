<?php
use OpeyemiJonah\ObjectOriented\Author;
//require_once (__DIR__)."uuid.php";
require ("uuid.php");

require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once ("../classes/Author.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
$pdo = $secrets->getPdoObject();
//require_once("/etc/apache2/capstone-mysql/Secrets.php");

require_once (dirname(__DIR__,1)."/classes/Author.php");
//use Author;

//$num1 = $_POST['number1'];
//$num2 = $_POST['number2'];

//$authorId = "3134e90a-e3a5-4df2-abff-7cc7d8324530";



$authorAvatarUrl = "https://avars.discourse.org/v4/letter/m/a8b319/squad4.png";

//               $password = "$_POST['$authorHash']";


if(isset($_POST['submit'])) {

	try{$authorUsername = $_POST['authorUsername'];
		$authorEmail = $_POST['authorEmail'];

		$authorActivationToken = bin2hex(random_bytes(16));

		$authorHash = password_hash($_POST['$authorHash'], PASSWORD_ARGON2I, ["time_cost" => 45]);

		$author = new Author(generateUuidV4(), $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);
		$author->insert($pdo);
	}
	catch(Exception $exception){
		$exception->getMessage();
	}


}

?>


<!DOCTYPE html>
<html lang="en">

<form method="post" action="../classes/Author.php">
	<label for="authorEmail">Insert email: </label>
	<input type="email" name="authorEmail" id="authorEmail"><br>

	<label for="authorHash">Insert password: </label>
	<input type="email" name="authorHash" id="authorHash"><br>

	<label for="authorUsername">Insert username: </label>
	<input type="email" name="authorUsername" id="authorUsername"><br>
	<input type="submit" value="Submit">




</form>

</html>