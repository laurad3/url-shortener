<?php
//require "config.php";
require "functions.php";
$message = "";

if(isset($_POST["submit"])) {
	if(!empty($_POST["url"])) {
		$url = $_POST["url"];

		if(!filter_var($url, FILTER_VALIDATE_URL)) {
			$message = "Invalid url";
			header("Location:index.php?message={$message}");
		}
		else{
			// connect to the database
			$db = connect();

			// check if url is already in the database
			$query = "SELECT code FROM links WHERE url = :url";
			$exists = $db->prepare($query);
			$exists->execute(array(
				":url" => $url
			));

			// if url exists
			if($exists->rowCount()) {
				// get code
				$code = $exists->fetch(PDO::FETCH_OBJ)->code;
				getUrl($code);

				$exists->closeCursor();
			}
			// if url doesn't exist
			else {
				// generate code
				$code = makeCode();

				// add new url with code to the database
				$query = "INSERT INTO links (url,code,created) VALUES (:url,:code,NOW())";
				$add = $db->prepare($query);
				$add->execute(array(
					":url" => $url,
					":code" => $code
				));

				getUrl($code);
				//$last = $db->lastInsertId();
			}
		}
	}
	else {
		$message = "You have to set a url";
		header("Location:index.php?message={$message}");
	}
}
else {
	header("Location:index.php");
}

?>