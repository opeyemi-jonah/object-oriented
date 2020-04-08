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
//$authorUsername = $_POST['authorUsername'];
//$authorEmail = $_POST['authorEmail'];

$authorActivationToken = bin2hex(random_bytes(16));



if(isset($_POST['submit'])) {
	try{
		$authorHash = password_hash($_POST['$authorHash'], PASSWORD_ARGON2I, ["time_cost" => 45]);
		$author = new Author(generateUuidV4(), $authorActivationToken, $authorAvatarUrl, $authorEmail = $_POST['authorEmail'], $authorHash, $_POST['authorUsername']);
		//$author->insert($pdo);

	}
	catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	echo "this is your username ".$author->getAuthorUsername()."<br>";
	echo "this is your email ".$author->getAuthorEmail()."<br>";
	echo "this is your password ".$author->getAuthorHash()."<br>";
	$author->insert($pdo);

}

?>


<!DOCTYPE html>
<html lang="en">

<form method="post">
	<label for="authorEmail">Insert email: </label>
	<input type="email" name="authorEmail" id="authorEmail"><br>

	<label for="authorHash">Insert password: </label>
	<input type="text" name="authorHash" id="authorHash"><br>

	<label for="authorUsername">Insert username: </label>
	<input type="text" name="authorUsername" id="authorUsername"><br>
	<input type="submit" value="Submit">

</form>


</html>