<?php
session_start();
require_once "../db_connection/config.php";
if (empty($_SESSION['user_email'])) {
    header('location:login_2.php');
}
$student_email = $_SESSION['user_email'];

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
                <div class="page-title">
                    <div class="title_left">
                        <a href="submit_claim.php">
                            <button class="btn btn-info" type="button"><font color="white">Creae a New Claim</font>
                            </button>
                        </a>
                    </div>


                </div>

                <div class="clearfix"></div>

                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                            </div>
                            <div class="x_content">
                                <h2 class="text-muted font-13 m-b-30">
                                    All Assigned Assignment List
                                </h2>
                                <table id="datatable-fixed-header" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Assessment Name</th>
                                        <th>Batch No</th>
                                        <th>Last Date</th>
                                        <th>Documents</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php
                                    $result = mysql_query("SELECT * FROM studentinformation WHERE st_email='$student_email'");
                                    $st_info = mysql_fetch_array($result);
                                    $counter = 0;
                                    $query = mysql_query("SELECT * FROM assesment WHERE facultyName='$st_info[11]' AND batch_number='$st_info[9]' AND sessions='$st_info[10]' AND departmentName='$st_info[12]'");
                                    while ($rows = mysql_fetch_array($query)) {
                                        $counter++;
                                        $sql_query = mysql_query("SELECT * FROM ecclaim WHERE assessment_Id='$rows[id]' AND ecclaim.student_email='$student_email' AND claimStatus='Complete'");
//                                        var_dump("SELECT * FROM ecclaim WHERE assessment_Id='$query[id]' AND ecclaim.student_email='$student_email' AND claimStatus='Complete'");
                                        $sql_result = mysql_fetch_array($sql_query);
                                        ?>
                                        <tr>
                                            <td><?php echo $counter ?></td>
                                            <td><?php echo $rows['ass_name'] ?></td>
                                            <td>
                                                <?php
                                                if ($sql_result > 0) {
                                                    echo "<p class='label label-success'> Submitted</p>";
                                                } else {
                                                    echo "<p class=\"label label-danger\">Not Submitted</p>";
                                                }

                                                ?>

                                            </td>
                                            <td><?php $rows['duDate'];

                                                $date_expire = $rows['duDate'];
                                                $date = new DateTime($date_expire);
                                                $now = new DateTime();
                                                if($now<$date){
                                                echo "<p class=\"bg-primary\">" . $date->diff($now)->format("%d days Left") . "</p>";
                                                }else{
                                                    echo "Date Already Over";
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <a href="<?php echo $rows['documents'] ?>"><i
                                                            class="fa fa-link">Download Problem</i></a>
                                            </td>

                                            <td>

                                                <?php
                                                if($now<=$date){
                                                ?>
                                                <a href="submit_claim.php">
                                                    <button class="btn btn-sm btn-success">Submit</button>
                                                </a>
                                                <?php }else{?>
                                                    <a href="submit_claim.php">
                                                        <button class="btn btn-sm btn-danger disabled">Time Out </button>
                                                    </a>
                                                <?php }?>
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