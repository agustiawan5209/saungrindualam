<?php include 'component/header.php';
$success = false;
?>
<div class="page-body-wrapper">

  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Perhitungan Weigted Moving Average</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">
                  <svg class="stroke-icon">
                    <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Proses</li>
              <li class="breadcrumb-item active">Perhitungan Weigted Moving Average</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <?php
            if (isset($_POST['mulaihitung'])) {
              $next_periode = $_POST['next_periode'];
              $n_periode = $_POST['n_periode'];
              $count = $db->get_var("SELECT COUNT(*) FROM periode");

              if ($n_periode < 2 || $n_periode > $count) {
                pesan("Isikan periode moving antara 2 dan $count");
              } elseif ($next_periode < 1) {
                pesan('Masukkan periode peramalan minimal 1');
              } else {
                $success = true;
              }
            } elseif (isset($_POST['simpan'])) {
              $kode_bahan = $_POST['kode_bahan'];
              $htanggal = $_POST['htanggal'];
              $hhasil = $_POST['hhasil'];
              $tot = count($hhasil);
              foreach ($kode_bahan as $key => $value) {
                mysqli_query($koneksi, "DELETE FROM hasil_prediksi WHERE kode_bahan='$value'");
                mysqli_query($koneksi, "INSERT INTO hasil_prediksi VALUES (null, '$value', '$htanggal[$value]', '$hhasil[$value]')");

                //   for($i = 0; $i < $tot; $i++){
                // mysqli_query($koneksi, "INSERT INTO hasil_prediksi VALUES (null, '$kode_bahan[$key]', '$htanggal[$key][$i]', '$hhasil[$key][$i]')");
                //  }
              }

              berhasil("peramalan.php");
            }
            ?>
            <form class="form theme-form" method="POST" enctype="multipart/form-data">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <!-- <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Bahan Baku</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="kode_bahan">
                                  <?= get_bahan_option(set_value('kode_bahan')) ?>
                              </select>
                            </div>
                          </div> -->
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">Periode Moving (Bulan)</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input class="form-control" type="number" placeholder="1-12" name="n_periode" value="<?= set_value('n_periode', 3) ?>" aria-describedby="mperiode" autocomplete="off"><span class="input-group-text" id="mperiode">Bulan</span>
                        </div>
                      </div>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">Jumlah Periode Diramal (Bulan)</label>
                      <div class="col-sm-2">
                        <div class="input-group">
                          <input class="form-control" type="number" placeholder="1-12" name="next_periode" value="<?= set_value('next_periode', 1) ?>" aria-describedby="nperiode" autocomplete="off"><span class="input-group-text" id="nperiode">Bulan</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                <div class="col-sm-9 offset-sm-3">
                  <button class="btn btn-primary" type="submit" name="mulaihitung">Hitung</button>
                </div>
              </div>
            </form>

            <?php
            if (!$PERIODE || !$BAHAN) :
              echo "Tampaknya anda belum mengatur periode dan jenis. Silahkan tambahkan minimal 3 periode dan 3 jenis.";
            elseif ($success) :
              require_once('peramalan_hasil_all.php');
              $_SESSION['post'] = $_POST;
            endif
            ?>

          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- footer start-->
  <footer class="footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 footer-copyright text-center">
          <p class="mb-0">Copyright 2023 © Saung Rindu Alam</p>
        </div>
      </div>
    </div>
  </footer>
</div>
</div>
<!-- latest jquery-->
<script src="assets/js/jquery.min.js"></script>
<!-- Bootstrap js-->
<script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="assets/js/icons/feather-icon/feather.min.js"></script>
<script src="assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="assets/js/scrollbar/simplebar.js"></script>
<script src="assets/js/scrollbar/custom.js"></script>
<!-- Sidebar jquery-->
<script src="assets/js/config.js"></script>
<!-- Plugins JS start-->
<script src="assets/js/sidebar-menu.js"></script>
<script src="assets/js/slick/slick.min.js"></script>
<script src="assets/js/slick/slick.js"></script>
<script src="assets/js/header-slick.js"></script>
<script src="assets/js/datatable/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/datatable/datatables/datatable.custom.js"></script>



<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="assets/js/script.js"></script>
<!-- Plugin used-->
</body>

</html>