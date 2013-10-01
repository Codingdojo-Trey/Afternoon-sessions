<?php 
session_start();
require('connection.php');
$query = "SELECT * FROM notes";
$notes = fetch_all($query);
?>
<html>
	<script type="text/javascript" src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<head>
	<title>Post Its!</title>
	<style>
		.note
		{
			border: 2px solid blue;
			display: inline-block;
			width: 200px;
			margin: 20px;
			padding: 14px;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form').submit(function(){
				$.post($(this).attr('action'), $(this).serialize(), function(dojo){
					console.log(dojo);
					$('#display').append(dojo.html_data);
				}, 'json');
				return false;
			});
		
			$(document).on('click', '.cheese', function(){
				alert('mahon suckers!');
			});

		});
	</script>
</head>
<body>
	<h4>Add a note!</h4>
	<form action = 'process.php' method = 'post'>
		Title: <input type = 'text' name = 'title'>
		<br>
		Message:<textarea name = 'message'></textarea>
		<input type = 'submit' value = 'add note!'>
		<input type = 'hidden' name = 'action' value = 'add_note'>
	</form>
	<div id = 'display'>
		<?php
			foreach ($notes as $note) 
			{
				echo "<div class = 'note'>
						<h3> {$note['title']} </h3>
						<p> {$note['message']} </p>
						<button class = 'cheese'>click me for cheese!</button>
					  </div>";
			}
		?>
	</div>
</body>
</html>