<?php
include "header.php";
?>
<script src='https://www.google.com/recaptcha/api.js' async defer></script>
<div class="login-clean">
    <form method="post" action="<?php echo $host; ?>function/actSignup.php">
        <h2 class="sr-only">Login Form</h2>
        <!-- if signup failed -->
        <?php
        switch (@$_GET['status']) {
            case 'failed':
                echo '<b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">Signup Failed</b>';
                break;
            case 'csrf':
                echo '<b style="display: block;position: relative;text-align:center; color: rgb(244,71,107)">Error CSRF</b>';
                break;
        }
        ?>

        <div class="illustration"><i class="fa fa-ticket"></i></div>
        <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
        <p style="color:brown" id='notif'></p>
        <div class="form-group"><input class="form-control" type="text" id='nama' name="fullname" placeholder="Nama Lengkap"></div>
        <div class="form-group"><input class="form-control" type="email" id='email' name="email" placeholder="Email"></div>
        <div class="form-group"><input class="form-control" type="password" name="password"  id='password'placeholder="Password"></div>
        <div class="form-group"><input class="form-control" type="password"  id='password2' placeholder="Confirm Password"></div>
        <div class="form-group"><input type="checkbox" onclick="showPassword($(this).prop('checked'))"> Lihat Password</div>
        <div class="form-group">
            <div class="g-recaptcha" data-sitekey="<?php echo getenv('RECAPTCHA_SITE_KEY') ?>"></div>
            <div class="form-group"><button id='submit' class="btn btn-primary btn-block" type="submit" disabled>Sign Up</button></div>
            <a class="forgot" href="#">Forgot your email or password?</a>
    </form>
</div>
<script src="assets/js/jquery.min.js"></script>
<script>
    $('#password').change(() => {
        pass = $('#password').val()
        if (/[a-z]/.test(pass) && /.{12,128}/.test(pass) && /[A-Z]/.test(pass) && /[!@#$~%^&*:,+_]/.test(pass) && /[0-9]/.test(pass)) {
            $('#notif').text('')
            console.log('ok!')
        } else {
            $('#notif').text('Password harus mengandung Huruf Besar, Huruf kecil, Spesial Char, Angka dan minimal 12 char');
        }
    })
    $('#password2').change(() => {
        pass = $('#password2').val()
        pass2 = $('#password').val()
        if(pass!=pass2){
            $('#notif').text('Password tidak sama');
            $('#submit').prop('disabled', true);
        }else{
            $('#notif').text('');
            $('#submit').prop('disabled', false);
        }
    })
    function showPassword($x) {
        if ($x)
            $('input[type=password]').attr("type", "text");
        else
            $('input[type=text]').attr("type", "password");
    }
</script>
<?php
include "footer.php";
?>