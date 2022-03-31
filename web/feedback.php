<?php
include "header.php";
include "function/getFeedback.php";
?>

<div class="booking-body">

    <?php if (@$_GET['status'] == 'success') { ?>
        <div class="profile-card" style="padding: 1rem 2rem; margin: 0 auto 1rem;">
            <b class="font-notify">Send Feedback Success</b>
        </div>
    <?php } ?>

    <div class="booking-card pb-1">
        <h4 class="mb-4">Feedbacks</h4>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
        ?>
                <div class="row pl-0 pr-0 pt-3 pb-3 ml-1 mr-1 booking-line">

                    <div class="col-md-6">
                        <p class="booking-font-field-title">Name</p>
                        <p class="booking-font-field"><?php echo $row['name']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="booking-font-field-title">Feedback</p>
                        <p class="booking-font-field"><?php echo $row['feedback']; ?></p>
                    </div>
                    
                </div>
        <?php } ?>
        
        <?php } ?>

        <div class="row mt-4">
                        <div class="col-md-12 content-right">
                            <a href="<?php echo $host; ?>sendFeedback.php">
                                <button class="btn btn-karcis-primary p-0 m-0" style="width: 180px; height: 50px;" type="submit">KIRIM FEEDBACK</button>
                            </a>
                        </div>
                    </div>
    </div>

</div>

<?php
include "footer.php";
?>