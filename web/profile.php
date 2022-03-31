<?php
    include "header.php";
    include "function/getProfile.php";

    ?>

<!-- cek tipe session -->
<!-- jika session == admin, redirect ke halaman admin <?php echo $host;?>adminxyz.php -->

<?php
if($_SESSION['tipe'] == 'admin'){
    unset($_SESSION["id"]);
    header('Location: '.$host.'adminxyz.php');
    exit;
}
?>

<div class="profile-body">

    <?php if(@$_GET['status'] == 'success') { ?>
        <div class="profile-card" style="padding: 1rem 2rem; margin: 0 auto 1rem;">
            <b class="font-notify">Profile Updated</b>
        </div>
    <?php } ?>

    <div class="profile-card">
        <h4>Profile</h4>
        <hr class="profile-line"/>
        <div class="row mx-auto pb-4">
            <div class="col-md-6">
                <div class="row pb-2 pt-3">
                    <span class="font-field-title">Nama Lengkap</span>
                </div>
                <div class="row pb-2">
                    <span class="font-field"><?php echo $user_profile['fullname'];?></span>
                </div>
                <div class="row pb-2 pt-3">
                    <span class="font-field-title">Email</span>
                </div>
                <div class="row pb-2">
                    <span class="font-field"><?php echo $user_profile['email'];?></span>
                </div>
                <div class="row pb-2 pt-3">
                    <span class="font-field-title">Nomor Handphone</span>
                </div>
                <div class="row pb-2">
                    <span class="font-field"><?php echo $user_profile['phone'];?></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row pb-2 pt-3">
                    <span class="font-field-title">Identitas (KTP/SIM/PASSPORT)</span>
                </div>
                <div class="center pb-4 pt-4">
                    <?php if($user_profile['identity_card']){
                        echo "<img src =".$host."files/".$user_profile['identity_card']." style='width: 180px'>";
                    } ?>
                </div>
            </div>
        </div>
        <hr class="profile-line"/>
        <div class="row mt-4">
            <div class="col-md-12 content-right">
                <a href="<?php echo $host;?>editProfile.php">
                    <button class="btn btn-karcis-primary p-0 m-0" style="width: 180px; height: 50px;" type="submit">EDIT</button>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>