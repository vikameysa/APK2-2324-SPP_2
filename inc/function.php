<?php
//set waktu
date_default_timezone_set('Asia/Jakarta');
$tgl = date('Y-m-d H:i:s');

//koneksi Database
$HOSTNAME = "localhost";
$DATABASE = "db_apk2_spp";
$USERNAME = "root";
$PASSWORD = "";

$KONEKSI = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

if (!$KONEKSI) {
    die("Koneksi database error broo....!!!" . mysqli_connect_error($KONEKSI));
}

//fungsi autonumber
function autonumber($tabel, $kolom, $lebar = 0, $awalan)
{
    global $KONEKSI;

    $auto = mysqli_query($KONEKSI, "SELECT $kolom FROM $tabel ORDER BY $kolom desc Limit 1") or die(mysqli_error($KONEKSI));
    $jumlah_record = mysqli_num_rows($auto);

    if ($jumlah_record == 0) {
        $nomor = 1;
    } else {
        $row = mysqli_fetch_array($auto);
        $nomor = intval(substr($row[0], strlen($awalan))) + 1;
    }

    if ($lebar > 0) {
        $angka = $awalan . str_pad($nomor, $lebar, "0", STR_PAD_LEFT);
    } else {
        $angka = $awalan . $nomor;
    }
    return $angka;
}
// echo autonumber ("tbl_users","id_user",3,"USR");


// fungsi register
function registrasi($data)
{
    global $KONEKSI;
    global $tgl;

    $id_user = stripslashes($data['id_user']);
    $nama = stripslashes($data['name']); // untuk cek form register dari input nama
    $email = strtolower(stripslashes($data['email'])); // memastikan form register menigirim input email hruf kecil semua
    $password = mysqli_real_escape_string($KONEKSI, $data['password']);
    $password2 = mysqli_real_escape_string($KONEKSI, $data['password2']);

    // echo $nama."|".$email."|".$password."|".$password2;

    //cek email yang di input ada belum di database
    $result = mysqli_query($KONEKSI, "SELECT email from tbl_auth WHERE email='$email'");
    // var_dump ($result);

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
    alert('Email yang di input sudah ada di database!!!');
    </script>";
        return false;
    }
    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
    alert('konfirmasi password tidak sesuai!!!');
    document.location.href='register.php'
    </script>";
        return false;
    }

    // enkripsi password yang akan kita masukkan ke database
    $password_hash = password_hash($password, PASSWORD_DEFAULT); //menggunakan algoritma default dari hash
    // var_dump($password_hash);




    // tambah user baru ke tbl_auth
    $sql_admin = "INSERT INTO tbl_auth SET
    auth_id = '$id_user',
    password = '$password_hash',
    email = '$email',
    role = 'Admin',
    create_at = '$tgl'";

    mysqli_query($KONEKSI, $sql_admin) or die("gagal menambahkan user" . mysqli_error($KONEKSI));

    // tambah user baru ke tbl_user
    $sql_user = "INSERT INTO tbl_user SET
    auth_id = '$id_user',
    nama_user = '$nama',
    create_at = '$tgl'";

    mysqli_query($KONEKSI, $sql_user) or die("gagal menambahkan user" . mysqli_error($KONEKSI));

    echo "<script>
    document.location.href='login.php'
    </script>";

    return mysqli_affected_rows($KONEKSI);
}

function tampil($DATA)
{
    global $KONEKSI;

    $HASIL = mysqli_query($KONEKSI, $DATA);
    $data = []; //menyiapkan variabel/wadah yg masih kosong untuk nantinya akan kita gunakan untuk menyimpan data yg kita query/panggil dari database

    while ($row = mysqli_fetch_assoc($HASIL)) {
        $data[] = $row; //kita masukan datanya disini
    }
    return $data; //kita kembalikan nilainya ,di munculkan
}
?>