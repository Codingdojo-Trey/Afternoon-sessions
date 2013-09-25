<?php
session_start();
require('connection.php');
if(isset($_POST['action']) && $_POST['action'] == 'register')
{
	$_SESSION['errors'] = array();

	if(empty($_POST['email']) OR empty($_POST['password']) OR empty($_POST['pw_confirm']) OR empty($_POST['username']))
	{
		$_SESSION['errors'][] = "All fields must be filled!";
	}

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$_SESSION['errors'][] = "Your email is invalid!";
	}

	if(!unique_email($_POST['email']))
	{
		$_SESSION['errors'][] = "Your email address is already in our database!";
	}

	if(strlen($_POST['password']) < 6)
	{
		$_SESSION['errors'][] = "Your password must be at least 6 characters!";
	}

	if($_POST['password'] !== $_POST['pw_confirm'])
	{
		$_SESSION['errors'][] = "Passwords must match";
	}

	if(strlen($_POST['username']) < 4)
	{
		$_SESSION['errors'][] = "Your username must be at least 4 characters!";
	}

	if(count($_SESSION['errors']) < 1)
	{
		$_SESSION['message'] = 'sucessful registration!';
		$username = mysql_real_escape_string($_POST['username']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = md5($_POST['password']);
		$query = "INSERT INTO Users (user_name, email, password, created_at, updated_at) VALUES ('{$username}', '{$email}', '{$password}', NOW(), NOW())";
		mysql_query($query);
	}

	header('location: index.php');
}

elseif(isset($_POST['action']) && $_POST['action'] == 'login')
{
	$password = md5($_POST['password']);
	$email = mysql_real_escape_string($_POST['email']);
	$query = "SELECT * FROM Users WHERE email = '{$email}' AND password = '{$password}'";
	$user = fetch_all($query);
	if(count($user) < 1)
	{
		$_SESSION['message'] = 'Your authentication was invalid!';
		header('location: index.php');
	}
	else
	{
		$_SESSION['logged_in'] = true;  #this is used to tell the web app as a whole your status
		$_SESSION['user']['id'] = $user[0]['id'];  #this is how the computer keeps track of all users uniquely
		$_SESSION['user']['username'] = $user[0]['user_name']; #this is your way of keeping track of who you are online
		header('location: home.php');
	}
}

elseif(isset($_POST['action']) AND $_POST['action'] == 'check_in')
{
	$message = mysql_real_escape_string($_POST['message']);
	$id = $_SESSION['user']['id'];
	$query = "INSERT INTO checkins (message, user_id, created_at, updated_at) VALUES ('{$message}', '{$id}', NOW(), NOW())";
	mysql_query($query);
	header('location: home.php');
}

//Assume if there is no post data that the user wants to log off
else
{
session_destroy();
header('location: index.php');
}

function unique_email($email)  #needs to return false if email isn't unique
{
	$esc_email = mysql_real_escape_string($email);
	$query = "SELECT * FROM Users WHERE email = '{$esc_email}'";
	$result = fetch_all($query);
	if(count($result) > 0)  #this means that the email has already been entered in our database
	{
		return false;
	}	
	else  #this means that the email address is unique
	{
		return true;
	}
}

?>