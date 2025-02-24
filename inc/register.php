<?php

@session_start();
require_once 'function.php';
/*
//cek apakah sudah login sebagai admin
if (@$_SESSION['email']) {
    if (@!$_SESSION['level']== "Admin") {
        header("location:../inc/register.php");
    } else {
        if (@$_SESSION['level'] == "Petugas") {
            header("location:../petugas/index.php");        
        } elseif (@$_SESSION['level']== "Penyewa") {
            header("location:../penyewa/index.php"); 
        } elseif (@$_SESSION['level']== "Owner") {
            header("location:../owner/index.php"); 
        } elseif (@$_SESSION['level']== "Karyawan") {
            header("location:../karyawan/index.php"); 
        }
    }  
    } else {
        header("location:../inc/login.php");
    }
*/


//registrasi
if (isset($_POST["registrasi"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User baru berhasil ditambahkan!!!');
        document.location.href='login.php';
        </scrip>";
    } else {
        echo mysqli_error($KONEKSI);
    }
}




?>
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">





    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">

                                <a class="text-center" href="index.html">
                                    <h4>Register</h4>
                                </a>

                                <form method="post">
                                    <form class="mt-5 mb-5 login-input">
                                        <div class="form-group">
                                            <label for="inputName" class="">Username</label>
                                            <input type="hidden" name="id_user" class="form-control" value="<?php echo autonumber("tbl_auth", "auth_id", 6, "AUTH") ?>" require>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail" class="">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="">Password</label>
                                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputPassword" class="">Password</label>
                                            <input type="password" class="form-control" name="password2" placeholder="Repeat Password" required>
                                        </div>
                                        <button class="btn login-form__btn submit w-100" name="registrasi">Sign up</button>
                                    </form>
                                </form>
                                <p class="mt-5 login-form__footer">Have account <a href="login.php" class="text-primary">Login</a> now</p>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




    <!--**********************************
        Scripts
    ***********************************-->
    <script src="../assets/plugins/common/common.min.js"></script>
    <script src="../assets/js/custom.min.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/gleek.js"></script>
    <script src="../assets/js/styleSwitcher.js"></script>
</body>

</html>