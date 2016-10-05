<?php
	include("includes/controller.php");
	if(!$authenticated)
	{
		header("Location: /index.php");
		exit();
	}
	$empty = false;
	$exists = false;
	$invalid = false;
	$enough = false;
	$sent = false;
	if(isset($_POST["sender"]) && isset($_POST["recipient"]) && isset($_POST["amount"]))
	{
		$sender = $_POST["sender"];
		$recipient = $_POST["recipient"];
		$amount = $_POST["amount"];
		if(!empty($sender) && !empty($recipient) && !empty($amount))
		{
			$conn = new mysqli("localhost","root","","candypal");
			$sqlSender = "SELECT candy FROM accounts WHERE username = '$sender'";
			$sqlRecipient = "SELECT candy FROM accounts WHERE username = '$recipient'";
			$resultSender = $conn->query($sqlSender);
			$resultRecipient = $conn->query($sqlRecipient);
			if(mysqli_num_rows($resultSender) != 0 && mysqli_num_rows($resultRecipient) != 0)
			{
				if(is_numeric($amount) && (int)$amount >= 0)
				{
					$amount = (int)$amount;
					$candySender = mysqli_fetch_array($resultSender)[0];
					$candyRecipient = mysqli_fetch_array($resultRecipient)[0];
					if($candySender - $amount >= 0)
					{
						$candySender = $candySender - $amount;
						$candyRecipient = $candyRecipient + $amount;
						$sqlSender = "UPDATE accounts SET candy=$candySender WHERE username='$sender'";
						$sqlRecipient = "UPDATE accounts SET candy=$candyRecipient WHERE username='$recipient'";
						$resultSender = $conn->query($sqlSender);
						$resultRecipient = $conn->query($sqlRecipient);
						mysqli_close($conn);
						$sent = true;
					}
					else
					{
						mysqli_close($conn);
						$enough = true;
					}
				}
				else
				{
					mysqli_close($conn);
					$invalid = true;
				}
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
		<title>CandyPal - Send</title>
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
								echo "<p style='color:red;'>Account Does Not Exist</p><br>";
							}
							if($invalid)
							{
								echo "<p style='color:red;'>Invalid Input</p><br>";
							}
							if($enough)
							{
								echo "<p style='color:red;'>Not Enough Candy</p><br>";
							}
							if($sent)
							{
								echo "<p style='color:green;'>Candy Sent!</p><br>";
							}
						?>
					</div>
					<h1>SEND</h1>
					<form name="send" action="send.php" method="POST">
						<input type="hidden" name="sender" value="<?php echo $username; ?>">
						<table>
							<tr>
								<td>Recipient:</td>
								<td><input type="text" name="recipient"><td>
							</tr>
							
							<tr>
								<td>Amount:</td>
								<td><input type="text" name="amount"><td>
							</tr>
							
							<tr>
								<td colspan="2"><center><input type="submit" name="submit" onclick="return checkInputs('send')" value="Submit"></center></td>
							</tr>
						</table>
					</form>
				</center>
			</div>
		</div>
	</body>
</html>