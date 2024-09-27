<?php 
session_start();
if(!isset($_SESSION["kepala_sekolah"])) header("Location: ../../login-kepala-sekolah.php");

require_once('../../config.php');
$calon_siswa = $conn->query("SELECT * FROM calon_siswa");
$calon_siswa_lulus = $conn->query("SELECT * FROM calon_siswa LEFT JOIN pendaftaran ON calon_siswa.id = pendaftaran.calon_siswa_id WHERE pendaftaran.status='Lulus'");
$calon_siswa_tidak_lulus = $conn->query("SELECT * FROM calon_siswa LEFT JOIN pendaftaran ON calon_siswa.id = pendaftaran.calon_siswa_id WHERE pendaftaran.status='Tidak Lulus'");
$jumlah_admin = $conn->query("SELECT * FROM admin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard Kepala Sekolah | MTs Mau'izhah</title>

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
          <a href="#" class="d-block"><?php echo $_SESSION['kepala_sekolah']['nama'] ?></a>
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
            <a href="data-calon-siswa.php" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Calon Siswa
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="profil-saya.php" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Profil Saya
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="../../logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
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
              <li class="breadcrumb-item"><a href="#">Kepala Sekolah</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content px-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6 col-lg-3">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h5 class="m-0">Calon Siswa Mendaftar</h5>
              </div>
              <div class="card-body">
                <h1 class="card-title font-weight-bold" style="font-size: 32pt; width: 100%; text-align: right;">
                <?php echo $calon_siswa->num_rows ?>
              </h1>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="card card-success card-outline">
              <div class="card-header">
                <h5 class="m-0">Calon Siswa Lulus</h5>
              </div>
              <div class="card-body">
                <h1 class="card-title font-weight-bold" style="font-size: 32pt; width: 100%; text-align: right;">
                <?php echo $calon_siswa_lulus->num_rows ?>
              </h1>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h5 class="m-0">Calon Siswa Tidak Lulus</h5>
              </div>
              <div class="card-body">
                <h1 class="card-title font-weight-bold" style="font-size: 32pt; width: 100%; text-align: right;">
                <?php echo $calon_siswa_tidak_lulus->num_rows ?>
              </h1>
              </div>
            </div>
          </div>
          <div class="col-6 col-lg-3">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="m-0">Jumlah Admin</h5>
              </div>
              <div class="card-body">
                <h1 class="card-title font-weight-bold" style="font-size: 32pt; width: 100%; text-align: right;">
                <?php echo $jumlah_admin->num_rows ?>
              </h1>
              </div>
            </div>
          </div>
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
