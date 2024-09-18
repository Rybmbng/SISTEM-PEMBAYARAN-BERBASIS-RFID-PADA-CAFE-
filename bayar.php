<?php
session_start();
error_reporting(0);
include_once 'controller/config.php';
if(isset($_POST['checkout'])) {
}
?>
 
 <?php if(@$_SESSION['berhasil']){ ?>
        <script>
            swal({
            title: "ALERT",
            text: "<?php echo $_SESSION['berhasil']; ?>",
            text: "Kembalian Rp.<?php echo $kembalian ?>",
            icon: "success"
            });
        </script>
<?php 
unset($_SESSION['berhasil']); 
} ?>
<!DOCTYPE html>
<html>
<head>
    <title>Halaman Menarik</title>
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
        }
        header {
            height: 400px;
            background-image: url('assets/bg.jpg'); /* Ganti 'path/header_background.jpg' dengan URL gambar menarik untuk header */
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            position: relative; /* Diperlukan untuk efek paralaks */
        }
        .logo {
            margin-bottom: 40px;
        }
        .logo img {
            max-height: 120px;
        }
        .container {
            padding: 40px;
            text-align: center;
            color: #333;
        }
        a {
            text-decoration : none;
            font-size : 15px;
            font-weight : bold;
        }
        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        li {
            margin: 10px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            min-width: 200px;
            max-width: 250px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="assets/icon/banner.png" alt="Logo"> <!-- Ganti 'path/logo.png' dengan URL logo Anda -->
            <h1>Pembayaran Digital Berbasis E-Money</h1>

        </div>
        <h1></h1>
    </header>
    <div class="container">
        <h3>Daftar Pelanggan Yang Belum Membayar</h3>
                      
        <ul>
        <?php
                                     $no = 1;
                                     $sql = mysqli_query($conn,"SELECT *FROM transaksi WHERE status='dinikmati'");
                                     while ($data = mysqli_fetch_array($sql)){  
                                     $username = $data['username'];
                                     $sqld = mysqli_query($conn,"SELECT *FROM tb_user WHERE username='$username'");
                                     $datas = mysqli_fetch_array($sqld);
                                     ?>
                 <a class="btn btn-primary" href="detail.php?id=<?php echo $data['kd_transaksi']?>">     
            <li style="display:flex;justify-content:center;align-items:center">
            <img src="assets/profile/<?php echo $datas['gambar'] ?>" style="height:40px;width:40px;" class="rounded"alt="" />
            
            </li>
            <?php echo ucwords($datas['nama_lengkap'])?>
            </a>
            <?php } ?>
        </ul>
        
    </div>

    <script>
        // Efek paralaks pada header
        window.addEventListener('scroll', function() {
            var header = document.querySelector('header');
            var yPos = -window.scrollY / 2;
            header.style.backgroundPositionY = yPos + 'px';
        });
    </script>
</body>
</html>
