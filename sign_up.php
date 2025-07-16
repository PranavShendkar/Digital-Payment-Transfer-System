<?php
// Start session for redirection
session_start();

//include database connection file
include("db.php");


if (isset($_SESSION))
 {
// Check for POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = $_POST['name'];
    $phno = $_POST['phno'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    //Hashing the Passwords
    $password2=password_hash($password,PASSWORD_DEFAULT);

    // Validate inputs
    $nmatch = preg_match("/^[a-zA-Z ]+$/", $name);
    $ematch = preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $email);
    $phmatch = preg_match("/^[0-9]{10}$/", $phno);
    $pmatch = preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@~!#$%^&*()_+[\]{}|;:,.<>?`]).{8,16}$/", $password);
    $cpmatch = $password === $cpassword;

    //check user exist
    $found=false;
    $exist="select * from user where email='$email'";
    $query7=mysqli_query($con,$exist);
    $result7=mysqli_num_rows($query7);
    if($result7==1)
    {
      $found=true;
    }
    else
    {
      $found=false;
    }

    if ($nmatch==true && $ematch==true && $phmatch==true && $pmatch==true && $cpmatch==true && $found==false) 
    {
      //generate random acno
      $acno1=rand();
      $acno2=rand();
      $acno=$acno1.$acno2;

        // Insert data into the sign_up table
        $sql= "insert into `project`.`user` (`name`, `phno`, `email`, `password`,`acno`,`block`) VALUES ('$name','$phno','$email','$password2','$acno','ub')";
        $result=mysqli_query($con,$sql);
        // Check SQL query success for redirection
        if($result)
         {
            $_SESSION['status1'] = "Account Created Successfully!";
            header("Location: log_in.php");     // Redirection to login page         
            exit();
        } 
    }
  }
}
else
{
  header("location: index.php");
}
      

    // Close the connection
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet">
</head>

<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>


                  <form class="mx-1 mx-md-4" action="sign_up.php" method="post">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="text" id="form3Example1c" class="form-control" name="name" required>
                        <label class="form-label" for="form3Example1c">Your Name</label>
                      </div>
                    </div>

                    
                    <?php
                      if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                          if($nmatch==false)
                          {
                            echo "<p> <font color='red'> *Name Should Contains only letters </font></p>";
                          }
                      }
                    ?>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-phone fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="number" id="form3Example1c" class="form-control" name="phno" maxlength="10"
                          required>
                        <label class="form-label" for="form3Example1c">Phone No</label>
                      </div>
                    </div>

                    <?php
                      if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                          if($phmatch==false)
                          {
                            echo "<p> <font color='red'> *Phone number should 10 digits only </font></p>";
                          }
                      }

                    ?>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="email" id="form3Example3c" class="form-control" name="email" required />
                        <label class="form-label" for="form3Example3c">Your Email</label>
                      </div>
                    </div>

                    <?php
                      if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                          if($ematch==false)
                          {
                            echo "<p> <font color='red'><br> *Email should in a proper format </font></p>";
                          }
                          else if($found==true)
                          {
                            echo "<p> <font color='red'><br> *user already exist </font></p>";
                          }
                      }
                      ?>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4c" class="form-control" name="password" required />
                        <label class="form-label" for="form3Example4c">Password</label>
                      </div>
                    </div>
                    <?php
                      if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                          if($pmatch==false)
                          {
                            echo "<p> <font color='red'> *Password Should contain:<br> 
                            *one uppercase,lowercase letter & digit <br>
                            *one special character like(@,-,%,_,#)<br>
                            *must be 8-16 digits long password
                            </font></p>";
                          }
                      }
                    ?>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div data-mdb-input-init class="form-outline flex-fill mb-0">
                        <input type="password" id="form3Example4cd" class="form-control" name="cpassword" required />
                        <label class="form-label" for="form3Example4cd">Repeat your password</label>
                      </div>
                    </div>
                    
                    <?php
                      if ($_SERVER['REQUEST_METHOD'] == 'POST')
                        {
                          if($cpmatch==false)
                          {
                            echo "<p> <font color='red'> *password do not match</font></p>";
                          }
                      }
                    ?>

                    <div class="form-check d-flex justify-content-center mb-3">
                      <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required/>
                      <label class="form-check-label" for="form2Example3">
                        I agree all statements in <a href="https://www.bankersadda.com/banking-regulation-compliance/">Terms of service</a>
                      </label>
                    </div>
                    <p class="mb-3 me-2"> Already have an account?<a href="log_in.php"> Sign in</a></p>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <input type="submit" class="btn btn-primary btn-lg" value="register">
                    </div>

                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="key.png" class="img-fluid" alt="Sample image">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>
</html>