
<?php

session_start();

//include database connection file
include("../db.php");

if (isset($_SESSION['auser']) && isset($_SESSION['apass'])) 
{
    //access session variables
    $uname=$_SESSION['auser'];
    $up=$_SESSION['apass'];

    $id=$_GET['id'];
    // echo $id;
    $query="delete from user where sno='$id'";
    $result=mysqli_query($con,$query);
    
    if($result)
    {
    echo"
    <script> window.alert('Customer Deleted Successfully..!!!');
    window.location.href='dashboard.php';
    </script>
    ";
    }
    else 
    {
      echo"
    <script> window.alert('Customer Deleted Failed');
    window.location.href='dashboard.php';
    </script>
    ";
    }
}
else
  {
      header("location: ../index.php");
  }
$con->close();
?>