<?php
include "../conn.php";

@session_start();

$id = @$_SESSION['id'];
$fullname = htmlspecialchars(@$_POST['fullname'],ENT_QUOTES);
$email = filter_var(@$_POST['email'],FILTER_SANITIZE_EMAIL);
$phone = 0;

if(@$_POST['phone'] != '' || @$_POST['phone'] != null){
    $phone = filter_var(@$_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
}

$allowed_types = ['image/png','image/jpg','image/jpeg'];
// mitra
$fileName = $_FILES['userfile']['name'];
$fileType = $_FILES['userfile']['type'];



 // nama direktori upload
$namaDir = '../files/';

// membuat path nama direktori + nama file.
// $pathFile = $namaDir.$fileName;
$newfilename=getOldIdentity($conn);
if ($fileName) {
    if (!in_array($fileType,$allowed_types)){
        echo "File gagal diupload.";
        exit();
    }
    $oldIdentity = $namaDir.$newfilename;
    unlink($oldIdentity);
    // memindahkan file ke temporary
    $tmpName  = $_FILES['userfile']['tmp_name'];

    $temp = explode(".", $fileName);
    $newfilename = round(microtime(true)) . '.' . end($temp);
    $pathFile = $namaDir.$newfilename;

    // proses upload file dari temporary ke path file
    if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $pathFile)) {
        var_dump($_FILES['userfile']['error']);
        echo "File gagal diupload.";
    }
}

updateUser($conn,$email);
updateProfile($conn,$fullname,$phone,$newfilename);
$conn->close();

header('Location: '.$host.'profile.php?status=success');


function updateUser($conn,string $email)
{
    $user = "UPDATE users SET email = ? WHERE id = ?";
    $stmt = $conn->prepare($user);
    $userid = @$_SESSION['id'];
    $stmt->bind_param('si',$email,$userid);
    execute($stmt);
}

function updateProfile($conn,string $fullname,string $phone,string $identity)
{
    $user = "UPDATE user_profile SET fullname = ?, phone = ?, identity_card =? WHERE id_user = ?";
    $stmt = $conn->prepare($user);
    $userid = @$_SESSION['id'];
    $stmt->bind_param('sisi',$fullname,$phone,$identity,$userid);
    execute($stmt);
}

function getOldIdentity($conn)
{
    $id = @$_SESSION['id'];
    $stmt = $conn->prepare("SELECT identity_card FROM user_profile WHERE id_user=?");
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $row = $result->fetch_assoc();
    if ($row['identity_card'] != null){
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