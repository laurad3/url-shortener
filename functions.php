<?php
require "config.php";

function connect() {
	try {
		$db = new PDO("mysql:host=".db_hostname.";dbname=".db_database, db_username, db_password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		die($e->getMessage());
	}

	return $db;
}

function getUrl($code) {
	$url = $_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"]);
	$message = "Your short url is <a href=\"http://{$url}/{$code}\">http://{$url}/{$code}</a>";
	header("Location:index.php?message={$message}");
}

function makeCode() {
	return substr(str_shuffle("abcdefghijklmnop1234567890"),0,5);
}

?>