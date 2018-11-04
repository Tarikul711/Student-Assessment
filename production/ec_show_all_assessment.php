<?php
session_start();
require_once "../db_connection/config.php";
if (empty($_SESSION['user_email'])) {
    header('location:login_2.php');
}
$email = $_SESSION['user_email'];
$facultyName = $_SESSION['facultyName']

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
        <div class="right_col" role="main">
            <div class="">

                <div class="clearfix"></div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="x_panel">
                            <div class="x_title">
                                <h2>All Submitted Claim
                                    <small>Users</small>
                                </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <p class="text-muted font-13 m-b-30">
                                </p>

                                <table id="datatable-responsive"
                                       class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                       width="100%">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%">No.</th>
                                        <th style="width: 25%">Title</th>
                                        <th style="width: 30%">Description</th>
                                        <th style="width: 15%">Decision Time</th>
                                        <th>Status</th>
                                        <th style="width: 20%">#Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //                                    $result = mysql_query("SELECT * FROM ecclaim WHERE student_email='$email'");
                                    $result = mysql_query("SELECT * FROM ecclaim,assesment WHERE assesment.facultyName='$facultyName' AND claimStatus='Complete' AND 
                                        assesment.id=ecclaim.assessment_Id");
                                    $counter = 0;
                                    while ($rows = mysql_fetch_array($result)) {
                                        $counter++;
                                        ?>
                                        <tr>
                                            <td><?php echo $counter ?></td>
                                            <td>
                                                <a><?php echo $rows['title'] ?></a>
                                                <br/>
                                                <small>Created <?php echo $rows['upload_date'] ?></small>
                                            </td>

                                            <td><?php echo $rows['description'] ?> </td>
                                            <td><?php $up_date = $rows['upload_date'];
                                                $last_process_date = date("Y/m/d", strtotime($up_date . "+14 days"));
                                                //                                                echo  $last_process_date;
                                                //                                                $left_date=date_diff($up_date,$last_process_date);
                                                $today = new DateTime($up_date);
                                                $today2 = new DateTime($last_process_date);
                                                $dd = date_diff($today, $today2, 1);
                                                $date_expire = $last_process_date;
                                                $date = new DateTime($date_expire);
                                                $now = new DateTime();
                                                if ($now < $date) {
                                                    echo "<p class=\"bg-primary\">" . $date->diff($now)->format("%d days Left") . "</p>";
                                                } else {
                                                    echo "<p class=\"bg-warning\">" . "Processing Time Over" . "</p>";
                                                }
                                                ?> </td>

                                            <td>
                                                <?php
                                                $status = $rows['processing_status'];
                                                if (strcmp($status, "Approved") == 0) {
                                                    ?>
                                                    <button type="button"
                                                            class="btn btn-success btn-xs">Approved
                                                    </button>
                                                <?php } else if (strcmp($status, "Rejected") == 0) {
                                                    ?>
                                                    <button type="button"
                                                            class="btn btn-danger btn-xs">Rejected
                                                    </button>
                                                <?php } else { ?>
                                                    <button type="button"
                                                            class="btn btn-warning btn-xs">In Decision
                                                    </button>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($now < $date) {
                                                    ?>
                                                    <a class="btn btn-primary btn-xs"
                                                       href="ec_claim_details_2.php?id=<?php echo $rows['ec_id']; ?>"><i
                                                                class="fa fa-folder"></i>
                                                        View &nscr;|&nscr; Process
                                                    </a>
                                                <?php } else {
                                                    ?>
                                                    <a class="btn btn-warning btn-xs disabled"
                                                       href="ec_claim_details.php?id=<?php echo $rows['ec_id']; ?>"><i
                                                                class="fa fa-folder"></i>
                                                        Process Time Out
                                                    </a>
                                                <?php } ?>
                                                <!--                                                <a class="btn btn-info btn-xs"href="edit_claim.php  ?id=-->
                                                <?php //echo $rows['ec_id']; ?><!--"><i class="fa fa-pencil"></i>-->
                                                <!--                                                    Edit-->
                                                <!--                                                </a>-->
                                                <!--                                                <a class="btn btn-danger btn-xs"onclick="return confirm_delete()"href="delete_claim.php?c_id=-->
                                                <?php //echo $rows['ec_id']; ?><!--"><i class="fa fa-trash-o"></i>-->
                                                <!--                                                    Delete </a>-->
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