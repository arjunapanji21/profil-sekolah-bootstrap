<?php 
session_start();
if(!isset($_SESSION["admin"])) header("Location: ../../login-admin.php");

require_once('../../config.php');
$calon_siswa_id = $_GET["calon_siswa_id"];
$calon_siswa = $conn->query("SELECT * FROM calon_siswa LEFT JOIN pendaftaran ON calon_siswa.id = pendaftaran.calon_siswa_id WHERE calon_siswa.id='$calon_siswa_id'");
$calon_siswa = $calon_siswa->fetch_assoc();

if(isset($_POST['simpan'])){

  // filter data yang diinputkan
  $nisn = filter_input(INPUT_POST, 'nisn', FILTER_UNSAFE_RAW);
  $nama = filter_input(INPUT_POST, 'nama', FILTER_UNSAFE_RAW);
  $tempat_lahir = filter_input(INPUT_POST, 'tempat_lahir', FILTER_UNSAFE_RAW);
  $tgl_lahir = filter_input(INPUT_POST, 'tgl_lahir', FILTER_UNSAFE_RAW);
  $jk = filter_input(INPUT_POST, 'jk', FILTER_UNSAFE_RAW);
  $agama = filter_input(INPUT_POST, 'agama', FILTER_UNSAFE_RAW);
  $anak_ke = filter_input(INPUT_POST, 'anak_ke', FILTER_UNSAFE_RAW);
  $jml_saudara = filter_input(INPUT_POST, 'jml_saudara', FILTER_UNSAFE_RAW);
  $asal_sekolah = filter_input(INPUT_POST, 'asal_sekolah', FILTER_UNSAFE_RAW);
  $alamat_sekolah_asal = filter_input(INPUT_POST, 'alamat_sekolah_asal', FILTER_UNSAFE_RAW);
  $no_kk = filter_input(INPUT_POST, 'no_kk', FILTER_UNSAFE_RAW);
  $nik_ayah = filter_input(INPUT_POST, 'nik_ayah', FILTER_UNSAFE_RAW);
  $nama_ayah = filter_input(INPUT_POST, 'nama_ayah', FILTER_UNSAFE_RAW);
  $nik_ibu = filter_input(INPUT_POST, 'nik_ibu', FILTER_UNSAFE_RAW);
  $nama_ibu = filter_input(INPUT_POST, 'nama_ibu', FILTER_UNSAFE_RAW);
  $pekerjaan_ayah = filter_input(INPUT_POST, 'pekerjaan_ayah', FILTER_UNSAFE_RAW);
  $pekerjaan_ibu = filter_input(INPUT_POST, 'pekerjaan_ibu', FILTER_UNSAFE_RAW);
  $kategori_penghasilan = filter_input(INPUT_POST, 'kategori_penghasilan', FILTER_UNSAFE_RAW);
  $alamat = filter_input(INPUT_POST, 'alamat', FILTER_UNSAFE_RAW);
  $no_telp = filter_input(INPUT_POST, 'no_telp', FILTER_UNSAFE_RAW);
  $status = filter_input(INPUT_POST, 'status', FILTER_UNSAFE_RAW);
  $keterangan = filter_input(INPUT_POST, 'keterangan', FILTER_UNSAFE_RAW);

  $sql = "UPDATE calon_siswa SET nisn='$nisn', nama='$nama', tempat_lahir='$tempat_lahir', tgl_lahir='$tgl_lahir', jk='$jk', agama='$agama', anak_ke='$anak_ke', jml_saudara='$jml_saudara', asal_sekolah='$asal_sekolah', alamat_sekolah_asal='$alamat_sekolah_asal', no_kk='$no_kk', nik_ayah='$nik_ayah', nama_ayah='$nama_ayah', nik_ibu='$nik_ibu', nama_ibu='$nama_ibu', pekerjaan_ayah='$pekerjaan_ayah', pekerjaan_ibu='$pekerjaan_ibu', kategori_penghasilan='$kategori_penghasilan', alamat='$alamat', no_telp='$no_telp' WHERE id='$calon_siswa_id'";

  if ($conn->query($sql) === TRUE) {
      $sql = "UPDATE pendaftaran SET status='$status', keterangan='$keterangan' WHERE calon_siswa_id='$calon_siswa_id'";
      $conn->query($sql);
      $conn->close();
      header("Location: detail-calon-siswa.php?calon_siswa_id=".$calon_siswa_id);
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
      $conn->close();
      header("Location: detail-calon-siswa.php?calon_siswa_id=".$calon_siswa_id);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Detail Calon Siswa | MTs Mau'izhah</title>

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
            <a href="berita.php" class="nav-link">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Berita
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
              <li class="breadcrumb-item active">Detail Calon Siswa</li>
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
        <div class="col-md-2 mb-4">
            <?php if($calon_siswa['pasfoto'] != null) { ?>
              <img src="../../img/uploads/data_calon_siswa/<?php echo $calon_siswa['pasfoto'] ?>" class="bg-light p-2 shadow" width="100%">
            <?php } else { ?>
              <img src="../../img/no-picture.png" class="bg-light p-2 shadow" width="100%">
              <?php } ?>
          </div>
        <div class="col-md-10">
        <form action="" method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nisn" name="nisn" value="<?php echo $calon_siswa['nisn'] ?>" placeholder="NISN">
                        <label for="nisn">NISN</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $calon_siswa['nama'] ?>" placeholder="Nama">
                        <label for="nama">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <select class="form-select" id="jk" name="jk">
                            <option selected disabled>Pilih jenis kelamin:</option>
                            <option <?php if($calon_siswa['jk'] == 'Laki-laki') echo 'selected' ?> value="Laki-laki">Laki-laki</option>
                            <option <?php if($calon_siswa['jk'] == 'Perempuan') echo 'selected' ?> value="Perempuan">Perempuan</option>
                        </select>
                        <label for="jk">Jenis Kelamin</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?php echo $calon_siswa['tempat_lahir'] ?>" placeholder="Tempat Lahir">
                        <label for="tempat_lahir">Tempat Lahir</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?php echo $calon_siswa['tgl_lahir'] ?>" placeholder="Tanggal Lahir">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <select class="form-select" id="agama" name="agama">
                            <option selected disabled>Pilih agama:</option>
                            <option <?php if($calon_siswa['agama'] == 'Islam') echo 'selected' ?> value="Islam">Islam</option>
                            <option <?php if($calon_siswa['agama'] == 'Kristen') echo 'selected' ?> value="Kristen">Kristen</option>
                            <option <?php if($calon_siswa['agama'] == 'Protestan') echo 'selected' ?> value="Protestan">Protestan</option>
                            <option <?php if($calon_siswa['agama'] == 'Hindu') echo 'selected' ?> value="Hindu">Hindu</option>
                            <option <?php if($calon_siswa['agama'] == 'Buddha') echo 'selected' ?> value="Buddha">Buddha</option>
                            <option <?php if($calon_siswa['agama'] == 'Konghucu') echo 'selected' ?> value="Konghucu">Konghucu</option>
                        </select>
                        <label for="agama">Agama</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="anak_ke" name="anak_ke" value="<?php echo $calon_siswa['anak_ke'] ?>" placeholder="Anak Ke">
                        <label for="anak_ke">Anak Ke</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="jml_saudara" name="jml_saudara" value="<?php echo $calon_siswa['jml_saudara'] ?>" placeholder="Dari Berapa Saudara">
                        <label for="jml_saudara">Dari Berapa Saudara</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" value="<?php echo $calon_siswa['asal_sekolah'] ?>" placeholder="Sekolah Asal">
                        <label for="asal_sekolah">Sekolah Asal</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="alamat_sekolah_asal" name="alamat_sekolah_asal" value="<?php echo $calon_siswa['alamat_sekolah_asal'] ?>" placeholder="Alamat Sekolah Asal">
                        <label for="alamat_sekolah_asal">Alamat Sekolah Asal</label>
                    </div>
                </div>
                <div class="col-md-full">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="no_kk" name="no_kk" value="<?php echo $calon_siswa['no_kk'] ?>" placeholder="Nomor Kartu Keluarga">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="nik_ayah" name="nik_ayah" value="<?php echo $calon_siswa['nik_ayah'] ?>" placeholder="NIK Ayah">
                        <label for="nik_ayah">NIK Ayah</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="<?php echo $calon_siswa['nama_ayah'] ?>" placeholder="Nama Ayah">
                        <label for="nama_ayah">Nama Ayah</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" value="<?php echo $calon_siswa['pekerjaan_ayah'] ?>" placeholder="Pekerjaan Ayah">
                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="nik_ibu" name="nik_ibu" value="<?php echo $calon_siswa['nik_ibu'] ?>" placeholder="NIK Ibu">
                        <label for="nik_ibu">NIK Ibu</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="<?php echo $calon_siswa['nama_ibu'] ?>" placeholder="Nama Ibu">
                        <label for="nama_ibu">Nama Ibu</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" value="<?php echo $calon_siswa['pekerjaan_ibu'] ?>" placeholder="Pekerjaan Ibu">
                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="kategori_penghasilan" name="kategori_penghasilan">
                            <option selected disabled>Pilih rentang penghasilan:</option>
                            <option <?php if($calon_siswa['kategori_penghasilan'] == 'Rendah') echo 'selected' ?> value="rendah">< Rp. 2.000.000 per bulan</option>
                            <option <?php if($calon_siswa['kategori_penghasilan'] == 'Sedang') echo 'selected' ?> value="sedang">> Rp. 2.000.000 - Rp. 3.000.000 per bulan</option>
                            <option <?php if($calon_siswa['kategori_penghasilan'] == 'Tinggi') echo 'selected' ?> value="tinggi">> Rp. 3.000.000 - Rp. 4.000.000 per bulan</option>
                            <option <?php if($calon_siswa['kategori_penghasilan'] == 'Sangat Tinggi') echo 'selected' ?> value="sangat tinggi">> Rp. 4.000.000 per bulan</option>
                        </select>
                        <label for="kategori_penghasilan">Rentang Penghasilan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?php echo $calon_siswa['no_telp'] ?>" placeholder="Nomor HP/Whatsapp">
                        <label for="no_telp">Nomor HP/Whatsapp</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" style="height: 150px"><?php echo $calon_siswa['alamat'] ?>
                    </textarea>
                        <label for="alamat">Alamat Lengkap</label>
                    </div>
                </div>
                <?php if($calon_siswa['pasfoto'] == null) { ?>
                    <div class="col-md-12">
                    <div class="form-floating bg-light">
                        <input class="form-control" name="pasfoto" type="file" id="pasfoto">
                        <label for="pasfoto">Upload Pasfoto</label>
                    </div>
                </div>
                <?php } ?>
                <div class="col-md-12">
                    <div class="form-floating">
                        <select class="form-select" id="status" name="status">
                            <option selected disabled>Pilih status pendaftaran calon siswa:</option>
                            <option <?php if($calon_siswa['status'] == 'Proses') echo 'selected' ?> value="Proses">Proses</option>
                            <option <?php if($calon_siswa['status'] == 'Lulus') echo 'selected' ?> value="Lulus">Lulus</option>
                            <option <?php if($calon_siswa['status'] == 'Tidak Lulus') echo 'selected' ?> value="Tidak Lulus">Tidak Lulus</option>
                        </select>
                        <label for="status">Status Pendaftaran Calon Siswa</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan" style="height: 150px"><?php echo $calon_siswa['keterangan'] ?>
                    </textarea>
                        <label for="keterangan">Keterangan</label>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-floating bg-light">
                        <input class="form-control" name="pasfoto" type="file" id="pasfoto">
                        <label for="pasfoto">Upload Pasfoto Warna</label>
                    </div>
                </div> -->
                <div class="col-12 mb-4">
                    <div class="row" style="justify-content: space-between;">
                        <div class="col">
                            <a href="data-calon-siswa.php" class="me-2 my-2 py-2 btn btn-secondary" type="submit">Kembali</a>
                        </div>
                        <div class="col text-right">
                            <a onclick="return confirm('Hapus data calon siswa ini ?')" href="hapus-calon-siswa.php?id=<?php echo $calon_siswa['id'] ?>" class="me-2 my-2 py-2 btn btn-danger" type="submit">Hapus</a>
                            <button class="btn btn-primary me-2 my-2 py-2" type="submit" name="simpan" value="simpan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
