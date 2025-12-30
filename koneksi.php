<?php
$username = "root";
$password = "";
$server = "localhost";
$database = "spk-wp-comp";


$koneksi = mysqli_connect($server, $username, $password, $database) or die("koneksi gagal");
define('BASE_URL', 'http://192.168.100.5/spk-wp-comp/');

date_default_timezone_set('Asia/Jakarta');
setlocale(LC_TIME, 'id_ID', 'id_ID.UTF-8', 'indonesia');
?>