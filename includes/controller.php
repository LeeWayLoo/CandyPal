<?php
	$authenticated = false;
	if(isset($_COOKIE["session"]))
	{
		$username = $_COOKIE["session"];
		$conn = new mysqli("localhost","root","","candypal");
		$sql = "SELECT candy FROM accounts WHERE username='$username'";
		$result = $conn->query($sql);
		mysqli_close($conn);
		if(mysqli_num_rows($result) == 0)
		{
			include("logout.php");
		}
		$candy = mysqli_fetch_array($result)[0];
		$authenticated = true;
	}
?>