<?php
session_start();
ob_start();
require_once "../db_connection/config.php";
require_once "MailClass.php";
if (empty($_SESSION['user_email'])) {
    header('location:login_2.php');
}
if (empty($_REQUEST['id'])) {
    header('location:ec_show_all_assessment.php');
}

$email = $_SESSION['user_email'];
$id = $_REQUEST['id'];
echo $id;
$MailSend_Object = new MailClass();
$find_st_email_query = mysql_query("SELECT * FROM ecclaim WHERE ec_id='$id'");
while ($rows = mysql_fetch_array($find_st_email_query)) {
    $send_mail_st_email = $rows['student_email'];
}

if (isset($_POST['approve_btn'])) {
    $send_to = $send_mail_st_email;//"tarikul711@gmail.com";
//    $send_to = "torikul711@gmail.com";
    echo $send_mail_st_email;
//    die();
//    $send_form = $email;//"torikul711@gmail.com";
    $send_form = "torikul711@gmail.com";
    $subject = "Assignment(Approved) ";
    $main_body = "Dear student your assessment was approved. As soon As Possible solve this problem";
    $query = mysql_query("UPDATE ecclaim SET processing_status='Approved' WHERE ec_id='$id'");
//    var_dump("UPDATE ecclaim SET processing_status='Approved' WHERE ec_id='$id'");
    $MailSend_Object->sendMail($send_form, "mdhasan17193@gmail.com", $subject, $main_body);
    header('location:ec_show_all_assessment.php');
}
if (isset($_POST['reject_submittion'])) {
    $reject_reasons = $_POST['reject_reasons'];
    $send_to = $send_mail_st_email;//"tarikul711@gmail.com";
//    $send_to = "torikul711@gmail.com";
    $send_form = "torikul711@gmail.com";
    $subject = "Assessment Rejected";
    $main_body = "Dear student your assessment Was Rejected.<br/> Because of \n" . $reject_reasons;
    $query = mysql_query("UPDATE ecclaim SET processing_status='Rejected' WHERE ec_id='$id'");
    $MailSend_Object->sendMail($send_form, "developer.tarikul711@gmail.com", $subject, $main_body);
    header('location:ec_show_all_assessment.php');
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
                                <h2>Claim INFO</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <?php
                                $result = mysql_query("SELECT * FROM ecclaim WHERE ec_id='$id' ");
                                $resultClaim = mysql_query("SELECT * FROM ecclaim WHERE ec_id='$id' ");
                                $find_status = mysql_fetch_array($result);
                                while ($rows = mysql_fetch_array($resultClaim)) {

                                    $ass_id = $rows['assessment_Id'];
                                    $query = mysql_query("SELECT * FROM assesment WHERE id='$ass_id'");
                                    $ass_title = mysql_fetch_array($query);
                                    $student_Email = $rows['student_email'];
                                    ?>
                                    <h3>Assessment
                                        Title: <?php echo "<div style='color: red'>" . $ass_title[1] . "</div>" ?></h3>
                                    <h4>Claim Title: <?php echo $rows['title'] ?></h4>
                                    <h4>Claim Description: <?php echo $rows['description'] ?></h4>
                                    <h4>Claim Upload: <?php echo $rows['upload_date'] ?></h4>
                                    <h4>Upload Status: <?php echo $rows['claimStatus'] ?></h4>
                                    <h4>Claim Processing
                                        Status: <?php echo "<div style='color: red'>" . $rows['processing_status'] . "</div>" ?></h4>
                                    <h4>Claim Evidence: &nbsp;&nbsp; <a href="<?php echo $rows['upload_document'] ?>"><i
                                                    class="fa fa-file"></i></a></h4>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Student INFO</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <?php

                                $st_info = mysql_query("SELECT * FROM studentinformation WHERE st_email='$student_Email' ");
                                while ($rows = mysql_fetch_array($st_info)) {
                                    $faculty = $rows['Faculty'];
                                    $departmentId = $rows['department'];
                                    $query = mysql_query("SELECT * FROM faculty where id='$faculty'");
                                    $query_department = mysql_query("SELECT * FROM department where id='$departmentId'");
                                    $faculty_name = mysql_fetch_array($query);
                                    $department_name = mysql_fetch_array($query_department);

                                    ?>
<!--                                    <h3>Student Name: --><?php //echo $rows['st_FirstName'] . " " . $rows['st_Lastname'] ?><!--</h3>-->
                                    <h3>Student Name: <?php echo "MD Tarikul Islam "?></h3>
                                    <h4>Faculty: <?php echo $faculty_name[1] ?></h4>
                                    <h4>Department: <?php echo $department_name[1] ?></h4>
                                    <h4>Batch No: <?php echo $rows['batchNo'] ?></h4>
                                    <h4>Session: <?php echo $rows['session'] ?></h4>
                                    <h4>Address: <?php echo $rows['st_address'] ?></h4>
                                    <h4>Phone: <?php echo $rows['st_photo'] ?></h4>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Claim Operations</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">

                                <div class="col-xs-12">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <div class="col-xs-12 col-md-12">
                                                <textarea rows="5" name="reject_reasons" placeholder="Message"></textarea>
                                                <br/>
                                                <h1></h1>
                                                <h1></h1>
                                            </div>

                                            <div class="col-xs-12 col-md-12">
                                                <?php
                                                $values = $find_status[10];
                                                if(strcmp($values,"Rejected")==0){
                                                ?>

                                                <input type="submit" class="btn btn-success " name="approve_btn"
                                                       value="Approve"/>
                                                    <button type="submit" name="reject_submittion" class="btn btn-danger disabled">
                                                        Reject
                                                    </button>
                                                <?php }elseif(strcmp($values,"Approved")==0){?>
                                                    <input type="submit" class="btn btn-success disabled " name="approve_btn"
                                                           value="Approve"/>
                                                    <button type="submit" name="reject_submittion" class="btn btn-danger ">
                                                        Reject
                                                    </button>

                                                <?php }else{?>
                                                    <input type="submit" class="btn btn-success " name="approve_btn"
                                                           value="Approve"/>
                                                    <button type="submit" name="reject_submittion" class="btn btn-danger ">
                                                        Reject
                                                    </button>
                                                <?php }?>

                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <!--                                <form action="" method="post">-->
                                <!--                                    <input type="submit" class="btn btn-success " name="approve_btn" value="Approve"/>-->
                                <!--                                </form>-->
                                <!--                                <form method="post" action="">-->
                                <!--                                    <input type="button" class="btn btn-danger" value="Reject" id="reject" name="reject"-->
                                <!--                                           onclick="show_hide()"/>-->
                                <!--                                    <fieldset id="reject_reason" name="reject_reason" style="display: none">-->
                                <!--                                        <div class="form-group">-->
                                <!--                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="reason_title">Reject-->
                                <!--                                                Reason <span class="required">*</span>-->
                                <!--                                            </label>-->
                                <!--                                            <div class="col-md-5 col-sm-5 col-xs-10">-->
                                <!--                                                <textarea name="reject_reasons" required="required"-->
                                <!--                                                          placeholder="Enter Your Reject Reasons"></textarea>-->
                                <!--                                            </div>-->
                                <!--                                        </div>-->
                                <!--                                        <div class="form-group">-->
                                <!--                                            <div class="col-md-5 col-sm-5 col-xs-10 col-md-offset-4">-->
                                <!--                                                <button type="submit" name="reject_submittion" class="btn btn-danger">-->
                                <!--                                                    Submit-->
                                <!--                                                </button>-->
                                <!--                                            </div>-->
                                <!--                                        </div>-->
                                <!---->
                                <!--                                    </fieldset>-->
                                <!---->
                                <!--                                </form>-->
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