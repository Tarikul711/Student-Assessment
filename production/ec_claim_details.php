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

$MailSend_Object = new MailClass();
$find_st_email_query= mysql_query("SELECT * FROM ecclaim WHERE ec_id='$id'");
while ($rows = mysql_fetch_array($find_st_email_query)) {
  echo  $send_mail_st_email= $rows['student_email'];
}

if (isset($_POST['approve_btn'])) {
    $send_to = $send_mail_st_email;//"tarikul711@gmail.com";
    $send_form = $email;//"torikul711@gmail.com";
    $subject = "Assessment Approve";
    $main_body = "Dear student your assessment was approved.";
    $query = mysql_query("UPDATE ecclaim SET processing_status='Approved' WHERE ec_id='$id'");
//    var_dump("UPDATE ecclaim SET processing_status='Approved' WHERE ec_id='$id'");
    $MailSend_Object->sendMail($send_form, $send_to, $subject, $main_body);
    header('location:ec_show_all_assessment.php');
}
if (isset($_POST['reject_submittion'])) {
    $reject_reasons = $_POST['reject_reasons'];
    $send_to = $send_mail_st_email;//"tarikul711@gmail.com";
    $send_form = $email;//"torikul711@gmail.com";
    $subject = "Assessment Rejected";
    $main_body = "Dear student your assessment Was Rejected.<br/> Because of <br/> " . $reject_reasons;
    $query = mysql_query("UPDATE ecclaim SET processing_status='Rejected' WHERE ec_id='$id'");
    $MailSend_Object->sendMail($send_form, $send_to, $subject, $main_body);
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

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
                        <h3>Plain Page</h3>
                    </div>

                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>

                <script type="text/javascript">
                    function show_hide() {
                        if (document.getElementById('reject').click) {
                            document.getElementById('reject_reason').style.display = 'block';
                        }
                    }

                </script>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">

                                <ul class="nav navbar-right panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#">Settings 1</a>
                                            </li>
                                            <li><a href="#">Settings 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>


                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab_content1" id="home-tab"
                                                                              role="tab" data-toggle="tab"
                                                                              aria-expanded="true"><span
                                                    style="color: #446CB3; font-size: medium ">Claim Details</span> </a>
                                    </li>

                                    <li role="presentation" class=""><a href="#tab_content3" role="tab"
                                                                        id="profile-tab2" data-toggle="tab"
                                                                        aria-expanded="false"><span
                                                    style="color: #446CB3; font-size: medium ">Student Profile</span></a>
                                    </li>
                                </ul>
                                <div id="myTabContent" class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                         aria-labelledby="home-tab">

                                        <!-- start recent activity -->
                                        <ul class="messages">
                                            <?php

                                            $result = mysql_query("SELECT * FROM ecclaim WHERE ec_id='$id'");
                                            while ($rows = mysql_fetch_array($result)) {

                                                $status = $rows['processing_status'];
                                                ?>

                                                <li>
                                                    <div class="message_date">
                                                        <h3 class="date text-info">Last Upload Date</h3>
                                                        <p class="month"><?php echo $rows['upload_date'] ?></p>
                                                    </div>
                                                    <div class="message_wrapper">
                                                        <h4 class="heading">Title: <span
                                                                    style="color: #00b3ee;"><?php echo $rows['title'] ?></span>
                                                        </h4>
                                                        <blockquote
                                                                class="message"><?php echo $rows['description'] ?></blockquote>
                                                        <br/>
                                                        <p class="url">
                                                            <span class="fs1 text-info" aria-hidden="true"
                                                                  data-icon=""></span>
                                                            <a href="<?php echo $rows['upload_document'] ?>"><i
                                                                        class="fa fa-paperclip"></i><?php echo $rows['upload_document'] ?>
                                                            </a><br/>
                                                            <a href="#"><i
                                                                        class="fa fa-paperclip"></i><?php echo $rows['upload_document2'] ?>
                                                            </a>
                                                        </p>
                                                    </div>
                                                </li>

                                                <?php
                                                $student_email = $rows['student_email'];


                                            } ?>

                                        </ul>
                                        <!-- end recent activity -->

                                    </div>

                                    <div role="tabpanel" class="tab-pane fade" id="tab_content3"
                                         aria-labelledby="profile-tab">
                                        <ul class="messages">
                                            <?php
                                            $st_info = mysql_query("SELECT * FROM studentinformation where st_email='$student_email'");
//                                            var_dump("SELECT * FROM studentinformation where st_email='$student_email'");
                                            while ($rows2 = mysql_fetch_array($st_info)) {
                                                ?>

                                                <li>
                                                    <img src="images/img.jpg" class="avatar" alt="Avatar">
                                                    <div class="message_wrapper">
                                                        <h4 class="heading"><span
                                                                    style="color: #00b3ee;"><?php echo $rows2['st_FirstName'] . " " . $rows2['st_Lastname'] ?></span>
                                                        </h4>
                                                        <blockquote class="message">
                                                            <h5>Student
                                                                ID: <?php echo $rows2['st_FirstName'] . " " . $rows2['st_id'] ?></h5>
                                                            <h5>Faculty: <?php echo $rows2['Faculty'] ?></h5>
                                                            <h5>Session: <?php echo $rows2['session'] ?></h5>
                                                            <h5>Email: <?php echo $rows2['st_email'] ?></h5>
                                                            <h5>Phone: <?php echo $rows2['st_phon'] ?></h5>
                                                        </blockquote>
                                                        <br/>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>


                                <form action="" method="post">
                                    <input type="submit" class="btn btn-success " name="approve_btn" value="Approve"/>
                                </form>
                                <form method="post" action="">

                                        <input type="button" class="btn btn-danger" value="Reject" id="reject" name="reject"
                                               onclick="show_hide()"/>

                                    <fieldset id="reject_reason" name="reject_reason" style="display: none">


                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="reason_title">Reject
                                                Reason <span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <textarea name="reject_reasons" required="required"
                                                          placeholder="Enter Your Reject Reasons"></textarea>
                                            </div>
                                        </div>
                                        <!--                                        <div class="clearfix"></div>-->

                                        <div class="form-group">
                                            <div class="col-md-5 col-sm-5 col-xs-10 col-md-offset-4">
                                                <button type="submit" name="reject_submittion" class="btn btn-danger">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>

                                    </fieldset>

                                </form>
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

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>
