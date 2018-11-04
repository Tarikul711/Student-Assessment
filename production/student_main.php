<?php
ob_start();
session_start();
require_once '../db_connection/config.php';
require_once "common_function.php";
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
                <!--                        <a href="new_assessment.php" class="btn-success btn-lg"> New Assessment</a><br/><br/><br/>-->
                <!--                        <a href="student_profile.php" class="btn-success btn-lg"> Submitted Claim</a><br/><br/><br/>-->
                <!--                        <a href="submit_claim.php" class="btn-success btn-lg"> Submit Claim</a><br/><br/><br/>-->
                <!--                        <a href="submit_assignment.php" class="btn-success btn-lg"> Submit Assignment</a><br/><br/><br/>-->
                <!--                        <a href="student_submitted_assignment.php" class="btn-success btn-lg"> Submitted Assignment</a><br/><br/><br/>-->
                <!--                    </div>-->
                <!--                </div>-->


                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="new_assessment.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-certificate"></i>
                            </div>
                            <div class="count">NEW</div>

                            <h3 style="color: red">New Assessment</h3>
                            <p>All New Assessment List</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="submit_claim.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i>
                            </div>
                            <div class="count"> Create</div>

                            <h3 style="color: red">Submit Claim</h3>
                            <p>Submit A New Claim</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="student_profile.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i>
                            </div>
                            <div class="count"> Claim</div>

                            <h3 style="color: red">Submitted Claim</h3>
                            <p>All Submitted Claim List</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="submit_assignment.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i>
                            </div>
                            <div class="count"> Create</div>

                            <h3 style="color: red">Submit Assignment</h3>
                            <p>Submit Your Assignment.</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="student_submitted_assignment.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i>
                            </div>
                            <div class="count"> List</div>

                            <h3 style="color: red">Submitted Assignment</h3>
                            <p>All Your Submitted Assignment</p>
                        </div>
                    </a>
                </div>
                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <a href="student_claim_decision.php">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-comments-o"></i>
                            </div>
                            <div class="count"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>

                            <h3 style="color: red">Claim Decision </h3>
                            <p>All Your Submitted Assignment Decision</p>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>


    <!---->
    <!--        --------------------------------------------------------------------------------------------------------->
    <!---->
    <!--        --------------------------------------------------------------------------------------------------------->
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