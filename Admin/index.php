<!doctype html>
<html lang="en">

<?php
    include "include/head.php";
    $pages = "dashboard.php";
    require "./lib/database.php";
    $db = new Database();
    $p = "dashboard";
    if(isset($_GET['p'])){
        $p = $_GET['p'];
        switch($p){
            case "dashboard": {
                $pages = "dashboard.php";
                break;
            }
            case "category": {
                $pages = "category.php";
                break;
            }
            case "user": {
              $pages = "user.php";
              break;
            }
            case "payment": {
              $pages = "payment.php";
              break;
            }
            case "shipping": {
              $pages = "shipping.php";
              break;
            }
            case "product": {
              $pages = "product.php";
              break;
            }
            case "order": {
              $pages = "order.php";
              break;
            }
            case "order_items": {
              $pages = "order_items.php";
              break;
            }
        }
    }
?>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="./assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <?php include "include/slidebar.php"?>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
        <?php include "include/header.php"?>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <?php include "$pages"?>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="./assets/js/dashboard.js"></script>
</body>

</html>