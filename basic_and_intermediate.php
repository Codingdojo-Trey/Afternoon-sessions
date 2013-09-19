<html>
<head>
	<script type="text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript">
		function rand6()
		{
			var possible_vals = ['a', 'b','c' , 'd', 'e', 'f', 1 , 2, 3, 4, 5, 6];
			var color = "";
			for(x = 0; x < 6; x ++)
			{
				var i = Math.floor((Math.random()*12));
				color = color + possible_vals[i];
			}
			return color;
		}
		$(document).ready(function(){
			$('button').click(function(){
				var color1 = "#" + rand6();
				var color2 = "#" + rand6();
				$('.red').css("background-color", color1);
				$('.black').css("background-color", color2);
			});

		}) //end of document .ready
	</script>
	<title></title>
	<style>
		table 
		{
			border: 1px solid red;
			border-collapse:collapse;
		}
		td, th, tr
		{
			border: 1px solid red;
		}
		#checkerboard td
		{
			width: 40px;
			height: 40px;
		}
		.red
		{
			background-color: red;
		}
		.black
		{
			background-color: black;
		}
	</style>
</head>
<body>
	<?php
	function coin_flip($number_flips)
	{
		$heads = 0;
		$tails = 0;
		for($x = 1; $x < $number_flips + 1; $x++) 
		{
			$sim_flip = rand(1,2);
			if($sim_flip == 1)
			{
				$heads ++;
				#echo "<h4>Flipping a coin, it's heads! </h4>";
			}
			if($sim_flip == 2)
			{
				$tails ++;
				echo "<h4>Flipping a coin, it's tails! </h4>";
			}
			echo "<p> Through {$x} flips...we have: {$heads} heads and {$tails} tails </p>";
		}
	}

	#coin_flip(10);

	$grade = rand(50, 100);

	if($grade < 70)
	{
		echo "your grade was {$grade}/100, you receieve a D";
	}
	else if($grade < 80)
	{
		echo "your grade was {$grade}/100, you receieve a C";
	}
	else if($grade < 90)
	{
		echo "your grade was {$grade}/100, you receieve a B";
	}
	else
	{
		echo "your grade was {$grade}/100, you receieve a A";
	}

	$sample = array(135, 2.4, 2.67, 1.23, 332, 2, 1.02);
	function get_max_min($array_of_numbers)
	{
		$min = $array_of_numbers[0];
		$max = $array_of_numbers[0]; 
		foreach ($array_of_numbers as $number) 
		{
			if($number < $min)  
			{
				$min = $number;
			}	
			if($number > $max)
			{
				$max = $number;
			}
		}
		return array('max' => $max, 'min' => $min);
	}

	$values = get_max_min($sample);

	foreach($values as $key => $value)
	{
		echo  "<br>The {$key} is ".$value."<br>";
	}

	function draw_stars($array_of_numbers)
	{
		foreach ($array_of_numbers as $number) 
		{ 
			for ($i=0; $i < $number ; $i++) 
			{ 
				echo "*";
			}

			echo "<br>"; 
		}
	}

	draw_stars(array(3,4, 5 , 6, 11));
	$stuff = array('a', 3, 4, 5, 'f', 'Trey', 4, 'Don');

	function draw_stars_and_letters($array)
	{
		foreach ($array as $char)
		{
			if(is_int($char))
			{
				for ($i=0; $i < $char; $i++) 
				{ 
					echo "*";
				}
			}
			else #since there are only 2 cases, we only need one if
			{
				$count = strlen($char);
				for($i = 0; $i < $count; $i ++)
				{
					echo strtolower($char[0]);
				}
			}
			echo "<br>";
		} #end of function 
	}

draw_stars_and_letters($stuff);
function multi_table($max)
{
	echo "<table>
			<tr>
				<th>*</th>";
				for ($i=1; $i < $max + 1; $i++)
				{ 
					echo "<th>{$i}</th>";
				}
	echo    "</tr>";
	for($y = 1; $y < $max + 1; $y++)
	{
		echo "<tr>
				<th> {$y} </th>";
		for ($x=1; $x < $max + 1; $x++) 
		{ 
			echo "<td>".($y * $x) ."</td>";
		} #end of little loop
		echo "</tr>";
	} #end of big loop
	echo "</table>";
} #end of function
multi_table(8);

$users = array( 
   array('first_name' => 'Michael', 'last_name' => ' Choi '),
   array('first_name' => 'John', 'last_name' => 'Supsupin'),
   array('first_name' => 'Mark', 'last_name' => ' Guillen'),
   array('first_name' => 'KB', 'last_name' => 'Tonel') 
);
echo "<table>
		<tr>
			<th>User Number</th> 
			<th>First Name</th> 
			<th>Last Name</th> 
			<th>Full name</th>
			<th>Full name Uppercase</th>
			<th>Lenght</th>
		</tr>";
	$counter = 1;
	foreach ($users as $user) 
	{
		$fname = $user['first_name'];
		$lname = $user['last_name'];
		$full_name = $fname." ".$lname;
		$length = strlen(trim($fname)." ".trim($lname));
		$upcase = strtoupper($full_name);
		echo "<tr>
				<td>{$counter}</td>
				<td>{$fname}</td>
				<td>{$lname}</td>
				<td>{$full_name}</td>	
				<td>{$upcase}</td>
				<td>{$length}</td>
			</tr>";
		$counter ++;
	}

	echo "<table id = 'checkerboard'>";
	for ($y=1; $y < 9; $y++) 
	{ 
		echo "<tr>";
		for ($x=1; $x < 9; $x++) 
		{ 
			if(($x + $y)%2 == 0)
			{
				echo "<td class = 'red'></td>";
			}
			else
			{
				echo "<td class = 'black'></td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";
	echo "<button>CLICK HERE, BUDDY</button>";


?>

</body>
</html>

