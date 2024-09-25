<?php

require_once("config.php");

if(isset($_POST['register'])){

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

    $sql = "INSERT INTO calon_siswa (
        nisn,
        nama,
        tempat_lahir,
        tgl_lahir,
        jk,
        agama,
        anak_ke,
        jml_saudara,
        asal_sekolah,
        alamat_sekolah_asal,
        no_kk,
        nik_ayah,
        nama_ayah,
        nik_ibu,
        nama_ibu,
        pekerjaan_ayah,
        pekerjaan_ibu,
        kategori_penghasilan,
        alamat,
        no_telp
    )
    VALUES (
        '$nisn',
        '$nama',
        '$tempat_lahir',
        '$tgl_lahir',
        '$jk',
        '$agama',
        '$anak_ke',
        '$jml_saudara',
        '$asal_sekolah',
        '$alamat_sekolah_asal',
        '$no_kk',
        '$nik_ayah',
        '$nama_ayah',
        '$nik_ibu',
        '$nama_ibu',
        '$pekerjaan_ayah',
        '$pekerjaan_ibu',
        '$kategori_penghasilan',
        '$alamat',
        '$no_telp'
    )";

    if ($conn->query($sql) === TRUE) {
        $calon_siswa_id = $conn->insert_id;
        $sql = "INSERT INTO pendaftaran (
            calon_siswa_id,
            status,
            keterangan
        )
        VALUES (
            '$calon_siswa_id',
            'Proses',
            'Lengkapi Berkas'
        )";
        $conn->query($sql);
        echo "New record created successfully";
        $conn->close();
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        $conn->close();
        die();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MTs Mau'izhah</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php include 'head.php'; ?>
</head>

<body>
    
    <?php include 'navbar.php'; ?>


    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Pendaftaran Siswa Baru</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Registration</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Form Start -->
    <div class="container-xxl py-5">
        <form action="" method="post">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nisn" name="nisn" placeholder="NISN">
                        <label for="nisn">NISN</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama">
                        <label for="nama">Nama Lengkap</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="jk" name="jk">
                            <option selected disabled>Pilih jenis kelamin:</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <label for="jk">Jenis Kelamin</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir">
                        <label for="tempat_lahir">Tempat Lahir</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="Tanggal Lahir">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="agama" name="agama">
                            <option selected disabled>Pilih agama:</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Protestan">Protestan</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Konghucu">Konghucu</option>
                        </select>
                        <label for="agama">Agama</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="anak_ke" name="anak_ke" placeholder="Anak Ke">
                        <label for="anak_ke">Anak Ke</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="jml_saudara" name="jml_saudara" placeholder="Dari Berapa Saudara">
                        <label for="jml_saudara">Dari Berapa Saudara</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" placeholder="Sekolah Asal">
                        <label for="asal_sekolah">Sekolah Asal</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="alamat_sekolah_asal" name="alamat_sekolah_asal" placeholder="Alamat Sekolah Asal">
                        <label for="alamat_sekolah_asal">Alamat Sekolah Asal</label>
                    </div>
                </div>
                <div class="col-md-full">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="no_kk" name="no_kk" placeholder="Nomor Kartu Keluarga">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="nik_ayah" name="nik_ayah" placeholder="NIK Ayah">
                        <label for="nik_ayah">NIK Ayah</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Nama Ayah">
                        <label for="nama_ayah">Nama Ayah</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="nik_ibu" name="nik_ibu" placeholder="NIK Ibu">
                        <label for="nik_ibu">NIK Ibu</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Nama Ibu">
                        <label for="nama_ibu">Nama Ibu</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="pekerjaan_ayah" name="pekerjaan_ayah" placeholder="Pekerjaan Ayah">
                        <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="pekerjaan_ibu" name="pekerjaan_ibu" placeholder="Pekerjaan Ibu">
                        <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <select class="form-select" id="kategori_penghasilan" name="kategori_penghasilan">
                            <option selected disabled>Pilih rentang penghasilan:</option>
                            <option value="Rendah">< Rp. 2.000.000 per bulan</option>
                            <option value="Sedang">> Rp. 2.000.000 - Rp. 3.000.000 per bulan</option>
                            <option value="Tinggi">> Rp. 3.000.000 - Rp. 4.000.000 per bulan</option>
                            <option value="Sangat Tinggi">> Rp. 4.000.000 per bulan</option>
                        </select>
                        <label for="kategori_penghasilan">Rentang Penghasilan</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor HP/Whatsapp">
                        <label for="no_telp">Nomor HP/Whatsapp</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Alamat" id="alamat" name="alamat" style="height: 150px"></textarea>
                        <label for="alamat">Alamat Lengkap</label>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <div class="form-floating bg-light">
                        <input class="form-control" name="pasfoto" type="file" id="pasfoto">
                        <label for="pasfoto">Upload Pasfoto Warna</label>
                    </div>
                </div> -->
                <div class="col-12">
                    <button class="btn btn-primary w-100 py-3" type="submit" name="register" value="register">Kirim</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Form End -->


    <?php include 'footer.php'; ?>
</body>

</html>