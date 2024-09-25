<?php 

require_once("config.php");

if(isset($_POST['login'])){

    // filter data yang diinputkan
    $username = filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    $sql = "SELECT * FROM kepala_sekolah WHERE username='$username'";
    $result = $conn->query($sql);
    $kepsek = $result->fetch_assoc();
    if ($kepsek > 0) {
        // verifikasi password
        if(password_verify($password, $kepsek["password"])){
            // buat Session
            session_start();
            $_SESSION["kepala_sekolah"] = $kepsek;
            // login sukses, alihkan ke halaman timeline
            $conn->close();
            header("Location: app/kepala-sekolah/dashboard.php");
        }else{
            header("Location: login-kepala-sekolah.php");
        }
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
                    <h1 class="display-3 text-white animated slideInDown">Login Kepala Sekolah</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Sign In</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Form Start -->
    <div class="container-xxl py-5">
        <form action="" method="POST">
            <div class="row g-3">
                <div class="col-5">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="username" name="username" require placeholder="Username">
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="col-5">
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" name="password" require placeholder="Password">
                        <label for="password">Password</label>
                    </div>
                </div>
                <div class="col-2">
                    <button class="btn btn-primary w-100 py-3" type="submit" name="login" value="login">Masuk</button>
                </div>
            </div>
        </form>
    </div>
    <!-- Form End -->


    <?php include 'footer.php'; ?>
</body>

</html>