<?php
session_start();

//include database connection file
include("db.php");

if (isset($_SESSION['user']) && isset($_SESSION['pass']))
 {
    // Access session variables
    $uname = $_SESSION['user'];
    $up = $_SESSION['pass'];
    
        //match user details
        $query2="select sno from user where email='$uname'";
        $result7=mysqli_query($con,$query2);
        $row7=mysqli_fetch_assoc($result7);
        $id=$row7['sno'];
        
       

//retrive hisory in table
$query="select * from history where uno='$id' order by sno desc";
$result=mysqli_query($con,$query);
$num=mysqli_num_rows($result);

//for total transaction count
$query2="select * from history where uno='$id'";
$result2=mysqli_query($con,$query2);
$num2=mysqli_num_rows($result2);

 }
 else
 {
  header("location: index.php");
 }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
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
            <a class="nav-link" href="customer.php">Customers</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="transfer.php">Transfer</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">History</a>
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
  <table border=5 class="table table-danger table-hover ">
    <tr>
      <th>Sno</th>
      <th>Receiver name</th>
      <th>Amount</th>
      <th>Date & Time</th>
      <th>Status</th>
</tr>

<?php
if($num>0)
{
$cnt=$num2;
while($row=mysqli_fetch_assoc($result))
{
  ?>
<tr>
  <?php
    if ($row['status']=='Failed') 
      {
  ?>

    <td><?php 
    echo "<font color=red>";
    echo $cnt; 
    ?></td>

    <td><?php
    echo "<font color=red>";
    echo $row['rname'];
    ?></td>

    <td><?php 
    echo "<font color=red>";
    echo $row['amount'].' Rs.';
    ?></td>
    
    <td><?php
    echo "<font color=red>";
     echo $row['time'];
     ?></td>
    
    <td><?php 
        echo "<font color=red>";
        echo $row['status'];
      }
    else 
      {
    ?>
        <td><?php echo $cnt; ?></td>
        <td><?php echo $row['rname'];?></td>
        <td><?php echo $row['amount'].' Rs.';?></td>
        <td><?php echo $row['time'];?></td>
        <td><?php 
          echo $row['status'];
      }
        ?></td>

      
</tr>
<?php
$cnt--;
}
}
else {
  
  echo '<br><h3><center>No Transactions Found</center></h3>';
}
?>
  </table>

  <center><a href="history.php"><b>Go back to main page</b></a></center>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>