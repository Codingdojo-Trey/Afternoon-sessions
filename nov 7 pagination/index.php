<?php 
 ?>
 <html>
 <head>
 	<style>
 		td
 		{
 			text-align: center;
 		}
 		ul li
 		{
 			display: inline-block;
 			list-style-type: none;
 			margin: 10px;
 		}
 	</style>
 	<title>Pagination</title>
 	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
 	<script type="text/javascript" src='http://code.jquery.com/jquery-1.9.1.js'></script>
 	<script type="text/javascript" src='http://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>
 	<script type="text/javascript">
 		function make_links(number)
 		{
 			$('#links').html(''); //this is a fast/easy way to clear html data
 			var number_of_links = Math.ceil(parseFloat(number)/5);
 			var link_html = "";
 			for (var x = 1; x < number_of_links + 1; x++) 
 			{
 				$('#links').append("<li><a href='#'>" +x+ "</a></li>");
 			}
 			
 		}
 		function make_links_work()
 		{
 			$('a').click(function(){
 				var tab = this.innerHTML;  //this is a compatibility issue with javascript this and jquery $(this)
 				$('#offset').val(tab);
 				$('form').submit();
 			});
 		}
 		$(document).ready(function(){
 			$('.datepicker').datepicker({ dateFormat: "yy-mm-dd" });
 			$('form').submit(function(){
 				$.post($(this).attr('action'), $(this).serialize(), function(data){
 					make_links(data.number.number);
 					make_links_work();
 					$('#results').html(data.people);
 				}, 'json');
 				return false;
 			})
 			$(document).keyup(function(){
 				$('form').submit();
 			});
 			$('.datepicker').change(function(){
 				$('form').submit();
 			})
 		});
 	</script>
 </head>
 <body>
 	<form action='process.php' method='post'>
 		First name:<input type='text' name='first_name'>
 		Last name:<input type='text' name='last_name'>
 		From:<input type='text' name='from' class='datepicker'>
 		To:<input type='text' name='to' class='datepicker'>
 		<input type='hidden' name='offset' value='' id='offset'>
 		<input type='submit'>
 	</form>
 	<ul id='links'></ul>
 	<div id='results'></div>
 </body>
 </html>