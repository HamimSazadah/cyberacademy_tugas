<?php
include "conn.php";
include "header.php";
?>

<div class="profile-body">
    <form action="<?php echo $host;?>function/actNewPassword.php" method="post">
        <div class="profile-card">
            <h4>Ganti Password</h4>
            <hr class="profile-line"/>
            <div class="form-row mx-auto pb-4">
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Email</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="text" autocomplete="off" name="email">
                </div>
            
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Password Baru</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="password" autocomplete="off" name="password">
                </div>

                <input type="hidden" value="<?php echo $_GET['hash'];?>" name="token">
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

<?php
include "footer.php";
?>