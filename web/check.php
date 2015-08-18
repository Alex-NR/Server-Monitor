<?php
	include_once(dirname(__FILE__)."/../php/autologin.php");
	include_once(dirname(__FILE__)."/../php/database.php");
	include_once(dirname(__FILE__)."/../php/util.php");
	
	class Main {
		public $http_regex = "^HTTP\/[0-9](?:\.[0-9])?\s([0-9]{3})\s(.*)$";

		public function __construct() {
			global $util, $database;

			if (!isset($_GET["id"]) || is_null($_GET["id"])) {
				echo(false);
				return;
			}

			$id = intval($_GET["id"]);
			$result = $database->query("SELECT `url`, `current_header`, `current_body`, `current_sha1` FROM `sites` WHERE `id`=".$id.";");

			if (count($result) != 1) {
				echo(false);
				return;
			}
			
			$headers = str_replace("\r", "", trim($util->load_uri_header($result[0]["url"])));
			$body = $util->load_uri_body($result[0]["url"]);
			$sha1_body = sha1($body);

			if ($result[0]["current_sha1"] != $sha1_body) {
				$database->execute("UPDATE `sites` SET "
					. "`latency`=".$util->load_uri_time($result[0]["url"]).","
					. "`last_sha1`='".$result[0]["current_sha1"]."',"
					. "`current_sha1`='".$sha1_body."',"
					. "`last_header`='".$result[0]["current_header"]."',"
					. "`current_header`=".$database->sanitize($util->sanitize($headers)).","
					. "`last_body`='".$result[0]["current_body"]."',"
					. "`current_body`=".$database->sanitize($util->sanitize($body))
					. " WHERE `id`=".$id.";");
			} else {
				$database->execute("UPDATE `sites` SET "
					. "`latency`=".$util->load_uri_time($result[0]["url"]).","
					. "`last_sha1`='',"
					. "`last_header`='',"
					. "`last_body`='',"
					. "`check_time`=NOW()"
					. " WHERE `id`=".$id.";");
			}

			echo(true);
		}
	}

	class Lock {
		private $file;

		public function __construct() {
			global $util;

			$this->file = fopen(__FILE__, "r");
			if (!flock($this->file, LOCK_EX | LOCK_NB)) {
				$util->die503();
			}
		}
		public function __destruct() {
			flock($this->file, LOCK_UN);
			fclose($this->file);
		}
	}
	
	$lock = new Lock();
	$main = new Main();
?>