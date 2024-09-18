<!DOCTYPE html>
<html>
<head>
    <!-- Load file CSS Bootstrap offline -->
	
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<title><?php echo ucwords($data['level'])?> | Rumah Singgah Rey</title>
<meta content="" name="description">
<meta content="" name="keywords">
<link href="https://foants.gstatic.com" rel="preconnect">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">  
<link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.16/r-2.2.1/datatables.min.js">
<script src="../assets/js/jquery-3.4.0.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="assets/css/style.css">
<link rel="apple-touch-icon" sizes="180x180" href="assets/icon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/icon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/icon/favicon-16x16.png">
<link rel="manifest" href="assets/icon/site.webmanifest">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="assets_admin/js/bootstrap-datepicker.js"></script>
<link rel="stylesheet" href="assets_admin/css/datepicker.css">
</head>
<body>
<div class="container">
    <br>
    <h4>Pencarian Data Berdasarkan Tanggal</h4>

    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">

        <div class="form-group">
            <label>Tanggal Awal</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                <input id="tgl_mulai" placeholder="masukkan tanggal Awal" type="text" class="form-control datepicker" name="tgl_awal"  value="<?php if (isset($_POST['tgl_awal'])) echo $_POST['tgl_awal'];?>" >
            </div>
        </div>
        <div class="form-group">
            <label>Tanggal Akhir</label>
            <div class="input-group date">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
                <input id="tgl_akhir" placeholder="masukkan tanggal Akhir" type="text" class="form-control datepicker" name="tgl_akhir" value="<?php if (isset($_POST['tgl_akhir'])) echo $_POST['tgl_akhir'];?>">
            </div>
        </div>

        <script type="text/javascript">
            $(function(){
                $(".datepicker").datepicker({
                    format: 'dd-mm-yyyy',
                    autoclose: true,
                    todayHighlight: false,
                });
                $("#tgl_mulai").on('changeDate', function(selected) {
                    var startDate = new Date(selected.date.valueOf());
                    $("#tgl_akhir").datepicker('setStartDate', startDate);
                    if($("#tgl_mulai").val() > $("#tgl_akhir").val()){
                        $("#tgl_akhir").val($("#tgl_mulai").val());
                    }
                });
            });
        </script>
    <div class="form-group">
        <input type="submit" class="btn btn-info" value="Cari">
    </div>
    </form>

    <table class="table table-bordered table-hover">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Jurusan</th>
        </tr>
        </thead>
        <?php

        include "controller/config.php";
        if (isset($_POST['tgl_awal'])&& isset($_POST['tgl_akhir'])) {

            $tgl_awal=date('Y-m-d', strtotime($_POST["tgl_awal"]));
            $tgl_akhir=date('Y-m-d', strtotime($_POST["tgl_akhir"]));


            $sql="select * from mahasiswa where tanggal_lhr between '".$tgl_awal."' and '".$tgl_akhir."' order by nim asc";

        }else {
            $sql="select * from mahasiswa order by nim asc";
        }

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;
            ?>
            <tbody>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data["nim"]; ?></td>
                <td><?php echo $data["nama"];   ?></td>
                <td><?php echo $data["jenis_kelamin"];   ?></td>
                <td><?php echo date('d-m-Y', strtotime($data["tanggal_lhr"]));   ?></td>
                <td><?php echo $data["jurusan"];   ?></td>
               
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
</div>
</body>
</html>