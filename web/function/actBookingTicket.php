<?php
    include "../conn.php";

    @session_start();

    $id_user = @$_SESSION['id'];

    $submit = @$_POST['submit'];
    $identity = (int)$submit[0];

    $id_ticket = @$_POST['id_ticket'][$identity];
    $seats = @$_POST['seats'][$identity];
    $price = (int)@$_POST['price'][$identity];

    $percent = 10;

    $percentInDecimal = $percent / 100;

    //Get the result.
    $percent = $percentInDecimal * $price;
    
    $total_price = $price + $percent;


    // jika kursi 0
    if($seats < 1){
        header('Location: '.$host.'tickets.php?status=seatsFailed' );
        exit;
    }
    

    // insert table booking
    $sql = "INSERT INTO booking (id_user, id_ticket, status, price) VALUES ('$id_user', '$id_ticket', 0,'$total_price')";

    if ($conn->query($sql) === TRUE) {
        // update seats in table tickets
        $sql_update = "UPDATE tickets SET seats = seats - 1 WHERE id = $id_ticket";
            if($conn->query($sql_update) === FALSE){
                echo("Error description: " . mysqli_error($conn));
                exit;
            } else {

                header('Location: '.$host.'myBookings.php?status=success');
            }
    } else {
        echo("Error description: " . mysqli_error($conn));
    }
?>