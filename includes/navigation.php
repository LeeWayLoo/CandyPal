<div id="navigation">
	<h1><a href="/index.php">CandyPal</a></h1>
	<?php
		if($authenticated)
		{
			echo '<ul><li><a href="/index.php">HOME</a></li><li><a href="/send.php">SEND</a></li><li><a href="/reminder.php">REMINDER</a></li><li><a href="/logout.php">LOGOUT</a></li></ul>';
		}
		else
		{
			echo '<ul><li><a href="/index.php">HOME</a></li><li><a href="/login.php">LOGIN</a></li><li><a href="/register.php">REGISTER</a></li></ul>';
		}
	?>
</div>