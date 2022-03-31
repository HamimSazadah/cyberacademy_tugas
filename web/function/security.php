<?php
include '../conn.php';
function sanitize($str){
    $str =  $conn->real_escape_string(htmlspecialchars($str,ENT_QUOTES));
}


// function strngPassword($str){
//     if(preg_match('/[0-9]/', $str) && preg_match('/[A-Z]/', $str) && preg_match('/[a-z]/', $str) && preg_match('/[@#$%^&*-+~]/', $str) && strlen($str)>=12 && strlen($str)<=128){

//     }else{

//     }
// }
?>