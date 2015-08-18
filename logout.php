<?php
	include_once(dirname(__FILE__)."/php/security.php");
	include_once(dirname(__FILE__)."/php/autologin.php");
	
	class Main {
		public function __construct() {
			global $database, $util, $security;

			$_SESSION["user_id"] = 0;
			$_SESSION["username"] = "";
			$_SESSION["priv"] = 0;

			$security->delete_cookie("user");
			$security->delete_cookie("encrypted_pass");

			header('Location: /');
		}
	}
	
	$main = new Main();
?>