<?php
include "header.php";
?>

    <div class="booking-body">
        <div class="booking-card pb-1">
            <h4 class="mb-4">My Rewards</h4>

            <div class="row pl-0 pr-0 pt-3 pb-3 ml-1 mr-1 booking-line">
                <div class="col-md-1 p-0 m-0">
                    <img class="booking-img-ticket-item" src="assets/img/mitra/lalajo.png" alt=""/>
                </div>
                <div class="col-md-2">
                    <p class="booking-font-field-title">Kode Hadiah</p>
                    <p class="booking-font-field">SDFEG4356</p>
                </div>
                <div class="col-md-6">
                    <p class="booking-font-field-title">Hadiah</p>
                    <p class="booking-font-field">GRATIS! Menonton 5 Film di hari Sabtu dan Minggu</p>
                </div>
                <div class="col-md-3 p-0 m-0 text-right">
                    <a href="<?php echo $host;?>function/actGetReward.php?page=https://www.google.com/reward?idReward=SDFEG4356">
                        <button class="btn btn-booking-primary p-0 m-0" type="submit">AMBIL SEKARAANG!</button>
                    </a>
                </div>
            </div>

            <div class="row pl-0 pr-0 pt-3 pb-3 ml-1 mr-1 booking-line">
                <div class="col-md-1 p-0 m-0">
                    <img class="booking-img-ticket-item" src="assets/img/mitra/lanjalan.png" alt=""/>
                </div>
                <div class="col-md-2">
                    <p class="booking-font-field-title">Kode Hadiah</p>
                    <p class="booking-font-field">AF43546YG</p>
                </div>
                <div class="col-md-6">
                    <p class="booking-font-field-title">Hadiah</p>
                    <p class="booking-font-field">Anda Mendapatkan Voucher 90% Paket Jalan-jalan ke Korea Selatan</p>
                </div>
                <div class="col-md-3 p-0 m-0 text-right">
                    <a href="<?php echo $host;?>function/actGetReward.php?page=https://www.google.com/reward?idReward=AF43546YG">
                        <button class="btn btn-booking-primary p-0 m-0" type="submit">AMBIL SEKARAANG!</button>
                    </a>
                </div>
            </div>

            <div class="row pl-0 pr-0 pt-3 pb-3 ml-1 mr-1 booking-line">
                <div class="col-md-1 p-0 m-0">
                    <img class="booking-img-ticket-item" src="assets/img/mitra/kebulan.png" alt=""/>
                </div>
                <div class="col-md-2">
                    <p class="booking-font-field-title">Kode Hadiah</p>
                    <p class="booking-font-field">Q453WTED</p>
                </div>
                <div class="col-md-6">
                    <p class="booking-font-field-title">Hadiah</p>
                    <p class="booking-font-field">SELAMAT! Anda berhak mendapatkan liburan GRATIS selama 3 bulan di ASGARUT SPACE</p>
                </div>
                <div class="col-md-3 p-0 m-0 text-right">
                    <a href="<?php echo $host;?>function/actGetReward.php?page=https://www.google.com/reward?idReward=Q453WTED">
                        <button class="btn btn-booking-primary p-0 m-0" type="submit">AMBIL SEKARAANG!</button>
                    </a>
                </div>
            </div>


        </div>

    </div>

<?php
include "footer.php";
?>