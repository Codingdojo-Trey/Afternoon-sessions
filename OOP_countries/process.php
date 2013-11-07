<?php 
	session_start();
	require('database.php');

	class Process extends Database
	{
		public function __construct()
		{
			parent::__construct();
			if (isset($_POST['action']) AND $_POST['action'] == 'country')
			{
				$this->Country_select_statement();
			}

		}

		public function Country_select_statement()
		{
			$name = mysql_real_escape_string($_POST['country']);
			$query = "SELECT * FROM country WHERE Name = '{$name}'";
			$results = $this->fetch_all($query);
			echo json_encode($results);	
		}


	}

	$trey = new Process();


 ?>