<?php
include "header.php";

?>

<div class="profile-body">
    <form action="<?php echo $host;?>function/actFeedback.php" method="post">
        <div class="profile-card">
            <h4>Feedback</h4>
            <hr class="profile-line"/>
            <div class="form-row mx-auto pb-4">
                <div class="form-group" style="width: 100%">
                    <textarea name="feedback"> </textarea>
                </div>
                <div class="form-group" style="width: 100%">
                        <p class="booking-font-field-title">Enter Captcha Image:</p>
                        <p class="booking-font-field">
                            <input name="captcha" type="text">
                            <img src="function/actCaptcha.php" />
                        </p>
                </div>
               
            </div>
            <hr class="profile-line"/>
            <div class="row mt-4">
                <div class="col-md-12 content-right">
                    <button class="btn btn-karcis-primary p-0 m-0" style="width: 180px; height: 50px;" type="submit">KIRIM</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include "footer.php";
?>
