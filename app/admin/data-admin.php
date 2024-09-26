<?php 
session_start();
if(!isset($_SESSION["admin"])) header("Location: ../../login-admin.php");

require_once('../../config.php');
$data = $conn->query("SELECT * FROM admin");

if(isset($_POST['simpan'])){
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $alamat = $_POST['alamat'];
  $telp = $_POST['telp'];

  $sql = "UPDATE admin SET nama='$nama', email='$email', alamat='$alamat', telp='$telp' WHERE username='$username'";

  if (mysqli_query($conn, $sql)) {
    $_SESSION['alert'] = "Data admin berhasil di Update!";
    header("Location: data-admin.php");
  } else {
    $_SESSION['alert'] = "Error updating record: " . mysqli_error($conn);
    header("Location: data-admin.php");
  }

  if(isset($_POST['password']) && $_POST['password'] != null){
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE admin SET password='$password' WHERE username='$username'";

    if (mysqli_query($conn, $sql)) {
      $_SESSION['alert'] = "Data admin berhasil di Update!";
      header("Location: data-admin.php");
    } else {
      $_SESSION['alert'] = "Error updating record: " . mysqli_error($conn);
      header("Location: data-admin.php");
    }
  }

  mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Admin | MTs Mau'izhah</title>

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
            <a href="data-admin.php" class="nav-link active">
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
            <h1 class="m-0">Data Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Data Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row m-2 p-2 bg-light shadow-sm">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Tgl. Dibuat</th>
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
                <td><?php echo $row['username'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo date('d-m-Y H:i', strtotime($row['tgl_dibuat'])) ?></td>
                <td>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $row['username']?>">
                      <i class="fas fa-pen fa-xs"></i>
                    </button>
                    <!-- Modal -->
                      <form action="" method="post">
                      <div class="modal fade" id="<?php echo $row['username']?>" tabindex="-1" aria-labelledby="<?php echo $row['username']?>Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="<?php echo $row['username']?>Label">Edit Data Admin</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <div class="col-12 my-2">
                                  <div class="form-floating">
                                      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama'] ?>" placeholder="Nama">
                                      <label for="nama">Nama</label>
                                  </div>
                              </div>
                            <div class="col-12 my-2">
                                  <div class="form-floating">
                                      <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email'] ?>" placeholder="email">
                                      <label for="email">Email</label>
                                  </div>
                              </div>
                            <div class="col-12 my-2">
                                  <div class="form-floating">
                                      <input readonly type="username" class="form-control" id="username" name="username" value="<?php echo $row['username'] ?>" placeholder="username">
                                      <label for="username">Username</label>
                                  </div>
                              </div>
                            <div class="col-12 my-2">
                                  <div class="form-floating">
                                      <input type="alamat" class="form-control" id="alamat" name="alamat" value="<?php echo $row['alamat'] ?>" placeholder="alamat">
                                      <label for="alamat">Alamat</label>
                                  </div>
                              </div>
                            <div class="col-12 my-2">
                                  <div class="form-floating">
                                      <input type="telp" class="form-control" id="telp" name="telp" value="<?php echo $row['telp'] ?>" placeholder="telp">
                                      <label for="telp">Telepon</label>
                                  </div>
                              </div>
                            <div class="col-12 my-2">
                                  <div class="form-floating">
                                      <input type="password" class="form-control" id="password" name="password" placeholder="password">
                                      <label for="password">Password</label>
                                  </div>
                              </div>
                            </div>
                            <div class="modal-footer" style="justify-content: space-between;">
                              <a onclick="return confirm('Hapus data admin ini?')" type="button" class="btn btn-danger">Hapus</a>
                              <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan</button>
                            </div>
                          </div>
                        </div>
                      </div>
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
