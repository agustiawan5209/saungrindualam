<?php
// error_reporting(~E_NOTICE);
session_start();
include 'koneksi.php';
include 'db.php';
include 'wma_class.php';

$db = new DB($servername, $usernameser, $passwordser, $database);

$modules = isset($_GET['mod']) ? $_GET['mod'] : '';

function validasi($data){
    global $koneksi;
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($koneksi, $data);
    return $data; 
}

function val($str){
    if (function_exists('get_magic_quotes_gpc'))
        return addslashes($str);
    else
        return false;
}

function set_value($key = null, $default = null)
{
    global $_POST;
    if (isset($_POST[$key]))
        return $_POST[$key];
    if (isset($_GET[$key]))
        return $_GET[$key];
    return $default;
}

function kode_oto($field, $table, $prefix, $length)
{
    global $db;
    $var = $db->get_var("SELECT $field FROM $table WHERE $field REGEXP '{$prefix}[0-9]{{$length}}' ORDER BY $field DESC");
    if ($var) {
        return $prefix . substr(str_repeat('0', $length) . (substr($var, -$length) + 1), -$length);
    } else {
        return $prefix . str_repeat('0', $length - 1) . 1;
    }
}

$rows = $db->get_results("SELECT * FROM periode ORDER BY kode_periode");
foreach ($rows as $row) {
    $PERIODE[$row->kode_periode] = $row->tanggal;
}

$rows = $db->get_results("SELECT * FROM bahanbaku ORDER BY kode_bahan");
foreach ($rows as $row) {
    $BAHAN[$row->kode_bahan] = $row->nama;
}

function get_bahan_option($selected = 0)
{
    global $BAHAN;
    $a = '';
    foreach ($BAHAN as $key => $value) {
        if ($key == $selected)
            $a .= "<option value='$key' selected>$value</option>";
        else
            $a .= "<option value='$key'>$value</option>";
    }
    return $a;
}

function get_analisa()
{
    global $db;

    $rows = $db->get_results("SELECT tanggal, kode_bahan, SUM(nilai) AS nilai
    FROM relasi r INNER JOIN periode p ON p.kode_periode=r.kode_periode    
    GROUP BY YEAR(tanggal), MONTH(tanggal), kode_bahan
    ORDER BY r.kode_periode, kode_bahan");

    $arr = array();
    foreach ($rows as $row) {
        $arr[$row->kode_bahan][$row->tanggal] = $row->nilai;
    }
    return $arr;
}

function pesan($msg, $type = 'danger'){
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">' . $msg . '</div>');
}

function print_msg($msg, $type = 'danger')
{
    echo ('<div class="alert alert-' . $type . ' alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $msg . '</div>');
}

function tgl_indo($tgl){
 $bulan = array (
  1 =>   'Januari',
  'Februari',
  'Maret',
  'April',
  'Mei',
  'Juni',
  'Juli',
  'Agustus',
  'September',
  'Oktober',
  'November',
  'Desember'
 );
 $pecah = explode('-', $tgl);
 
 
 return $bulan[ (int)$pecah[1] ] . ' ' . $pecah[0]; 
}


function berhasil($links){
    echo '
    <script type="text/javascript">
    setTimeout(function () {
        Swal.fire({
            title: "Berhasil",
            text:  "Data Tersimpan!",
            icon: "success",
            timer: 2000,
            allowOutsideClick:false,
            showConfirmButton: false
        });
    },10);
    window.setTimeout(function(){
        window.location.replace("'.$links.'");
    } ,2000);
    </script>';
}

function gagal($links){
    echo '
    <script type="text/javascript">
    setTimeout(function () {
        Swal.fire({
            title: "Gagal",
            text:  "Terjadi Kesalahan!",
            icon: "error",
            timer: 2000,
            allowOutsideClick:false,
            showConfirmButton: false
        });
    },10);
    window.setTimeout(function(){
        window.location.replace("'.$links.'");
    } ,2000);
    </script>';
}

function aksesadmin(){
    if (isset($_SESSION['admin_akses']) == true) {
        echo '<script>dasbor.php";</script>';
    }
    return true;
}

function halaman($url){
    echo '<script type="text/javascript">window.location.replace("' . $url . '");</script>';
}
