<?php
error_reporting(~E_NOTICE & ~E_DEPRECATED);

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

$servername = "127.0.0.1";
$usernameser = "root";
$passwordser = "";
$database = "saungrindualam";
$koneksi = mysqli_connect($servername,$usernameser,$passwordser,$database);
$db = new mysqli($servername, $usernameser, $passwordser, $database);
try {
	$pdo = new PDO('mysql:host='.$servername.';dbname='.$database, $usernameser, $passwordser);
	$pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );	
} 
catch(PDOException $e) {
	die("Koneksi ke database gagal ".$e->getMessage());
}
if (mysqli_connect_errno()){
	echo "Koneksi ke database gagal : " . mysqli_connect_error();
}
global $koneksi;
// global $pdo;
?>