<?php

use Predis\Client;

include "../conn.php";
include "FloodDetection.php";
include "security.php";

@session_start();

$flood = new FloodDetection();
$flood->check();

$fullname = sanitize(@$_POST['fullname']);
$email = filter_var(@$_POST['email'], FILTER_SANITIZE_EMAIL);

$id = @$_SESSION['id'];
$phone = 0;

if (@$_POST['phone'] != '' || @$_POST['phone'] != null) {
    $phone = filter_var(@$_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
}

$allowed_types = ['image/png', 'image/jpg', 'image/jpeg'];
// mitra
$fileName = $_FILES['userfile']['name'];
$fileType = $_FILES['userfile']['type'];

if (!empty($_POST) && $_SESSION['csrf'] != $_POST['csrf']) {
    $_SESSION['csrf'] =  bin2hex(random_bytes(35));
    echo 'gagal 1';
    exit;
}


// nama direktori upload
$namaDir = '../files/';

// membuat path nama direktori + nama file.
// $pathFile = $namaDir.$fileName;
$newfilename = getOldIdentity($conn);
if ($fileName) {
    if (!in_array($fileType, $allowed_types)) {
        $_SESSION['csrf'] =  bin2hex(random_bytes(35));
        echo "File gagal diupload.";
        exit;
    }
    $oldIdentity = $namaDir . $newfilename;
    unlink($oldIdentity);
    // memindahkan file ke temporary
    $tmpName  = $_FILES['userfile']['tmp_name'];

    $temp = explode(".", $fileName);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $pathFile = $namaDir . $newfilename;

    if (!in_array(mime_content_type($_FILES['userfile']['tmp_name']), $allowed_types)) {
        echo 'gagal 2 ' . mime_content_type($_FILES['userfile']['tmp_name']);
        exit;
    }
    //proses upload file dari temporary ke path file
    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $pathFile)) {
        $_SESSION['csrf'] =  bin2hex(random_bytes(35));
        var_dump($_FILES['userfile']['error']);
        echo "File gagal diupload.";
        exit;
    }
}

updateUser($conn, $email);
updateProfile($conn, $fullname, $phone, $newfilename);
$conn->close();
$_SESSION['csrf'] =  bin2hex(random_bytes(35));
header('Location: ' . $host . 'profile.php?status=success');


function updateUser($conn, string $email)
{
    $user = "UPDATE users SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($user);
    $userid = @$_SESSION['id'];
    $stmt->bind_param('si', $email, $userid);
    execute($stmt);
}

function updateProfile($conn, string $fullname, string $phone, string $identity)
{
    $user = "UPDATE user_profile SET fullname = ?, phone = ?, identity_card =? WHERE id_user = ?";
    $stmt = $conn->prepare($user);
    $userid = @$_SESSION['id'];
    $stmt->bind_param('sisi', $fullname, $phone, $identity, $userid);
    execute($stmt);
}

function getOldIdentity($conn)
{
    $id = @$_SESSION['id'];
    $stmt = $conn->prepare("SELECT identity_card FROM user_profile WHERE id_user=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    if ($row['identity_card'] != null) {
        return $row['identity_card'];
    }
    return '';
}

function execute($stmt)
{
    $status = $stmt->execute();
    $stmt->close();
    return $status;
}
