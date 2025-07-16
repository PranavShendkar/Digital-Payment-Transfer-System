<?php

session_start();

// Include database connection file
include("../db.php");

if (isset($_SESSION['auser']) && isset($_SESSION['apass'])) {
    // Access session variables
    $uname = $_SESSION['auser'];
    $up = $_SESSION['apass'];

    // Customers list
    $query = "SELECT * FROM user";
    $result = mysqli_query($con, $query);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sr = $_POST['sr'];

        $query = "SELECT * FROM user WHERE 
                  name LIKE '%$sr%' OR 
                  phno LIKE '%$sr%' OR
                  email LIKE '%$sr%' OR 
                  acno LIKE '%$sr%'";

        $result = mysqli_query($con, $query);

        $num = mysqli_num_rows($result);

        echo "<h2><center> Customer Search Results</center></h2>";
        if ($num > 0) {
            echo "<p>$num Matching Records Found</p>
            <a href='dashboard.php'>Go to Dashboard</a>";
        } else {
            echo "<p>No records found.</p>
            <a href='dashboard.php'>Go to Dashboard</a>";

        }
    }
} else {
    header("location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="sign_up.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <h2><center>Customer Details</center></h2>
    <form method="post" action="dashboard.php">
        <div class="search">
            <input type="text" class="search-input" placeholder="Search Acno, Email, Phno" name="sr">
            <button type="submit" class="search-icon"><i class="fa fa-search"></i></button>
        </div>
    </form>

    <table class="table" border="5">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Customer No.</th>
                <th>Customer Email</th>
                <th>Customer A/C No.</th>
                <th>Cust. Balance (Rs.)</th>
                <th>Edit</th>
                <th>Block/Unblock</th>
                <th>Delete</th>
                <th>Statement</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td align="center"><?= htmlspecialchars($row['name']) ?></td>
                        <td align="center"><?= htmlspecialchars($row['phno']) ?></td>
                        <td align="center"><?= htmlspecialchars($row['email']) ?></td>
                        <td align="center"><?= htmlspecialchars($row['acno']) ?></td>
                        <td align="center"><?= htmlspecialchars($row['balance']) ?> Rs.</td>
                        <td align="center"><a href="edit.php?id=<?= $row['sno'] ?>" onclick="return confirm('Are You Sure?')">Edit</a></td>
                        <td align="center" align="center">
                            <?php if ($row['block'] == 'ub') { ?>
                                <a href="block.php?id=<?= $row['sno'] ?>" onclick="return confirm('Are You Sure?')">Block</a>
                            <?php } else { ?>
                                <a href="ublock.php?id=<?= $row['sno'] ?>" onclick="return confirm('Are You Sure?')">Unblock</a>
                            <?php } ?>
                        </td>
                        <td align="center"><a href="delete.php?id=<?= $row['sno'] ?>" onclick="return confirm('Are You Sure?')">Delete</a></td>
                        <td align="center"><a href="statement.php?id=<?= $row['sno'] ?>" onclick="return confirm('Are You Sure? Download the statement')">Download</a></td>
                    </tr>
                    <?php
                }
            } ?>
        </tbody>
    </table>

    <form class="form-inline" action="alog_out.php" method="post">
        <input type="submit" class="btn btn-success" value="Log Out">
    </form>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js"></script>
</body>

</html>
