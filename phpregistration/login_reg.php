<?php
session_start();
?>
<html>
<head>
	<script type="text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('button').click(function(){ 
			$('.pw').attr('type','text');
		});
		<?php
		if (isset($_SESSION['errors'])) 
		{
			foreach ($_SESSION['errors'] as $key => $error) 
			{
				echo "\r\n$('.{$key}').text('{$error}'); \r\n"; 
				 #notice How I used php to echo Jquery.  Also notice how I used $key as the class names to automate m
			}
		}; 
		unset($_SESSION['errors']); #so the errors on get displayed once.  
		?>
	});
	</script>
	
	<title>My first login and registration</title>
</head>
<body>
	<?php
		if(isset($_SESSION['message']))
		{
			echo $_SESSION['message'];
			unset($_SESSION['message']);  
		}
	?>
	<form action = 'process.php' method = 'post'>
		First name:	<input type = 'text' name = 'first_name'> <div class = 'fname_blan---k fname_number'></div>
		Last name: <input type = 'text' name = 'last_name'> <div class = 'lname_blank lname_number'></div>
		Email address: <input type = 'text' name = 'email'> <div class = 'email'></div>
		Password: <input class = 'pw 'type = 'password' name = 'password'> <div class = 'pw'></div>
		Confirm password: <input  class = 'pw' type = 'password' name = 'conf_password'> <div class = 'conf'></div>
		Birthday: <input type = 'date' name = 'DOB'> <div class = 'DOB'></div>
		<input type = 'hidden' name = 'action' value = 'register'>
		<input type = 'submit' value = 'Register!'> 
	</form>

	<form action= 'process.php' method = 'post'>
		Email: <input type = 'text' name = 'email'>
		Password: <input type = 'password' name = 'password'>
		<input type = 'hidden' name = 'action' value = 'login'>
		<input type = 'submit' value = 'login'>
	</form>
	<button>Show characters for password!</button>

</body>
</html>