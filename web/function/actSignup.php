<?php
session_start();
include "../conn.php";
include "security.php";
if (!empty($_POST) && $_SESSION['csrf'] == $_POST['csrf']) { 
    $fullname = sanitize(@$_POST['fullname']);
    $email    = sanitize(@$_POST['email']);
    $password  = sha1(sanitize(@$_POST['password']) . $email . getenv('SALT'));

    if (isset($_POST['g-recaptcha-response'])) {
        $captcha=$_POST['g-recaptcha-response'];
    }
    if (!$captcha) {
        header('Location: '.$host.'signup.php?status=failed-captcha' );
        exit;
    }
    $secretKey = getenv('RECAPTCHA_SECRET_KEY');
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    if(!$responseKeys["success"]) {
        header('Location: '.$host.'signin.php?status=failed-captcha' );
        exit;
    }

    // insert to database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        $sql_profile = "INSERT INTO user_profile (id_user,fullname) VALUES ('$conn->insert_id','$fullname')";
        if ($conn->query($sql_profile) === TRUE) {

            header('location:' . $host . 'signin.php?status=success');
        } else {;
            echo ("Error description: " . mysqli_error($conn));
        }
    }
}else{
    header('location:' . $host . 'signup.php?status=csrf');
}
$_SESSION['csrf'] =  bin2hex(random_bytes(35));