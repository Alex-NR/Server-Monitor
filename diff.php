<?php
	include_once(dirname(__FILE__)."/php/autologin.php");
	
	class Main {
		public function __construct() {
			
		}
	}
	
	$main = new Main();
?>

<!doctype html>
<!--[if lt IE 7]>
	<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="">
<![endif]-->
<!--[if IE 7]>
	<html class="no-js lt-ie9 lt-ie8" lang="">
<![endif]-->
<!--[if IE 8]>
	<html class="no-js lt-ie9" lang="">
<![endif]-->
<!--[if gt IE 8]><!-->
	<html class="no-js" lang="">
<!--<![endif]-->
	
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Native Rank Server Monitor | Diff</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <link rel="stylesheet" href="/css/normalize.min.css">
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="/css/pages/diff.css">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
		
        <script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

		<script src="/js/main.js"></script>
		<script src="/js/pages/diff.js"></script>

		<script src="/js/analytics.js"></script>
    </head>
    <body>
		<?php include_once(dirname(__FILE__)."/web/header.php"); ?>
		
        <div class="main-container">
            <div class="main wrapper clearfix">
				<img id="leftArrow" class="left" src="/img/arrow_left.png" height="200">
				<img id="rightArrow" class="right" src="/img/arrow_right.png" height="200">
				<div id="content" class="hcenter" style="width: 60%; background-color: #ccc;">
					<div id="top" style="width: 100%; text-align: center;"></div>
					<div id="leftContent" class="left" style="width: 50%; height: 25%;"></div>
					<div id="rightContent" class="right" style="width: 50%; height: 25%;"></div>
					<iframe id="preview" class="right" style="width: 100%; height: 250px;"></iframe>
					<div id="bottomContent" style="width: 100%; height: 50%;"></div>
				</div>
				<div id="spacer"></div>
            </div>
        </div>
		
        <?php include_once(dirname(__FILE__)."/web/footer.php"); ?>
    </body>
</html>
