<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
header('Content-Type: text/plain');

$mysqli=new mysqli('oniddb.cws.oregonstate.edu','chrieric-db','temp','chrieric-db');
if(!$mysqli||$mysqli->connect_errno)
{
  echo 'Connection error ' . $mysqli->connect_errno . '' . $mysqli->connect_error;
} 

?>	

<!DOCTYPE html>
<html lang='en'>
<meta charset='utf-8'>
<head>
	<title>Video Rental</title>
</head>
<body>
    <section>

    <form action='QueryFunctions.php' method='post'>
        <input type='button' name='delete_all' value='Delete All'>
		<input type='text' name='name'>
        <input type='text' name='category'>
        <input type='text' name='length'>
        <input type='submit' name='add_video' value='Add'>
    </form>
	
	
	<table border='0.5'>
	<thead>
	<tr>
		<th>Title</th>
		<th>Category</th>
		<th>Length</th>
		<th>Rented</th>
		<th>Check-In/Out</th>
		<th>Delete Movie</th>
	</tr>
	</thead>
	<tbody>
<?php
	$row;
	
	while($row=mysqli_fetch_array($stmt))
	{
		echo "<tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['category'] . "</td>";
		if($row['length']==0)
		{
			echo "<td>" . "none listed" . "</td>";
		}
		else
		{
			echo "<td>" . $row['length'] . "</td>";

		}
		echo "<td>" . $row['rented'] . "</td>";
		echo "<td>";
		echo "<form action='QueryFunctions.php' method='post'>";
		echo "<input type='submit' name='check_in_out' value='Check In/Out' id='$row['id']'>";
		echo "</td>";
		
		echo "<td>";
		echo "<form action='QueryFunctions.php' method='post'>";
		echo "<input type='submit' name='delete_movie' value='delete' id='$row['id']'>";
		echo "</td>";
	}
?>
	
    </section>
</body>
</html>