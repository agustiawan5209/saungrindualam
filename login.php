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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="assets/images/login/2.jpg" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card login-dark">
            <div>
              <div>
               <a class="logo text-center" href="login.php">
                  <img class="img-fluid for-light" src="assets/images/logo/logins.png" alt="looginpage">
                  <img class="img-fluid for-dark" src="assets/images/logo/logins.png" alt="looginpage">
               </a>
               </div>
               <div class="login-main"> 
                <form class="theme-form" method="POST" action="?mod=login">
                  <?php if ($_POST) include 'config/action.php' ?>
                  <h4>Masuk ke akun</h4>
                  <p>Masukkan username & kata sandi untuk login</p>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input class="form-control" type="text" required="" name="username">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="">
                    </div>
                  </div>
                  <div class="form-group mb-0 mt-4">                    
                    <button class="btn btn-success btn-block w-100 " type="submit">Login</button>
                  </div>                
                </form>
               </div>
            </div>
          </div>
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
      <!-- Sidebar jquery-->
      <script src="assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="assets/js/script.js"></script>
      <!-- Plugin used-->
    </div>
  </body>
</html>