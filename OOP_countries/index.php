<?php
	session_start();
	require('database.php');
	$database = new Database();
	$query = "SELECT name FROM country";
	$countries = $database->fetch_all($query);
?>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="http:////ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form').submit(function(){
				$.post($(this).attr('action'), $(this).serialize(), function(data){
					$('#continent').html(data[0].Continent);
					$('#region').html(data[0].Region);
					$('#country').html(data[0].Name);
					$('#population').html(data[0].Population);
					$('#life_exp').html(data[0].LifeExpectancy);
					$('#govt_form').html(data[0].GovernmentForm);

				}, 'json');
				return false
			});
		});
	</script>
</head>
<body>
	<form action='process.php' method='post'>
		<select name='country'>
			<?php 
				foreach ($countries as $country) 
				{
					echo "<option>{$country['name']}</option>";
				}
			 ?>
		</select>
		<input type='submit' value='get country info!'>
		<input type='hidden' name='action' value='country'>
	</form>
	
		
	<h2> Country Information:</h2>
	<h3>Country: <span id='country'> </span></h3>
	<h3>Continent: <span id='continent'> </span></h3>
	<h3>Region: <span id='region'> </span></h3>
	<h3>Population: <span id='population'> </span></h3>
	<h3>Life Expectancy: <span id='life_exp'> </span></h3>
	<h3>Government Form: <span id='govt_form'> </span></h3>
	
</body>
</html>