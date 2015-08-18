<?php
	include_once(dirname(__FILE__)."/conf.php");
	
	class Util {
		public function __construct() {
			
		}
		
		public function die503() {
			header('HTTP/1.1 503 Service Temporarily Unavailable');
			header('Status: 503 Service Temporarily Unavailable');
			header('Retry-After: 300');
			die();
		}
		
		public function sanitize($string) {
			return htmlspecialchars($string, ENT_QUOTES);
		}
		
		public function format_date($date, $format) {
			$t = strtotime($date);
			return date($format, $t);
		}
		
		public function random_string($length) {
			global $conf;
			
			$char_len = strlen($conf->rand_chars);
			$rand_string = '';
			
			for ($i = 0; $i < $length; $i++) {
				$rand_string .= $conf->rand_chars[mt_rand(0, $char_len - 1)];
			}
			
			return $rand_string;
		}
		
		public function load_uri_header($uri, $user = null, $pass = null, $timeout = 10) {
			$ch = $this->get_curl($uri, $user, $pass, $timeout);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_NOBODY, true);
			$result = curl_exec($ch);
			curl_close($ch);
			
			return $result;
		}
		public function load_uri_body($uri, $user = null, $pass = null, $timeout = 10) {
			$ch = $this->get_curl($uri, $user, $pass, $timeout);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_NOBODY, false);
			$result = curl_exec($ch);
			curl_close($ch);
			
			return $result;
		}
		public function load_uri_time($uri, $user = null, $pass = null, $timeout = 10) {
			$ch = $this->get_curl($uri, $user, $pass, $timeout);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_NOBODY, true);
			curl_exec($ch);
			$result = curl_getinfo($ch, CURLINFO_TOTAL_TIME);
			curl_close($ch);
			
			return $result;
		}
		private function get_curl($uri, $user, $pass, $timeout) {
			$timeout = intval($timeout);
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
			curl_setopt($ch, CURLOPT_ENCODING, '');
			curl_setopt($ch, CURLOPT_URL, $uri);
			if ($user != null) {
				curl_setopt($ch, CURLOPT_USERPWD, $user.":".$pass); 
			}
			
			//Firefox 36.0
			curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0');
			
			return $ch;
		}
	}
	
	$util = new Util();
?>
