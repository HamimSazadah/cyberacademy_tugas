<?php
include "header.php";

$id_booking = filter_var(@$_GET['IDBOOKING'],FILTER_SANITIZE_NUMBER_INT);
$id_ticket = filter_var(@$_GET['IDTICKET'],FILTER_SANITIZE_NUMBER_INT);

@session_start();
    
$id = @$_SESSION['id'];

if(!$id){
    header('location:'.$host.'signin.php');
}

function get($conn,int $id_booking, int $id_tiket)
{
    $user = "SELECT tickets.*, booking.id as id_booking, booking.price as booking_price FROM booking LEFT JOIN tickets ON tickets.id = booking.id_ticket WHERE booking.id = ? AND tickets.id = ?";
    $stmt = $conn->prepare($user);
    $stmt->bind_param('ii',$id_booking,$id_tiket);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
    return $booking;
}

// get data user
$booking = get($conn,$id_booking,$id_ticket);
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
                        <span class="font-field"><?php echo htmlspecialchars($booking['id_booking'],ENT_QUOTES);?></span>
                    </div>
                    <div class="row pb-2 pt-3">
                        <span class="font-field-title">Destinasi</span>
                    </div>
                    <div class="row pb-2">
                        <span class="font-field"><?php echo htmlspecialchars($booking['from'],ENT_QUOTES)." - ".htmlspecialchars($booking['to'],ENT_QUOTES);?></span>
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