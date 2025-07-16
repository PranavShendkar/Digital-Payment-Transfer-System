<?php
    session_start();

    //include database connection file
    include("../db.php");

    if (isset($_SESSION['auser']) && isset($_SESSION['apass']))
    {
      $id=$_SESSION['id'];

      $cname=$_POST['cname'];
      $cphno=$_POST['cphno'];
      $cemail=$_POST['cemail'];

       // Validate inputs
       $nmatch = preg_match("/^[a-zA-Z ]+$/", $cname);
       $ematch = preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $cemail);
       $phmatch = preg_match("/^[0-9]{10}$/", $cphno);

        if($nmatch==false)
        {
          echo"
          <script> window.alert('*-Name should contains only letters');
          window.location.href='dashboard.php';
          </script>
          ";
        }
        else if($phmatch==false)
        {
          echo"
          <script> window.alert('*-Phone number should 10 digits only');
          window.location.href='dashboard.php';
          </script>
          ";
        }
        else if($ematch==false)
        {
          echo"
          <script> window.alert('*-Email should in a proper format');
          window.location.href='dashboard.php';
          </script>
          ";
        }
        else
        {
        // Prepare and execute the query
        $sql2 = "update user set name='$cname' WHERE sno='$id'";
        $sql3 = "update user set email='$cemail' WHERE sno='$id'";
        $sql4 = "update user set phno='$cphno' WHERE sno='$id'";

        $result2 = mysqli_query($con, $sql2);
        $result3= mysqli_query($con, $sql3);
        $result4= mysqli_query($con, $sql4);

        if($result2 || $result3 || $result4)
        {
        echo"
        <script> window.alert('Information Updated Successfully..!!!');
        window.location.href='dashboard.php';
        </script>
        ";
        }
        else 
        {
            echo"
          <script> window.alert('Information Updated Failed');
          window.location.href='dashboard.php';
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
