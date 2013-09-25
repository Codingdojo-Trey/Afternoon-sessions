<?php
session_start();
require('connection.php');
if($_SESSION['logged_in'] != true)
{
	header('location: index.php');
}
$query = "SELECT checkins.*, users.user_name FROM checkins
		  LEFT JOIN users ON users.id = checkins.user_id 
		  ORDER BY checkins.created_at DESC";
$check_ins = fetch_all($query);
?>
<html>
<head>
	<title></title>
</head>
<body>
	<h4>Welcome to the Coding Dojo checkin page! <?php echo $_SESSION['user']['username']; ?></h4>
	<h5>Leave a message!</h5>
	<form action = 'process.php' method = 'post'>
		<textarea name = 'message'></textarea>
		<input type = 'hidden' name = 'action' value = 'check_in'>
		<input type = 'submit' value = 'check in!'>
	</form>
	<a href="process.php">Log off!</a>
	<div id = 'content'>
		<?php
			foreach($check_ins as $check_in)
			{
				echo "<h3>{$check_in['user_name']} checked in at: {$check_in['created_at']}</h3>
					  <h4>{$check_in['message']}</h4>";
			}
		?>
	</div>	
</body>
</html>