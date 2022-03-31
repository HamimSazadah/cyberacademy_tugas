<?php
include "header.php";

$id_booking = @$_GET['IDBOOKING'];
$id_ticket = @$_GET['IDTICKET'];

@session_start();
    
$id = @$_SESSION['id'];

if(!$id){
    header('location:'.$host.'signin.php');
}

// get data user
$user = "SELECT tickets.*, booking.id as id_booking, booking.price as booking_price FROM booking LEFT JOIN tickets ON tickets.id = booking.id_ticket WHERE booking.id = $id_booking AND tickets.id = $id_ticket";

$result = $conn->query($user);
$booking = $result->fetch_assoc()
?>

    <div class="booking-body">
        <div class="booking-card pb-1">
            <h4 class="mb-4">Booking Detail</h4>
            <hr class="booking-line"/>
            <div class="row mx-auto pb-4">
                <div class="col-md-12">
                    <div class="row pb-2 pt-3">
                        <span class="font-field-title">ID Booking</span>
                    </div>
                    <div class="row pb-2">
                        <span class="font-field"><?php echo $booking['id_booking'];?></span>
                    </div>
                    <div class="row pb-2 pt-3">
                        <span class="font-field-title">Destinasi</span>
                    </div>
                    <div class="row pb-2">
                        <span class="font-field"><?php echo $booking['from']." - ".$booking['to'];?></span>
                    </div>
                    <div class="row pb-2 pt-3">
                        <span class="font-field-title">Harga (+PPn)</span>
                    </div>
                    <div class="row pb-2">
                        <span class="font-field">Rp<?php echo number_format($booking['booking_price'],2,',','.'); ?></span>
                    </div>
                    <div class="row pb-2 pt-3">
                        <span class="font-field-title">Tanggal Pemesanan</span>
                    </div>
                    <div class="row pb-2">
                        <span class="font-field"><?php echo $booking['created_at'];?></span>
                    </div>
                    <div class="row pb-2 pt-3">
                        <span class="font-field-title">Status</span>
                    </div>
                    <div class="row pb-2">
                        <span class="font-field" style="color: darkorange">Belum Dibayar</span>
                    </div>

                </div>
            </div>
        </div>

    </div>

<?php include "footer.php";?>