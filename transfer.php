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
    $query8 = "select sno FROM user WHERE email='$uname'";
    $result8 = mysqli_query($con, $query8);
    $row8 = mysqli_fetch_assoc($result8);
    $id = $row8['sno'];

    // Retrieve data in dropdown
    $query = "SELECT * FROM user";
    $result = mysqli_query($con, $query);

    // Retrieve dropdown value
    if (isset($_POST['rid'])) 
      {
        // Access receiver id and amount
        $rid = $_POST['rid'];
        $amount = $_POST['amount'];
        $upin= $_POST['pin'];

        // Check balance of user
        $query9 = "select balance FROM user WHERE sno='$id'";
        $result9 = mysqli_query($con, $query9);
        $row9 = mysqli_fetch_assoc($result9);
        $user_balance = $row9['balance'];


        //check if user was blocked or not
        $query10="select block from user where sno='$id'";
        $result10=mysqli_query($con,$query10);
        $row=mysqli_fetch_assoc($result10);

        if($row['block']=='ub')
        {

            // For database history
            $query7 = "select name FROM user WHERE sno='$rid'";
            $result7 = mysqli_query($con, $query7);
            $row7 = mysqli_fetch_assoc($result7);
            $rname = $row7['name'];

        // Check if user's account balance is not less than transfer amount
        if ($user_balance == 0) 
          {
              echo '<script>alert("Transfer failed due to zero balance \\n Please add balance from profile tab")
                                  window.location.href = "profile.php";
                    </script>';

              // Update history
              $query_h = "INSERT INTO `project`.`history` (`rname`,`uno`, `amount`, `time`,`status`) VALUES ('$rname','$id', '$amount', CURRENT_TIMESTAMP(), 'Failed')";
              $result5 = mysqli_query($con, $query_h);
          } 
          else if($user_balance-$amount<=500)
          {
           echo '<script>alert("Transfer failed due to min balance amt limit Rs.500 \\n Please add balance from profile tab")
           window.location.href = "transfer.php";
           </script>';

              // Update history
              $query_h = "INSERT INTO `project`.`history` (`rname`,`uno`, `amount`, `time`,`status`) VALUES ('$rname','$id', '$amount', CURRENT_TIMESTAMP(), 'Failed')";
              $result5 = mysqli_query($con, $query_h);
          }
        elseif ($user_balance <= $amount)
         {
            echo '<script>alert("Transfer failed due to insufficient balance \\n Please add balance from profile tab")
                                window.location.href = "profile.php";
            </script>';

              // Update history
              $query_h = "INSERT INTO `project`.`history` (`rname`,`uno`, `amount`, `time`,`status`) VALUES ('$rname','$id', '$amount', CURRENT_TIMESTAMP(), 'Failed')";
              $result5 = mysqli_query($con, $query_h);
         } 
        else
         {

            //checking pin is right
            $query_pin = "select pin FROM user WHERE email='$uname'";
            $result_pin = mysqli_query($con, $query_pin);
            $num_pin = mysqli_fetch_assoc($result_pin);
            $dpin = $num_pin['pin'];

            if ($dpin!=$upin) 
            {
                echo '<script>alert("Transfer failed due to incorrect pin")
                                    window.location.href = "transfer.php";
                      </script>';
            
              // Update history
              $query_h = "INSERT INTO `project`.`history` (`rname`,`uno`, `amount`, `time`,`status`) VALUES ('$rname','$id', '$amount', CURRENT_TIMESTAMP(), 'Failed')";
              $result5 = mysqli_query($con, $query_h);  
            }
          else 
             {
                //Update receiver's account balance
                $query3 = "UPDATE user SET balance=balance+'$amount' WHERE sno='$rid'";
                $result3 = mysqli_query($con, $query3);
                if ($result3) 
                {
                    // Update sender's account balance
                    $query4 = "UPDATE user SET balance=balance-'$amount' WHERE sno='$id'";
                    $result4 = mysqli_query($con, $query4);

                    // Update history
                    $query5 = "INSERT INTO `project`.`history` (`rname`,`uno`, `amount`, `time`,`status`) VALUES ('$rname','$id', '$amount', CURRENT_TIMESTAMP(), 'Success')";
                    $result5 = mysqli_query($con, $query5);

                    echo '<script>
                            alert("Transaction Successful");
                            window.location.href = "history.php";
                          </script>';
                }
               else 
                {
                    echo '<script>alert("Transaction failed")
                    window.location.href = "transfer.php";
                  </script>';

              // Update history
              $query_h = "INSERT INTO `project`.`history` (`rname`,`uno`, `amount`, `time`,`status`) VALUES ('$rname','$id', '$amount', CURRENT_TIMESTAMP(), '<font color='red'>Failed</font>')";
              $result5 = mysqli_query($con, $query_h);
                }
              }
     }
    }

    else 
    {
      echo"
<script> 
window.alert('Transaction Failed...\\nYour account has been suspended due to some technical issue..\\n Kindly visit your nearby branch..');
window.location.href='transfer.php';
</script>
";
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
  <title>Transfer</title>
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
            <a class="nav-link" href="#">Transfer</a>
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
  </nav><br><br><br><br><br><br>

  <form action="transfer.php" method="post">
    <div class="container p-0">
      <div class="card px-4">
        <p class="h8 py-3">Payment Details</p>
        <div class="row gx-3">
          <div class="col-12">
            <div class="d-flex flex-column">
              <p class="text mb-1">Receiver Name</p>
              <select name="rid" class="form-select" required>
              <?php
              // Assuming $result contains the query result with user data
              while ($row = mysqli_fetch_assoc($result)) 
              {
                if($row['sno']!=$id)
                {
              ?>
                <option value="<?php echo ($row['sno']); ?>">
                  <?php echo ($row['name']); ?>
                </option>
              <?php
              }
              }
              ?>
            </select>

            </div>
          </div>
          <div class="col-12">
            <div class="d-flex flex-column">
              <p class="text mb-1">Transfer Amount</p>
              <input class="form-control mb-3" type="number" placeholder="0.000" name="amount" required>
            </div>

            <div class="col-6">
              <div class="d-flex flex-column">
                <p class="text mb-1">CVV/PIN</p>
                <input class="form-control mb-3 pt-2 " type="password" placeholder="***" name="pin" required>
              </div>
            </div>
            <input type="submit" class="btn btn-primary mb-3" value="Pay">
  </form>
  </div>
  </div>
  </div>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>