<?php
	include_once(dirname(__FILE__)."/../php/database.php");
	include_once(dirname(__FILE__)."/../php/util.php");
	include_once(dirname(__FILE__)."/../php/autologin.php");
	
	class Main {
		private $all = "/^(?:https?:\/\/)?(?:www.)?(\w*?)\.[a-z]*?[\/\\\\]?$/";
		private $http_www = "/^(?:https?:\/\/)(?:www.)(\w*?)\.[a-z]*?[\/\\\\]?$/";
		private $http = "/^(?:https?:\/\/)(\w*?)\.[a-z]*?[\/\\\\]?$/";
		private $www = "/^(?:www.)(\w*?)\.[a-z]*?[\/\\\\]?$/";
		private $none = "/^(\w*?)\.[a-z]*?[\/\\\\]?$/";

		public function __construct() {
			global $database, $util;

			if (!isset($_POST["url"]) || is_null($_POST["url"])) {
				return;
			}
			$url = $_POST["url"];

			if ($_SESSION["priv"] < 2) {
				return;
			}

			if (!preg_match($this->all, $url)) {
				return;
			}

			$matches = array();

			if (preg_match($this->none, $url)) {
				$url = "http://www.".$url;
			} else if (preg_match($this->www, $url)) {
				$url = "http://".$url;
			} else if (preg_match($this->http, $url, $matches)) {
				$url = "http://www.".$matches[1];
			}

			$database->execute("INSERT INTO `sites` (`url`) VALUES ("
				. $database->sanitize($util->sanitize($url))
			. ");");
		}
	}
	
	$main = new Main();
?>