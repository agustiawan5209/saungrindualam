<?php include 'component/header.php';
if($_REQUEST['hapus'])
{
  $sql="DELETE FROM periode WHERE kode_periode='$_REQUEST[hapus]'";
  mysqli_query($koneksi, $sql);
  mysqli_query($koneksi,"DELETE FROM relasi WHERE kode_periode='$_REQUEST[hapus]'");
  echo "<script>window.location = 'periode.php';</script>";
}
?>
   <div class="page-body-wrapper">
        
      <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Data Periode</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item active">Periode</li>
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
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="display" id="basic-1">
                        <thead>
                          <tr>
                            <th>Kode</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                              $no=1;
                              $query = mysqli_query($koneksi, "SELECT * FROM periode ORDER BY kode_periode ASC");
                              while($rows=mysqli_fetch_array($query)){
                           ?>
                           <tr>
                              <td><?= $rows['kode_periode'] ?></td>
                              <td><?= $rows['tanggal'] ?></td>
                              <td> 
                                 <ul class="action"> 
                                   <li class="eye"><a href="periode-detail.php?kode_periode=<?=$rows['kode_periode']?>"><i class="icon-eye"></i></a></li>
                                   <?php  echo str_repeat('&nbsp;', 2);?>
                                   <li class="delete"><a href="periode.php?hapus=<?=$rows['kode_periode']?>" onclick="return confirm('Mau menghapus data ini?');"><i class="icon-trash"></i></a></li>
                                 </ul>
                              </td>
                           </tr>
                           <?php } ?>
                        </tbody>
                      </table>
                    </div>
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
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!-- Plugin used-->
  </body>
</html>