<?php
include "../conn.php";
include "security.php";

@session_start();

$id = @$_SESSION['id'];

if(!$id){
    header('location:'.$host.'signin.php');
}

$sql = "SELECT * FROM users where id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $email = $row['email'];
        $currentPasswordDb = $row['password'];
    }
} else {
    header('Location: '.$host.'changePassword.php?status=failed-id');
    exit;
}

$currentPassword = sha1(sanitize($_POST['current_password']).$email.getenv('SALT'));
if ($currentPassword != $currentPasswordDb) {
    header('Location: '.$host.'changePassword.php?status=failed-current');
    exit;
}

$password = sha1(sanitize($_POST['password']).$email.getenv('SALT'));
$confirmPassword = sha1(sanitize($_POST['confirm_password']).$email.getenv('SALT'));
if ($password != $confirmPassword) {
    header('Location: '.$host.'changePassword.php?status=failed-confirm');
    exit;
}

// update data
$user = "UPDATE users SET password = '$password' WHERE id = $id";
$conn->query($user);


if($conn->query($user) === FALSE){
    echo("Error description: " . mysqli_error($conn));
}

header('Location: '.$host.'changePassword.php?status=success');


