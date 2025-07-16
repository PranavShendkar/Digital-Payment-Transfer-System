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
    $sql = "select * from user where email= '$uname'";
    $result = mysqli_query($con, $sql);   //store result of query
    $row=mysqli_fetch_array($result);

    $id=$row['sno'];
    $dp=$row['password'];
    if($_SERVER['REQUEST_METHOD']=='POST')
  {
   
    $uop=$_POST['op'];  
    $unp=$_POST['np'];  
    $ucnp=$_POST['cnp']; 
    
        //make hash of password
        $password2=password_hash($unp,PASSWORD_DEFAULT);

        //Matching Hash Password
        $hmatch=password_verify($uop,$up);
    

    // Validate inputs
    $pmatch = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@~!#$%^&*()_+[\]{}|;:,.<>?`]).{8,16}$/", $unp);

    if($hmatch==false)
      {
        echo "
        <script>
        alert('Old Password Does Not Match');
        window.location.href='change_password.html';
        </script> ";
      }
     else if($pmatch==false)
      {
          echo"<script> alert('New Password Should contain:\\n*one uppercase,lowercase letter & digit\\n*one special character like(@,-,%,_,#)\\n*must be 8-16 digits long password');
          window.location.href='change_password.html'; </script>";
      }
      else if($unp!=$ucnp)
      {
        echo "
        <script>
        alert('New and Confirm Password Does Not Match');
         window.location.href='change_password.html';
        </script> ";
      }
    else
     {
                    $sql4="update user set password='$password2' where sno='$id'";
                    $result4=mysqli_query($con,$sql4); 
                    session_unset();
                    session_destroy();  
                    echo "
                    <script>
                    alert(' Password Changed Successfully');
                    alert('Login Again');
                    window.location.href ='log_in.php';
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
