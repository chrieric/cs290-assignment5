<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
header('Content-Type: text/plain');

$failure=0;
 
$mysqli=new mysqli('oniddb.cws.oregonstate.edu','chrieric-db','temp','chrieric-db');
if(!$mysqli||$mysqli->connect_errno)
{
  echo 'Connection error' . $mysqli->connect_errno . '' . $mysqli->connect_error;
} 

 
function addMovie(array)
{ 
  $name=array["name"];
  $category=array["category"];
  $length=array["length"];
    
        if($name !=null && $category != null && $length != null)
        {
          /*this is where you add functionality to add the data to the table via SQL call
          include button creation here as well?*/
          
          if(!$stmt=$mysqli->prepare("INSERT INTO video_store_inventory (name, category, length)
          VALUES (?,?,?)"))
          {
            echo 'Prep failed: (' . $mysqli->errno . ') ' . $mysqli->error
          }
          elseif(!$stmt->bind_param("ssi", $name, $category, $length))
          {
            echo 'Binding failed: (' . $stmt->errno . ') ' . $stmt->error;
          }
          else if(!stmt->execute())
          {
            echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
          }
          else
          {
            mysqli_stmt::bind_param('ssi',$name,$category,$length);
            $stmt->execute();
          }
          $stmt->close();
        }
        else
        {
          if($name==null)
          {
            echo 'You failed to enter a name';
          }
          if($category=null)
          {
            echo 'You failed to enter a category';
          }
          if($length==null)
          {
            echo 'You failed to enter a movie length';
          }
		  
		  echo "Error while adding video, click <a href='front_page.php'>here</a> to return to your inventory.";
        }
    }
};
 
function deleteMovie(array)
{
  $id=$_POST['id'] /*this is just to inform me what should be here, change later*/
  
	if($name!=null)
	{
		if(!$stmt=$mysqli->prepare("DELETE FROM video_store_inventory WHERE (id = ?)"))
		{
			echo 'Prep failed: (' . $mysqli->errno . ') ' . $mysqli->error
		}
		elseif(!$stmt->bind_param("s", $id))
		{
			echo 'Binding failed: (' . $stmt->errno . ') ' . $stmt->error;
		}
		else if(!stmt->execute())
		{
			echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
		}
		$stmt->close();
	}
	else
	{
		echo "Name not found click <a href='front_page.php'>here</a> to return to your inventory.";
    }
};
 
function deleteAll(array)
{
	if(!$stmt=$mysqli->prepare("DELETE FROM video_store_inventory)")
	{
		echo 'Prep failed: (' . $mysqli->errno . ') ' . $mysqli->error
    }
    else if(!stmt->execute())
	{
		echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
    }
    $stmt->close();
}

function checkInOut(array)
{
	//gets id passed from post
	$id=array['id'];
	//temp variable
	$temp_rented;
	
	//checks to deteremine if an errors
	if(!(stmt = $mysqli->query("SELECT rented FROM video_store_inventory WHERE id=?"))
	{
		echo 'Query failed: (' . $mysqli->errno . ') ' . $mysqli->error;
	}
	//if no errors, fetches value of rented
	//then changes rented value from 0 to 1 or 1 to 0
	else
	{	stmt = $mysqli->query("SELECT rented FROM video_store_inventory WHERE name=?"
		$temp_rented=stmt->fetch_assoc();
		
		if($temp_rented==0)
		{
			if(!($stmt=$mysqli->prepare("UPDATE video_store_inventory SET rented=1 WHERE id=?")))
			{
				echo 'Prep failed: (' . $mysqli->errno . ') ' . $mysqli->error;
			}
			elseif((!($stmt->bind_param("i", $id)))
			{
				echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
			}
			else if(!(stmt->execute()))
			{
				echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
			}
		}
		else
		{
			if(!($stmt=$mysqli->prepare("UPDATE video_store_inventory SET rented=0 WHERE name=?")))
			{
				echo 'Prep failed: (' . $mysqli->errno . ') ' . $mysqli->error;
			}
			elseif(!($stmt->bind_param("i", $id)))
			{
				echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
			}
			else if(!(stmt->execute()))
			{
				echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
			}
		}
	}
	$stmt->close();
}

if($_POST != null)
{
	if(isset($_POST['add_video']))
	{
		addMovie($_POST);
	}
	elseif(isset($_POST['delete_movie']))
	{
		deleteMovie($_POST);
	}
	elseif(isset($_POST['delete_all']))
	{
		deleteAll($_POST);
	}
	elseif(isset($_POST['check_in_out']))
	{
		checkInOut($_POST);
	}

	if($failure==0)
	{
		header("Location:front_page.php",true);
	}
}
else
{
	echo "Error while sending data, click <a href='front_page.php'>here</a> to return to your inventory.";
}
 
?>