<html>
<head>
	<title>Using Google Maps API!</title>
	<script type="text/javascript" src = 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form').submit(function(){
				var from = $('#origin').val();
				var to = $('#destination').val();
				var url = 'http://maps.googleapis.com/maps/api/directions/json?&sensor=false';
				console.log('Form Info', $(this).serialize())
				$.get($(this).attr('action'), $(this).serialize(), function(data){
					end = data.routes[0].legs[0].end_address;
					$('#start').text(data.routes[0].legs[0].start_address); //adding text
					$('#end').text(data.routes[0].legs[0].end_address); //adding text
					count = data.routes[0].legs[0].steps.length   //this calculates how many different steps there are in this route
					step = data.routes[0].legs[0].steps  //this is the part of the returned JSON that lists each step of the navigation, complete with some HTML markup.
					var list_of_directions = "" ; 
					for(x = 0; x < count ; x++)
					{
						list_of_directions += "<li>"+step[x].html_instructions+"</li>";
					};
					$('ol').append(list_of_directions);
				}, 'json');
				return false;
			});
		});
	</script>
</head>
<body>
	<form action='http://maps.googleapis.com/maps/api/directions/json?' method='get'>  <!--For this API, we need to do a get INSTEAD of  POST -->
		From: <input type = 'text' name = 'origin' id = 'origin'>
		To: <input type = 'text' name = 'destination' id = 'destination'>
		<input type='hidden' name='sensor' value='false'>
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