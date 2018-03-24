<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'الصفحة الرئيسية';
include_once "layout/header.php";
include_once "php/check_authentication.php";
include_once "php/functions.php";
?>
<body class="fix-header card-no-border fix-sidebar">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">النيابة العامة</p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <?php
        include_once "layout/topbar.php";
        include_once "layout/sidebar.php";
        ?>
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="card">
                    <div class="card-header bg-info">
                        <h4 class="m-b-0 text-white">إحصائية لدفتر الحيازة لسنة <?php echo date('Y') ?></h4>
                    </div>
                    <div class="row">
                        <!-- Column -->
                        <div class="col-lg-4 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="align-self-center">
                                            <h2 class="text-muted m-t-10 m-b-0">إجمالي عدد قضايا الحيازة</h2>
                                            <h2 class="m-t-0">
                                                <?php
                                                $count_all_possession_query = mysqli_query($con,"SELECT
  Count(DISTINCT possession.possession_number, possession.possession_year) AS Count_possession_number
FROM
  possession
where possession.possession_year = YEAR(curdate())") or die(mysqli_error($con));
                                                $count_all_possession_info = mysqli_fetch_assoc($count_all_possession_query);
                                                echo $count_all_possession_info['Count_possession_number']
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-4 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="align-self-center">
                                            <h2 class="text-muted m-t-10 m-b-0">عدد قضايا الحيازة التي تم إنجازها</h2>
                                            <h2 class="m-t-0">
                                                <?php
                                                $count_done_possession_query = mysqli_query($con,"SELECT
  Count(DISTINCT possession.possession_number, possession.possession_year) AS Count_possession_number
FROM
  possession
WHERE
  possession.case_send_number > 0 AND possession.possession_year = YEAR(curdate())") or die(mysqli_error($con));
                                                $count_done_possession_info = mysqli_fetch_assoc($count_done_possession_query);
                                                echo $count_done_possession_info['Count_possession_number']
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-lg-4 col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex no-block">
                                        <div class="align-self-center">
                                            <h2 class="text-muted m-t-10 m-b-0">عدد قضايا الحيازة التي لم يتم إنجازها</h2>
                                            <h2 class="m-t-0">
                                                <?php
                                                $count_still_possession_query = mysqli_query($con,"SELECT
  Count(DISTINCT possession.possession_number, possession.possession_year) AS Count_possession_number
FROM
  possession
WHERE
  possession.case_send_number = 0 AND possession.possession_year = YEAR(curdate())") or die(mysqli_error($con));
                                                $count_still_possession_info = mysqli_fetch_assoc($count_still_possession_query);
                                                echo $count_still_possession_info['Count_possession_number'];
                                                ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                    <!-- Row -->
                    <div class="row">
                        <?php
                        include_once "layout/index_charts.php";
                        ?>
                    </div>
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <?php
            include_once "layout/footer.php";
            ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/plugins/gauge/gauge.min.js"></script>
    <script src="js/widget-data.js"></script>
    <!-- ============================================================== -->
</body>
</html>