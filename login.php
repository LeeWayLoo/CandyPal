<?php
	include("/includes/controller.php");
	$empty = false;
	$auth = false;
	if(isset($_GET["username"]) && isset($_GET["password"]))
	{
		$username = $_GET["username"];
		$password = $_GET["password"];
		if(!empty($username) && !empty($password))
		{
			$conn = new mysqli("localhost","root","","candypal");
			$sql = "SELECT username FROM accounts WHERE password='$password'";
			$result = $conn->query($sql);
			mysqli_close($conn);
			if(mysqli_num_rows($result) != 0)
			{
				$username = mysqli_fetch_array($result)[0];
				setcookie("session",$username);
				header("Location: /index.php?name=$username");
				exit();
			}
			else
			{
				$auth = true;
			}
		}
		else
		{
			$empty = true;
		}
	}
?>
<html>
	<head>
		<title>CandyPal - Login</title>
		<?php include("/includes/header.php"); ?>
	</head>
	<body>
		<?php include("/includes/navigation.php"); ?>
		<div id="wrapper">
			<div id="content">
				<center>
					<div id="error">
						<?php
							if($empty)
							{
								echo "<p style='color:red;'>Missing Fields</p><br>";
							}
							if($auth)
							{
								echo "<p style='color:red;'>Incorrect Credentials</p><br>";
							}
						?>
					</div>
					<h1>LOGIN</h1>
					<form name="login" action="login.php">
						<table>
							<tr>
								<td>Username:</td>
								<td><input type="text" name="username"><td>
							</tr>
							
							<tr>
								<td>Password:</td>
								<td><input type="text" name="password"><td>
							</tr>
							
							<tr>
								<td colspan="2"><center><input type="submit" name="submit" onclick="return checkInputs('login')" value="Submit"></center></td>
							</tr>
						</table>
					</form>
				</center>
			</div>
		</div>
	</body>
</html>