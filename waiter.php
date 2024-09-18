<?php 
error_reporting(0);
session_start();

include 'controller/config.php';  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include_once 'template/style.php' ?>
  </head>
  <body>
    <div class="container-scroller"> 
      <?php include_once 'template_waiter/navbar.php'; ?>
      <div class="container-fluid page-body-wrapper">
        <?php include_once 'template_waiter/sidebar.php'; ?>
        <div class="main-panel">
          <div class="content-wrapper">
          <?php include './controller/pagewaiter.php'; ?>
          </div>
          <footer class="footer">
            <div class="container-fluid d-flex justify-content-between">
              <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Copyright © 2023</span>
              <span class="float-none float-sm-end mt-1 mt-sm-0 text-end"> <b>Rumah</b> Singgah</span>
            </div>
          </footer>
        </div>
       </div>
    </div>


    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/todolist.js"></script>
 </body>
</html>