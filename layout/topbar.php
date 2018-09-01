<!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                            <!-- Light Logo icon -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span>
                         <!-- dark Logo text -->
                         <img src="assets/images/logo-text.png" alt="homepage" class="dark-logo" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-user"></i>
                                <?php
                                $user_nickname=$_SESSION['saraki']['nickname'];
                                if($_SESSION['saraki']["securitylvl"] == "a"){
                                    $admin_id=$_SESSION['saraki']["admin_id"];
                                    $user_id=$_SESSION['saraki']["idusers"];
                                    $user_job="مدير النظام";
                                }elseif ($_SESSION['saraki']["securitylvl"] == "d"){
                                    $user_id=$_SESSION['saraki']["idusers"];
                                    $user_job="مدخل بيانات";
                                }
                                echo $user_job . " / ";
                                echo $user_nickname;
                                ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                <ul class="dropdown-user">
                                    <?php
                                    if($_SESSION['saraki']["securitylvl"] == "d" ):
                                        ?>
                                        <li>
                                            <a href="php/check_out.php">
                                                <i class="ace-icon fa fa-child"></i>
                                                تسجيل إنصراف
                                            </a>
                                        </li>
                                        <?php
                                    endif;
                                    ?>
                                    <li><a href="php/logout.php"><i class="fa fa-power-off"></i> تسجيل الخروج</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->