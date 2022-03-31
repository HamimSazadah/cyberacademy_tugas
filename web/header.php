<?php 
session_start();
include "conn.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Beli Karcis Kekinian </title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Animation-Cards-1.css">
    <link rel="stylesheet" href="assets/css/Animation-Cards.css">
    <link rel="stylesheet" href="assets/css/booking.css">
    <link rel="stylesheet" href="assets/css/Drag--Drop-Upload-Form.css">
    <link rel="stylesheet" href="assets/css/Footer-Basic.css">
    <link rel="stylesheet" href="assets/css/Highlight-Phone.css">
    <link rel="stylesheet" href="assets/css/Lista-Productos-Canito.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form-1.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/smoothproducts.css">
    <link rel="stylesheet" href="assets/css/untitled-1.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body style="font-family:-apple-system, BlinkMacSystemFont, sans-serif !important;">
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean-button">
            <div class="container" id="nav-menu"><a class="navbar-brand" href="<?php echo $host; ?>">Karcis</a>

                <?php
                
                $_SESSION['csrf'] = isset($_SESSION['csrf'])?$_SESSION['csrf']:bin2hex(random_bytes(35));
                $id = @$_SESSION['id'];
                if ($id) { ?>
                    <a class="login" style="float:left">
                        <form action="search.php" method="get">
                            <input type="text" name="IDBOOKING" value="" placeholder="Search ID Booking">
                            <button type="submit" role="button">Search
                    </a>

                    </form>
                    </a>
                <?php } ?>

                <button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto" style="color: #8e216f;"></ul>
                    <span class="navbar-text actions">
                        <?php
                        if ($id) { ?>
                            <a class="login" href="feedback.php">Feedback</a>
                            <a class="login" href="tickets.php">Tickets</a>
                            <a class="login" href="myBookings.php">My Bookings</a>
                            <a class="login" href="myRewards.php">My Rewards</a>
                            <a class="login" href="profile.php">Profile</a>
                            <a class="login" href="changePassword.php">Ganti Password</a>
                            <a class="login" href="<?php echo $host; ?>function/logout.php">Logout</a>
                        <?php } else { ?>
                            <a class="login" href="signin.php">Log In</a>
                            <a class="btn btn-light action-button" role="button" href="signup.php">Sign Up</a>
                        <?php } ?>
                    </span>
                </div>
            </div>
        </nav>
    </div>