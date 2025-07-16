<?php
session_start();

//include database connection file
include("db.php");

if (isset($_SESSION['user']) && isset($_SESSION['pass']))
 {
      // Access session variables
      $uname = $_SESSION['user'];
      $up = $_SESSION['pass'];

      // Match user details
      $query8 = "select * FROM user WHERE email='$uname'";
      $result8 = mysqli_query($con, $query8);
      $row8 = mysqli_fetch_assoc($result8);
      $id = $row8['sno'];
      $dpin=$row8['pin'];

      if($_SERVER['REQUEST_METHOD']== 'POST')
      {
      $amount=$_POST['amount'];
      $upin=$_POST['pin'];
      
    //checking pin is right
    $pmatch=false;
    if($upin==$dpin)
    {
        $pmatch=true;
    }
    else
    {
        $pmatch=false; 
    }

      $result=false;
    if ($pmatch==false) 
      {
          echo '<script>alert("Incorrect Pin")
          window.location.href="profile.php";
          </script>';
          
      }
    else if($amount>=10000)
    {
      echo '<script>alert("Please Enter amount less than 10000")
      window.location.href="profile.php";
      </script>';
    }
    else
    {
      
      // add/update balance of user
      $sql="update user set balance=balance+'$amount' where sno='$id'";
      $result=mysqli_query($con,$sql);
    }
      
      if($result)
      {
          echo "
          <script>
          alert('Balance added sucessfully');
          window.location.href = 'profile.php';
          </script> ";
      }
      else
      {
        echo "
        <script>
        alert('Failed to add balance');
        window.location.href = 'profile.php';
        </script> ";
      }
    }
}
else
{
  header("location: index.php");
}



$con->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Balance</title>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="tranfer.css">
  </link>
</head>

<body>
 
</body>
</html>