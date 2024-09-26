<?php 
session_start();
if(!isset($_SESSION["admin"])) header("Location: ../../login-admin.php");

require_once('../../config.php');
$data = $conn->query("SELECT * FROM calon_siswa");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Calon Siswa | MTs Mau'izhah</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.css">
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
          <a href="#" class="d-block"><?php echo $_SESSION['admin']['nama'] ?></a>
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
            <a href="dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="data-calon-siswa.php" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Calon Siswa
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="data-kepala-sekolah.php" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Data Kepala Sekolah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="data-admin.php" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Data Admin
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
            <h1 class="m-0">Data Calon Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Data Calon Siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?php if(isset($_SESSION['alert'])) { ?>
          <div class="row">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Alert!</strong> <?php echo $_SESSION['alert']; unset($_SESSION['alert']);?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
        <?php } ?>
        <div class="row m-2 p-2 bg-light shadow-sm">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Tempat Lahir</th>
                <th>Tgl. Lahir</th>
                <th>Sekolah Asal</th>
                <th>Alamat</th>
                <th>Tgl. Registrasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($data as $index=>$row) {
            ?>
            <tr>
                <td><?php echo $index + 1 ?></td>
                <td><?php echo $row['nama'] ?></td>
                <td><?php echo $row['nisn'] ?></td>
                <td><?php echo $row['tempat_lahir'] ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['tgl_lahir'])) ?></td>
                <td><?php echo $row['asal_sekolah'] ?></td>
                <td><?php echo $row['alamat'] ?></td>
                <td><?php echo date('d-m-Y H:i', strtotime($row['tgl_daftar'])) ?></td>
                <td>
                  <form action="detail-calon-siswa.php" method="get">
                    <button class="btn btn-sm  btn-primary" name="calon_siswa_id" value="<?php echo $row['id'] ?>">
                      <i class="fas fa-pen fa-xs"></i>
                    </button>
                  </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
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
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap5.js"></script>
<script>
  $('#example').DataTable();
</script>
</body>
</html>
