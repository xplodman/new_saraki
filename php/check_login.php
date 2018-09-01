<?php
include_once "connection.php";
$username = $_POST['username'];
$username = mysqli_real_escape_string($sqlcon, $username);

$password = $_POST['password'];
$password = mysqli_real_escape_string($sqlcon, $password);

$result = mysqli_query($sqlcon, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password'")or die(mysqli_error($sqlcon));
$result2 = mysqli_query($sqlcon, "Select 
      pros.prosname,
      pros.idpros,
      users.idusers,
      users.nickname,
      users.securitylvl,
      users.info_done,
      users.username
    From pros_has_users
      Inner Join pros On pros.idpros = pros_has_users.idpros
      Right Join users On pros_has_users.idusers = users.idusers Where users.username ='$username'")or die(mysqli_error($sqlcon));
$row2 = mysqli_fetch_assoc($result2);

if(mysqli_num_rows($result) == 0) {
    header('Location: ../login.php?backresult=0');
    exit;
}else{
    if($row2['securitylvl'] == "a"){
        $_SESSION['saraki']['timestamp'] = time();
        $_SESSION['saraki']["authenticate"] = "true";
        $_SESSION['saraki']["prosname"] = $row2['prosname'];
        $_SESSION['saraki']["prosid"] = $row2['idpros'];
        $_SESSION['saraki']["nickname"] = $row2['nickname'];
        $_SESSION['saraki']["securitylvl"] = $row2['securitylvl'];
        $_SESSION['saraki']["admin_id"] = $row2['idusers'];
        $_SESSION['saraki']["idusers"] = $row2['idusers'];
        header('Location: ../index.php');
        exit;
    }elseif($row2['securitylvl'] == "d"){
        if($row2['info_done'] == "0"){
            header('Location: ../data_entry_info.php?idusers='.$row2[idusers]);
            exit;
        }
        $maxattendanceid = mysqli_query($sqlcon, "Select Max(`attendance`.attendanceid) From `attendance`");
        $maxattendanceidrow = mysqli_fetch_row($maxattendanceid);
        $maxattendanceid = implode("", $maxattendanceidrow);
        $maxattendanceid=$maxattendanceid+1;
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $result3 = mysqli_query($sqlcon, "INSERT INTO `pic`.`attendance` (`attendanceid`, `checkindate`, `checkintime`, `checkoutdate`, `checkouttime`, `idusers`, `ip_address`) VALUES ($maxattendanceid, curdate(), curtime(), NULL, NULL, $row2[idusers], '$ip_address')");
        mysqli_commit($sqlcon);
        $_SESSION['saraki']['timestamp'] = time();
        $_SESSION['saraki']["authenticate"] = "true";
        $_SESSION['saraki']["prosname"] = $row2['prosname'];
        $_SESSION['saraki']["prosid"] = $row2['idpros'];
        $_SESSION['saraki']["nickname"] = $row2['nickname'];
        $_SESSION['saraki']["securitylvl"] = $row2['securitylvl'];
        $_SESSION['saraki']["idusers"] = $row2['idusers'];
        header('Location: ../index.php');
        exit;
    }else{
        header('Location: ../login.php?backresult=7');
        exit;
    };
};
?>