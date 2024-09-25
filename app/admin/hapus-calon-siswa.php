<?php 
session_start();
if(!isset($_SESSION["admin"])) header("Location: ../../login-admin.php");

require_once('../../config.php');
$calon_siswa_id = $_GET["id"];
$conn->query("DELETE FROM calon_siswa where id = '$calon_siswa_id'");
$conn->query("DELETE FROM pendaftaran where calon_siswa_id = '$calon_siswa_id'");
$_SESSION["alert"] = "Data Calon Siswa Berhasil Dihapus.";
header("Location: data-calon-siswa.php");
?>