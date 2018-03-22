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
                    <div class="">
                        <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_possession_record"> إضافة قيد </button>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- search form -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <a class="collapse-link" data-toggle="collapse" data-target="#search">
                                <div class="card-header bg-info">
                                    <h4 class="m-b-0 text-white">للبحث داخل الدفتر</h4>
                                </div>
                            </a>
                            <?php
                            if (isset($_POST['submit']))
                            {
                                $possession_query="
SELECT
  `case`.id,
  possession.case_receive_date,
  possession.completion_send_date,
  possession.completion_delegate,
  possession.completion_receive_date,
  possession.prosecution_decision,
  possession.case_send_date,
  possession.case_send_number,
  main_ledger.name AS main_ledger_name,
  depart.name AS depart_name,
  subject.name AS subject_name,
  prosecutor.name AS prosecutor_name,
  possession.possession_number,
  possession.possession_year,
  `case`.case_number,
  `case`.case_year
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
  main_ledger.deleted = 0";
                                if (!empty($_POST['possession_number'])) {
                                    $possession_number=$_POST['possession_number'];
                                    if(trim($possession_number) != ''){$possession_query .= " AND  `possession`.possession_number='$possession_number'";}
                                }
                                if (!empty($_POST['possession_year'])) {
                                    $possession_year=$_POST['possession_year'];
                                    if(trim($possession_year) != ''){$possession_query .= " AND  `possession`.possession_year='$possession_year'";}
                                }
                                if (!empty($_POST['case_number'])) {
                                    $case_number=$_POST['case_number'];
                                    if(trim($case_number) != ''){$possession_query .= " AND  `case`.case_number='$case_number'";}
                                }
                                if (!empty($_POST['case_year'])) {
                                    $case_year=$_POST['case_year'];
                                    if(trim($case_year) != ''){$possession_query .= " AND  `case`.case_year='$case_year'";}
                                }
                                if (!empty($_POST['main_ledger'])) {
                                    $main_ledger=$_POST['main_ledger'];
                                    if(trim($main_ledger) != ''){$possession_query .= " AND   main_ledger.id ='$main_ledger'";}
                                }
                                if (!empty($_POST['depart'])) {
                                    $depart=$_POST['depart'];
                                    if(trim($depart) != ''){$possession_query .= " AND   depart.id ='$depart'";}
                                }
                                if (!empty($_POST['receive_date'])) {
                                    $receive_date=$_POST['receive_date'];
                                    if(trim($receive_date) != ''){$possession_query .= " AND   `possession`.receive_date ='$receive_date'";}
                                }
                                if (!empty($_POST['subject'])) {
                                    $subject=$_POST['subject'];
                                    if(trim($subject) != ''){$possession_query .= " AND subject.id ='$subject'";}
                                }
                                if (!empty($_POST['prosecutor'])) {
                                    $prosecutor=$_POST['prosecutor'];
                                    if(trim($prosecutor) != ''){$possession_query .= " AND prosecutor.id ='$prosecutor'";}
                                }
                                if (!empty($_POST['person_name'])) {
                                    $person_name=$_POST['person_name'];
                                    if(trim($person_name) != ''){$possession_query .= " AND person.name ='$person_name'";}
                                }
                                if (!empty($_POST['person_id'])) {
                                    $person_id=$_POST['person_id'];
                                    if(trim($person_id) != ''){$possession_query .= " AND person.national_id ='$person_id'";}
                                }

                                $possession_query .= " GROUP BY `case`.id ORDER BY possession.possession_year, possession.possession_number LIMIT 100";
                            }else{
                                $possession_query="
SELECT
  `case`.id,
  possession.case_receive_date,
  possession.completion_send_date,
  possession.completion_delegate,
  possession.completion_receive_date,
  possession.prosecution_decision,
  possession.case_send_date,
  possession.case_send_number,
  main_ledger.name AS main_ledger_name,
  depart.name AS depart_name,
  subject.name AS subject_name,
  prosecutor.name AS prosecutor_name,
  possession.possession_number,
  possession.possession_year,
  `case`.case_number,
  `case`.case_year
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
  main_ledger.deleted = 0
GROUP BY
  `case`.id
ORDER BY
  possession.possession_year,
  possession.possession_number
LIMIT 100";
                            }
                            ?>
                            <div class="collapse card-body" id="search">
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="form-body">
                                        <div class="form-group row">
                                            <label for="example-search-input" class="col-md-1 col-form-label">رقم الحيازة</label>
                                            <div class="col-md-1">
                                                <div class="form-group has-danger">
                                                    <input type="number" name="possession_number" id="possession_number" class="form-control" placeholder="رقم" value="<?php if (!empty($possession_number)) { echo $possession_number; }?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group has-danger">
                                                    <input type="number" name="possession_year" id="possession_year" class="form-control" placeholder="سنة" value="<?php if (!empty($possession_year)) { echo $possession_year; }?>">
                                                </div>
                                            </div>
                                            <label for="example-search-input" class="col-xlg-pull-2 col-md-3 col-form-label">رقم القضية</label>
                                            <div class="col-md-1">
                                                <div class="form-group has-danger">
                                                    <input type="number" name="case_number" id="case_number" class="form-control" placeholder="رقم" value="<?php if (!empty($case_number)) { echo $case_number; }?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group has-danger">
                                                    <input type="number" name="case_year" id="case_year" class="form-control" placeholder="سنة" value="<?php if (!empty($case_year)) { echo $case_year; }?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-danger">
                                                    <select name="main_ledger" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                        <option value="" disabled selected>
                                                            الجدول
                                                        </option>
                                                        <?php
                                                        $query_for_main_ledger = "SELECT * FROM main_ledger";
                                                        $result_for_main_ledger=mysqli_query($con, $query_for_main_ledger);
                                                        //loop
                                                        foreach ($result_for_main_ledger as $result_for_main_ledger){
                                                            ?>
                                                            <option
                                                                <?php
                                                                if (!empty($_POST['main_ledger'])) {
                                                                    if((int)$_POST['main_ledger'] == (int)$result_for_main_ledger["id"]){
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>
                                                                value="<?php echo $result_for_main_ledger["id"];?> "><?php echo $result_for_main_ledger["name"];?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group has-danger">
                                                    <select name="depart" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                        <option value="" disabled selected>القسم</option>
                                                        <?php
                                                        $query = "SELECT * FROM depart";
                                                        $results=mysqli_query($con, $query);
                                                        //loop
                                                        foreach ($results as $depart){
                                                            ?>
                                                            <option
                                                                <?php
                                                                if (!empty($_POST['depart'])) {
                                                                    if((int)$_POST['depart'] == (int)$depart["id"]){
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
                                            <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">تاريخ الورود</label>
                                                    <input type="text" name="receive_date" id="receive_date" class="form-control date_autoclose" placeholder="تاريخ الورود" value="<?php if (!empty($possession_year)) { echo $possession_year; }?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">موضوع التنازع</label>
                                                    <select name="subject" class="select2 form-control custom-select"  style="width: 100%; height:100%;">
                                                        <option value="" disabled selected></option>
                                                        <?php
                                                        $query = "SELECT * FROM subject";
                                                        $results=mysqli_query($con, $query);
                                                        //loop
                                                        foreach ($results as $subject){
                                                            ?>
                                                            <option
                                                                <?php
                                                                if (!empty($_POST['subject'])) {
                                                                    if((int)$_POST['subject'] == (int)$subject["id"]){
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
                                                    <select class="select2 form-control custom-select"  style="width: 100%; height:100%;" name="prosecutor">
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
                                                                    if((int)$prosecutor == (int)$prosecutor["id"]){
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
                                            <div class="col-md-8">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">أسم الطرف</label>
                                                    <input type="text" name="person_name" id="" class="form-control" placeholder="أسم الطرف" value="<?php if (!empty($person_name)) { echo $person_name; }?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group has-danger">
                                                    <label class="control-label">الرقم القومي</label>
                                                    <input oninvalid="this.setCustomValidity('برجاء إدخال رقم قومي صحيح')" oninput="setCustomValidity('')"type="text" name="person_id" id="" class="form-control" placeholder="الرقم القومي"  onkeypress="return isNumberKey(event)" minlength="14" maxlength="14" value="<?php if (!empty($person_id)) { echo $person_id; }?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <button name="submit" type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" class="btn btn-inverse">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end of search form -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th width="10%">رقم الحيازة </th>
                                                <th width="18%">الرقم القضائي </th>
                                                <th width="10%">تاريخ الورود </th>
                                                <th width="13%">موضوع المنازعة </th>
                                                <th width="17%">وكيل النيابة </th>
                                                <th width="20%">قرار النيابة </th>
                                                <th width="9%"></th><!--tools-->
                                                <th ></th><!--info column-->
                                                <th width="3%"></th><!--info hidden column-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $result = mysqli_query($con, $possession_query);
                                        while($possession_info = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr data-child-value="<?php
                                            $person_query_info = mysqli_query($con, "
                                                        SELECT
                                                          person_status.name AS person_status,
                                                          person.name AS person_name,
                                                          person.national_id
                                                        FROM
                                                          person_has_case
                                                          INNER JOIN person ON person_has_case.person_id = person.id
                                                          INNER JOIN person_status ON person_has_case.person_status_id = person_status.id
                                                          INNER JOIN `case` ON person_has_case.case_id = `case`.id
                                                        WHERE
                                                          `case`.id = $possession_info[id] AND
                                                          `case`.status = 1 AND
                                                          `case`.deleted = 0 AND
                                                          person_status.status = 1 AND
                                                          person_status.deleted = 0");
                                            while($person_info = mysqli_fetch_assoc($person_query_info)) {
                                                echo "أسم ال".$person_info['person_status']." :".$person_info['person_name']."<br>";
                                                echo "الرقم القومي لل".$person_info['person_status']." :".$person_info['national_id']."<br>";
                                            }
                                            ?>">
                                                <td>
                                                    <?php echo $possession_info['possession_number']." / ".$possession_info['possession_year']?>
                                                </td>
                                                <td>
                                                    <?php echo $possession_info['case_number']." / ".$possession_info['case_year']." / ".$possession_info['main_ledger_name']." / ".$possession_info['depart_name']?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $possession_info['case_receive_date']
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $possession_info['subject_name']
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $possession_info['prosecutor_name']
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $possession_info['prosecution_decision']
                                                    ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-rounded">تفاصيل
                                                    </button>
                                                </td>
                                                <td>
                                                    <?php echo " ".$possession_info['case_receive_date']?>
                                                    <br>
                                                    <?php
                                                    $person_query_info = mysqli_query($con, "
                                                        SELECT
                                                          person_status.name AS person_status,
                                                          person.name AS person_name,
                                                          person.national_id
                                                        FROM
                                                          person_has_case
                                                          INNER JOIN person ON person_has_case.person_id = person.id
                                                          INNER JOIN person_status ON person_has_case.person_status_id = person_status.id
                                                          INNER JOIN `case` ON person_has_case.case_id = `case`.id
                                                        WHERE
                                                          `case`.id = $possession_info[id] AND
                                                          `case`.status = 1 AND
                                                          `case`.deleted = 0 AND
                                                          person_status.status = 1 AND
                                                          person_status.deleted = 0");
                                                    while($person_info = mysqli_fetch_assoc($person_query_info)) {
                                                        echo " ".$person_info['person_name'];
                                                        echo " ".$person_info['national_id'];
                                                    }
                                                    echo " ".$possession_info['prosecutor_name']
                                                    ?>
                                                </td>
                                                <td class="details-control"></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
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
<script>
    $('document').ready(function(){
        var username_state = false;
        $('#national_id_2').on('blur', function(){
            var national_id = $('#national_id_2').val();

            if (national_id == '') {
                national_id_state = false;
                return;
            }

            $.ajax({
                url: 'check_national_id.php',
                type: 'post',
                data: {
                    'national_id_check' : 1,
                    'national_id' : national_id,
                },
                success: function(response){
                    if (response == 'taken' ) {
                        national_id_state = false;
                        alert("هذا الرقم القومي تم إدخاله مسبقاً  !!!!");
                        $('#national_id_2').val("");
                    }
                }
            });
        });
        $('#national_id').on('blur', function(){
            var national_id = $('#national_id').val();

            if (national_id == '') {
                national_id_state = false;
                return;
            }

            $.ajax({
                url: 'php/check_national_id.php',
                type: 'post',
                data: {
                    'national_id_check' : 1,
                    'national_id' : national_id,
                },
                success: function(response){
                    if (response == 'taken' ) {
                        national_id_state = false;
                        alert("هذا الرقم القومي تم إدخاله مسبقاً  !!!!");
                        $('#national_id').val("");
                    }
                }
            });
        });
    });
</script>
<?php
include_once "layout/common_script.php";
?>
</body>
</html>