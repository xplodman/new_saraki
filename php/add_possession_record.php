<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
include_once "connection.php";
$user_id=$_SESSION['cj_family']['id'];

$possession_number=$_POST['possession_number'];
$possession_year=$_POST['possession_year'];
$case_number=$_POST['case_number'];
$case_year=$_POST['case_year'];
$main_ledger=$_POST['main_ledger'];
$depart=$_POST['depart'];
$receive_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['receive_date'])));
$subject=$_POST['subject'];
$prosecutor=$_POST['prosecutor'];
$plaintiff=$_POST['plaintiff'];
$plaintiff_id=$_POST['plaintiff_id'];
$defendant=$_POST['defendant'];
$defendant_id=$_POST['defendant_id'];
$completion_send_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['completion_send_date'])));
$completion_delegate=$_POST['completion_delegate'];
$completion_receive_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['completion_receive_date'])));
$prosecution_decision=$_POST['prosecution_decision'];
$case_send_date = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['case_send_date'])));
$case_send_number=$_POST['case_send_number'];

$insert_possession = mysqli_query($con, "INSERT INTO `cj_family`.`possession` (`possession_number`, `possession_year`, `case_receive_date`, `prosecutor_id`, `completion_send_date`, `completion_delegate`, `completion_receive_date`, `prosecution_decision`, `case_send_date`, `case_send_number`, `createdate`, `updatedate`, `status`, `deleted`, `users_id`, `subject_id`) VALUES ('$possession_number', '$possession_year', '$receive_date', '$prosecutor', '$completion_send_date', '$completion_delegate', '$completion_receive_date', '$prosecution_decision', '$case_send_date', '$case_send_number', CURRENT_TIMESTAMP, NULL, '1', '0', '2', '2');");

if ($insert_possession) {
    $max_case_id = mysqli_query($con, "SELECT MAX(id) FROM `cj_family`.`case`");
    $max_case_id = mysqli_fetch_row($max_case_id);
    $max_case_id = implode("", $max_case_id);
    $max_case_id = $max_case_id+1;

    $insert_case = mysqli_query($con, "INSERT INTO `cj_family`.`case` (`id`, `createdate`, `updatedate`, `status`, `deleted`, `depart_id`, `main_ledger_id`, `case_number`, `case_year`) VALUES ('$max_case_id+1', CURRENT_TIMESTAMP, NULL, '1', '0', '$depart', '$main_ledger', '$case_number', '$case_year');");

    if ($insert_case) {
        $insert_case_has_possession = mysqli_query($con, "INSERT INTO `cj_family`.`case_has_possession` (`possession_possession_number`, `possession_possession_year`, `case_id`) VALUES ('$possession_number', '$possession_year', '$max_case_id+1');");
        if ($insert_case_has_possession) {

            $max_person_id = mysqli_query($con, "SELECT MAX(id) FROM `cj_family`.`person`");
            $max_person_id = mysqli_fetch_row($max_person_id);
            $max_person_id = implode("", $max_person_id);

            $insert_plaintiff_person = mysqli_query($con, "INSERT INTO `cj_family`.`person` (`id`, `name`, `national_id`) VALUES (NULL, '$plaintiff', '$plaintiff_id');");

            $insert_plaintiff_person_status = mysqli_query($con, "INSERT INTO `cj_family`.`person_has_case` (`id`, `person_id`, `case_id`, `person_status_id`) VALUES (NULL, '$max_person_id+1', '$max_case_id+1', '1');");

            $insert_defendant_person = mysqli_query($con, "INSERT INTO `cj_family`.`person` (`id`, `name`, `national_id`) VALUES (NULL, '$defendant', '$defendant_id');");

            $insert_defendant_person_status = mysqli_query($con, "INSERT INTO `cj_family`.`person_has_case` (`id`, `person_id`, `case_id`, `person_status_id`) VALUES (NULL, '$max_person_id+2', '$max_case_id+1', '2');");

            mysqli_commit($con);
            mysqli_close($con);
            header('Location: ../possession.php?backresult=1');
            exit;
        }else{
            header('Location: ../possession.php?backresult=0');
            exit;
        }
    }else{
        header('Location: ../possession.php?backresult=3'); //رقم القضية مكرر
        exit;
    }
} else {
    header('Location: ../possession.php?backresult=2'); //رقم الحيازة مكرر
    exit;
}


?>
<!--<table>-->
<!--    --><?php
//    foreach ($_POST as $key => $value) {
//        echo "<tr>";
//        echo "<td>";
//        echo $key;
//        echo "</td>";
//        echo "<td>";
//        if (is_array($value)){
//            print_r($value);
//        }else{
//            echo $value;
//        }
//        echo "</td>";
//        echo "</tr>";
//    }
//    ?>
<!--</table>-->

