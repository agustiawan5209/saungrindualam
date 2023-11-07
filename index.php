<?php include 'component/header.php';?>
        <div class="page-body">
          <div class="container-fluid">        
            <div class="page-title">
              <div class="row">
                <div class="col-6">
                  <h3>Dasbor</h3>
                </div>
                <div class="col-6">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item">
                        <a href="./">
                           <svg class="stroke-icon">
                             <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                           </svg>
                        </a>
                     </li>
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active">Dasbor</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row widget-grid">
              <div class="col-xxl-6 col-sm-6 box-col-6"> 
                <div class="card profile-box">
                  <div class="card-body">
                    <div class="media media-wrapper">
                      <div class="media-body"> 
                        <div class="greeting-user">
                          <h4 class="f-w-600">Selamat Datang</h4>
                          <p>Implementasi Sistem Peramalan Pengadaan Kebutuhan Bahan Baku Pangan Dengan Metode Weighted Moving Average Dan Weighted Product Pada Saung Rindu Alam</p>
                        </div>
                      </div>
                      <div>  
                        <div class="clockbox">
                          <svg id="clock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 600">
                            <g id="face">
                              <circle class="circle" cx="300" cy="300" r="253.9"></circle>
                              <path class="hour-marks" d="M300.5 94V61M506 300.5h32M300.5 506v33M94 300.5H60M411.3 107.8l7.9-13.8M493 190.2l13-7.4M492.1 411.4l16.5 9.5M411 492.3l8.9 15.3M189 492.3l-9.2 15.9M107.7 411L93 419.5M107.5 189.3l-17.1-9.9M188.1 108.2l-9-15.6"></path>
                              <circle class="mid-circle" cx="300" cy="300" r="16.2"></circle>
                            </g>
                            <g id="hour">
                              <path class="hour-hand" d="M300.5 298V142"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="minute">
                              <path class="minute-hand" d="M300.5 298V67">   </path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9"></circle>
                            </g>
                            <g id="second">
                              <path class="second-hand" d="M300.5 350V55"></path>
                              <circle class="sizing-box" cx="300" cy="300" r="253.9">   </circle>
                            </g>
                          </svg>
                        </div>
                        <div class="badge f-10 p-0" id="txt"></div>
                      </div>
                    </div>
                    <div class="cartoon"><img class="img-fluid" src="assets/images/dashboard/cartoon.svg" alt="vector women with leptop"></div>
                  </div>
                </div>
              </div>

              <div class=" col-xl-3 col-sm-6 box-col-6"> 
                <div class="row"> 
                  <div class="col-xl-12"> 
                    <div class="card widget-1">
                      <div class="card-body"> 
                        <div class="widget-content">                          
                          <div> 
                            <h4><?php $result=mysqli_query($koneksi, "SELECT count(1) FROM bahanbaku");
                $row = mysqli_fetch_array($result);
                $total = $row[0];
                echo $total; ?></h4><span class="f-light">Total Bahan Baku</span>
                          </div>
                        </div>                        
                      </div>
                    </div>
                    <div class="col-xl-12"> 
                      <div class="card widget-1">
                        <div class="card-body"> 
                          <div class="widget-content">
                            <div> 
                              <h4><?php $result=mysqli_query($koneksi, "SELECT count(1) FROM periode");
                $row = mysqli_fetch_array($result);
                $total = $row[0];
                echo $total; ?></h4><span class="f-light">Total Periode</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class=" col-xl-3 col-sm-6 box-col-6"> 
                <div class="row"> 
                  <div class="col-xl-12"> 
                    <div class="card widget-1">
                      <div class="card-body"> 
                        <div class="widget-content">
                          <div> 
                            <h4><?php $result=mysqli_query($koneksi, "SELECT count(1) FROM hasil_prediksi");
                $row = mysqli_fetch_array($result);
                $total = $row[0];
                echo $total; ?></h4><span class="f-light">Total Hasil Prediksi</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xl-12"> 
                      <div class="card widget-1">
                        <div class="card-body"> 
                          <div class="widget-content">
                            <div> 
                              <h4><?php $result=mysqli_query($koneksi, "SELECT count(1) FROM evaluasi_wp");
                $row = mysqli_fetch_array($result);
                $total = $row[0];
                echo $total; ?></h4><span class="f-light">Total Evaluasi WP</span>
                            </div>
                          </div>
                        </div>
                      </div>
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
    <script src="assets/js/clock.js"></script>
    <script src="assets/js/slick/slick.min.js"></script>
    <script src="assets/js/slick/slick.js"></script>
    <script src="assets/js/header-slick.js"></script>
    <script src="assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="assets/js/chart/apex-chart/moment.min.js"></script>
    <script src="assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets/js/dashboard/default.js"></script>
    <!-- <script src="assets/js/notify/index.js"></script> -->
    <script src="assets/js/typeahead/handlebars.js"></script>
    <script src="assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="assets/js/typeahead/typeahead.custom.js"></script>
    <script src="assets/js/typeahead-search/handlebars.js"></script>
    <script src="assets/js/typeahead-search/typeahead-custom.js"></script>
    <script src="assets/js/height-equal.js"></script>
    <script src="assets/js/animation/wow/wow.min.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assets/js/script.js"></script>
    <!-- Plugin used-->
  </body>
</html>