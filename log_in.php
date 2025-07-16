<?php
//for authentication
session_start();

//for invalid username and password
$showerror = false;

//include database connection file
include("db.php"); 

// Check if the form was submitted
if (isset($_POST['password']))
    {
        // Collect POST variables
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        // Prepare and execute the query
        $sql = "select * FROM user WHERE email= '$user_name'";
        $result = mysqli_query($con, $sql);   //store result of query
        $row=mysqli_fetch_assoc($result);
        $num=mysqli_num_rows($result);        //return found rows

        if ($num==1)
            {
                $dpassword=$row['password'];

                //make hash of password
                $password2=password_hash($password,PASSWORD_DEFAULT);

                //Matching Hash Password
                $hash_match=password_verify($password,$dpassword);

                if ($num==1 && $hash_match==true)
                    {
                        $_SESSION["user"]=$user_name;
                        $_SESSION["pass"]=$password2;
                        $_SESSION['status2'] = "Logged in successfully!";
                        header("Location: set_pin.php");
                        exit(); // Ensure the script stops executing after the redirect
                    }
                else
                    {
                        $showerror=true;
                    }
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
    <link rel="stylesheet" href="style.css">
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
                                        <?php
                                            if (isset($_SESSION['status1'])) {
                                                echo "<div class='alert alert-success' role='alert'>" . 
                                                        ($_SESSION['status1']) . 
                                                    "</div>";
                                                unset($_SESSION['status1']); // Remove the status message after displaying it
                                            }
                                        ?>
                                    </div>

                                    <form action="log_in.php" method="post">
                                        <p>Please login to your account</p>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <input type="email" id="form2Example11" class="form-control"
                                               name="user_name" required />
                                            <label class="form-label" for="form2Example11" >Email Id</label>
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
                                                <input type="submit" value="Log in" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                                            <a class="text-muted" href="forget_password.php">Forgot password?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            
                                            <a href="sign_up.php" class="btn btn-outline-danger">Create new</a>

                                            </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">We are more than just a trust</h4>
                                    <p class="small mb-0">Helping You Make Smart Financial Choices.We Make Banking Easy
                                    </p>
                   
                                </div>
                            </div>
                            <a href="admin\admin_login.php" class="btn btn-outline-primary">Admin Login</a>

                        </div>
                        
                    </div>
                </div>

            </div>
        </div>
           
                                      
    </section>


    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js">
    </script>
</body>

</html>