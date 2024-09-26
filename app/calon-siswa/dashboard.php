<?php 
session_start();
if(!isset($_SESSION["user"])) header("Location: ../../login.php");
require_once('../../config.php');
$id = $_SESSION["user"]["id"];
$calon_siswa = $conn->query("SELECT * FROM calon_siswa LEFT JOIN pendaftaran ON calon_siswa.id = pendaftaran.calon_siswa_id WHERE calon_siswa.id='$id'");
$calon_siswa = $calon_siswa->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Calon Siswa | MTs Mau'izhah</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php 
  include '../component/navbar.php';
  ?>

  <!-- Sidebar -->
  <aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <label class="brand-link">
      <span class="brand-text">MTs Mau'izhah</span>
    </label>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/AdminLTELogo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['user']['nama'] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="dashboard.php" class="nav-link active">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="data-diri.php" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data Diri
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../../logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="data-kepala-sekolah.php" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Kelulusan
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  </aside>
  <!-- End Sidebar -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Calon Siswa</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <?php if($calon_siswa['pasfoto'] == null) { ?>
            <div class="col-12">
            <div class="card card-danger card-outline">
            <div class="card-header">
                Lengkapi Data Diri
              </div>
              <div class="card-body">
                <h5 class="card-title">Belum Upload Pasfoto</h5>
                <p class="card-text">Silahkan upload pasfoto melalui halaman data diri.</p>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if($calon_siswa['status'] == "Lulus") { ?>
            <div class="col-12">
            <div class="card card-info card-outline">
            <div class="card-header">
                Pengumuman
              </div>
              <div class="card-body">
                <h5 class="card-title">Selamat, Kamu Lulus!</h5>
                <p class="card-text">Pendaftaran berhasil dan kamu telah diterima masuk sebagai siswa MTs Mau'izhah.</p>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if($calon_siswa['status'] == "Belum Lulus") { ?>
            <div class="col-12">
            <div class="card card-info card-outline">
            <div class="card-header">
                Pengumuman
              </div>
              <div class="card-body">
                <h5 class="card-title">Maaf, Kamu Belum Lulus!</h5>
                <p class="card-text">Pendaftaran gagal dan kamu belum diterima masuk sebagai siswa MTs Mau'izhah, silahkan coba lagi tahun depan.</p>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if($calon_siswa['status'] == "Proses") { ?>
            <div class="col-12">
            <div class="card card-info card-outline">
            <div class="card-header">
                Pengumuman
              </div>
              <div class="card-body">
                <h5 class="card-title">Belum Ada Pengumuman</h5>
                <p class="card-text">Saat ini belum ada informasi pengumuman kelulusan.</p>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include '../component/footer.php' ?>
</div>
<!-- ./wrapper -->

<?php include '../component/script.php' ?>
</body>
</html>
