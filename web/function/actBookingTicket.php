<?php
    include "../conn.php";
    include "FloodDetection.php";
    include "security.php";
    @session_start();

    $flood = new FloodDetection();
    $flood->check();

    $id_user = @$_SESSION['id'];

    if (!empty($_POST) && $_SESSION['csrf'] != $_POST['csrf']) { 
        $_SESSION['csrf'] =  bin2hex(random_bytes(35));
        echo 'gagal';
        exit;
    }

    $submit = @$_POST['submit'];
    $identity = (int)$submit[0];

    $id_ticket = sanitize(filter_var(@$_POST['id_ticket'][$identity],FILTER_SANITIZE_NUMBER_INT));
   

    $percent = 10;

    $percentInDecimal = $percent / 100;

    $cek = check($conn,$id_ticket);
    if ( $cek == null){
        header('Location: '.$host.'tickets.php?status=seatsFailed' );
        exit;
    }

    if ($cek["seats"] <= 0){
        header('Location: '.$host.'tickets.php?status=seatsFailed' );
        exit;
    }

    $seats = $cek['seats'];
    $price = $cek['price'];
    //Get the result.
    $percent = $percentInDecimal * $price;
    
    $total_price = $price + $percent;


    // jika kursi 0
    if($seats < 1){
        header('Location: '.$host.'tickets.php?status=seatsFailed' );
        exit;
    }
    

    // insert table booking
    // $sql = "INSERT INTO booking (id_user, id_ticket, status, price) VALUES ('$id_user', '$id_ticket', 0,'$total_price')";
    $insertedBooking = insertBooking($conn,$id_user,$id_ticket,0,$total_price);
    if($insertedBooking){
        $updated_ticket = updateTicket($conn,$cek['id']);
        if ($updated_ticket){
            header('Location: '.$host.'myBookings.php?status=success');
        }else{
            echo("Gagal update tiket");
            exit;
        }

    }else{
        echo("Gagal booking");
    }
    // if ($conn->query($sql) === TRUE) {
    //     // update seats in table tickets
    //     $sql_update = "UPDATE tickets SET seats = seats - 1 WHERE id = $id_ticket";
    //         if($conn->query($sql_update) === FALSE){
    //             echo("Error description: " . mysqli_error($conn));
    //             exit;
    //         } else {

    //             header('Location: '.$host.'myBookings.php?status=success');
    //         }
    // } else {
    //     echo("Error description: " . mysqli_error($conn));
    // }


    function check($conn,int $id)
    {
        $stmt = $conn->prepare("SELECT * FROM tickets WHERE id=?");
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        $row = $result->fetch_assoc();
        return $row;
    }

    function insertBooking($conn,int $id_user, int $id_ticket, int $status,int $total_price )
    {
        $sql = "INSERT INTO booking (id_user, id_ticket, status, price) VALUES (?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iiii',$id_user,$id_ticket,$status,$total_price);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }

    function updateTicket($conn,int $id)
    {
        $sql_update = "UPDATE tickets SET seats = seats - 1 WHERE id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param('i',$id);
        $status = $stmt->execute();
        $stmt->close();
        return $status;
    }
?>