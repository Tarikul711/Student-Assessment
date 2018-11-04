<?php
ob_start();
session_start();
require_once "../db_connection/config.php";
if (!isset($_REQUEST['id'])) {
    header('location:student_profile.php');
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
    <!-- jQuery custom content scroller -->
    <link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php require_once "main_left_side_menu.php" ?>

        <?php require_once "top_menu.php" ?>

        <div class="right_col" role="main">
            <div class="row">


                <div class="x_panel">
                    <div class="x_title">
                        <h2>Claim Details</h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <?php
                        $id = $_REQUEST['id'];
                        $result2 = mysql_query("SELECT * FROM ecclaim  WHERE ec_id='$id'");
                        while ($rows = mysql_fetch_array($result2)) {
                            ?>
                            <h4>Assessment Name:<?php echo "<div style='color: red'>".$rows['assessment_Id']."</div>" ?></h4>

                            <h4>Title: &nbsp;&nbsp;<?php echo "<div style='color: red'>".$rows['title']."</div>" ?></h4>
                            <h4>Description: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<div style='color: red'>".$rows['description']."</div>" ?></h4>
                            <h4>Assessment Doc: &nbsp;&nbsp; <a href="<?php echo $rows['upload_document'] ?>"><i class="fa fa-file"></i></a></h4>
                        <?php } ?>
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
<!-- jQuery custom content scroller -->
<script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>