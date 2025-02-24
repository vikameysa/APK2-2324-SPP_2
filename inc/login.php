<?php
session_start();
require_once 'function.php';

// cek session
if (@$_SESSION['email']) {
  if (@$_SESSION['level']=="Admin") {
     header("location:../admin/index.php");
  } elseif (@$_SESSION['level']=="Petugas") {
      header("location:../petugas/index.php");
    } elseif (@$_SESSION['level']=="Penyewa") {
      header("location:../penyewa/index.php");
    } elseif (@$_SESSION['level']=="Owner") {
      header("location:../owner/index.php");
    } elseif (@$_SESSION['level']=="Karyawan") {
      header("location:../karyawan/index.php");
    }  
  }    
  
// cek login

// Jika tombol Signin (Login) ditekan, maka akan mengirim variabel yang ada form login yaitu usename (email) dan password

if (isset($_POST['login'])) {
  $email = strtolower(stripslashes($_POST['email'])); // email di input oleh user
  $userpass = mysqli_real_escape_string($KONEKSI,$_POST['password']); //password yang di input oleh user
  //lalu kita query ke database
  
$sql= mysqli_query($KONEKSI,"SELECT password, role FROM tbl_auth WHERE email='$email'");


list($paswd,$level) = mysqli_fetch_array($sql);

// jika data ditemukan dalama database, maka akan melakukan proses validasi dengan manggunakan password_verify

if (mysqli_num_rows($sql)>0) {

  /* juka ada data (>0) maka kita laukakan validasi
  $userpass ==> diambil dari form input yang dilakukan oleh user
  $passwd ==> password yang ada di database dalam bentuk HARI
  */ 
  if (password_verify($userpass, $paswd)) {
    // akan kita buat session 
    
    $_SESSION['email'] = $email;
    $_SESSION['level'] = $level;
    

/*
jika berhasil login, maka user akan kita arahkan halaman admin sesuai dengan level user
jika dia level admin ==> admin/index.php
jika dia level petugas ==> petugas/index.php
jika dia level penyewa ==> penyewa/index.php
*/

if ($_SESSION['level']=="Admin") {
  header("location:../admin/index.php");
} elseif ($_SESSION['level']=="Petugas") {
  header("location:../petugas/index.php");
} elseif ($_SESSION['level']=="Penyewa") {
  header("location:../penyewa/index.php");
}
  } else {
    echo '<script language="javascript">
    window.alert("LOGIN gagal..! Email/Password salah");
    document.location.href="login.php";
    </script>';
  }
} else {
  echo '<script language="javascript">
    window.alert("LOGIN gagal..! Email tidak ditemukan");
    document.location.href="login.php";
    </script>';
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
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
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
                                    <h4>Login</h4>
                                </a>

                                <form method="post">
                                    <form class="mt-5 mb-5 login-input">
                                        <div class="form-group">
                                        <label for="inputEmail" class="">Email</label>
                                            <input type="email" id="inputEmail" class="form-control mb-4" placeholder="Login" name="email" require>
                                        </div>
                                        <div class="form-group">
                                        <label for="inputPassword" class="">Password</label>
                                            <input type="password" id="inputPassword" class="form-control mb-5" placeholder="Password" name="password" require>
                                        </div>
                                        

                                        <button class="btn login-form__btn submit w-100" name="login">Sign In</button>
                                    </form>
                                </form>
                                <p class="mt-5 login-form__footer">Dont have account? <a href="register.php" class="text-primary">Register</a> now</p>
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

    <!--- END GLOBAL MANDATORY SCRIPTS ----->
    <script type="text/javascript">
        function tipeUser(val) {
            if (val != '') {
                if (val == '1') {
                    $("#x_branch").show();
                } else {
                    $("#x_branch").hide();
                }
            } else {
                $("#x_brach").hide();
            }
        }
    </script>
</body>

</html>