<?php
ob_start();
session_start();
require_once "../db_connection/config.php";
require_once "common_function.php";
if (empty($_SESSION['user_email'])) {
    header('location:login_2.php');
}
if (empty($_REQUEST['id'])) {
    header('location:assessment_list.php');
}
$id = $_REQUEST['id'];
$email = $_SESSION['user_email'];

if (isset($_POST['submit'])) {
    $message = $_POST['message'];
    $send_to = "tarikul711@gmail.com";
    $send_form = "torikul711@gmail.com";
    $subject = "Password Retrieve";
    sendMail($send_form, $send_to, $subject, $message);
    mysql_query("UPDATE password_retrieve SET confirmation='Password Send' WHERE id='$id'");
    header("location:st_password_management.php");

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
                                <h2>Student Password Retrieve!</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                $result = mysql_query("SELECT * FROM password_retrieve WHERE password_retrieve.id='$id' ");
                                while ($rows = mysql_fetch_array($result)) {
                                    ?>


                                    <h4>Student Name: <?php

                                        echo "<div style='color: red'>" . $rows['name'] . "</div>" ?>
                                    </h4>
                                    <h4>Email Address: <?php
                                        echo "<div style='color: red'>" . $rows['email'] . "</div>" ?></h4>
                                    <h4>
                                        Confirmation:<?php echo "<div style='color: red'>" . $rows['confirmation'] . "</div>" ?></h4>
                                    <br><br><br>
                                    <h3 style="color: #00A000"> SEND EMAIL </h3>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <div class="col-xs-12">
                                                <div class="col-xs-12 col-md-12">
                                                    <textarea rows="3" placeholder="Password And Other Message"
                                                              name="message"></textarea>
                                                    <h1></h1>
                                                </div>
                                                <div class="col-xs-12 col-md-12">
                                                    <input type="submit" class="btn btn-primary" value="SEND PASSWORD"
                                                           name="submit">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
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