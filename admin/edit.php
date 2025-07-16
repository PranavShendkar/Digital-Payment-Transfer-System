
<?php
    session_start();

//include database connection file
include("../db.php");

    if (isset($_SESSION['auser']) && isset($_SESSION['apass']))
    {
      // Access session variables
      $uname = $_SESSION['auser'];
      $up = $_SESSION['apass'];

      $id=$_GET['id'];
    // Prepare and execute the query
    $sql = "select * FROM user WHERE sno='$id'";
    $result = mysqli_query($con, $sql);   //store result of query
    $row=mysqli_fetch_assoc($result);    

    $_SESSION['id']=$id;
    
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
    <title>Update Info</title>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"></head>
<body>
<br><br>
<form action="edit2.php" method="post">
  <h2 align="center">Update the Customer Info.</h2>
  <br>
  <div class="container p-1">
    <div class="card px-4">
      <div class="row gx-1">
        <div class="col-10">
          <div class="d-flex flex-column">
            <p class="text mb-1 mt-3">Customer Name</p> <!-- Added mt-3 for margin-top -->
            <input class="form-control mb-3" type="text" name="cname" value="<?php echo $row['name']; ?>" required>
          </div>
        </div><br><br>
  
      
        <div class="col-10">
          <div class="d-flex flex-column">
            <p class="text mb-1 mt-3">Customer Ph.No</p> <!-- Added mt-3 for margin-top -->
            <input class="form-control mb-3" type="text" name="cphno" value="<?php echo $row['phno']; ?>" required>
          </div>
        </div><br><br>

        <div class="col-10">
          <div class="d-flex flex-column">
            <p class="text mb-1 mt-3">Customer Email</p> <!-- Added mt-3 for margin-top -->
            <input class="form-control mb-3" type="email" name="cemail" value="<?php echo $row['email']; ?>" required>
          </div>
        </div><br><br>

        <div class="col-20">
          <input type="submit" class="btn btn-primary mb-3" value="Update">
        </div>
      </div>
    </div>
  </div>
</form><br><br><br><br>
</center>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>
</html>
