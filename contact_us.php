<?php
session_start();

if (isset($_SESSION['user']) && isset($_SESSION['pass']))
 {
  if(isset($_POST['submit']))
  {
echo "<br><br><div class='alert alert-success' role='alert'>Thanks For Contact Us..We'll contact you soon.</div>";
  }
}
else
{
  header("location: index.php");
}
?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>contact us</title>
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="home.css">
<link rel="stylesheet" href="contact_us.css"></link>

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
            <a class="nav-link" href="history.php">History</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="about_us.php">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item">
                    <a class="nav-link" href="profile.php">My Profile</a>
                </li>
        </ul>
      </div>
    </div>
  </nav>  
  <div class="container">
    <form id="contactus" action="contact_us.php" method="post">
        <h3>Contact us for any queries</h3>
        <fieldset> <input placeholder="name" type="text" tabindex="1"  name="name1" required autofocus> </fieldset>
        <fieldset> <input placeholder="Email Address" type="email" tabindex="2" required> </fieldset>
        <fieldset> <input placeholder="Phone Number" type="tel" tabindex="3" required> </fieldset>
        <fieldset> <textarea placeholder="Type your message here..." tabindex="5" required></textarea> </fieldset>
        <fieldset> <button name="submit" type="submit" id="contactus-submit" data-submit="...Sending"><i id="icon" class=""></i> Send Now</button> </fieldset>
    </form>
</div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>