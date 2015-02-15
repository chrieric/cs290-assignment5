<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
header('Content-Type: text/plain');
 
$mysqli=new mysqli('oniddb.cws.oregonstate.edu','chrieric-db','temp','chrieric-db');
if(!$mysqli||$mysqli->connect_errno)
{
  echo 'Connection error' . $mysqli->connect_errno . '' . $mysqli->connect_error;
}
 
 
function addMovie(array)
{
  
  $name=$_POST["name"];
  $category=$_POST["category"];
  $length=$_POST["length"];
    
    if($_POST != null)
    {
        if($name !=null && $category != null && $length != null)
        {
          /*this is where you add functionality to add the data to the table via SQL call
          include button creation here as well?*/
          
          if(!$stmt=$mysqli->prepare("INSERT INTO video_store_inventory (name, category, length)
          VALUES (?,?,?);"))
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
        }
    }
    else
    {
        echo 'There was an error submitting your data';
    }
};
 
function deleteMovie(array)
{
  $id=$_POST['button_id'] /*this is just to inform me what should be here, change later*/
  
  if($name!=null)
  {
    if(!$stmt=$mysqli->prepare("DELETE FROM video_store_inventory WHERE (id = ?)))
   {
      echo 'Prep failed: (' . $mysqli->errno . ') ' . $mysqli->error
    }
    elseif(!$stmt->bind_param("i", $id))
    {
      echo 'Binding failed: (' . $stmt->errno . ') ' . $stmt->error;
    }
    else if(!stmt->execute())
    {
      echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
    }
    else
    {
        mysqli_stmt::bind_param('i',$id);
        $stmt->execute();
    }
    $stmt->close();
    }
    else
    {
      if($name==null)
      {
        echo 'ID not found';
      }
    }
  }
};
 
function deleteAll(array)
{
  if(!$stmt=$mysqli->prepare("DELETE FROM video_store_inventory))
   {
      echo 'Prep failed: (' . $mysqli->errno . ') ' . $mysqli->error
    }
    }
    else if(!stmt->execute())
    {
      echo 'Execution failed: ' . $stmt->errno . ') ' . $stmt->error;
    }
    else
    {
        mysqli_stmt::bind_param('i',$id);
        $stmt->execute();
    }
    $stmt->close();
}
 
 
?>