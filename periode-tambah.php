<?php include 'component/header.php';
$rows = $db->get_results("SELECT * FROM bahanbaku ORDER BY kode_bahan");
foreach ($rows as $row) {
    $BAHAN[$row->kode_bahan] = $row->nama;
}
?>
      <div class="page-body-wrapper">       
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Tambah Data Periode</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Periode</li>
                    <li class="breadcrumb-item active">Tambah Data</li>
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
                  <form class="form theme-form" method="POST" action="?mod=periode-tambah" enctype="multipart/form-data">
                     <?php if ($_POST) include 'config/action.php' ?>
                     <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Kode Periode</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" name="kode_periode" value="<?= kode_oto('kode_periode', 'periode', 'P', 2) ?>" required>
                            </div>
                          </div>
                          <div class="mb-3 row">
                            <label class="col-sm-3 col-form-label">Tanggal</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="date" name="tanggal" required>
                            </div>
                          </div>
                        </div>
                      </div>

                     <div class="row g-3 mb-3">
                        <?php foreach ($BAHAN as $key => $val) : ?>
                        <div class="col-md-6">
                          <label class="form-label"><?= $val ?></label>
                              <input class="form-control" type="number" name="nilai[<?= $key ?>]" value="<?= isset($_POST['nilai'][$key]) ? $_POST['nilai'][$key] : '' ?>" >
                        </div> 
                        <?php endforeach ?>                                                
                     </div>

                    </div>
                    <div class="card-footer text-end">
                      <div class="col-sm-9 offset-sm-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <input class="btn btn-light" type="reset" value="Cancel">
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