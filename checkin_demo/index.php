<?php
session_start();
?>
<html>
<head>
	<title>Welcome to Checkin!</title>
</head>
<body>
<?php
	if(isset($_SESSION['errors']))
	{
		foreach ($_SESSION['errors'] as $error) 
		{
			echo $error."<br>";
		}
		unset($_SESSION['errors']);
	}

	if(isset($_SESSION['message']))
	{
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
?>
	<h3>Register!</h3>
	<form action = 'process.php' method = 'post'>
		Email:<input type = 'text' name = 'email'>
		Username:<input type = 'text' name = 'username'>
		Password:<input type = 'password' name = 'password'>
		Confirm Password:<input type = 'password' name = 'pw_confirm'>
		<input type = 'submit' value = 'register!'>
		<input type = 'hidden' value = 'register' name = 'action'>
	</form>
	<h3>Login!</h3>
	<form action = 'process.php' method = 'post'>
		Email:<input type = 'text' name = 'email'>
		Password<input type = 'password' name = 'password'>
		<input type = 'submit' value = 'login!'>
		<input type = 'hidden' value = 'login' name = 'action'>
	</form>
</body>
</html>