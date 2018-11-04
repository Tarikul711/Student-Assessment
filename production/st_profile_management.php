<?php
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
                                        <th>Name</th>
                                        <th>Faculty</th>
                                        <th>Department</th>
                                        <th>Batch No</th>
                                        <th>Session</th>
                                        <th>Phone</th>
                                        <th>#Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>


                                    <?php
                                    $result=mysql_query("SELECT * FROM studentinformation");
                                    $counter = 0;
                                    while ($rows = mysql_fetch_array($result)) {
                                        $counter++;
                                        ?>
                                        <tr>
                                            <td><?php echo $counter ?></td>
                                            <td>
                                                <a><?php echo $rows['st_FirstName']." ".$rows['st_Lastname'] ?></a>

                                            </td>
                                            <td>
                                                <a>
                                                    <?php
                                                    $fID = $rows['Faculty'];
                                                    $result1 = mysql_query("SELECT * FROM faculty  WHERE faculty.id='$fID' ");
                                                    $fname = mysql_fetch_array($result1);
                                                    echo $fname[1]
                                                    ?>

                                                </a>

                                            </td>
                                            <td>
                                                    <?php
                                                    $fID = $rows['department'];
                                                    $result2 = mysql_query("SELECT * FROM department  WHERE id='$rows[department]' ");
                                                    $dname = mysql_fetch_array($result2);
                                                    echo $dname[1];
                                                    ?>
                                            </td>

                                            <td><?php echo $rows['batchNo'] ?>
                                            </td>

                                            <td>
                                                <?php
                                                echo $rows['session'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo $rows['st_phon'] ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                   href="st_profile_detais_view.php?id=<?php echo $rows['st_id']; ?>"><i
                                                            class="fa fa-folder"></i>
                                                    View
                                                </a>

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