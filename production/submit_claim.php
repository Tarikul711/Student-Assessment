<?php
ob_start();
session_start();
require_once '../db_connection/config.php';
require_once "common_function.php";
require_once "FileUploadClass.php";
//require_once "MailClass.php";

if (!isset($_SESSION['user_email'])) {
    header('location:login_2.php');
}
$student_email = $_SESSION['user_email'];
if (isset($_POST['submit'])) {
    $title = $_POST['claimtitle'];
    $description = $_POST['claimdescription'];
//    $claimFile = 'a';
    $ass_id = $_POST['ass_id'];
    $dates = date("Y/m/d");
    $claimFile = imageUpload('fileToUpload', "claim_doc/");
    try {
        if (empty($title) || empty($description) || empty($ass_id)) {
            throw new Exception("Field Can't Be Empty");
        }
        $fileName = $_FILES['fileToUpload']['name'];
        if (strlen($fileName) > 0) {

            if (!$claimFile) {
                throw new Exception("You Can Upload Image OR PDF File");

            } else {
                echo $claimFile;
                $result = mysql_query("INSERT INTO ecclaim (title,description,upload_document,upload_date,assessment_Id,claimStatus,processing_status,student_email)
VALUES ('$title','$description','$claimFile','$dates','$ass_id','Complete','InProcess','$student_email')");

                $query = mysql_query("SELECT *  FROM studentinformation WHERE st_email='$student_email'");
                $st_info = mysql_fetch_array($query);
                $query10 = mysql_query("SELECT * FROM managementinfo WHERE role='ec_coordinator' AND facultyName='$st_info[11]'");
                $management_info = mysql_fetch_array($query10);
//                var_dump("SELECT * FROM managementinfo WHERE role='ec_coordinator' AND facultyName='$st_info[11]'");
                $send_to = "tarikul711@gmail.com";
                $send_form = "torikul711@gmail.com";
                $subject = "New Claim";
                $main_body = "Submitted New Claim By<br/>" . "Name: " . $st_info[1] . " " . $st_info[2]."\n"."Send A Claim . This Claim Will process Within 14 day.";
                sendMail($send_form, $send_to, $subject, $main_body);
//                sendMail("torikul711@gmail.com", "tarikul711@gmail.com", "Test Tarikul", "Hello Tarikul");
//                die();
                header("location:student_profile.php");
            }
        } else {
            $result = mysql_query("INSERT INTO ecclaim (title,description,upload_document,upload_date,assessment_Id,claimStatus,processing_status,student_email)
VALUES ('$title','$description','$claimFile','$dates','$ass_id','Incomplete','InProcess','$student_email')");
            header("location:student_profile.php");
        }

        $success = "Successfuly Claim Created";
    } catch (Exception $e) {
        $error = $e->getMessage();
    }


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
    <link href="../build/css/custom.min.css" rel="stylesheet"/>
    <link href="css/custom.css" rel="stylesheet"/>
</head>

<body class="nav-md footer_fixed">
<div class="container body">
    <div class="main_container">
        <?php require_once "main_left_side_menu.php" ?>

        <?php require_once "top_menu.php" ?>
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="x_title">

                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h3 align="center"><b>Create your claim</b></h3>
                                </div>
                                <div class="x_content">
                                    <br/>

                                    <h2><?php
                                        if (isset($success)) {
                                            echo $success;
                                        }
                                        if (isset($error)) {
                                            echo "<h2 style='color: red'>".$error."</h2>";
                                        }
                                        ?></h2>
                                    <form id="demo-form2" enctype="multipart/form-data" action="" method="post"
                                          data-parsley-validate
                                          class="form-horizontal form-label-left">

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Assesment
                                                Name</label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <select name="ass_id" class="select2_group form-control">
                                                    <?php
                                                    $student_info = mysql_query("SELECT * FROM studentinformation WHERE st_email='$student_email'");
                                                    $query_result = mysql_fetch_array($student_info);
                                                    $currentDate = date("Y/m/d");
                                                    $facultyName = $query_result[11];
                                                    $departmentName = $query_result[12];
                                                    $result = mysql_query("SELECT * FROM assesment WHERE facultyName='$facultyName' AND departmentName='$departmentName' AND duDate>='$currentDate'");
                                                    while ($rows = mysql_fetch_array($result)) {
                                                        ?>

                                                        <option value="<?php echo $rows['id'] ?>"
                                                        ><?php echo $rows['ass_name'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Claim
                                                Title <span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <input type="text" id="title" name="claimtitle" required="required"
                                                       class="form-control col-md-4 col-xs-8">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="description">Claim
                                                Description</label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <textarea class="resizable_textarea form-control" id="description"
                                                          required="required" rows="5" name="claimdescription"
                                                          placeholder="Write Description here..."></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">

                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-primary btn-file">
                                                <span class="fileupload-new">Upload Your Evidence</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" name="fileToUpload"/></span>
                                                <span class="fileupload-preview"></span>
                                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload"
                                                   style="float: none">×</a>
                                            </div>

                                        </div>

                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-5 col-sm-5 col-xs-10 col-md-offset-4">
                                                <button class="btn btn-primary" type="button">Cancel</button>
                                                <button class="btn btn-primary" type="reset">Reset</button>
                                                <input type="submit" class="btn btn-success" value="Submit"
                                                       name="submit"/>
                                            </div>
                                        </div>

                                    </form>
                                </div>
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
<script src="js/file.js"></script>
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