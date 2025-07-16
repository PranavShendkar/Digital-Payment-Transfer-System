<?php
session_start();

if (isset($_SESSION['user']) && isset($_SESSION['pass'])) 
{
//access session variables
$uname=$_SESSION['user'];
$up=$_SESSION['pass'];
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
    <title>Home</title>
    <!-- Include Bootstrap CSS and Font Awesome for icons -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>

        .overlay-list {
            top: 0; /* Align at the top */
            left: 0;
            width: 50%; /* Span the entire width */
        }
        .bg-transparent-custom {
            background-color: transparent; /* Ensure background is transparent */
        }
        .txt {
            margin-bottom: 50px; /* Adjust margin as needed */
        }

   
    </style>
  </head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Navbar brand -->
            <a class="navbar-brand" href="home.php">
                <img src="bank.png" height="30" alt="Logo" loading="lazy" />
            </a>
            <!-- Left links -->
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link tab" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" href="customer.php">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" href="transfer.php">Transfer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" href="history.php">History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" href="about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" href="contact_us.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link tab" href="profile.php">My Profile</a>
                </li>
            </ul>
            <!-- Right side logout button -->
            <form class="form-inline" action="log_out.php" method="post">
                <input type="submit" class="btn btn-primary" value="Log Out">
            </form>
        </div>
    </div>
</nav>

<!-- Main content -->
<div class="container-fluid p-0 mt-5">
    <div class="position-relative">
        <!-- Background Image -->
        <img src="bank.jpg" alt="image" height="100%" width="100%">
<ul class="list-group w-100 mx-auto position-absolute overlay-list bg-transperent bg-opacity-100 p-3 rounded">
<?php
    
    if (isset($_SESSION['status2'])) {
    echo "<div class='alert alert-success' role='alert'>" . 
    ($_SESSION['status2']) . 
    "</div>";
    unset($_SESSION['status2']); // Remove the status message after displaying it
    }
    ?>
<div class="p-3 mb-50 bg-transperent text-white txt"><h2>Kyestone Private Sector</h2></div>
                                    
            <li class="list-group-item d-flex align-items-center bg-transparent border-0 text-white">
                <span class="d-inline-flex align-items-center justify-content-center text-white rounded-circle me-2" style="background-color: #0082ca; width: 40px; height: 40px;">
                    <i class="fas fa-camera fa-lg"></i>
                </span>
                 10+ Branches
            </li>
            <li class="list-group-item d-flex align-items-center bg-transparent border-0 text-white">
                <span class="d-inline-flex align-items-center justify-content-center text-white rounded-circle me-2" style="background-color: #ff4500; width: 40px; height: 40px;">
                    <i class="fas fa-hashtag fa-lg"></i>
                </span>
               24 * 7 Service
            </li>
            <li class="list-group-item d-flex align-items-center bg-transparent border-0 text-white">
                <span class="d-inline-flex align-items-center justify-content-center text-white rounded-circle me-2" style="background-color: #00b386; width: 40px; height: 40px;">
                    <i class="fas fa-hiking fa-lg"></i>
                </span>
                10000+ Customers
            </li>
            <li class="list-group-item d-flex align-items-center bg-transparent border-0 text-white">
                <span class="d-inline-flex align-items-center justify-content-center text-white rounded-circle me-2" style="background-color: #00b386; width: 40px; height: 40px;">
                    <i class="fas fa-hiking fa-lg"></i>
                </span>
                24 Hours Atm Service
            </li>
        </ul>
    </div>
</div>




<script>
    // Attach event listeners to all tabs
    document.querySelectorAll('.tab').forEach(tab => {
      tab.addEventListener('click', function (e) {
        e.preventDefault(); // Prevent immediate navigation
        const url = this.getAttribute('href'); // Get the href value

        // Optional: Add a visual effect (e.g., fade-out)
        document.body.style.transition = "opacity 0.5s";
        document.body.style.opacity = "0";

        // Redirect after a delay
        setTimeout(() => {
          window.location.href = url;
        }, 1000); // 2000ms = 2 seconds
      });
    });
  </script>

 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
