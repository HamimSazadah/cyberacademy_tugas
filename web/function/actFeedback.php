<?php
include "../conn.php";

function BlockSQLInjection($str)

{
return str_replace(array("&","<",">","/","\\",'"',"'","?","+",";","*","-","#"),'',$str);
}

@session_start();

$id_user = @$_SESSION['id'];
$feedback = @$_POST['feedback'];

//prevent SQL Injection
$id_user = BlockSQLInjection($id_user);
$feedback = BlockSQLInjection($feedback);

if (!is_numeric($id_user)) {
echo "Sorry, id_user only positive integers allowed here!";
exit;
}

//prevent html tag injection (XSS)
$feedback = htmlspecialchars($feedback);

//chapcha
if(isset($_POST["captcha"])&&$_POST["captcha"]!=""&&$_SESSION["code"]==$_POST["captcha"])
{
echo "Captcha Okay!";
//Place other codes here to execute when captcha is passed
}
else
{
die("Wrong Captcha Code!");
}

// insert table feedback
$sql = "INSERT INTO feedbacks (id_user, feedback) VALUES ('$id_user', '$feedback')";

if ($conn->query($sql) === TRUE) {

header('Location: ' . $host . 'feedback.php?status=success');
} else {
echo ("Error description: " . mysqli_error($conn));
}