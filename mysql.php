<?php
ob_start();
@session_start();
error_reporting(0);

$host = 		'localhost';
$kullanici = 	'dayko_aidat';
$sifre = 		'5Nl?0l9j1';
$db_isim = 		'dayko_aidat';

$conn = new MySQLi($host, $kullanici, $sifre, $db_isim);
mysqli_set_charset($conn, "utf8");

if ($conn->connect_error)
{
	die('Veritabanı Bağlantısı Hatası: ' . $conn->connect_error);
}
$_SESSION["mysqli"] = $conn;
$_SESSION["query"];