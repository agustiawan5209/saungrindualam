<?php
require_once 'function.php';

if ($modules == 'login') {
    $username = validasi($_POST['username']);
    $password = validasi($_POST['password']);
    $query = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE username='$username' AND password='$password'");
    $result = mysqli_num_rows($query);
    if ($result != 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['id'] = $row['id'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['jabatan'] = $row['jabatan'];
        $_SESSION['telp'] = $row['telp'];
        $_SESSION['jk'] = $row['jk'];
        $_SESSION['login_history'] = $row['login_history'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        $_SESSION['23e5f197886970b2d92bd7d3d8fd5d0e80cf3414'] = true;
        halaman("index.php");
    } else {
        pesan("Username dan Password salah!!!");
    }
} elseif ($modules == 'logout') {
    unset($_SESSION['23e5f197886970b2d92bd7d3d8fd5d0e80cf3414']);
    session_destroy();
    halaman("../login.php");
}

if ($modules == 'ubah-password') {
    $id = validasi($_GET['id']);
    $password = validasi($_POST['password']);
    $result= mysqli_query($koneksi, "UPDATE pegawai SET password='$password' WHERE id='$id'");
    if ($result) {
        berhasil("index.php");
    } else {
        pesan("Gagal memproses data.");
    }    
}


if ($modules == 'bahanbaku-tambah') {    
    $nama = validasi($_POST['nama']);
    $kode_bahan = validasi($_POST['kode_bahan']);
    $result = mysqli_query($koneksi, "INSERT INTO bahanbaku VALUES ('$kode_bahan', '$nama')");
    if ($result) {
        berhasil("bahanbaku.php");
    } else {
        pesan("Gagal memproses data.");
    }
}
if ($modules == 'bahanbaku-ubah') {
    $kode_bahan = validasi($_GET['kode_bahan']);
    $nama = validasi($_POST['nama']);
    $result= mysqli_query($koneksi, "UPDATE bahanbaku SET nama='$nama' WHERE kode_bahan='$kode_bahan'");
    if ($result) {
        berhasil("bahanbaku.php");
    } else {
        pesan("Gagal memproses data.");
    }    
}
if ($modules == 'periode-tambah') {    
    $kode_periode = validasi($_POST['kode_periode']);
    $tanggal = $_POST['tanggal'];
    $tgl = explode("-" , $tanggal);
    if ($tgl[2] !== "01")
        pesan("Silahkan pilih tanggal 1");
    elseif ($db->get_row("SELECT * FROM periode WHERE kode_periode='$kode_periode'"))
        pesan("Kode sudah ada!");
    elseif ($db->get_row("SELECT * FROM periode WHERE tanggal='$tanggal' AND kode_periode<>'$kode_periode'"))
        pesan("Periode sudah ada!");
    else {
        $db->query("INSERT INTO periode (kode_periode, tanggal) VALUES ('$kode_periode', '$tanggal')");
        foreach ($_POST['nilai'] as $key => $val) {
            $db->query("INSERT INTO relasi(kode_periode, kode_bahan, nilai) VALUES ('$kode_periode', '$key', '$val')");
        }
        berhasil("periode.php");
    }
}
if ($modules == 'periode-detail') {    
    $kode_periode = validasi($_POST['kode_periode']);
    foreach ($_POST['nilai'] as $key => $val) {
            $db->query("UPDATE relasi SET nilai='$val' WHERE id='$key'");
    }
    berhasil("periode.php");    
}

if ($modules == 'kriteria-ubah') {
    $idk = validasi($_GET['idk']);
    $namak = validasi($_POST['namak']);
    $bobot = validasi($_POST['bobot']);
    $result= mysqli_query($koneksi, "UPDATE kriteria SET namak='$namak', bobot='$bobot' WHERE idk='$idk'");
    if ($result) {
        berhasil("kriteria.php");
    } else {
        pesan("Terjadi Kesalahan Sistem!!!");
    }
}
if ($modules == 'wp-tambah') {    
    $tanggal = $_POST['tanggal'];
    $kode_bahan = $_POST['kode_bahan'];
    $c1 = $_POST['c1'];
    $c2 = $_POST['c2'];
    $c3 = $_POST['c3'];
    $total = count($kode_bahan);
    mysqli_query($koneksi, "DELETE FROM evaluasi_wp WHERE periode='$tanggal'");
    for($i = 0; $i < $total; $i++){
        mysqli_query($koneksi, "INSERT INTO evaluasi_wp VALUES (NULL, '$kode_bahan[$i]', '$tanggal', '$c1[$i]', '$c2[$i]', '$c3[$i]', '', '')");
    }
    berhasil("wp-hasil.php?periode=$tanggal");
}