<?php
	include_once(dirname(__FILE__)."/../php/database.php");

	require_once('Horde/Text/Diff.php');
	require_once('Horde/String.php');
	require_once('Horde/Text/Diff/Renderer.php');
	require_once('Horde/Text/Diff/Renderer/Inline.php');
	require_once('Horde/Text/Diff/Engine/Native.php');
	require_once('Horde/Text/Diff/Op/Base.php');
	require_once('Horde/Text/Diff/Op/Add.php');
	require_once('Horde/Text/Diff/Op/Change.php');
	require_once('Horde/Text/Diff/Op/Copy.php');
	
	class Main {
		public function __construct() {
			global $database;

			if (!isset($_GET["id"]) || is_null($_GET["id"])) {
				return;
			}

			$id = intval($_GET["id"]);
			$result = $database->query("SELECT `url`, `latency`, `last_sha1`, `current_sha1`, `last_header`, `current_header`, `last_body`, `current_body` FROM `sites` WHERE `id`=".$id.";");

			echo("[".json_encode($result));
			if (count($result) != 1) {
				echo("]");
				return;
			}

			$sb1 = explode('\n', $result[0]["last_sha1"].'\n\n'.$result[0]["last_header"].'\n\n'.$result[0]["last_body"]);
			$sb2 = explode('\n', $result[0]["current_sha1"].'\n\n'.$result[0]["current_header"].'\n\n'.$result[0]["current_body"]);

			$diff = new Horde_Text_Diff('auto', array($sb1, $sb2));
			$renderer = new Horde_Text_Diff_Renderer_Inline();
			$string = $renderer->render($diff);

			$string = str_replace('&amp;', '&', $string);
			$string = str_replace(array("\r", "\n"), '<br>', $string);

			echo(",[{\"data\":".json_encode($string)."}]]");

			//echo($string);
		}
	}
	
	$main = new Main();
?>