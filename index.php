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
  possession") or die(mysqli_error($con));
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
  possession.case_send_number > 0") or die(mysqli_error($con));
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
  possession.case_send_number = 0") or die(mysqli_error($con));
                                            $count_still_possession_info = mysqli_fetch_assoc($count_still_possession_query);
                                            echo $count_still_possession_info['Count_possession_number']
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
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex no-block">
                                    <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img src="assets/images/icon/income.png" alt="Income" /></div>
                                    <div class="align-self-center">
                                        <h6 class="text-muted m-t-10 m-b-0">Total Income</h6>
                                        <h2 class="m-t-0">953,000</h2></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3>40%</h3>
                                        <h6 class="card-subtitle">Pending Product</h6></div>
                                    <div class="col-12">
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 40%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3>56%</h3>
                                        <h6 class="card-subtitle">Product A</h6></div>
                                    <div class="col-12">
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 56%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <h3>26%</h3>
                                        <h6 class="card-subtitle">Product B</h6></div>
                                    <div class="col-12">
                                        <div class="progress">
                                            <div class="progress-bar bg-inverse" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-info text-center">
                                <h1 class="font-light text-white">2,064</h1>
                                <h6 class="text-white">Sessions</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-primary text-center">
                                <h1 class="font-light text-white">1,738</h1>
                                <h6 class="text-white">Users</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-success text-center">
                                <h1 class="font-light text-white">5963</h1>
                                <h6 class="text-white">Page Views</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-dark text-center">
                                <h1 class="font-light text-white">2.9s</h1>
                                <h6 class="text-white">Pages/Session</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-megna text-center">
                                <h1 class="font-light text-white">1.5s</h1>
                                <h6 class="text-white">Avg. Session</h6>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card">
                            <div class="box bg-warning text-center">
                                <h1 class="font-light text-white">10%</h1>
                                <h6 class="text-white">Bounce Rate</h6>
                            </div>
                        </div>
                    </div>
                </div>
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