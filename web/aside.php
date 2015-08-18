<?php
	include_once(dirname(__FILE__)."/../php/autologin.php");

	class Aside {
		public function __construct() {
			
		}
	}
	
	$aside = new Aside();
?>

<aside>
	<h3>User Stats</h3>
	<p><?php echo(($_SESSION["user_id"] == 0) ? "Not logged in" : "Logged in as ".$_SESSION["username"]); ?></p>
</aside>