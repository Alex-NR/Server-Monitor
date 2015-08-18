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
        <title>Native Rank Server Monitor | Big Screen</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <link rel="stylesheet" href="/css/normalize.min.css">
        <link rel="stylesheet" href="/css/main.css">
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')</script>
		
        <script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
		
		<script src="/js/main.js"></script>
		<script src="/js/pages/big.js"></script>

		<script src="/js/analytics.js"></script>
    </head>
    <body style="overflow-x: hidden;">
		<?php include_once(dirname(__FILE__)."/web/header.php"); ?>
		
        <div class="main-container">
            <div class="main wrapper clearfix">
                <article>
                    <section>
						<div id="slideIn" class="hcenter slideIn"></div>
						<div id="slideOut" class="hcenter slideOut"></div>
					</section>
					<section id="spacer">
					</section>
                </article>
            </div>
        </div>
		
        <?php include_once(dirname(__FILE__)."/web/footer.php"); ?>
    </body>
</html>
