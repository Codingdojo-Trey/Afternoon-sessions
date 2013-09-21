<?php
session_start();
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
		$_SESSION['success'] = "you successfully registered!";
		#this is where you would insert a new user into your DB
		header('location: login_reg.php');	
	}

}

//if(preg_match('/[0-9]+/', $string))









?>