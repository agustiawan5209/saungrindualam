<?php
include 'config/function.php';
if (!isset($_SESSION['23e5f197886970b2d92bd7d3d8fd5d0e80cf3414'])) {
  echo '<script>location.href="login.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/images/favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
  <title>Implementasi Sistem Peramalan Pengadaan Kebutuhan Bahan Baku Pangan Dengan Metode Weighted Moving Average Dan Weighted Product Pada Saung Rindu Alam</title>
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/feather-icon.css">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/slick-theme.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/datatables.css">
  <link rel="stylesheet" type="text/css" href="assets/js/sweetalert2/sweetalert2.min.css">
  <script src="assets/js/sweetalert2/sweetalert2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/date-picker.css">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">

  <script src="assets/js/jquery.min.js"></script>
  <!-- Bootstrap js-->
  <script src="assets/js/bootstrap/bootstrap.bundle.min.js"></script>

  <script src="assets/js/highcharts/highcharts.js"></script>
  <script src="assets/js/highcharts/exporting.js"></script>
  <script src="assets/js/highcharts/export-data.js"></script>
  <script src="assets/js/highcharts/accessibility.js"></script>
  <script src="assets/js/chart/google/google-chart-loader.js"></script>
  <script src="assets/js/chart/google/google-chart.js"></script>
</head>

<body>
  <!-- <div class="loader-wrapper">
    <div class="loader-index"> <span></span></div>
    <svg>
      <defs></defs>
      <filter id="goo">
        <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
        <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
      </filter>
    </svg>
  </div> -->

  <!-- tap on top starts-->
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
  <!-- tap on tap ends-->
  <!-- page-wrapper Start-->
  <div class="page-wrapper compact-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <div class="page-header">
      <div class="header-wrapper row m-0">
        <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"></div>
              </div>
            </div>
          </form>
        <div class="header-logo-wrapper col-auto p-0">
          <div class="logo-wrapper"><a href="./"><img class="img-fluid" src="assets/images/logo/logo.png" alt=""></a></div>
          <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
        </div>
        <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
          <div class="notification-slider">
            <div class="d-flex h-100">
              <h4 class="mb-0 f-w-400"><span class="font-success">Saung Rindu Alam</span></h4>
            </div>
          </div>
        </div>
        <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
          <ul class="nav-menus">
            <li class="profile-nav onhover-dropdown pe-0 py-0">
              <div class="media profile-media">

                <div class="media-body"><span><?= $_SESSION['nama'] ?></span>
                  <p class="mb-0 font-roboto"><?= $_SESSION['jabatan'] ?> <i class="middle fa fa-angle-down"></i></p>
                </div>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                <li><a href="ubah-password.php"><span>Ubah Password </span></a></li>
                <li><a href="config/action.php?mod=logout"><span>Logout</span></a></li>
              </ul>
            </li>
          </ul>
        </div>

      </div>
    </div>
    <!-- Page Header Ends -->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
      <!-- Page Sidebar Start-->
      <div class="sidebar-wrapper" sidebar-layout="stroke-svg">
        <div>
          <div class="logo-wrapper"><a href="./"><img class="img-fluid for-light" src="assets/images/logo/logo.png" alt=""><img class="img-fluid for-dark" src="assets/images/logo/logo_dark.png" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="./"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="./"><img class="img-fluid" src="assets/images/logo/logo-icon.png" alt=""></a>
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                  <div>
                    <h6>Pinned</h6>
                  </div>
                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6 class="lan-1">Mengelola</h6>
                  </div>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="./">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-home"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-home"></use>
                    </svg><span>Dasbor</span></a>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-widget"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-widget"></use>
                    </svg><span>Transaksi</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="barangmasuk.php">Barang Masuk</a></li>
                    <li><a href="barangkeluar.php">Barang Keluar</a></li>
                  </ul>
                </li>

                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-widget"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-widget"></use>
                    </svg><span>Data Bahan Baku</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="bahanbaku.php">Lihat Data</a></li>
                    <li><a href="bahanbaku-tambah.php">Tambah Data</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-task"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-task"></use>
                    </svg><span>Data Periode</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="periode.php">Lihat Data</a></li>
                    <li><a href="periode-tambah.php">Tambah Data</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="kriteria.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-task"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-task"></use>
                    </svg><span>Data Kriteria</span></a>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-social"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-social"></use>
                    </svg><span>Peramalan WMA</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="peramalan.php">Mulai Peramalan</a></li>
                    <li><a href="peramalan-data.php">Lihat Data</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-animation"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-animation"></use>
                    </svg><span>Perangkingan WP</span></a>
                  <ul class="sidebar-submenu">
                    <li><a href="wp-evaluasi.php">Evaluasi Data</a></li>
                    <li><a href="wp-hasil.php">Hasil WP</a></li>
                  </ul>
                </li>
                <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="laporan.php">
                    <svg class="stroke-icon">
                      <use href="assets/svg/icon-sprite.svg#stroke-sample-page"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="assets/svg/icon-sprite.svg#fill-sample-page"></use>
                    </svg><span>Laporan</span></a>
                </li>
              </ul>
            </div>

            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>

          </nav>
        </div>
      </div>
      <!-- Page Sidebar Ends-->