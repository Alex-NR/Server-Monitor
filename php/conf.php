<?php
	class Conf {
		public $db_type = "mysql";
		public $db_host = "127.0.0.1";
		public $db_user = "web";
		public $db_pass = "KnEy!SAF%*fZY3^Z";
		public $db_name = "web";
		
		public $hash_cost = 10;
		
		public $log_type = "stdout log";
		//public $log_type = "log";
		public $log_directory = "C:/xampp/web_logs";
		//public $log_directory = "/var/log/web_logs";
		
		public $encrypt_algo = "rijndael-256";
		public $encrypt_mode = "ofb";
		
		public $rand_chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ`-=[]\\;',./~!@#\$%^&*()_+{}|:\"<>?";
		
		public $session_life = 86400; //1 day
		public $session_regen_expire = 10;
		public $session_expire_chance = 5;
		
		public $cookie_life = 604800; //1 week
		
		public $hostname = null;
		
		public function __construct() {
			$this->hostname = $_SERVER['HTTP_HOST'];
			if (is_null($this->hostname) || $this->hostname == "") {
				$this->hostname = $_SERVER['SERVER_NAME'];
			}
		}
	}
	
	$conf = new Conf();
?>
