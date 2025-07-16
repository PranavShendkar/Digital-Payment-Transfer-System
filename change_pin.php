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
    $dpin=$row['pin'];
    if($_SERVER['REQUEST_METHOD']=='POST')
  {
    $upin=$_POST['pin1'];    

        //check both same pin or not
        if($dpin==$upin)
             {
                $sql3="update user set pin='0' where sno='$id'";
                $result3=mysqli_query($con,$sql3);
                session_unset();
                session_destroy();
                echo "
                <script>
                alert('UPI Pin Reset Successfully');
                alert('Login Again to Set New UPI Pin');
                window.location.href ='log_in.php';
                </script> ";
              }
        else
            {
                echo " <script>
                window.alert('Pin Does Not Match');
                window.location.href= 'change_pin.html';
                </script>";
            }
          }
  }

 else
 {
    header("location: index.php");
 }

 $con->close();

 ?>