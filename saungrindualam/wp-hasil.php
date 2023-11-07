<?php include 'component/header.php';
$periode=$_GET['periode'];

$rowswp = $db->get_results("SELECT * FROM kriteria ORDER BY idk");
foreach ($rowswp as $row) {
    $KRITERIA[$row->idk] = $row->namak;
    $BOBOT[$row->idk] = $row->bobot;
}

?>
   <div class="page-body-wrapper">
        
      <div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Hasil Perangkingan Weighted Product</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Hasil</li>
                    <li class="breadcrumb-item active">Weighted Product</li>
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
                  <div class="card-header">
                    <form class="theme-form">
                      <div class="input-group m-0 flex-nowrap">
                        <form method="GET">
                           <input class="datepicker-here form-control digits" name="periode" type="text" data-language="id" data-min-view="months" data-view="months" data-date-format="MM yyyy" autocomplete="off" placeholder="Pilih periode"><button type="submit" class="btn btn-primary input-group-text">Cari</button>
                        </form>
                      </div>
                    </form>
                  </div>
                  <?php
                     $results = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp WHERE periode='$periode'");
                     if($periode==NULL){
                        echo "<div class='card-body'><h5 class='text-center'><span class='txt-danger'>Silahkan pilih periode hasil weighted product terlebih dahulu</span></h5></div>";
                     } else if (mysqli_num_rows($results) > 0) { ?>
                     <div class="card-header">
                       <h5>Evaluasi Data Periode <?=$periode?></h5>
                     </div>               
                     <div class="card-body">
                       <div class="table-responsive">
                         <table class="table table-bordered">
                           <thead>
                             <tr>
                               <th>Kode</th>
                               <th>Bahan Baku</th>
                               <?php foreach ($KRITERIA as $key => $vals) : ?>
                                 <th class="text-center"><?= $vals ?></th>
                               <?php endforeach ?>
                             </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $no=1;
                                 $query = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp as e, bahanbaku as b WHERE e.kode_bahan=b.kode_bahan AND e.periode='$periode' ORDER BY e.kode_bahan ASC");
                                 while($rows=mysqli_fetch_array($query)){
                              ?>
                              <tr>
                                 <td><?= $rows['kode_bahan'] ?></td>
                                 <td><?= $rows['nama'] ?></td>
                                 <td class="text-center"><?= $rows['c1'] ?></td>
                                 <td class="text-center"><?= $rows['c2'] ?></td>
                                 <td class="text-center"><?= $rows['c3'] ?></td>

                              </tr>
                              <?php } ?>
                           </tbody>
                         </table>
                       </div>
                     </div>
                     <div class="card-header">
                       <h5>Perbaikan Bobot</h5>
                     </div>               
                     <div class="card-body">
                       <div class="table-responsive">
                         <table class="table table-bordered">
                           <thead>
                             <tr>
                               <th></th>
                               <?php foreach ($KRITERIA as $key => $vals) : ?>
                                 <th class="text-center"><?= $vals ?></th>
                               <?php endforeach ?>
                             </tr>
                           </thead>
                           <tbody>

                              <tr>
                                 <td>Bobot Awal</td>
                                 <?php
                                    foreach ($BOBOT as $key => $vals) :
                                 ?>
                                    <td class="text-center"><?= $vals ?></td>
                                 <?php endforeach ?>
                              </tr>
                              <tr>
                                 <td>Bobot Baru</td>
                                 <?php
                                    $arBB = array();
                                    $i=0;
                                    $sumB = mysqli_query($koneksi, "SELECT SUM(bobot) AS sum FROM kriteria");
                                    $quB = mysqli_fetch_array($sumB);
                                    $jml_bobot = $quB['sum'];
                                    foreach ($BOBOT as $key => $vals) :
                                       $bb = $vals/$jml_bobot;
                                       $arBB[$i]=$bb;
                                 ?>
                                    <td class="text-center"><?=round($bb, 3)?></td>
                                 <?php $i++; endforeach ?>
                              </tr>
                              
                           </tbody>
                         </table>
                       </div>
                     </div>
                     <?php
                        $query = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp WHERE periode='$periode'");
                        while ($rows=mysqli_fetch_array($query)){
                           $vkt_s = 1;
                           for($c=1;$c<=3;$c++){
                              $tb = "c" . $c;
                              $ab = $c-1;
                              $pangkat = pow($rows[$tb], $arBB[$ab]);
                              $vkt_s = $vkt_s * $pangkat;
                           }
                           $upd = mysqli_query($koneksi, "UPDATE evaluasi_wp SET vektor_s = '$vkt_s' WHERE kode_bahan = '$rows[kode_bahan]'");
                        }
                        $v = mysqli_query($koneksi, "SELECT sum(vektor_s) as all_vk FROM evaluasi_wp WHERE periode='$periode'");
                        $vk = mysqli_fetch_array($v);
                        $all_vk = $vk['all_vk'];
                        
                        $queryv = mysqli_query($koneksi, "SELECT kode_bahan, vektor_s FROM evaluasi_wp WHERE periode='$periode'");
                        while ($rowsv=mysqli_fetch_array($queryv)){
                           $vk_v = $rowsv['vektor_s']/$all_vk;
                           $up_v = mysqli_query($koneksi, "UPDATE evaluasi_wp SET vektor_v = '$vk_v' WHERE kode_bahan='$rowsv[kode_bahan]'");
                        }
                     ?>
                     <div class="card-header">
                       <h5>Hasil Perangkingan Bahan Baku</h5>
                     </div>               
                     <div class="card-body">
                       <div class="table-responsive">
                         <table class="table table-bordered">
                           <thead>
                             <tr>
                                 <th>Ranking</th>
                                 <th>Bahan Baku</th>
                                 <th>Vektor_S</th>
                                 <th>Vektor_V</th>
                             </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $rank=1;
                                 $query = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp as e, bahanbaku as b WHERE e.kode_bahan=b.kode_bahan AND e.periode='$periode' ORDER BY e.vektor_v DESC");                                 
                                 while($rows=mysqli_fetch_array($query)){
                              ?>
                              <tr>
                                 <td><?=$rank?></td>
                                 <td><?= $rows['nama'] ?></td>
                                 <td><?= round($rows['vektor_s'], 3) ?></td>
                                 <td><?= round($rows['vektor_v'], 3) ?></td>                              
                              </tr>
                              <?php $rank++; } ?>
                           </tbody>
                         </table>
                       </div>
                     </div>
                     <div class='card-wrapper border rounded-3 light-card'>
                        <h5 class='text-center'>
                           <?php 
                           $querys = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp as e, bahanbaku as b WHERE e.kode_bahan=b.kode_bahan AND e.periode='$periode' ORDER BY e.vektor_v DESC LIMIT 1");
                           $hrow = $querys->fetch_assoc(); ?>
                           Dari hasil perangkingan menggunakan metode WP (Weighted Product) <span class='txt-primary'><?=$hrow['nama']?></span> menjadi bahan baku yang sangat dibutuhkan pada periode <?=$periode?>                           
                        </h5>
                     </div>
                  <?php
                     } else {
                  ?>
                     <div class='card-body'><h5 class='text-center'><span class='txt-danger'>Evaluasi data periode <?=$periode?> belum ada. Silahkan input dari menu peramalan WMA</span></h5></div>
                  <?php
                     }
                  ?>
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