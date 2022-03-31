<?php
@session_start();

$id = @$_SESSION['id'];

if (!$id) {
    header('location:' . $host . 'signin.php');
}

// get data user
$feedback = "SELECT user_profile.fullname as name, feedbacks.feedback as feedback FROM feedbacks 
            LEFT JOIN user_profile ON user_profile.id_user = feedbacks.id_user ORDER BY feedbacks.created_at DESC ";



$result = $conn->query($feedback);

?>