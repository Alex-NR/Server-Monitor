<?php
	include_once(dirname(__FILE__)."/../php/database.php");
	include_once(dirname(__FILE__)."/../php/autologin.php");
	
	class Main {
		public function __construct() {
			global $database;

			if (!isset($_GET["id"]) || is_null($_GET["id"])) {
				return;
			}

			if ($_SESSION["priv"] < 2) {
				return;
			}

			$id = intval($_GET["id"]);
			$database->execute("DELETE FROM `sites` WHERE `id`=".$id.";");
			$database->execute("SET @count = 0; UPDATE `sites` SET `sites`.`id` = @count:= @count + 1;");
			$database->execute("ALTER TABLE `sites` AUTO_INCREMENT = 1;");
		}
	}
	
	$main = new Main();
?>