<?php
	if(isset($_GET["url"]))
	{
		$url = $_GET["url"];
	}
	else
	{
		$url = "";
	}
	
	if(isset($_GET["name"]))
	{
		$name = $_GET["name"];
		$conn = new mysqli("localhost","root","","candypal");
		$sql = "SELECT email FROM accounts WHERE username='$name'";
		$result = $conn->query($sql);
		mysqli_close($conn);
		if(mysqli_num_rows($result) != 0)
		{
			$email = mysqli_fetch_array($result)[0];
		}
	}
	else
	{
		$name = "";
	}
?>
<html>
	<head>
		<title>CandyPal - Redirect</title>
		<script>
			function redirect()
			{
				var url = "<?php echo $url; ?>";
				var name = "<?php echo $name; ?>";
				window.location = url+"?name="+name;
			}
			setTimeout(redirect,1000);
		</script>
	</head>
	<body>
		<center style="margin:5em;">
			<h1>Loading Profile<br><?php echo $email; ?></h1>
			<img style="width:20%;" src="/images/loading.gif" />
			
		</center>
	</body>
</html>