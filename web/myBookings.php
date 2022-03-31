<?php
include "header.php";
include "function/getMyTickets.php";
?>

<div class="booking-body">

    <?php if(@$_GET['status'] == 'success') { ?>
        <div class="profile-card" style="padding: 1rem 2rem; margin: 0 auto 1rem;">
            <b class="font-notify">Booked Success</b>
        </div>
    <?php } ?>

    <div class="booking-card pb-1">
        <h4 class="mb-4">My Bookings</h4>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
            <div class="row pl-0 pr-0 pt-3 pb-3 ml-1 mr-1 booking-line">
                <div class="col-md-1 p-0 m-0">
                    <img class="booking-img-ticket-item" src="assets/img/ticket-item.png" alt=""/>
                </div>
                <div class="col-md-2">
                    <p class="booking-font-field-title">ID Booking</p>
                    <p class="booking-font-field"><?php echo htmlspecialchars($row['id_booking'],ENT_QUOTES);?></p>
                </div>
                <div class="col-md-6">
                    <p class="booking-font-field-title">Destination</p>
                    <p class="booking-font-field"><?php echo htmlspecialchars($row['from'],ENT_QUOTES);?> - <?php echo htmlspecialchars($row['to'],ENT_QUOTES);?></p>
                </div>
                <div class="col-md-3 p-0 m-0 text-right">
                    <a href="<?php echo $host;?>myBookingDetail.php?IDBOOKING=<?php echo htmlspecialchars($row['id_booking'],ENT_QUOTES);?>&IDTICKET=<?php echo htmlspecialchars($row['id'],ENT_QUOTES);?>">
                        <button class="btn btn-booking-primary p-0 m-0" type="submit">Detail</button>
                    </a>
                </div>
            </div>
        <?php } } ?>

    </div>

</div>

<?php
include "footer.php";
?>