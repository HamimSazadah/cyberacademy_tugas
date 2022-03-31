<?php
include "header.php";

@session_start();

$id = @$_SESSION['id'];
$tipe = @$_SESSION['tipe'];

if (!$id || $tipe != 'admin') {
    header('location:' . $host . 'adminxyz.php');
    exit;
}
?>
<div class="login-clean">
    <form>
        <h2 class>Halaman Admin</h2>
    </form>
</div>

<?php
include "footer.php";
?>