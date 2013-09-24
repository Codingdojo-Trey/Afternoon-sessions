<?php
session_start();
require('connection.php');
#the follwing line tells the back end to run registration validation on your form data
if(isset($_POST['action']) AND $_POST['action'] == 'register')
{
	$_SESSION['errors'] = array();

	if(empty($_POST['first_name']))
	{
		$_SESSION['errors']['fname_blank'] = "First name cannot be blank";
	}
	elseif(preg_match('/[0-9]+/', $_POST['first_name']))
	{
		$_SESSION['errors']['fname_number'] = "First name cannot contain numbers!";
	}	

	if(empty($_POST['last_name']))
	{
		$_SESSION['errors']['lname_blank'] = "Last name cannot be blank";
	}
	elseif(preg_match('/[0-9]+/', $_POST['last_name']))
	{
		$_SESSION['errors']['lname_numbers'] = "Last name cannot contain numbers!";
	}

	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))	
	{
		$_SESSION['errors']['email'] = "Email address is not valid!";
	}

	if(strlen($_POST['password']) < 6) 
	{
		$_SESSION['errors']['pw'] = "6 letters or more, you moron.";
	}

	if(!($_POST['password'] === $_POST['conf_password']))
	{
		$_SESSION['errors']['conf'] = "passwords must match!";
	}
	if (empty($_POST['DOB']))
	{
		$_SESSION['errors']['DOB'] = "Birthdate is required!";
	}
	if(count($_SESSION['errors']) > 0 )
	{
		header('location: login_reg.php');
	}
	else
	{
		$_SESSION['message'] = "you successfully registered!";
		$first_name = mysql_real_escape_string($_POST['first_name']);
		$last_name = mysql_real_escape_string($_POST['last_name']);
		$email = mysql_real_escape_string($_POST['email']);
		$DOB = mysql_real_escape_string($_POST['DOB']);
		$password = md5($_POST['password']);
		$query = "INSERT INTO Users (first_name, last_name, password, email, birthday, created_at, updated_at) 
		VALUES ('{$first_name}', '{$last_name}', '{$password}', '{$email}', '{$DOB}', NOW(), NOW())";
		mysql_query($query);
		header('location: login_reg.php');	
	}

} //end of registration stuff!

if(isset($_POST['action']) AND $_POST['action'] == 'login')
{
	$email = mysql_real_escape_string($_POST['email']);
	$password = md5($_POST['password']);
	$query = "SELECT * FROM Users WHERE Users.email = '{$email}' AND Users.password = '{$password}'";
	$user = fetch_record($query);
	if(count($user < 1)) #bad case, Trey must learn to correctly use parenthesis even though he majored in math...
	{
		$_SESSION['message'] = 'Authentication failed!  Please retry!';
		header('location: login_reg.php');
	}
	else #good case
	{
		$_SESSION['logged_in'] = TRUE;
		$_SESSION['user'] = $user;
		header('location: home.php');
	}
}










?>