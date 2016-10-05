<?php
	include("includes/controller.php");
	$empty = false;
	$exists = false;
	if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]))
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];
		if(!empty($username) && !empty($password) && !empty($email))
		{
			$conn = new mysqli("localhost","root","","candypal");
			$sql = "SELECT * FROM accounts WHERE username = '$username'";
			$result = $conn->query($sql);
			if(mysqli_num_rows($result) == 0)
			{
				$sql = "INSERT INTO accounts (username,password,email,reminder,candy) VALUES ('$username','$password','$email','',5)";
				$result = $conn->query($sql);
				mysqli_close($conn);
				setcookie("session",$username);
				header("Location: /redirect.php?url=/index.php&name=$username");
				exit();
			}
			else
			{
				mysqli_close($conn);
				$exists = true;
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
		<title>CandyPal - Register</title>
		<?php include("includes/header.php"); ?>
	</head>
	<body>
		<?php include("includes/navigation.php"); ?>
		<div id="wrapper">
			<div id="content">
				<center>
					<div id="error">
						<?php
							if($empty)
							{
								echo "<p style='color:red;'>Missing Fields</p><br>";
							}
							if($exists)
							{
								echo "<p style='color:red;'>Account Already Exists</p><br>";
							}
						?>
					</div>
					<h1>REGISTER</h1>
					<form name="register" action="register.php" method="POST">
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
								<td>Email:</td>
								<td><input type="text" name="email"><td>
							</tr>
							
							<tr>
								<td colspan="2"><center><input type="submit" name="submit" onclick="return checkInputs('register')" value="Submit"></center></td>
							</tr>
						</table>
					</form>
				</center>
			</div>
		</div>
	</body>
</html>