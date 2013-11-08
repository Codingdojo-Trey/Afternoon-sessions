<?php 
	require('connection.php');
	if(!empty($_POST['offset'])) 
	{
		$offset = ($_POST['offset'] - 1) * 5;

	}
	else
	{
		$offset = 0;
	}
	$query = "SELECT * FROM leads 
	WHERE (first_name LIKE '{$_POST['first_name']}%' 
	AND last_name LIKE '{$_POST['last_name']}%')" ;
	
	if(!empty($_POST['to']) AND empty($_POST['from']))
	{
		$query .= $query .= " AND (registered_datetime <= ".'"'.$_POST['to'].'")';
	}
	if(!empty($_POST['from']) AND empty($_POST['to']))
	{
		$query .= " AND (registered_datetime >= ".'"'.$_POST['from'].'")';
	}
	if(!empty($_POST['to']) AND !empty($_POST['from']))
	{
		$query .= " AND (registered_datetime BETWEEN ".' " '.$_POST['from']. ' " ' ."AND". ' " ' . $_POST['to'].'")';

	}

	$query .= " LIMIT {$offset} , 5";
	$data  = array('people' => '');
	$data['people'] .= "<table>
							<tr>
								<th>Id</th>
								<th>first name</th>
								<th>last name</th>
								<th>registered datetime</th>
								<th>email</th>
							</tr>";
	$people = fetch_all($query);
	foreach ($people as $person) 
	{
		$data['people'] .= "
		<tr>
			<td>{$person['leads_id']}</td>
			<td>{$person['first_name']}</td>
			<td>{$person['last_name']}</td>
			<td>{$person['registered_datetime']}</td>
			<td>{$person['email']}</td>
		</tr>";

	}
	$data['people'] .= "</table>";
	$query2 = "SELECT COUNT(*) as number FROM leads 
	WHERE first_name LIKE '{$_POST['first_name']}%' 
	AND last_name LIKE '{$_POST['last_name']}%'";
	$data['number'] = fetch_record($query2);
	echo json_encode($data);
 ?>