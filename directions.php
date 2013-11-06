<html>
<head>
	<title>Using Google Maps API!</title>
	<script type="text/javascript" src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<script type="text/javascript">
		$(document).ready(function(){
			function callback(word)
			{
				alert('are you crazy?  You want to go to '+word)
			};
			$('form').submit(function(){
				var from = $('#origin').val();
				var to = $('#destination').val();
				var url = 'http://maps.googleapis.com/maps/api/directions/json?origin='+from+'&destination='+to+'&sensor=false';
				$.post(url, function(data){
					console.log(url);
					end = data.routes[0].legs[0].end_address;
					callback(end);
					$('ol').html(' ');
					$('#start').text(data.routes[0].legs[0].start_address);
					$('#end').text(data.routes[0].legs[0].end_address);
					count = data.routes[0].legs[0].steps.length   //this calculates how many different steps there are in this route
					step = data.routes[0].legs[0].steps  //this is the part of the returned JSON that lists each step of the navigation, complete with some HTML markup.
					for(x = 0; x < count ; x++)
					{
						$('ol').append("<li>"+step[x].html_instructions+"</li>");
					};
				}, 'json');
				return false;
			});
		});
	</script>
</head>
<body>
	<form>
		From: <input type = 'text' name = 'origin' id = 'origin'>
		To: <input type = 'text' name = 'destination' id = 'destination'>
		<input type = 'submit' value = 'get directions!'>
	</form>	
	<div id = 'results'>
		<h2>Start address: <span id = 'start'>  </span></h2>
		<h2>End address: <span id = 'end'>  </span></h2>
		<h2>Route:</h2>
		<ol>
		</ol>
	</div>
</body>
</html>