<!DOCTYPE html>
<html lang='en'>
<meta charset='utf-8'>
<head>
	<title>Video Rental</title>
</head>
<body>
    <section>
<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
header('Content-Type: text/plain');
?>	
    <form action='QueryFunctions.php' method='post'>
        <input type='button' name='delete_all' value='Delete All'>
		<input type='text' name='name'>
        <input type='text' name='category'>
        <input type='text' name='length'>
        <input type='submit' name='add_video' value='Add'>
    </form>
<?php

?>
	
    </section>
</body>
</html>