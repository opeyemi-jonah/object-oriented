<?php
use OpeyemiJonah\ObjectOriented\Author;
//require_once (__DIR__)."uuid.php";
require ("uuid.php");

require_once("/etc/apache2/capstone-mysql/Secrets.php");
require_once ("../classes/Author.php");
$secrets =  new Secrets("/etc/apache2/capstone-mysql/cohort28/ojonah.ini");
$pdo = $secrets->getPdoObject();
require_once (dirname(__DIR__,1)."/classes/Author.php");
/*
 * Just a creative way to input data into my database
 */

//TODO make users able to upload an image
$authorAvatarUrl = "https://avars.discourse.org/v4/letter/m/a8b319/squad4.png";

$authorActivationToken = bin2hex(random_bytes(16));

$authorId = generateUuidV4()->getBytes();
//var_dump($_POST);


if(isset($_POST['authorUsername'], $_POST['authorEmail'],$_POST['authorHash'])) {

	try{
		$authorHash = password_hash($_POST['authorHash'], PASSWORD_ARGON2I, ["time_cost" => 45]);
		$author = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail = $_POST['authorEmail'],$authorHash,$authorUsername = $_POST['authorUsername']);
		//$author->insert($pdo);
		echo "Congratulations sqaud mate! ".$author->getAuthorUsername()."<br>";
		//echo "this is your email ".$author->getAuthorEmail()."<br>";
		//echo "this is your password ".$author->getAuthorHash()."<br>";
	}
	catch(\InvalidArgumentException | \RangeException | \Exception | TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}


	$author->insert($pdo);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Join My Squad</title>
</head>
<body>
<div class="jumbotron jumbotron-fluid">
	<div class="container">
		<h1>Welcome to my squad</h1>
		<p class="lead">Before you join this awesome squad please sign up</p>
		<form method="post">
			<label for="authorEmail">Insert email: </label>
			<input type="email" name="authorEmail" id="authorEmail"><br>

			<label for="authorHash">Insert password: </label>
			<input type="password" name="authorHash" id="authorHash"><br>

			<label for="authorUsername">Insert username: </label>
			<input type="text" name="authorUsername" id="authorUsername"><br>
			<input type="submit" value="Sign up!">

		</form>
	</div>
</div>


</body>

</html>