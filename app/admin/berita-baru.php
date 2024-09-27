<?php 
session_start();
if(!isset($_SESSION["admin"])) header("Location: ../../login-admin.php");

require_once('../../config.php');
$data = $conn->query("SELECT * FROM berita");

if(isset($_POST['submit'])){
$admin_id = $_SESSION['admin']['id'];
$judul = $_POST['judul'];
$konten = $_POST['konten'];
$tanggal = date('Y-m-d');

$sql = "INSERT INTO berita (admin_id, judul, konten, tanggal) VALUES ('$admin_id', '$judul', '$konten', '$tanggal')";

$conn->query($sql);

if(isset($_FILES['sampul'])){
  $berita_id = $conn->insert_id;
  $ekstensi =  array('jpg','jpeg');
  $filename = $_FILES['sampul']['name'];
  $ukuran = $_FILES['sampul']['size'];
  $ext = pathinfo($filename, PATHINFO_EXTENSION);
   
  if(!in_array($ext,$ekstensi) ) {
    header("location:berita.php?alert=gagal_ekstensi");
  }else{
    if($ukuran < 1044070){		
      $sampul = $filename;
      move_uploaded_file($_FILES['sampul']['tmp_name'], '../../img/uploads/berita/'.$filename);
      $conn->query("UPDATE berita SET sampul='$sampul' WHERE id='$berita_id'");
      header("location:berita.php?alert=berhasil");
    }else{
      header("location:berita.php?alert=gagal_ukuran");
    }
  }
}
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buat Berita | MTs Mau'izhah</title>

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
            <a href="berita.php" class="nav-link active">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Berita
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
            <h1 class="m-0">Buat Berita</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Berita Baru</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content px-2">
      <div class="container-fluid">
        <form action="" method="post">
        <div class="row">
          <div class="mb-3">
            <label for="judul" class="form-label">Judul Berita</label>
            <input require type="text" class="form-control" id="judul" name="judul" placeholder="Ketikkan judul berita">
          </div>
          <div class="mb-3">
            <label for="konten" class="form-label">Isi Berita</label>
            <textarea class="form-control" id="konten" name="konten" rows="10"></textarea>
          </div>
          <div class="mb-3">
              <label for="sampul" class="form-label">Upload Sampul Berita</label>
              <input class="form-control" type="file" id="sampul" name="sampul" accept="image/jpeg, image/jpg">
            </div>
            <div class="mb-3" style="justify-content: space-between;">
              <a href="berita.php" class="btn btn-secondary">Kembali</a>
              <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            </div>
        </div>
        </form>
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
