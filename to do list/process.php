<?php 
session_start();
require('connection.php');

if(isset($_POST['action']) && $_POST['action'] == 'add_note')
{
	$message = mysql_real_escape_string($_POST['message']);
	$title = mysql_real_escape_string($_POST['title']);
	$query = "INSERT INTO notes (title, message, created_at, updated_at) VALUES ('{$title}', '{$message}', NOW(), NOW())";
	mysql_query($query);
	$note_html = array();
	$note_html['html_data'] =  "<div class = 'note'>
									<h3> {$title} </h3>
									<p> {$message} </p>
									<button class = 'cheese'>click me for cheese!</button>
					 			</div>";
	echo json_encode($note_html);

}

 ?>