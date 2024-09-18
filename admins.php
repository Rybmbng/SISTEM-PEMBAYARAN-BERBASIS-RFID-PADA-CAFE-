<?php 
// error_reporting(0);
include 'controller/config.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include './template/style.php'; ?>
  </head>
  <body>
  <?php include './template/navbar.php'; ?>

  <?php include './controller/pageadmin.php'; ?>

  <!-- ======= Footer ======= -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets_admin/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets_admin/vendor/chart.js/chart.umd.js"></script>
  <script src="assets_admin/vendor/echarts/echarts.min.js"></script>
  <script src="assets_admin/vendor/quill/quill.min.js"></script>
  <script src="assets_admin/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets_admin/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets_admin/vendor/php-email-form/validate.js"></script>
  <!-- Template Main JS File -->
  <script src="assets_admin/js/main.js"></script>
</body>

</html>