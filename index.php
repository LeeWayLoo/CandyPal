<?php
	include("includes/controller.php");
?>
<html>
	<head>
		<title>CandyPal - Home</title>
		<?php include("includes/header.php"); ?>
	</head>
	<body>
		<?php include("includes/navigation.php"); ?>
		<div id="wrapper">
			<div id="content">
				<center>
					<?php
						if($authenticated)
						{
							if(isset($_GET["name"]))
							{
								$name = $_GET["name"];
								echo "<h2>Welcome $name!</h2><br>";
							}
							echo "<b>You currently have $candy candy</b>";
						}
						else
						{
							echo "<b>Welcome to CandyPal, the place to be for sending and receiving candy!<br>For a limited time only, get 5 candy when you register today!</b>";
						}
					?>
				</center>
			</div>
		</div>
	</body>
</html>