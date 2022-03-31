<?php
include "../conn.php";

@session_start();

$id_user = @$_SESSION['id'];
$feedback = @$_POST['feedback'];


// insert table feedback
$sql = "INSERT INTO feedbacks (id_user, feedback) VALUES ('$id_user', '$feedback')";

if ($conn->query($sql) === TRUE) {

    header('Location: ' . $host . 'feedback.php?status=success');
} else {
    echo ("Error description: " . mysqli_error($conn));
}
