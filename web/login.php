<?php
	include_once(dirname(__FILE__)."/../php/database.php");
	include_once(dirname(__FILE__)."/../php/util.php");
	include_once(dirname(__FILE__)."/../php/security.php");
	include_once(dirname(__FILE__)."/../php/autologin.php");
	
	class Main {
		public function __construct() {
			global $database, $util, $security;

			if (!isset($_POST["username"]) || is_null($_POST["username"]) || $_POST["username"] == "") {
				echo('Username cannot be blank');
				return;
			}
			if (!isset($_POST["password"]) || is_null($_POST["password"]) || $_POST["password"] == "") {
				echo('Password cannot be blank');
				return;
			}

			$result = $database->query("SELECT `id`, `username`, `pass_hash`, `key`, `iv`, `priv` FROM `users` WHERE `username`=".$database->sanitize($util->sanitize($_POST["username"]))." OR `email`=".$database->sanitize($util->sanitize($_POST["username"])).";");
			if (count($result) != 1) {
				echo('No user was found by that name');
				return;
			}

			if (!$security->pass_verify($result[0]["pass_hash"], $_POST["password"])) {
				echo('The password given is incorrect');
				return;
			}

			$_SESSION["user_id"] = $result[0]["id"];
			$_SESSION["username"] = $result[0]["username"];
			$_SESSION["priv"] = $result[0]["priv"];

			$security->set_cookie("user", $_POST["username"]);
			$security->set_cookie("encrypted_pass", $security->encrypt($_POST["password"], $result[0]["key"], base64_decode($result[0]["iv"])));

			echo("1");
		}
	}
	
	$main = new Main();
?>