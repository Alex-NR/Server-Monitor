<?php
	include_once(dirname(__FILE__)."/../php/database.php");
	
	class Main {
		public function __construct() {
			global $database;

			$arr = $database->query("SELECT `id`, `url`, UNIX_TIMESTAMP(`check_time`) AS `check_time`, `latency` FROM `sites`;");
			$arr_count = count($arr);

			echo('{');
				echo('"data": [');
					for ($i = 0; $i < $arr_count; $i++) {
						echo('[');
							echo(json_encode($arr[$i]["id"]).',');
							echo(json_encode('<a href="'.$arr[$i]["url"].'" target="_blank">'.$arr[$i]["url"].'</a>').',');
							echo(json_encode($arr[$i]["latency"]." s").',');

							$seconds = time() - $arr[$i]["check_time"];
							$seconds_txt = "second";
							if ($seconds >= 60) {
								$seconds /= 60;
								$seconds_txt = "minute";

								if ($seconds >= 60) {
									$seconds /= 60;
									$seconds_txt = "hour";

									if ($seconds >= 24) {
										$seconds /= 24;
										$seconds_txt = "day";

										if ($seconds >= 7) {
											$seconds /= 7;
											$seconds_txt = "week";

											if ($seconds >= 4) {
												$seconds /= 4;
												$seconds_txt = "month";

												if ($seconds >= 12) {
													$seconds /= 12;
													$seconds_txt = "year";
												}
											}
										}
									}
								}
							}

							$seconds = intval($seconds);
							echo(json_encode($seconds.' '.$seconds_txt.(($seconds == 1) ? '' : 's').' ago'));
						if ($i == $arr_count - 1) {
							echo(']');
						} else {
							echo('],');
						}
					}
				echo(']');
			echo('}');
		}
	}
	
	$main = new Main();
?>