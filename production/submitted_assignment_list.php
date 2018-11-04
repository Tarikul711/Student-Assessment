<?php
ob_start();
session_start();
require_once "../db_connection/config.php";
if (empty($_SESSION['user_email'])) {
    header('location:login_2.php');
}
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
                                <h2>Responsive example
                                    <small>Users</small>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <table id="datatable-responsive"
                                       class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Student Name</th>
                                        <th>Assignment</th>
                                        <th>Department</th>
                                        <th>Batch No</th>
                                        <th>Session</th>
                                        <th>Upload Date</th>
                                        <th>Uploaded File</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    if (isset($_SESSION['facultyName'])) {
                                        $facultyName = $_SESSION['facultyName'];
                                        // When Login Faculty Co Login
//                                        $result = mysql_query("SELECT * FROM assignment WHERE assesment.facultyName='$facultyName' ");
                                        $result = mysql_query("SELECT * FROM assignment,assesment WHERE assignment.assessment_Id=assesment.id AND 
assesment.facultyName='$facultyName'");
//var_dump("SELECT * FROM assignment,assesment WHERE assignment.assessment_Id=assesment.id AND
//assesment.facultyName='$facultyName'");
                                    } else {
                                        //When Admin Login
                                        $result = mysql_query("SELECT * FROM assignment");
//                                        var_dump("SELECT * FROM assignment");
                                    }
                                    $counter = 0;
                                    while ($rows = mysql_fetch_array($result)) {
                                        $counter++;

                                        ?>
                                        <tr>
                                            <td><?php echo $counter ?></td>
                                            <td><?php
                                                $st_email = $rows['student_email'];
                                                $st_info = mysql_query("SELECT * FROM studentinformation WHERE st_email='$st_email'");
                                                $st_result = mysql_fetch_array($st_info);
                                                echo $st_result[1] . " " . $st_result[2];
                                                ?></td>
                                            <td>
                                                <a><?php
                                                    $query_assName = mysql_query("SELECT * FROM assesment WHERE id='$rows[assessment_Id]'");
                                                    $query_result = mysql_fetch_array($query_assName);
                                                    echo $query_result[1] ?></a>

                                            </td>
                                            <td>
                                                <a>
                                                    <?php
                                                    $fID = $query_result[2];
                                                    $result1 = mysql_query("SELECT * FROM faculty  WHERE faculty.id='$fID' ");
                                                    $fname = mysql_fetch_array($result1);
                                                    echo $fname[1]
                                                    ?>

                                                </a>

                                            </td>

                                            <td><?php echo $st_result[9] ?>
                                            </td>

                                            <td>
                                                <?php
                                                echo $st_result[10] ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $rows['upload_date']
                                                ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo $rows   ['upload_document'] ?>"><i
                                                            class="fa fa-file"></i> </a>

                                            </td>
                                        </tr>

                                    <?php } ?>
                                    </tbody>
                                </table>


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
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>