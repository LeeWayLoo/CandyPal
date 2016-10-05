<?php
	include("includes/controller.php");
	if(isset($_POST["username"]) && isset($_POST["candy"]))
	{
		$reminderUser = $_POST["username"];
		$reminderCandy = $_POST["candy"];
		$conn = new mysqli("localhost","root","","candypal");
		$stmt = $conn->prepare("UPDATE accounts SET reminder=? WHERE username=?");
		$stmt->bind_param("ss",$reminderCandy,$reminderUser);
		$stmt->execute();
		$stmt->close();
		$conn->close();
	}
	
	if(!$authenticated)
	{
		header("Location: /index.php");
		exit();
	}
	
	$conn = new mysqli("localhost","root","","candypal");
	$sql = "SELECT reminder FROM accounts WHERE username='$username'";
	$result = $conn->query($sql);
	mysqli_close($conn);
	$reminder = mysqli_fetch_array($result)[0];
?>
<html>
	<head>
		<title>CandyPal - Reminder</title>
		<?php include("includes/header.php"); ?>
	</head>
	<body>
		<?php include("includes/navigation.php"); ?>
		<div id="wrapper">
			<div id="content">
				<center>
					<div id="error">

					</div>
					<h1>REMINDER</h1>
					<i>Don't forget the candy you're craving for!</i>
					<form style="margin:1em;" name="reminder" action="reminder.php" method="POST">
						<input type="hidden" name="username" value="<?php echo $username; ?>">
						<table>
							<tr>
								<td>Candy:</td>
								<td><input type="text" maxlength="20" name="candy"><td>
							</tr>
							<tr>
								<td colspan="2"><center><input type="submit" name="submit" onclick="return checkInputs('remindr')" value="Save"></center></td>
							</tr>
						</table>
					</form>
					<?php
						if($reminder != "")
						{
							echo "<div style='border-style:dotted;'>";
							echo "<h2>Currently Craving:</h2>";
							eval("echo '$reminder';");
							echo "</div>";
						}
					?>
				</center>
			</div>
		</div>
	</body>
</html>