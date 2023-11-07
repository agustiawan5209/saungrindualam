<?php include 'component/header.php';
$tanggal=$_GET['tanggal'];
?>
      <div class="page-body-wrapper">       
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Tambah Evaluasi Weighted Product</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Weighted Product</li>
                    <li class="breadcrumb-item active">Tambah Evaluasi</li>
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
                  <form class="form theme-form" method="POST" action="?mod=wp-tambah" enctype="multipart/form-data">
                     <?php if ($_POST) include 'config/action.php' ?>
                     <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">PERIODE</label>
                            <div class="col-sm-9">
                              <h5><?=$tanggal?></h5>
                              <input class="form-control" type="hidden" name="tanggal" value="<?=$tanggal?>" required>
                            </div>
                          </div>                          
                        </div>
                      </div>
                     <div class="row g-3 mb-3">
                        <?php
                           $query = mysqli_query($koneksi, "SELECT * FROM hasil_prediksi, bahanbaku WHERE 
                              hasil_prediksi.kode_bahan=bahanbaku.kode_bahan AND 
                              hasil_prediksi.tanggal='$tanggal' ORDER BY hasil_prediksi.kode_bahan ASC");
                           while($rows=mysqli_fetch_array($query)){
                        ?>
                        <fieldset class="card-wrapper border rounded-3 light-card">
                           <div class="row">
                              <label class="col-form-label col-sm-3 pt-0">(<?= $rows['kode_bahan'] ?>) <?= $rows['nama'] ?><br/>
                                 <!-- <small>Hasil Peramalan: <b><?= $rows['prediksi'] ?></b></small> -->
                                 <input type="hidden" name="kode_bahan[]" value="<?= $rows['kode_bahan'] ?>">
                              </label>
                              <div class="col-sm-9">
                                 <?php 
                                    $q = mysqli_query($koneksi, "SELECT * FROM kriteria ORDER BY idk ASC");
                                    while($r=mysqli_fetch_array($q)){
                                 ?>
                                 <div class="mt-1">
                                    <label class="form-label">C<?= $r['idk'] ?> - <?= $r['namak'] ?></label>
                                    <?php 
                                       if ($r['idk']==1){
                                          $nilai=$rows['prediksi'];
                                       } else {
                                          $nilai="";
                                       }
                                    ?>
                                    <input class="form-control" type="text" name="c<?= $r['idk'] ?>[]" value="<?=$nilai?>" onkeypress="return event.charCode >= 48 && event.charCode <=57" required>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </fieldset>
                        <?php }  ?>                        
                     </div>

                    </div>
                    <div class="card-footer text-center">
                      <div class="col-sm-12">
                        <button class="btn btn-primary" type="submit">Hitung</button>
                      </div>
                    </div>
                  </form>
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
    <script src="assets/js/config.js"></script>
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/slick/slick.min.js"></script>
    <script src="assets/js/slick/slick.js"></script>
    <script src="assets/js/header-slick.js"></script>

    <script src="assets/js/script.js"></script>
  </body>
</html>