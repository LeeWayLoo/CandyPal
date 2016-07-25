<?php
	setcookie("session", null, time() - 3600);
	header("Location: /index.php");
	exit();
?>