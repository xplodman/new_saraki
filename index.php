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
            <?php
            if ($_SESSION['saraki']["securitylvl"] == "a"){
                ?>
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>تقرير متابعة مدخلي
                                            البيانات بإجمالي عدد القضايا</h3>
                                    </div>
                                </div>
                                <form class="form-horizontal" method="post" action="reports/dataentryrep.php"
                                      target="_blank">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="من"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_start"/>
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="إلى"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_end"/>
                                        </div>
                                    </div>
                                    <button class="btn btn-info col-sm-12" type="Submit" name="submit">
                                        <i class="ace-icon fa fa-print bigger-150"></i>
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>تقرير حضور و غياب مدخلي
                                            البيانات عن فترة</h3>
                                    </div>
                                </div>
                                <form class="form-horizontal" method="post" action="reports/dataentry_attend_rep.php"
                                      target="_blank">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="من"
                                                   type="text" data-date-format="yyyy/mm/dd" name="date_start"/>
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="إلى"
                                                   type="text" data-date-format="yyyy/mm/dd" name="date_end"/>
                                        </div>
                                    </div>
                                    <button class="btn btn-info col-sm-12" type="Submit" name="submit">
                                        <i class="ace-icon fa fa-print bigger-150"></i>
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>تقرير حضور و غياب مدخلي
                                            البيانات عن يوم</h3>
                                    </div>
                                </div>
                                <form class="form-horizontal" method="post"
                                      action="reports/dataentry_daily_attend_rep.php" target="_blank">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="من"
                                                   type="text" data-date-format="yyyy/mm/dd" name="daily_date"/>
                                        </div>
                                    </div>
                                    <button class="btn btn-info col-sm-12" type="Submit" name="submit">
                                        <i class="ace-icon fa fa-print bigger-150"></i>
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>تقرير تفصيلي بالقضايا
                                            للمستخدم</h3>
                                    </div>
                                </div>
                                <form class="form-horizontal" method="post" action="reports/full_dataentry_rep_x.php"
                                      target="_blank">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="من"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_start"/>
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="إلى"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_end"/>
                                            <select class="select2 form-control  col-sm-12" id="form-field-4"
                                                    name="idusers">
                                                <option value="" disabled selected>أسم المستخدم</option>
                                                <?php
                                                $result22 = mysqli_query($sqlcon, "SELECT
  *
FROM
  users
  INNER JOIN pros_has_users ON pros_has_users.idusers = users.idusers
  INNER JOIN pros ON pros_has_users.idpros = pros.idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  users.securitylvl = 'd' AND
  overallpros_has_users.users_idusers = '$admin_id'
  GROUP BY
  users.idusers");
                                                while ($row22 = $result22->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row22['idusers'] ?>"> <?php echo $row22['nickname'] ?> </option>

                                                <?php } ?>
                                            </select>
                                            <select class="select2 form-control  col-sm-12" id="form-field-4"
                                                    name="type2">
                                                <option selected="selected" value="1 , 2">الكل</option>
                                                <?php
                                                $result2 = mysqli_query($sqlcon, "SELECT * FROM `casetype2`");
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row2['idcasetype2'] ?>"
                                                        <?php

                                                        if (!empty($type)) {
                                                            if ($row2['idcasetype'] == $type)
                                                                echo 'selected="selected"';
                                                        }

                                                        ?>
                                                    > <?php echo $row2['casetype2name'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-info col-sm-12" type="Submit" name="submit">
                                        <i class="ace-icon fa fa-print bigger-150"></i>
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>تقرير متابعة النيابات
                                        </h3>
                                    </div>
                                </div>
                                <form class="form-horizontal" method="post" action="reports/prosrep.php"
                                      target="_blank">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="من"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_start"/>
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="إلى"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_end"/>
                                            <select class="select2 form-control  col-sm-12" id="form-field-4"
                                                    name="overallprosid">
                                                <option value="">الكل</option>
                                                <?php
                                                $result22 = mysqli_query($sqlcon, "SELECT
  *
FROM
  overallpros
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  overallpros_has_users.users_idusers = '$admin_id'");
                                                while ($row22 = $result22->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row22['overallprosid'] ?>"> <?php echo $row22['overallprosname'] ?> </option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-info col-sm-12" type="Submit" name="submit">
                                        <i class="ace-icon fa fa-print bigger-150"></i>
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>تقرير مفصل بالقضايا
                                            للنيابات</h3>
                                    </div>
                                </div>
                                <form class="form-horizontal" method="post" action="reports/full_prosrep.php"
                                      target="_blank">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="من"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_start"/>
                                            <input required type="text" autocomplete="off"
                                                   class="date_autoclose form-control col-sm-12" placeholder="إلى"
                                                   type="text" data-date-format="yyyy/mm/dd" name="week_end"/>
                                            <select class="select2 form-control  col-sm-12" id="form-field-4"
                                                    name="prosid">
                                                <option value="">الكل</option>
                                                <?php
                                                $result22 = mysqli_query($sqlcon, "SELECT
  pros.idpros,
  pros.prosname
FROM
  overallpros
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
  INNER JOIN pros ON pros.overallprosid = overallpros.overallprosid
WHERE
  overallpros_has_users.users_idusers = '$admin_id'");
                                                while ($row22 = $result22->fetch_assoc()) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $row22['idpros'] ?>"> <?php echo $row22['prosname'] ?> </option>

                                                <?php } ?>
                                            </select>
                                            <select class="select2 form-control  col-sm-12" id="form-field-4"
                                                    name="type2">
                                                <option selected="selected" value="">الكل</option>
                                                <?php
                                                $result2 = mysqli_query($sqlcon, "SELECT * FROM `casetype2`");
                                                while ($row2 = $result2->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $row2['idcasetype2'] ?>"
                                                        <?php

                                                        if (!empty($type)) {
                                                            if ($row2['idcasetype'] == $type)
                                                                echo 'selected="selected"';
                                                        }

                                                        ?>
                                                    > <?php echo $row2['casetype2name'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-info col-sm-12" type="Submit" name="submit">
                                        <i class="ace-icon fa fa-print bigger-150"></i>
                                        Print
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div>
                                        <h3 class="card-title m-b-5"><span class="lstick"></span>كشف بالحضور و الإنصراف
                                        </h3>
                                    </div>
                                </div>
                                <div class="table-responsive m-t-40">
                                    <table id="datatable" class="datatable display table table-hover table-striped table-bordered"
                                           cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>الأسم</th>
                                            <th>التاريخ</th>
                                            <th>وقت الحضور</th>
                                            <th>Ip address الدخول</th>
                                            <th>موقع الدخول</th>
                                            <th>وقت الإنصراف</th>
                                            <th>Ip address الخروج</th>
                                            <th>موقع الخروج</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>الأسم</th>
                                            <th>التاريخ</th>
                                            <th>وقت الحضور</th>
                                            <th>Ip address الدخول</th>
                                            <th>موقع الدخول</th>
                                            <th>وقت الإنصراف</th>
                                            <th>Ip address الخروج</th>
                                            <th>موقع الخروج</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php
                                        $result4 = mysqli_query($sqlcon, "
															SELECT
  pros.prosname,
  attendance.attendanceid,
  attendance.checkindate,
  attendance.ip_address AS ip_address_real,
  attendance.ip_address_2 AS ip_address_2_real,
  (CASE
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.10'
    THEN 'IT رمل'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.50'
    THEN 'غرب'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.51'
    THEN 'شئون مالية'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.52'
    THEN 'الأحداث'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.53'
    THEN 'الجمرك'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.54'
    THEN 'سيدي جابر'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.55'
    THEN 'اللبان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.56'
    THEN 'العطارين'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.58'
    THEN 'المنتزة ثان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.50'
    THEN 'المنتزة أول'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.20'
    THEN 'الميناء'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.42'
    THEN 'مينا البصل'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.41'
    THEN 'كرموز'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.40'
    THEN 'محرم بك'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.30'
    THEN 'عامرية أول'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.31'
    THEN 'عامرية ثان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.32'
    THEN 'الدخيلة'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '40.60'
    THEN 'برج العرب'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.6'
    THEN 'رمل أول'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.22'
    THEN 'رمل ثان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.4'
    THEN 'شرق الكلية'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.2'
    THEN 'إستئناف'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.8'
    THEN 'باب شرقي'
    WHEN SubString_Index(SubString_Index(attendance.ip_address, '.', 3), '.', -2) = '31.17'
    THEN 'المنشية'
    ELSE 'OTHERS'
  END) AS ip_address,
  (CASE
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.10'
    THEN 'IT رمل'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.50'
    THEN 'غرب'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.51'
    THEN 'شئون مالية'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.52'
    THEN 'الأحداث'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.53'
    THEN 'الجمرك'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.54'
    THEN 'سيدي جابر'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.55'
    THEN 'اللبان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.56'
    THEN 'العطارين'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.58'
    THEN 'المنتزة ثان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.50'
    THEN 'المنتزة أول'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.20'
    THEN 'الميناء'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.42'
    THEN 'مينا البصل'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.41'
    THEN 'كرموز'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.40'
    THEN 'محرم بك'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.30'
    THEN 'عامرية أول'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.31'
    THEN 'عامرية ثان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.32'
    THEN 'الدخيلة'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '40.60'
    THEN 'برج العرب'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.6'
    THEN 'رمل أول'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.22'
    THEN 'رمل ثان'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.4'
    THEN 'شرق الكلية'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.2'
    THEN 'إستئناف'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.8'
    THEN 'باب شرقي'
    WHEN SubString_Index(SubString_Index(attendance.ip_address_2, '.', 3), '.', -2) = '31.17'
    THEN 'المنشية'
    ELSE 'OTHERS'
  END) AS ip_address_2,
  Date_Format(attendance.checkouttime, '%h:%i %p') AS checkouttime,
  users.nickname,
  users.idusers,
  Date_Format(attendance.checkintime, '%h:%i %p') AS checkintime
FROM
  attendance
  INNER JOIN users ON users.idusers = attendance.idusers
  INNER JOIN pros_has_users ON pros_has_users.idusers = users.idusers
  INNER JOIN pros ON pros.idpros = pros_has_users.idpros
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  overallpros_has_users.users_idusers = '$admin_id'
GROUP BY
  attendance.checkindate,
  users.idusers,
  overallpros_has_users.users_idusers
ORDER BY
  attendance.checkindate DESC
LIMIT 100") or die(mysqli_error($sqlcon));
                                        while ($row4 = mysqli_fetch_assoc($result4)) {
                                            ?>
                                            <tr>
                                                <td><a class="green"
                                                       href="userprofile.php?idusers=<?php echo $row4['idusers'] ?>"><?php echo $row4['nickname'] ?></a>
                                                </td>
                                                <td><?php echo $row4['checkindate'] ?></td>
                                                <td>
                                                    <?php
                                                    $dateinlate = "09:15 AM";
                                                    $dateinnormal = "09:00 AM";
                                                    $dateinearly = "08:45 AM";
                                                    $dateinearly = date("h:i A", strtotime($dateinearly));
                                                    $dateinlate = date("h:i A", strtotime($dateinlate));
                                                    $dateinnormal = date("h:i A", strtotime($dateinnormal));
                                                    if (($dateinnormal >= $row4['checkintime'])):
                                                        $varb = '<span class="btn btn-sm btn-success">';
                                                    elseif (($dateinlate < $row4['checkintime'])):
                                                        $varb = '<span class="btn btn-sm btn-danger">';
                                                    else:
                                                        $varb = '<span class="btn btn-sm btn-warning">';
                                                    endif;
                                                    echo $varb . $row4['checkintime']; ?></span>

                                                </td>
                                                <td><?php echo $row4['ip_address_real'] ?></td>
                                                <td><?php echo $row4['ip_address'] ?></td>
                                                <td>


                                                    <?php
                                                    $dateoutlate = "03:00 PM";

                                                    $dateoutearly = "02:00 PM";

                                                    $dateoutearly = date("h:i A", strtotime($dateoutearly));
                                                    $dateoutlate = date("h:i A", strtotime($dateoutlate));

                                                    if (($dateoutearly > $row4["checkouttime"])):
                                                        $varb = '<span class="btn btn-sm btn-danger">';

                                                    elseif (($dateoutlate > $row4["checkouttime"])):
                                                        $varb = '<span class="btn btn-sm btn-warning">';

                                                    else:
                                                        $varb = '<span class="btn btn-sm btn-success">';
                                                    endif;
                                                    echo $varb . $row4['checkouttime']; ?></span>


                                                </td>
                                                <td><?php echo $row4['ip_address_2_real'] ?></td>
                                                <td><?php echo $row4['ip_address_2'] ?></td>

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
                <?php
            }elseif ($_SESSION['saraki']["securitylvl"] == "d"){ ?>
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="assets/images/icon/expense.png" alt="Income"/></div>
                                <div class="align-self-center">
                                    <h4 class="text-muted m-t-10 m-b-0">إيراد الشهر الحالي</h4>
                                    <?php
                                    $month = date("n");
                                    $numofday = date("j");
                                    if ($numofday > "25"):
                                        $month = $month + 1;
                                    endif;
                                    $monthminus1 = $month - 1;
                                    $monthminus2 = $month - 2;
                                    $monthminus3 = $month - 3;
                                    $year = date("Y");
                                    $idusers = $_SESSION["saraki"]["idusers"];
                                    $casecount = mysqli_query($sqlcon, "Select Count(`case`.idcase) As casecount,
departs.departname,
users.nickname,
`case`.caseyear,
casetype.casetypename,
`case`.createdate 
From `case`
Inner Join departs On departs.iddeparts = `case`.departs_iddeparts
Inner Join sarki On sarki.idsarki = `case`.sarki_idsarki
Inner Join users On users.idusers = sarki.idusers
Inner Join casetype On `case`.casetype_idcasetype = casetype.idcasetype
WHERE (`case`.createdate BETWEEN '$year-$monthminus1-26 00:00:00' AND '$year-$month-26 00:00:00')  And
users.idusers = $idusers  
                                    
                                    Order By departs.departname,
                                      `case`.caseyear,
                                      casetype.casetypename");
                                    while ($casecountrow = mysqli_fetch_assoc($casecount))
                                    {
                                    ?>
                                    <h2 class="m-t-0"><?php echo $casecountrow['casecount'] ?></h2>
                                    <h6 class="m-t-0">
                                        من 26\<?php echo $monthminus1; ?> إلى 25\<?php echo $month; ?></h6>
                                </div>
                                <?php }; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="assets/images/icon/expense.png" alt="Income"/></div>
                                <div class="align-self-center">
                                    <h4 class="text-muted m-t-10 m-b-0">إيراد الشهر السابق</h4>
                                    <?php
                                    $casecount=mysqli_query($sqlcon, "Select Count(`case`.idcase) As casecount,
  departs.departname,
  users.nickname,
  `case`.caseyear,
  casetype.casetypename,
  `case`.createdate 
From `case`
  Inner Join departs On departs.iddeparts = `case`.departs_iddeparts
  Inner Join sarki On sarki.idsarki = `case`.sarki_idsarki
  Inner Join users On users.idusers = sarki.idusers
  Inner Join casetype On `case`.casetype_idcasetype = casetype.idcasetype
WHERE (`case`.createdate BETWEEN '$year-$monthminus2-26 00:00:00' AND '$year-$monthminus1-26 00:00:00')  And
  users.idusers = $idusers  
										
										Order By departs.departname,
										  `case`.caseyear,
										  casetype.casetypename");
                                    $casecountrow = mysqli_fetch_assoc($casecount);
                                    ?>
                                    <h2 class="m-t-0"><?php echo $casecountrow['casecount'] ?></h2>
                                    <h6 class="m-t-0">
                                        من 26\<?php echo $monthminus2;?> إلى 25\<?php echo $monthminus1;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="assets/images/icon/income.png" alt="Income"/></div>
                                <div class="align-self-center">
                                    <h4 class="text-muted m-t-10 m-b-0">تصرفات الشهر الحالي</h4>
                                    <?php
                                    $month = date("n");
                                    $numofday = date("j");
                                    if($numofday > "25"):
                                        $month=$month+1;
                                    endif;
                                    $monthminus1=$month-1;
                                    $monthminus2=$month-2;
                                    $monthminus3=$month-3;
                                    $year = date("Y");
                                    $casecount=mysqli_query($sqlcon, "
									SELECT
									  COUNT(*) AS casecount
									FROM
									  case_has_action
									  INNER JOIN users ON case_has_action.users_idusers = users.idusers
									WHERE (case_has_action.insert_date BETWEEN '$year-$monthminus1-26 00:00:00' AND '$year-$month-26 00:00:00')  And users.idusers = $idusers");
                                    $casecountrow_action = mysqli_fetch_assoc($casecount);

                                    $casecount=mysqli_query($sqlcon, "
									SELECT
									  COUNT(*) AS casecount
									FROM
									  case_has_court_session
									  INNER JOIN users ON case_has_court_session.users_idusers = users.idusers
									WHERE (case_has_court_session.insert_date BETWEEN '$year-$monthminus1-26 00:00:00' AND '$year-$month-26 00:00:00')  And users.idusers = $idusers");
                                    $casecountrow_court = mysqli_fetch_assoc($casecount);
                                    ?>
                                    <h2 class="m-t-0"><?php echo $casecountrow_action['casecount'] + $casecountrow_court['casecount'] ?></h2>
                                    <h6 class="m-t-0">
                                        من 26\<?php echo $monthminus1;?> إلى 25\<?php echo $month;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block">
                                <div class="m-r-20 align-self-center"><span class="lstick m-r-20"></span><img
                                        src="assets/images/icon/income.png" alt="Income"/></div>
                                <div class="align-self-center">
                                    <h4 class="text-muted m-t-10 m-b-0">تصرفات الشهر السابق</h4>
                                    <?php
                                    $casecount=mysqli_query($sqlcon, "
									SELECT
									  COUNT(*) AS casecount
									FROM
									  case_has_action
									  INNER JOIN users ON case_has_action.users_idusers = users.idusers
									WHERE (case_has_action.insert_date BETWEEN '$year-$monthminus2-26 00:00:00' AND '$year-$monthminus1-26 00:00:00')  And users.idusers = $idusers");
                                    $casecountrow_action = mysqli_fetch_assoc($casecount);

                                    $casecount=mysqli_query($sqlcon, "
									SELECT
									  COUNT(*) AS casecount
									FROM
									  case_has_court_session
									  INNER JOIN users ON case_has_court_session.users_idusers = users.idusers
									WHERE (case_has_court_session.insert_date BETWEEN '$year-$monthminus2-26 00:00:00' AND '$year-$monthminus1-26 00:00:00')  And users.idusers = $idusers");
                                    $casecountrow_court = mysqli_fetch_assoc($casecount);
                                    ?>
                                    <h2 class="m-t-0"><?php echo $casecountrow_action['casecount'] + $casecountrow_court['casecount']  ?></h2>
                                    <h6 class="m-t-0">
                                        من 26\<?php echo $monthminus2;?> إلى 25\<?php echo $monthminus1;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div>
                                    <h3 class="card-title m-b-5"><span class="lstick"></span>كشف بالحضور و الإنصراف
                                    </h3>
                                </div>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="datatable" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>الأسم</th>
                                        <th>التاريخ</th>
                                        <th>وقت الحضور</th>
                                        <th>وقت الإنصراف</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>الأسم</th>
                                        <th>التاريخ</th>
                                        <th>وقت الحضور</th>
                                        <th>وقت الإنصراف</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $result4 = mysqli_query($sqlcon,"
															Select pros.prosname,
															  attendance.checkindate,
															  Date_Format(attendance.checkouttime, '%h:%i %p') As checkouttime,
															  users.nickname,
															  Date_Format(attendance.checkintime, '%h:%i %p') As checkintime
															From attendance
															  Inner Join users On users.idusers = attendance.idusers
															  Inner Join pros_has_users On pros_has_users.idusers = users.idusers
															  Inner Join pros On pros.idpros = pros_has_users.idpros    
															  Where users.idusers = $idusers
															group by attendance.checkindate
															Order By pros.prosname,
															  attendance.checkindate Desc Limit 50") or die(mysqli_error($sqlcon));
                                    while($row4 = mysqli_fetch_assoc($result4))
                                    {
                                        ?>
                                        <tr>
                                            <td><?php echo $row4['nickname'] ?></td>
                                            <td><?php echo $row4['checkindate'] ?></td>
                                            <td>
                                                <?php
                                                $dateinlate = "09:15 AM";
                                                $dateinnormal = "09:00 AM";
                                                $dateinearly = "08:45 AM";
                                                $dateinearly=date("h:i A",strtotime($dateinearly));
                                                $dateinlate=date("h:i A",strtotime($dateinlate));
                                                $dateinnormal=date("h:i A",strtotime($dateinnormal));
                                                if(($dateinnormal >= $row4['checkintime'])):
                                                    $varb='<span class="btn btn-sm btn-success">';
                                                elseif(($dateinlate < $row4['checkintime'])):
                                                    $varb='<span class="btn btn-sm btn-danger">';
                                                else:
                                                    $varb='<span class="btn btn-sm btn-warning">';
                                                endif;
                                                echo $varb.$row4['checkintime'];?></span>

                                            </td>
                                            <td>


                                                <?php
                                                $dateoutlate = "03:00 PM";

                                                $dateoutearly = "02:00 PM";

                                                $dateoutearly=date("h:i A",strtotime($dateoutearly));
                                                $dateoutlate=date("h:i A",strtotime($dateoutlate));

                                                if(($dateoutearly > $row4["checkouttime"])):
                                                    $varb='<span class="btn btn-sm btn-danger">';

                                                elseif(($dateoutlate > $row4["checkouttime"])):
                                                    $varb='<span class="btn btn-sm btn-warning">';

                                                else:
                                                    $varb='<span class="btn btn-sm btn-success">';
                                                endif;
                                                echo $varb.$row4['checkouttime'];?></span>


                                            </td>
                                        </tr>
                                        <?php
                                    };
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
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
<script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!--Custom JavaScript -->
<script src="js/custom.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
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

<!-- Bootstrap Duallistbox -->
<script src="assets/plugins/bootstrap-duallistbox/bootstrap-duallistbox.js"></script>

<!-- Date Picker Plugin JavaScript -->
<script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>

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
                $results = mysqli_query($con, $query);
                while ($y = mysqli_fetch_assoc($results)) {
                    echo "['" . $y['name'] . "','" . $y['Count_charges'] . "'],";
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
                format: function (value, ratio, id) {
                    return value;
                }
            }
        }
    });

    var chart = c3.generate({
        bindto: "#chart6",
        data: {
            columns: [
                <?php
                $query = "SELECT
  Count(case_has_investigation_has_reason_to_done.case_has_investigation_has_reason_to_done_id) AS
  Count_reason_to_done,
  reason_to_done.name
FROM
  case_has_investigation_has_reason_to_done
  LEFT JOIN reason_to_done ON case_has_investigation_has_reason_to_done.reason_to_done_id_reason_to_done =
    reason_to_done.id_reason_to_done
GROUP BY
  reason_to_done.name";
                $results = mysqli_query($con, $query);
                while ($y = mysqli_fetch_assoc($results)) {
                    echo "['" . $y['name'] . "','" . $y['Count_reason_to_done'] . "'],";
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
                format: function (value, ratio, id) {
                    return value;
                }
            }
        }
    });
</script>
<?php
include_once "layout/common_script.php";
include_once "layout/backresult.php";
?>
</body>
</html>