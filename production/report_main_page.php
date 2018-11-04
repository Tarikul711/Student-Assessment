<?php
ob_start();
session_start();
require_once '../db_connection/config.php';

if (!isset($_SESSION['user_email'])) {
    header('location:login_2.php');
}

// this for showall assignment page load funtion
$_SESSION['ec_manager']="ec_manager";

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
<!--                        <a href="assessment_list.php" class="btn-success btn-lg"> Assessment List</a><br/><br/><br/>-->
<!--                        <a href="show_all_assessment.php" class="btn-success btn-lg"> Show All Claim</a><br/><br/><br/>-->
<!--                        <a href="submitted_assignment_list.php" class="btn-success btn-lg"> Show Submitted Assignment</a><br/><br/><br/>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="number_of_cliam_report.php">
                        <div class="tile-stats">
                            <div class="icon"></i>
                            </div>
                            <div class="count"> Claim</div>

                            <h3 style="color: red">Number Of Claim</h3>
<!--                            <p>Number Of Claim Each Year</p>-->
                        </div>
                    </a>
                </div>

                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="percentage_of_cliam_report.php">
                        <div class="tile-stats">
                            <div class="icon"></i>
                            </div>
                            <div class="count">Percentage</div>

                            <h3 style="color: red">Claim Percentages </h3>
<!--                            <p>Show Percentages Of Claim</p>-->
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="number_of_student_report.php">
                        <div class="tile-stats">
                            <div class="icon"></i>
                            </div>
                            <div class="count"> students </div>

                            <h3 style="color: red">Claim By Student</h3>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="evidence_claim_report.php">
                        <div class="tile-stats">
                            <div class="icon"></i>
                            </div>
                            <div class="count"> Evidence</div>

                            <h3 style="color: red">Claims without Evidence </h3>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <a href="claim_decision_report.php">
                        <div class="tile-stats">
                            <div class="icon"></i>
                            </div>
                            <div class="count"> Decision</div>

                            <h3 style="color: red">Claims without decision </h3>
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