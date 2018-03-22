<!DOCTYPE html>
<html lang="en" dir="rtl">
<?php
$pageTitle = 'تسجيل الدخول';
include_once "layout/header.php";
?>
<body class="card-no-border">
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
    <!-- php login script -->
    <!-- ============================================================== -->
    <?php
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $username = mysqli_real_escape_string($con, $username);

        $password = $_POST['password'];
        $password = mysqli_real_escape_string($con, $password);

        $result = mysqli_query($con, "SELECT
  users.id,
  users.nickname,
  role.name AS role_name
FROM
  users
  INNER JOIN role ON users.role_id = role.id
Where users.username = '$username' And users.password = '$password'")or die(mysqli_error($con));
        if (mysqli_num_rows($result) != 0) {

            $row = mysqli_fetch_assoc($result);


            $_SESSION['cj_family']['timestamp'] = time();
            $_SESSION['cj_family']['authenticate'] = "true";
            $_SESSION['cj_family']['id'] = $row['id'];
            $_SESSION['cj_family']['job'] = $row['role_name'];
            $_SESSION['cj_family']['nickname'] = $row['nickname'];
            header('Location: index.php');
            exit;
        } else {
            header('Location: login.php?backresult=0');
            $_SESSION['cj_family']['username'] = $username;
            exit;
        }
    }
    ?>
    <!-- ============================================================== -->
    <!-- end php login script -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url(assets/images/background/login-register.jpg);">
            <div class="login-box">
                <div class="card-body card">
                    <form  class="form-horizontal form-material" id="loginform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <h3 class="box-title m-b-20">تسجيل الدخول</h3>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="Username" name="username" value="<?php
                                if (isset($_SESSION['cj_family']['username'])){echo $_SESSION['cj_family']['username'];}?>" oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" required="" placeholder="Password" name="password" oninvalid="this.setCustomValidity('هذا الحقل إجباري')" oninput="setCustomValidity('')"> </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit" name="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
    <!--Custom JavaScript -->
    <script src="assets/plugins/toast-master/js/jquery.toast.js"></script>
    <script src="js/toastr.js"></script>
    <script type="text/javascript">
    $(function() {
        $(".preloader").fadeOut();
    });
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });

    </script>
    <?php
    if (isset($_GET['backresult'])){
        $backresult=$_GET['backresult'];
        if ($backresult ==  "0") {
            ?>
            <script>
                $.toast({
                    heading: 'أسم المستخدم أو كلمة المرور خطأ',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'error',
                    hideAfter: 3500
                })
            </script>
            <?php
        }
    }
    ?>
</body>
</html>