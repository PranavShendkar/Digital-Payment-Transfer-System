<?php
    session_start();

//include database connection file
include("db.php");

    if (isset($_SESSION['user']) && isset($_SESSION['pass']))
    {
      // Access session variables
      $uname = $_SESSION['user'];
      $up = $_SESSION['pass'];

         // Prepare and execute the query
    $sql = "select * FROM user WHERE email= '$uname'";
    $result = mysqli_query($con, $sql);   //store result of query
    $row=mysqli_fetch_assoc($result);
    $id=$row['sno'];
    $pin2=$row['pin'];
    
    if($_SERVER['REQUEST_METHOD']=='POST')
    {

    //collect post variable pin and conferm pin
    $pin1=$_POST['pin'];
    $cpin1=$_POST['cpin'];
    
    //check both same pin or not
    if($pin1!=$cpin1)
    {
      echo "  <script>
            alert('Pin Do not Match');
            window.location.href= 'set_pin.php';
        </script>";
        
    }
    else
    {
      if($_SERVER['REQUEST_METHOD']=='POST')
      {
    //set pin to the account
    $sql2="update user set pin='$cpin1' where sno='$id'";
    $result2=mysqli_query($con,$sql2);
    
  
    if($result2==1)
    {
        echo "
        <script>
        alert('UPI Pin Set Successfully');
        window.location.href = 'home.php';
        </script> ";
    }
    }
}
 }
}
 else
 {
    header("location: index.php");
 }

 $con->close();

?>


<?php

if($pin2==0)
{
  echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>set pin</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
<body>
<br><br>
<form action="set_pin.php" method="post">
  <h2 align="center">Set UPI Pin to your account</h2>
  <br>
  <div class="container p-1">
    <div class="card px-4">
      <div class="row gx-1">
        <div class="col-10">
          <div class="d-flex flex-column">
            <p class="text mb-1 mt-3">Enter UPI Pin</p> <!-- Added mt-3 for margin-top -->
            <input class="form-control mb-3" type="password" placeholder="******" name="pin" required>
          </div>
        </div><br><br>
        <div class="row gx-1">
        <div class="col-10">
            <p class="text mb-1 mt-3">Confirm UPI Pin</p> <!-- Added mt-3 for margin-top -->
            <input class="form-control mb-3" type="password" placeholder="******" name="cpin" required>
          </div>
        </div>
        <div class="col-20">
          <input type="submit" class="btn btn-primary mb-3" value="set">
        </div>
      </div>
    </div>
  </div>
</form><br><br><br><br>
</center>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>
</html> ';
}
else
{
  header("location: home.php");
}
?>
  