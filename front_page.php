<?php
ob_start();
session_start();
include 'QueryFunctions.php';
error_reporting(E_ALL);
ini_set('display_errors',1);

$mysqli=new mysqli('oniddb.cws.oregonstate.edu','chrieric-db','KpqdL049GgphILrs','chrieric-db');
if($mysqli->connect_errno)
{
  echo 'Connection error ' . $mysqli->connect_errno . '' . $mysqli->connect_error;
} 

?>	
<!DOCTYPE html>
<html lang='en'>
<head>
	<title>Video Rental</title>
</head>
<body>
    <section>
	
	<form action='QueryFunctions.php' method='post'>
	<input type='submit' name='delete_all' value='Delete All'>
	</form>
    <form action='QueryFunctions.php' method='post'>
		<p>Name:<input type='text' name='name'></p>
        <p>Category:<input type='text' name='category'></p>
        <p>Length:<input type='text' name='length'></p>
        <input type='submit' name='add_video' value='Add'>
    </form>
	
	
<?php
	if(!($stmt=$mysqli->query("SELECT id, name, category, length, rented FROM video_store_inventory")))
	{
		echo "Query failed: (" .  $mysqli->errno . ") ". $mysqli->error;
	}
?>
	
	
	<table border='1'>
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
	
	while($row = mysqli_fetch_array($stmt))
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
		echo "<input type='hidden' name='id' value=\"".$row['id']."\">";
		echo "<input type='submit' name='check_in_out' value='Check In/Out'>";
		echo "</form>";
		echo "</td>";
		
		echo "<td>";
		echo "<form action='QueryFunctions.php' method='post'>";
		echo "<input type='hidden' name='id' value=\"".$row['id']."\">";
		echo "<input type='submit' name='delete_movie' value='Delete'>";
		echo "</form>";
		echo "</td>";
		echo "</tr>";
	}
?>
	</tbody>
	</table>
    </section>
</body>
</html>