<?php include 'component/header.php';

if ($_REQUEST['hapus']) {
  $sql = "delete from hasil_prediksi where id='$_REQUEST[hapus]'";
  mysqli_query($koneksi, $sql);
  $tanggal = $_GET['tanggal'];
  echo "<script>window.location = 'peramalan-data.php?tanggal=$tanggal';</script>";
}

?>
<div class="page-body-wrapper">
  <div class="page-body">
    <div class="container-fluid">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h3>Data Hasil Peramalan</h3>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">
                  <svg class="stroke-icon">
                    <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Data</li>
              <li class="breadcrumb-item active">Hasil Peramalan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid search-page">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <form class="theme-form">
                <div class="input-group m-0 flex-nowrap">
                  <form method="GET">
                    <input class="datepicker-here form-control digits" name="tanggal" type="text" data-language="id" data-min-view="months" data-view="months" data-date-format="MM yyyy" autocomplete="off" placeholder="Pilih periode"><button type="submit" class="btn btn-primary input-group-text">Cari</button>
                  </form>
                </div>
              </form>
            </div>
            <div class="card-body">
              <?php
              $tanggal = isset($_GET['tanggal']) ?  $_GET['tanggal'] : '';
              if (!isset($_GET['tanggal'])) {
                echo "<h5 class='text-center'><span class='txt-danger'>Silahkan pilih periode hasil peramalan terlebih dahulu</span></h5>";
              } else {
              ?>
                <form method="GET" action="wp-tambah.php">
                  <div class="table-responsive">
                    <h5 class='text-center mb-2'><span>Periode <?= $tanggal ?> <input type="hidden" name="tanggal" value="<?= $tanggal ?>"></span></h5>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Bahan Baku</th>
                          <th>Prediksi</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM hasil_prediksi, bahanbaku WHERE hasil_prediksi.kode_bahan=bahanbaku.kode_bahan AND hasil_prediksi.tanggal='$tanggal' ORDER BY hasil_prediksi.kode_bahan ASC");
                        while ($rows = mysqli_fetch_array($query)) {
                        ?>
                          <tr>
                            <td>(<?= $rows['kode_bahan'] ?>) <?= $rows['nama'] ?>
                            </td>
                            <td><?= $rows['prediksi'] ?>
                            </td>
                            <td>
                              <ul class="action">
                                <li class="delete"><a href="peramalan-data.php?hapus=<?= $rows['id'] ?>&tanggal=<?= $tanggal ?>" onclick="return confirm('Mau menghapus data ini?');"><i class="icon-trash"></i></a></li>
                              </ul>
                            </td>
                          </tr>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3" class="text-center">
                            <button class="btn btn-primary" type="submit" name="simpan">Proses ke metode WP</button>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </form>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
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

<script src="assets/js/datepicker/date-picker/datepicker.js"></script>
<script src="assets/js/datepicker/date-picker/datepicker.id.js"></script>
<script src="assets/js/datepicker/date-picker/datepicker.custom.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="assets/js/script.js"></script>
<!-- Plugin used-->
</body>

</html>