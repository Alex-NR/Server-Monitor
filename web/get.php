<?php
	include_once(dirname(__FILE__)."/../php/database.php");
	
	class Main {
		public function __construct() {
			global $database;

			if (!isset($_GET["id"]) || is_null($_GET["id"])) {
				return;
			}

			$id = intval($_GET["id"]);
			$result = $database->query("SELECT `id`, `url`, `last_sha1`, `current_sha1`, `current_header`, `latency` FROM `sites` WHERE `id`=".$id.";");

			echo(json_encode($result));
		}
	}
	
	$main = new Main();
?>