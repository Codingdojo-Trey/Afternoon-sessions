<?php
session_start();
?>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		echo "WELCOME TO YOUR HOME PAGE, ".$_SESSION['user']['first_name']."!!";
		var_dump($_SESSION);

	?>

</body>
</html>