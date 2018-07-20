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
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h3 class="card-title m-b-5"><span class="lstick"></span>إحصائية لدفتر حصر التحقيق لسنة <?php echo date('Y') ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="p-20 active text-center bg-info">
                                    <h4 class="text-white">ما تم حصره</h4>
                                    <h3 class="text-white m-b-0">
                                        <?php
                                        $all_case_has_investigation = mysqli_query($con,"SELECT
Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS Count_id_case_has_investigation
FROM
  case_has_investigation
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0");
                                        $all_case_has_investigation = mysqli_fetch_assoc($all_case_has_investigation);

                                        echo $all_case_has_investigation['Count_id_case_has_investigation'];
                                        ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="p-20 active text-center bg-success">
                                    <h4 class="text-white">ما تم إنجازه</h4>
                                    <h3 class="text-white m-b-0">
                                        <?php
                                        $done_case_has_investigation = mysqli_query($con,"SELECT
Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS Count_id_case_has_investigation
FROM
  case_has_investigation
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  case_has_investigation.case_status_idcase_status = 1");
                                        $done_case_has_investigation = mysqli_fetch_assoc($done_case_has_investigation);

                                        echo $done_case_has_investigation['Count_id_case_has_investigation'];
                                        ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="p-20 active text-center bg-warning">
                                    <h4 class="text-white">ما لم يتم إنجازه</h4>
                                    <h3 class="text-white m-b-0">
                                        <?php
                                        $undone_case_has_investigation = mysqli_query($con,"SELECT
  Coalesce(Count(DISTINCT case_has_investigation.id_case_has_investigation), 0) AS Count_id_case_has_investigation
FROM
  case_has_investigation
WHERE
  case_has_investigation.status = 1 AND
  case_has_investigation.deleted = 0 AND
  case_has_investigation.case_status_idcase_status = 2");
                                        $undone_case_has_investigation = mysqli_fetch_assoc($undone_case_has_investigation);

                                        echo $undone_case_has_investigation['Count_id_case_has_investigation'];
                                        ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div>
                                <h3 class="card-title m-b-5"><span class="lstick"></span>إحصائية لدفتر حصر التحقيق لسنة <?php echo date('Y') ?> مصنفه بالتهم</h3>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div id="chart5" dir="ltr"></div>
                                    عدد التهم : <?php
                                    $query = "SELECT
  Count(case_has_investigation_has_charges.case_has_investigation_has_charges_id) AS Count_charges,
  charges.name
FROM
  case_has_investigation_has_charges
  LEFT JOIN charges ON case_has_investigation_has_charges.charges_id_charges = charges.id_charges
GROUP BY
  charges.name,
  charges.id_charges";
                                    $results=mysqli_query($con, $query);
                                    $all_charges = 0;
                                    while($y = mysqli_fetch_assoc($results)) {
                                        $all_charges= $all_charges + $y['Count_charges'];
                                    }
                                    echo $all_charges
                                    ?>
                                </div>
                            </div>
                        </div>
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
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Chart JS -->
    <script src="assets/plugins/c3-master/c3.min.js"></script>
    <script src="assets/plugins/d3/d3.min.js"></script>
    <!-- ============================================================== -->
    <script>
        var chart = c3.generate({
            bindto: "#chart5",
            data: {
                columns: [
                    <?php
                    $query = "SELECT
  Count(case_has_investigation_has_charges.case_has_investigation_has_charges_id) AS Count_charges,
  charges.name
FROM
  case_has_investigation_has_charges
  LEFT JOIN charges ON case_has_investigation_has_charges.charges_id_charges = charges.id_charges
GROUP BY
  charges.name,
  charges.id_charges";
                    $results=mysqli_query($con, $query);
                    while($y = mysqli_fetch_assoc($results)) {
                        echo "['".$y['name']."','".$y['Count_charges']."'],";
                    }
                    ?>

                ],
                type: 'donut',
                empty: {
                    label: {
                        text: "No Data Available"
                    }
                }
            },
            donut: {
                label: {
                    format: function(value, ratio, id) {
                        return value;
                    }
                }
            }
        });
    </script>

</body>
</html>