<?php
	class Header {
		public function __construct() {
			
		}
	}
	
	$header = new Header();
?>

<div class="header-container">
	<header class="wrapper clearfix">
		<a href="/"><h1 class="title">Native Rank Server Monitor</h1></a>
		<nav>
			<ul>
				<li><a href="/">Status</a></li>
				<li><a href="/big">Big Screen</a></li>
				<?php
					if ($_SESSION["user_id"] == 0) {
						echo('<li><a href="/login">Login</a></li>');
					} else {
						echo('<li><a href="/logout">Logout</a></li>');
					}
				?>
			</ul>
		</nav>
	</header>
</div>