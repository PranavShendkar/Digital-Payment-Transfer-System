<?php

session_start();

//include database connection file
include("db.php");

if (isset($_SESSION['user']) && isset($_SESSION['pass'])) 
{
    //access session variables
    $uname=$_SESSION['user'];
    $up=$_SESSION['pass'];

    //match user details
    $query2="select sno from user where email='$uname'";
    $result7=mysqli_query($con,$query2);
    $row7=mysqli_fetch_assoc($result7);
    $id=$row7['sno'];

    //customers list
    $query="select * from user";
    $result=mysqli_query($con,$query);
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
  <link rel="stylesheet" href="sign_up.css">

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="home.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <!-- Container wrapper -->
    <div class="container-fluid">
      <!-- Toggle button -->
      <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img src="bank.png" height="15" alt="Logo" loading="lazy" />
        </a>
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="home.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contacts</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="transfer.php">Transfer</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="history.php">History</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="about_us.php">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contact_us.php">Contact Us</a>
          </li>
          <li class="nav-item">
                    <a class="nav-link" href="profile.php">My Profile</a>
          </li>
        </ul>
      </div>
    </div>
  </nav><br><br>

  <table class="table" border=2>
    <tr>
      <th scope="col" >Contact Name</th>
      <th scope="col" >Contact No.</th>
    </tr>
 
    <tr>
      <?php
      while($row=mysqli_fetch_assoc($result))
      if($row['sno']!=$id)
      {
      {
        ?>
         <td > <?php echo $row['name'];   ?></td>
         <td > <?php echo $row['phno'];   ?></td>
        </tr>
        <?php
      }
    }
      ?>  
    

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>