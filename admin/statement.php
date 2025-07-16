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

        //customers history
        $query="select * from history where uno='$id'";
        $result=mysqli_query($con,$query);
        $num=mysqli_num_rows($result);

  
        //customers details
        $query2="select * from user where sno='$id'";
        $result2=mysqli_query($con,$query2);      
        $row2=mysqli_fetch_assoc($result2);
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

  <script type="text/javascript">
        // Automatically trigger the print dialog when the page loads
        window.onload = function() {
            window.print();
        }
    </script>
</head>

<body>
      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <a class="navbar-brand mt-2 mt-lg-0" href="#">
          <img src="bank.png" height="15" alt="Logo" loading="lazy" />
        </a>
    </div>
    <center><h3>Customer Transaction Statement</h3></center>
  </nav><br><br>
  <h5>Account Holder Name : <?php echo $row2['name']; ?></h5>
  <h5>----------||---------- Ph.No : <?php echo $row2['phno']; ?></h5>
  <h5>----------||---------- Email : <?php echo $row2['email']; ?></h5>
  <h5>----------||---------- A/C No. : <?php echo $row2['name']; ?></h5><br><br>

  <table border=5 class="table table-danger table-hover ">
    <tr>
      <th>Sno</th>
      <th>Receiver name</th>
      <th>Amount</th>
      <th>Date & Time</th>
</tr>

<?php
$cnt=1;
if($num>0)
{
while($row=mysqli_fetch_assoc($result))
{ 
  ?>
<tr>

    <td><?php echo $cnt; ?></td>
    <td><?php echo $row['rname'];?></td>
    <td><?php echo $row['amount'].' Rs.';?></td>
    <td><?php echo $row['time'];?></td>

</tr>
<?php
$cnt++;
}
}

else 
{
    echo "<h3>No Transactions Found...</h3>";
}
echo "<br><a href='dashboard.php'> Go Dashboard </a><br>";
?>

</table>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"> </script>
</body>

</html>