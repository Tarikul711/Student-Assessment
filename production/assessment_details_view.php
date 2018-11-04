<?php
session_start();
require_once "../db_connection/config.php";
if (empty($_SESSION['user_email'])) {
    header('location:login_2.php');
}
if (empty($_REQUEST['id'])) {
    header('location:assessment_list.php');
}
$id = $_REQUEST['id'];
$email = $_SESSION['user_email'];

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
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <script>
        function confirm_delete() {
            return confirm('Are you sure want to delete this data?');
        }
    </script>
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php require_once "main_left_side_menu.php" ?>

        <?php require_once "top_menu.php" ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Assessment Details</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                $result = mysql_query("SELECT * FROM assesment WHERE assesment.id='$id' ");
                                while ($rows = mysql_fetch_array($result)) {
                                    ?>


                                    <h4>Faculty Name: <?php

                                        $fID=$rows['facultyName'];
                                          $result=mysql_query("SELECT * FROM faculty  WHERE faculty.id='$fID' ");
                                         $fname=mysql_fetch_array($result);

                                        echo "<div style='color: red'>".$fname[1]."</div>" ?>
                                    </h4>
                                    <h4>Department Name: <?php
                                        $fID=$rows['departmentName'];
                                         $result=mysql_query("SELECT * FROM department  WHERE id='$rows[departmentName]' ");
                                        $dname=mysql_fetch_array($result);

                                        echo "<div style='color: red'>".$dname[1]."</div>"?></h4>
									<h4>Assessment Name:<?php echo "<div style='color: red'>".$rows['ass_name']."</div>" ?></h4>
                                    
                                    <h4>Batch Number: &nbsp;&nbsp;<?php echo "<div style='color: red'>".$rows['batch_number']."</div>" ?></h4>
                                    <h4>Session: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<div style='color: red'>".$rows['sessions']."</div>" ?></h4>
                                    <h4>Submission Last Date: <?php echo "<div style='color: red'>".$rows['duDate'] ."</div>"?></h4>
                                    <h4>Assessment Doc: &nbsp;&nbsp; <a href="<?php echo $rows['documents'] ?>"><i class="fa fa-file"></i></a></h4>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
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
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>