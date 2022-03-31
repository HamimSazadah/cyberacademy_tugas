<?php
function sanitize($str){
    include '../conn.php';
    return  mysqli_real_escape_string($conn,htmlspecialchars($str,ENT_QUOTES));
}
?>