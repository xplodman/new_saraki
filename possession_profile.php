<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'حيازة';
include_once "layout/header.php";
include_once "php/check_authentication.php";
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
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-10 align-self-center">
                    <h3 class="text-themecolor">دفتر / حيازة</h3>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- search form -->
            <!-- ============================================================== -->
            <?php
                $possession_query="
SELECT
`case`.id,
possession.case_receive_date,
possession.completion_send_date,
possession.completion_delegate,
possession.completion_receive_date,
possession.prosecution_decision,
possession.case_send_date,
possession.id AS possession_id,
possession.case_send_number,
main_ledger.id AS main_ledger_id,
main_ledger.name AS main_ledger_name,
depart.id AS depart_id,
depart.name AS depart_name,
subject.name AS subject_name,
subject.id AS subject_id,
prosecutor.id AS prosecutor_id,
prosecutor.name AS prosecutor_name,
possession.possession_number,
possession.possession_year,
`case`.case_number,
`case`.case_year,
`case`.id AS case_id
FROM
`case`
INNER JOIN case_has_possession ON `case`.id = case_has_possession.case_id
INNER JOIN possession ON case_has_possession.possession_possession_number = possession.possession_number AND
case_has_possession.possession_possession_year = possession.possession_year
INNER JOIN depart ON `case`.depart_id = depart.id
INNER JOIN main_ledger ON `case`.main_ledger_id = main_ledger.id
INNER JOIN subject ON possession.subject_id = subject.id
INNER JOIN prosecutor ON possession.prosecutor_id = prosecutor.id
LEFT JOIN person_has_case ON `case`.id = person_has_case.case_id
INNER JOIN person ON person_has_case.person_id = person.id
WHERE
`case`.deleted = 0 AND
`case`.status = 1 AND
possession.status = 1 AND
possession.deleted = 0 AND
depart.status = 1 AND
depart.deleted = 0 AND
main_ledger.status = 1 AND
main_ledger.deleted = 0 AND
possession.id = $_GET[id]
ORDER BY
possession.possession_year DESC ,
possession.possession_number DESC 
LIMIT 100";?>
            <!-- ============================================================== -->
            <!-- end of search form -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <a class="collapse-link" data-toggle="collapse" data-target="#search">
                            <div class="card-header bg-info">
                                <h4 class="m-b-0 text-white">تفاصيل السجل</h4>
                            </div>
                        </a>
                        <div class="card-body">
                                <?php
                                $result = mysqli_query($con, $possession_query);
                                $possession_info = mysqli_fetch_assoc($result);
                                ?>
                            <form method="post" action="php/edit_possession_record.php?id=<?php echo $_GET['id']; ?>">

                                <input type="hidden" name="possession_id" id="possession_id" value="<?php echo $possession_info['possession_id']; ?>">
                                <input type="hidden" name="case_id" id="case_id" value="<?php echo $possession_info['case_id']; ?>">

                                <div class="form-body">
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-md-1 col-form-label">رقم الحيازة</label>
                                        <div class="col-md-3">
                                            <label class="col-md-12 col-form-label">الرقم</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')" type="number" name="possession_number" id="possession_number" class="form-control" placeholder="رقم" value="<?php echo $possession_info['possession_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="col-md-12 col-form-label">السنة</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')"type="number" name="possession_year" id="possession_year" class="form-control" placeholder="سنة" value="<?php echo $possession_info['possession_year']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-search-input" class="col-md-1 col-form-label">رقم القضية</label>
                                        <div class="col-md-3">
                                            <label class="col-md-12 col-form-label">الرقم</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')" type="number" name="case_number" id="case_number" class="form-control" placeholder="رقم" value="<?php echo $possession_info['case_number']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="col-md-12 col-form-label">السنة</label>
                                            <div class="form-group has-danger">
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')" type="number" name="case_year" id="case_year" class="form-control" placeholder="سنة" value="<?php echo $possession_info['case_year']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="col-md-12 col-form-label">الجدول</label>
                                                <select required name="main_ledger" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected>جدول</option>
                                                    <?php
                                                    $query = "SELECT * FROM main_ledger";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $main_ledger){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($main_ledger)) {
                                                                if((int)$possession_info['main_ledger_id'] == (int)$main_ledger['id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $main_ledger["id"];?>"><?php echo $main_ledger["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="col-md-12 col-form-label">القسم</label>
                                                <select required name="depart" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected>القسم</option>
                                                    <?php
                                                    $query = "SELECT * FROM depart";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $depart){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($depart)) {
                                                                if((int)$possession_info['depart_id'] == (int)$depart['id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $depart["id"];?>"><?php echo $depart["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group has-danger">
                                                <label class="control-label">تاريخ الورود</label>
                                                <input required oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')"type="text" name="receive_date" id="receive_date" class="form-control date_autoclose" value="<?php
                                                if ($possession_info['case_receive_date']>1){
                                                    echo date("j/n/Y", strtotime($possession_info['case_receive_date']));
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-danger">
                                                <label class="control-label">موضوع التنازع</label>
                                                <select required name="subject" oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')"class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected></option>
                                                    <?php
                                                    $query = "SELECT * FROM subject";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $subject){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($subject)) {
                                                                if((int)$possession_info['subject_id'] == (int)$subject['id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $subject["id"];?>"><?php echo $subject["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group has-danger">
                                                <label class="control-label">أسم العضو المعروض عليه القضية</label>
                                                <select required name="prosecutor" oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')"class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                    <option value="" disabled selected></option>
                                                    <?php
                                                    $query = "SELECT * FROM prosecutor";
                                                    $results=mysqli_query($con, $query);
                                                    //loop
                                                    foreach ($results as $prosecutor){
                                                        ?>
                                                        <option
                                                            <?php
                                                            if (!empty($prosecutor)) {
                                                                if((int)$possession_info['prosecutor_id'] == (int)$prosecutor['id']){
                                                                    echo 'selected';
                                                                }
                                                            }
                                                            ?>
                                                            value="<?php echo $prosecutor["id"];?>"><?php echo $prosecutor["name"];?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group has-success">
                                                <label class="control-label">تاريخ قرار الإستيفاء</label>
                                                <input type="text" name="completion_send_date" class="form-control date_autoclose" value="<?php
                                                if ($possession_info['completion_send_date']>1){
                                                    echo date("j/n/Y", strtotime($possession_info['completion_send_date']));
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-success">
                                                <label class="control-label">أسم المندوب</label>
                                                <input type="text" name="completion_delegate" id="" class="form-control" placeholder="أسم المندوب" value="<?php echo $possession_info['completion_delegate']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group has-success">
                                                <label class="control-label">تاريخ ورود رد الإستيفاء</label>
                                                <input type="text" name="completion_receive_date" id="receive_date" class="form-control date_autoclose" value="<?php
                                                if ($possession_info['completion_receive_date']>1){
                                                    echo date("j/n/Y", strtotime($possession_info['completion_receive_date']));
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group has-success">
                                                <label class="control-label">قرار النيابة</label>
                                                <textarea type="text" name="prosecution_decision" id="" class="form-control"><?php echo $possession_info['prosecution_decision']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/row-->
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group has-success">
                                                <label class="control-label">تاريخ تصدير القضية</label>
                                                <input type="text" name="case_send_date" id="receive_date" class="form-control date_autoclose" value="<?php
                                                if ($possession_info['case_send_date']>1){
                                                    echo date("j/n/Y", strtotime($possession_info['case_send_date']));
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group has-success">
                                                <label class="control-label">رقم الصادر</label>
                                                <input type="text" name="case_send_number" id="number" class="form-control" value="<?php echo $possession_info['case_send_number']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="button" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End PAge Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <?php
        include_once "layout/footer.php";
        include_once "layout/modals.php";
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
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- This is data table -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<!-- start - This is for export functionality only -->
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.flash.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="assets/plugins/toast-master/js/jquery.toast.js"></script>

<!-- Date Picker Plugin JavaScript -->
<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

<!-- end - This is for export functionality only -->
<script>
    $('#datatable').DataTable({
        aaSorting: [ ],
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   -1
        } ],
        columnDefs: [ {
            visible: false,
            targets:   -2
        } ]
    });

    // DataTable
    var table = $('#datatable').DataTable();
</script>
<script>
    function format(value) {
        return '<div class="middle wrap col-sm-12"  >' + value + '</div>';
    }
    $(document).ready(function () {
        $(".select2").select2({
        });
        // Add event listener for opening and closing details
        $('#datatable').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
    });
</script>
<script>
    // Date Picker
    jQuery('.date_autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'd-m-yy'
    });
</script>
<?php
include_once "layout/common_script.php";
?>
</body>
</html>