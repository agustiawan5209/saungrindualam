<?php include 'component/header.php';
$kode_periode=$_GET['kode_periode'];
$row = $db->get_row("SELECT * FROM periode WHERE kode_periode='$kode_periode'");
?>
   <div class="page-body-wrapper">
        
      <div class="page-body">
         <form method="POST" action="?mod=periode-detail&kode_periode=<?=$kode_periode?>" enctype="multipart/form-data">
         <?php if ($_POST) include 'config/action.php' ?>
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Data Periode: <?= $row->kode_periode ?>, <?= $row->tanggal ?></h3> 
                </div>
                <div class="col-6">
                     <div class="text-end">
                      <div class="col-sm-9 offset-sm-3">
                        <button class="btn btn-primary" type="submit">Ubah</button>
                        <a href="periode.php" class="btn btn-light">Kembali</a>
                      </div>
                    </div>
                </div>
              </div>
            </div>
         </div>
         <!-- Container-fluid starts-->
         <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-lg">
                        <thead>
                          <tr>
                            <th>Kode Bahan</th>
                            <th>Bahan Baku</th>
                            <th style="width: 40%;">Nilai</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                           $rows = $db->get_results("SELECT * FROM relasi r 
                               INNER JOIN bahanbaku b ON b.kode_bahan=r.kode_bahan
                           WHERE kode_periode='$row->kode_periode' ORDER BY r.kode_bahan");
                           foreach ($rows as $row) : ?>
                           <tr>
                              <td><?= $row->kode_bahan ?></td>
                              <td><?= $row->nama ?></td>
                              <td><input type="text" class="form-control" name="nilai[<?= $row->ID ?>]" value="<?= $row->nilai ?>"></td>                             
                           </tr>
                           <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </div>
         </form>
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
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!-- Plugin used-->
    <script type="text/javascript">
      $(document).ready(function() {
         $('#tbl_id').dataTable({
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
            "iDisplayLength": 25
         });
      })
    </script>
  </body>
</html>