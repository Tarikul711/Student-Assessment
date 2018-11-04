<?php
ob_start();
session_start();
require_once '../db_connection/config.php';

if (!isset($_SESSION['user_email'])) {
    header('location:login_2.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php require_once "main_left_side_menu.php" ?>
        <!-- top navigation -->
        <?php require_once "top_menu.php" ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">
                <!--                <div class="page-title">-->
                <!--                    <div class="title_left">-->
                <!--                        <a href="add_assessment.php" class="btn-success btn-lg"> Create New Assessment</a><br/><br/><br/>-->
                <!--                        <a href="assessment_list.php" class="btn-success btn-lg"> List All Assessment</a><br/><br/><br/>-->
                <!--                        <a href="show_all_assessment.php" class="btn-success btn-lg"> Show All Claim</a><br/><br/><br/>-->
                <!--                        <a href=".php" class="btn-success btn-lg"> Student Profile Management</a><br/><br/><br/>-->
                <!--                        <a href="show_all_assessment.php" class="btn-success btn-lg"> Password Management</a><br/><br/><br/>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="add_assessment.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i>
                            </div>
                            <div class="count"> Assessment</div>

                            <h3 style="color: red">Create Assessment</h3>
                            <p>Create a New Assessment!</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="assessment_list.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-vine"></i>
                            </div>
                            <div class="count"> List</div>

                            <h3 style="color: red">Assessment List</h3>
                            <p>Display All Assessment List!</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="show_all_assessment.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-yc-square"></i>
                            </div>
                            <div class="count"> Claim</div>

                            <h3 style="color: red">Claim List</h3>
                            <p>Display All Student Claim!</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="submitted_assignment_list.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-check"></i>
                            </div>
                            <div class="count"> List</div>

                            <h3 style="color: red">Submitted Assessment</h3>
                            <p>Show All Student Submitted Assessment</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="st_profile_management.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-align-center"></i>
                            </div>
                            <div class="count"> Profile</div>

                            <h3 style="color: red">Student Profile</h3>
                            <p>All Student Profile Management</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="st_password_management.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-asl-interpreting"></i>
                            </div>
                            <div class="count"> Retrieve</div>

                            <h3 style="color: red">Password Retrieve</h3>
                            <p>Student Password Retrieve Management!</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>