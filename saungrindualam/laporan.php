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
                  <h3>Cetak Laporan</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">                                       
                        <svg class="stroke-icon">
                          <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Cetak</li>
                    <li class="breadcrumb-item active">Laporan</li>
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
                </div>
               </div>

               <div class="col-sm-12">
                <div class="card"> 
                  <?php
                     $results = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp WHERE periode='$periode'");
                     if($periode==NULL){
                        echo "<div class='card-body'><h5 class='text-center'><span class='txt-danger'>Silahkan pilih periode yang ingin di cetak</span></h5></div>";
                     } else if (mysqli_num_rows($results) > 0) { ?>
                     <div class="cetaks" id="printableArea">
                        <div class="card-header">
                           <center><img src="assets/images/logo/logocetak.jpg" width="300"> </center>
                          <h5 class="text-center">Hasil Peramalan Pengadaan Kebutuhan Bahan Baku Pangan Dengan Metode Weighted Moving Average Dan Weighted Product Pada Saung Rindu Alam periode <?=$periode?></h5>
                        </div>               
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th>Kode</th>
                                  <th>Bahan Baku</th>
                                  <th class="text-center">Hasil Prediksi</th>
                                  <th class="text-center">Hasil Vektor_S</th>                               
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
                                    <td class="text-center"><?= round($rows['vektor_v'], 3) ?></td>
                                 </tr>
                                 <?php } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <div class="card-body chart-block">
                          <div class="chart-overflow" id="grafikprediksi"></div>
                        </div>
                        <div class="card-body chart-block">
                          <div class="chart-overflow" id="grafikvektor"></div>
                        </div>
                     </div>
                     <script>

                        google.charts.load('current', {
                          callback: drawChart,
                          packages: ['corechart']
                        });
                        function drawChart() {
                           if ($("#grafikprediksi").length > 0) {
                              var a = google.visualization.arrayToDataTable([
                                ["Hasil", "Hasil Prediksi", {role: "style"}],
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp as e, bahanbaku as b WHERE e.kode_bahan=b.kode_bahan AND e.periode='$periode' ORDER BY e.kode_bahan ASC");
                                    while($rows=mysqli_fetch_array($query)){
                                    $color = substr(md5(rand()), 0, 6);
                                 ?>
                                 ["<?= $rows['nama'] ?>", <?= $rows['c1'] ?>, '<?=$color?>'],
                                 <?php } ?>

                              ]),
                              b = {
                                chart: {
                                  title: "Grafik Hasil Prediksi",
                                },
                                bars: "horizontal",
                                vAxis: {
                                  format: "decimal"
                                },
                                height: 400,
                                width:'100%',
                              },

                              c = new google.visualization.BarChart(document.getElementById("grafikprediksi"));
                              c.draw(a, b)

                           }
                           if ($("#grafikvektor").length > 0) {
                              var a = google.visualization.arrayToDataTable([
                                ["Hasil", "Vektor V", { role: 'style' }],
                                <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM evaluasi_wp as e, bahanbaku as b WHERE e.kode_bahan=b.kode_bahan AND e.periode='$periode' ORDER BY e.kode_bahan ASC");
                                    while($rows=mysqli_fetch_array($query)){
                                    $color = substr(md5(rand()), 0, 6);
                                 ?>
                                 ["<?= $rows['nama'] ?>", <?= $rows['vektor_v'] ?>, '<?=$color?>'],
                                 <?php } ?>
                              ]),
                              b = {
                                chart: {
                                  title: "Grafik Hasil Vektor V",
                                },
                                bars: "horizontal",
                                vAxis: {
                                  format: "decimal"
                                },
                                height: 400,
                                width:'100%'
                              },
                              c = new google.visualization.BarChart(document.getElementById("grafikvektor"));
                              c.draw(a, b)
                           }
                        }
                     </script>

                     <div class="card-body">
                          <div class="row">
                              <div class="col-md-12 text-center">
                                  <button class="btn btn-primary" type="button" onclick="printDiv();" id="cetak">Cetak</button>
                              </div>
                          </div>
                     </div>
                     
                  <?php
                     } else {
                  ?>
                     <div class='card-body'><h5 class='text-center'><span class='txt-danger'>Periode <?=$periode?> belum memiliki hasil dari WP. Silahkan input dari menu peramalan WMA</span></h5></div>
                  <?php
                     }
                  ?>
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

    <script src="assets/js/datepicker/date-picker/datepicker.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.id.js"></script>
    <script src="assets/js/datepicker/date-picker/datepicker.custom.js"></script>    
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <script src="assets/js/jQuery.print.js"></script>
    <script type="text/javascript">
       jQuery(function($) { 'use strict';
         $(".cetaks").find('#cetak').on('click', function() {
             //Print ele2 with default options
             $.print(".cetaks");
         });   
      });

      function printDiv() {
         var divToPrint=document.getElementById('printableArea');
         var newWin=window.open('','Print-Window');
         newWin.document.open();
         newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
         newWin.document.close();
         setTimeout(function(){newWin.close();},10);
      }
    </script>
    <!-- Plugin used-->
  </body>
</html>