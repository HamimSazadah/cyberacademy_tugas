<?php
include "header.php";
include "function/getProfile.php";
?>

<div class="profile-body">
    <form action="<?php echo $host; ?>function/actUpdateProfile.php" method="post" enctype="multipart/form-data">
        <div class="profile-card">
            <h4>Edit Profile</h4>
            <hr class="profile-line" />
            <div class="form-row mx-auto pb-4">
                <input type="hidden" name="id_user" value="<?php echo $user_profile['id_user']; ?>">
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Nama Lengkap</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="text" autocomplete="off" name="fullname" value="<?php echo htmlspecialchars($user_profile['fullname'],ENT_QUOTES); ?>">
                </div>
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Email</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="email" autocomplete="off" name="email" value="<?php echo htmlspecialchars($user_profile['email'],ENT_QUOTES); ?>">
                </div>
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Nomor Handphone</label>
                    <input class="form-control font-field" style="width: 100%; height: 50px;" type="number" autocomplete="off" name="phone" value="<?php echo htmlspecialchars($user_profile['phone'],ENT_QUOTES); ?>">
                </div>
                <div class="form-group" style="width: 100%">
                    <label class="font-field-title">Identitas (KTP/SIM/PASSPORT)</label>
                    <input type="file" class="form-control" id="image" accept="image/*" onChange="validate(this.value)" name="userfile" style="padding: 3px;" accept=".jpg,.jpeg">
                </div>
            </div>
            <hr class="profile-line" />
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

<script>
    function validate(file) {

    }
</script>