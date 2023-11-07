<?php include 'component/header.php';
if($_REQUEST['hapus'])
{
  $sql="delete from bahanbaku where kode_bahan='$_REQUEST[hapus]'";
  mysqli_query($koneksi, $sql);
  echo "<script>window.location = 'bahanbaku.php';</script>";
}
?>
   <div class="page-body-wrapper">
        
      <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Data Bahan Baku</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item active">Bahan Baku</li>
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
                            <th>Nama Bahan Baku</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                           <?php
                              $no=1;
                              $query = mysqli_query($koneksi, "SELECT * FROM bahanbaku ORDER BY kode_bahan DESC");
                              while($rows=mysqli_fetch_array($query)){
                           ?>
                           <tr>
                              <td><?= $rows['kode_bahan'] ?></td>
                              <td><?= $rows['nama'] ?></td>
                              <td> 
                                 <ul class="action"> 
                                   <li class="edit"> <a href="bahanbaku-ubah.php?kode_bahan=<?=$rows['kode_bahan']?>"><i class="icon-pencil-alt"></i></a></li>
                                   <li class="delete"><a href="bahanbaku.php?hapus=<?=$rows['kode_bahan']?>" onclick="return confirm('Mau menghapus data ini?');"><i class="icon-trash"></i></a></li>
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