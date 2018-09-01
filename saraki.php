<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'السراكي';
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex">
                                <div>
                                    <h3 class="card-title m-b-5"><span class="lstick"></span>السراكي  </h3>
                                </div>
                                <?php
                                if (isset($_SESSION['saraki']['securitylvl']))
                                {
                                    $securitylvl=$_SESSION['saraki']['securitylvl'];
                                    if($securitylvl == "d" ):
                                        ?>
                                        <div class="ml-auto">
                                            <button class="btn btn-success " type="button" data-toggle="modal" data-target="#add_investigation_record"> إضافة قيد </button>
                                        </div>
                                        <?php
                                    endif;
                                }
                                ?>
                            </div>
                            <div class="table-responsive m-t-40">
                                <table id="datatable" class="display table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>التاريخ</th>
                                        <th>من رقم إلى رقم</th>
                                        <th>السنة</th>
                                        <th>الجدول</th>
                                        <th>القسم</th>
                                        <th>نوع </th>
                                        <th>منشئ السركي</th>
                                        <th>عدد القضايا</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>التاريخ</th>
                                        <th>من رقم إلى رقم</th>
                                        <th>السنة</th>
                                        <th>الجدول</th>
                                        <th>القسم</th>
                                        <th>نوع </th>
                                        <th>منشئ السركي</th>
                                        <th>عدد القضايا</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    if($_SESSION['saraki']["securitylvl"] == "a")
                                    {
                                        $admin_id=$_SESSION['saraki']['admin_id'];
                                        $result4 = mysqli_query($sqlcon,"

															SELECT
  departs.departname,
  casetype2.casetype2name,
  casetype.casetypename,
  sarki.date,
  sarki.`from`,
  sarki.`to`,
  sarki.year,
  sarki.createdate,
  sarki.updatedate,
  sarki.idsarki,
  sarki.notes,
  users.idusers,
  users.nickname
FROM
  sarki
  INNER JOIN casetype2 ON casetype2.idcasetype2 = sarki.casetype2_idcasetype2
  INNER JOIN casetype ON casetype.idcasetype = sarki.casetype_idcasetype
  INNER JOIN departs ON departs.iddeparts = sarki.departs_iddeparts
  INNER JOIN pros ON pros.idpros = departs.pros_idpros
  INNER JOIN users ON sarki.idusers = users.idusers
  INNER JOIN overallpros ON pros.overallprosid = overallpros.overallprosid
  INNER JOIN overallpros_has_users ON overallpros_has_users.overallpros_overallprosid = overallpros.overallprosid
WHERE
  overallpros_has_users.users_idusers = '$admin_id'
ORDER BY
  sarki.idsarki DESC
LIMIT 200") or die(mysqli_error($sqlcon));
                                    }else
                                    {
                                        $idusers = $_SESSION['saraki']['idusers'];
                                        $result4 = mysqli_query($sqlcon,"

															Select departs.departname,
															  casetype2.casetype2name,
															  casetype.casetypename,
															  sarki.date,
															  sarki.`from`,
															  sarki.`to`,
															  sarki.year,
															  sarki.createdate,
															  sarki.updatedate,
															  sarki.idsarki,
															  sarki.notes,
															  users.idusers,
															  users.nickname
															From sarki
															  Inner Join casetype2 On casetype2.idcasetype2 = sarki.casetype2_idcasetype2
															  Inner Join casetype On casetype.idcasetype = sarki.casetype_idcasetype
															  Inner Join departs On departs.iddeparts = sarki.departs_iddeparts
															  Inner Join pros On pros.idpros = departs.pros_idpros
															  Inner Join users On sarki.idusers = users.idusers
															Where users.idusers =$idusers Order By sarki.idsarki Desc Limit 200") or die(mysqli_error($sqlcon));
                                    }
                                    while($row4 = mysqli_fetch_assoc($result4))
                                    {

                                        ?>
                                        <tr>
                                            <?php if($_SESSION['saraki']["securitylvl"] == "a") 	{?>
                                                <td><a class="red" href="sarkiprofile.php?idsarki=<?php echo $row4['idsarki'] ?>"><?php echo $row4['idsarki'] ?></a></td>
                                            <?php }else{ ?>
                                                <td><a class="red" ><?php echo $row4['idsarki'] ?></a></td>
                                            <?php };?>
                                            <td><?php echo $row4['date'] ?></td>
                                            <td style="word-wrap: break-word; word-break: break-all; white-space: normal;" class="middle wrap"><?php echo $row4['to'] ?></td>
                                            <td><?php echo $row4['year'] ?></td>
                                            <td><?php echo $row4['casetypename'] ?></td>
                                            <td><?php echo $row4['departname'] ?></td>
                                            <td><?php echo $row4['casetype2name'] ?></td>
                                            <?php if($_SESSION['saraki']["securitylvl"] == "a"){?>
                                                <td><a class="green" href="userprofile.php?idusers=<?php echo $row4['idusers'] ?>"><?php echo $row4['nickname'] ?></a></td>
                                            <?php }else{?>
                                                <td><?php echo $row4['nickname'] ?></a></td>
                                            <?php };?>
                                            <td>
                                                <?php
                                                $result55 = mysqli_query($sqlcon,"
Select Count(`case`.idcase) As countcase
From `case`
  Inner Join sarki On sarki.idsarki = `case`.sarki_idsarki
Where sarki.idsarki = $row4[idsarki]") or die(mysqli_error($sqlcon));
                                                $row55 = mysqli_fetch_assoc($result55);
                                                if($row55['countcase'] > '0')
                                                {echo $row55['countcase'];}else
                                                {echo "0";}
                                                ?>
                                            </td>														<td><?php echo $row4['notes'] ?></td>
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
            <!-- ============================================================== -->
            <!-- End PAge Content -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
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

<?php
include_once "layout/common_script.php";
?>
</body>
</html>