<?php
include "header.php";
?>

<div class="profile-body">
    <form action="<?php echo $host;?>function/actChangePassword.php" method="post">
        <div class="profile-card">
            <div id="notif">
                <?php if (@$_GET['status'] == 'success') { ?>
                    <b style="display: block;position: relative;text-align:center; color: rgb(0,200,0)">Sukses ganti password</b>
                <?php } else if (@$_GET['status'] == 'failed-current') { ?>
                    <b style="display: block;position: relative;text-align:center; color: rgb(200,0,0)">Password saat ini tidak sesuai</b>
                <?php } else if (@$_GET['status'] == 'failed-confirm') { ?>
                    <b style="display: block;position: relative;text-align:center; color: rgb(200,0,0)">Password konfirmasi tidak sesuai</b>
                <?php } else if (@$_GET['status'] == 'failed-id') { ?>
                    <b style="display: block;position: relative;text-align:center; color: rgb(200,0,0)">User tidak ditemukan</b>
                <?php } ?>
            </div>

            <h4>Ganti Password</h4>
            <hr class="profile-line"/>
            <div class="form-row mx-auto pb-4">
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Password Sekarang</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="password" autocomplete="off" name="current_password">
                </div>
            </div>
            <div class="form-row mx-auto pb-4"1>
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Password Baru</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="password" autocomplete="off" name="password" id="password">
                </div>
            </div>
            <div class="form-row mx-auto pb-4">
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Konfirmasi Password Baru</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="password" autocomplete="off" name="confirm_password" id="confirm_password">
                </div>
            </div>
            <hr class="profile-line"/>
            <div class="row mt-4">
                <div class="col-md-12 content-right">
                    <button class="btn btn-karcis-primary p-0 m-0" style="width: 180px; height: 50px;" type="submit">SIMPAN</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="assets/js/jquery.min.js"></script>
<script>
    $('#password').change(() => {
        pass = $('#password').val()
        if (/[a-z]/.test(pass) && /.{12,128}/.test(pass) && /[A-Z]/.test(pass) && /[!@#$~%^&*:,+_]/.test(pass) && /[0-9]/.test(pass)) {
            $('#notif').html('')
        } else {
            $('#notif').html('<b style="display: block;position: relative;text-align:center; color: rgb(200,0,0)">Password harus mengandung Huruf Besar, Huruf kecil, Spesial Char, Angka dan minimal 12 char</b>');
        }
    })

    $('#confirm_password').change(() => {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#notif').html('')
        } else {
            $('#notif').html('<b style="display: block;position: relative;text-align:center; color: rgb(200,0,0)">Konfirmasi password tidak sesuai</b>');
        }
    })
</script>

<?php
include "footer.php";
?>