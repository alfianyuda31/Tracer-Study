<!-- <?php
    include('../koneksi/koneksi.php');
    session_start();
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $_SESSION['nama'] = $nama;
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['level'] = $level;

    // var_dump($nama, $email, $username, $password, $level);
    // die();

        if (empty($nama)){
            header("Location:tambah_user.php?notif=tambahkosong&jenis=nama");
        }else if(empty($email)){
            header("Location:tambah_user.php?notif=tambahkosong&jenis=email");
        }else if(empty($username)){
            header("Location:tambah_user.php?notif=tambahkosong&jenis=username");
        }else if(empty($password)){
            header("Location:tambah_user.php?notif=tambahkosong&jenis=password");
        }else if(empty($level)){
            header("Location:tambah_user.php?notif=tambahkosong&jenis=level");
        }else{
            $sql = "INSERT INTO `admin` ( `nama`,`email`,`username`,`password`,`level`) 
            VALUES ('$nama', '$email', '$username', '$password', '$level')";
            mysqli_query($koneksi,$sql);
        
    unset($_SESSION['nama']);
    unset($_SESSION['email']);
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['level']);
    header("Location:user.php?notif=tambahberhasil");
    }
?> -->
