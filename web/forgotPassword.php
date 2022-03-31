<?php
include "header.php";
?>

<div class="login-clean">
        <form method="post" action="<?php echo $host;?>function/actForgotPassword.php">
             <!-- if signup failed -->
             <?php
                if(@$_GET['status'] == 'failed'){
            ?>
                <b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">Failed</b>
            <?php } else if(@$_GET['status'] == 'success'){ ?>
                <b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">Check Your Email</b>
            <?php } ?>
            <!--  -->

            <h2 class="sr-only">Forgot Password</h2>
            <div class="illustration"><i class="fa fa-ticket"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Reset Password</button></div><a class="forgot" href="signin.php">Already Have an Account?</a></form>
</div>

<?php
include "footer.php";
?>