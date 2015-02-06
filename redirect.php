<?php
//require "shorten.php";
//require "config.php";
require "functions.php";
$message = "";

if(isset($_GET["code"])) {
	$code = $_GET["code"];

	// connect to the database
	$db = connect();

	// get url linked with the code
	$query = "SELECT url FROM links WHERE code = :code";
	$get = $db->prepare($query);
	$get->execute(array(
		":code" => $code
	));

	if($get->rowCount()) {
		$url = $get->fetch(PDO::FETCH_OBJ)->url;

		$status = substr(get_headers($url)[0],9,3);

		if(intval($status) == 301) {
			$query = "SELECT url FROM links WHERE id = 3";
			$last = $db->prepare($query);
			$last->execute();
			$lastUrl = $last->fetch(PDO::FETCH_OBJ)->url;

			header("Location:{$lastUrl}");
		}
		else {
			header("Location:{$url}");
		}

		die();
	}
	else {
		// if no link is stored with the given code
		header("Location:http://localhost:8888/404/404.jpg");
	}

	$get->closeCursor();
}
else {
	header("Location:index.php");
}

?>