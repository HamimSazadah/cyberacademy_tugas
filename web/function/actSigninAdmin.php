<?php
    include "../conn.php";

    $email = @$_POST['email'];
    $password = sha1(@$_POST['password']);

    $sql = "SELECT * FROM admin where email = '$email' and password = '$password'";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            session_start();
            @$_SESSION["id"] = $row['id'];
            @$_SESSION["fullname"] = $row['fullname'];
            @$_SESSION['tipe'] = 'admin';
       
            header('Location: '.$host.'admin.php');
        }
    } else {
        header('Location: '.$host.'adminxyz.php?status=failed' );
    }
    $conn->close();


?>