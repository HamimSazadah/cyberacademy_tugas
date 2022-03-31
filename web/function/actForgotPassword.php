<?php
    include "../conn.php";

    $email = @$_POST['email'];
    $hash = sha1($email);
    $link = $host."resetPassword.php?hash=".$hash;


    $sql = "INSERT INTO forgot_password (email, hash, link)
    VALUES ('$email', '$hash', '$link')";

    if ($conn->query($sql) === TRUE) {
        header('location:'.$host.'confirmation.php?hash='.$hash);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>