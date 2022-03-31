<?php

    include "../conn.php";

    $email = @$_POST['email'];
    $password = sha1(@$_POST['password']);

    if (isset($_POST['g-recaptcha-response'])) {
        $captcha=$_POST['g-recaptcha-response'];
    }
    if (!$captcha) {
        header('Location: '.$host.'signin.php?status=failed-captcha' );
        exit;
    }
    $secretKey = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    if(!$responseKeys["success"]) {
        header('Location: '.$host.'signin.php?status=failed-captcha' );
        exit;
    }

    $sql = "SELECT * FROM users where email = '$email' and password = '$password'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            session_start();
            @$_SESSION["id"] = $row['id'];
            @$_SESSION["fullname"] = $row['fullname'];
            @$_SESSION['tipe'] = 'users';

            header('Location: '.$host.'profile.php');
        }
    } else {
        header('Location: '.$host.'signin.php?status=failed' );
    }
    $conn->close();


?>