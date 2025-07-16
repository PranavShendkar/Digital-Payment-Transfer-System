<?php
session_start();

$showerror = false;

//include database connection file
include("../db.php");

// Check if the form was submitted
if (isset($_POST['password']))
 {
    // Collect POST variables
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $sql = "select * FROM admin WHERE aemail= '$user_name' and apassword='$password'";
    $result = mysqli_query($con, $sql);   //store result of query
    $num=mysqli_num_rows($result);        //return found rows

    if ($num==1)
        {
            
            $_SESSION["auser"]=$user_name;
            $_SESSION["apass"]=$password;
             header("Location: dashboard.php");
            exit(); // Ensure the script stops executing after the redirect
        }
    else
    {
        $showerror=true;
    }
} 



// Close database connection
$con->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../style.css">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet">
</head>

<body>
<section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="bank.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">We are The Key Stone Team</h4>
                                    </div>

                                    <form action="admin_login.php" method="post">
                                        <p>Please login to your account</p>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="form2Example11" class="form-control"
                                               name="user_name" required />
                                            <label class="form-label" for="form2Example11" >Email Id / Username</label>
                                        </div>

                                        <?php
                                        
                                            if ($_SERVER['REQUEST_METHOD'] == 'POST')
                                                {
                                                if($showerror==true)
                                                {
                                                    echo "<p> <font color='red'> Invalid username and password </font></p>";
                                                }
                                            }

                                        ?>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="password" id="form2Example22" class="form-control" name="password" required/>
                                            <label class="form-label" for="form2Example22">Password</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <!-- <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">Log
                                                in</button> -->
                                                <input type="submit" value="Log in" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                                            <a class="text-muted" href="aforget_password.php">Forgot password?</a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center">
                                <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a trust</h4>
                                    <p class="small mb-0">Helping You Make Smart Financial Choices.We Make Banking Easy
                                    </p>
                   
                                </div>
                            </div>

                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
           
                                      
    </section>


    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
    
    </body>

</html>