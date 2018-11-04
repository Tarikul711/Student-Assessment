<?php
ob_start();
session_start();
require_once '../db_connection/config.php';

if (!isset($_SESSION['user_email'])) {
    header('location:login_2.php');
}


function imageUpload($fileName, $path)
{
    $errors = array();
    $file = $_FILES[$fileName];
    $file_name = $file['name'];
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_type = $file['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));
    $expensions = array("jpeg", "jpg", "png", "pdf");
    if (in_array($file_ext, $expensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        $uploadPath = $path . $file_name;
        move_uploaded_file($file_tmp, $uploadPath);
        return $uploadPath;
    } else {
        return false;
    }
}


$email = $_SESSION['user_email'];
if (isset($_POST['submit'])) {
    $assessment_name = $_POST['assessment_name'];
    $faculty_name = $_POST['faculty_name'];
    $batch_number = $_POST['batch_number'];
    $session = $_POST['session'];
    $department_name = $_POST['department_name'];
//    $sub_date1 = $_POST['sub_date'];
    $sub_date1 = date_create($_POST['sub_date']);
    $sub_date = date_format($sub_date1, "Y/m/d");

    $late_sub=date_create($_POST['late_submit']);
    $late_sub_date = date_format($late_sub, "Y/m/d");

    $dates = date("Y/m/d");
    $claimFile = imageUpload('fileToUpload', "claim_problem/");
    try {
        if (empty($assessment_name) || empty($faculty_name) || empty($batch_number) || empty($session) || empty($sub_date) || empty($claimFile)) {
            throw new Exception("Field Can't Be Empty");
        }
        if (!$claimFile) {
            throw new Exception("You Can Upload Image OR PDF File");
        }
        $query = mysql_query("SELECT * FROM assesment WHERE ass_name='$assessment_name' AND facultyName='$faculty_name' AND 
          batch_number='$batch_number' AND sessions='$session' AND departmentName='$department_name'");
//        var_dump("SELECT * FROM assesment WHERE ass_name='$assessment_name' AND facultyName='$faculty_name' AND
//          batch_number='$batch_number' AND sessions='$session'");
        $num = mysql_num_rows($query);
        echo "tarikul" . $num;
        if ($num > 0) {
            throw new Exception("Assessment Already Exist");
        }

        $result = mysql_query("INSERT INTO assesment (ass_name,facultyName,batch_number,sessions,dates,duDate,lastSubDate,documents,departmentName)
VALUES ('$assessment_name','$faculty_name','$batch_number','$session','$dates','$sub_date','$late_sub_date','$claimFile','$department_name')");
//        var_dump("INSERT INTO assesment (ass_name,facultyName,batch_number,sessions,dates,duDate,lastSubDate,documents,departmentName)
//VALUES ('$assessment_name','$faculty_name','$batch_number','$session','$dates','$sub_date',$late_sub_date,'$claimFile','$department_name')");
        $success = "Successfuly Claim Created";
        header('location:assessment_list.php');
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
    <link href="css/jquery-ui.min.css" rel="stylesheet"/>
    <link href="css/custom.css" rel="stylesheet"/>
</head>

<body class="nav-md footer_fixed">
<div class="container body">
    <div class="main_container">
        <?php require_once "main_left_side_menu.php" ?>
        <?php require_once "top_menu.php" ?>

        <!-- page content -->
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
                                    <h3 align="center"><b>Create A New Assessment</b></h3>
                                </div>
                                <div class="x_content">
                                    <br/>

                                    <h2><?php
                                        if (isset($success)) {
                                            echo $success;
                                        }
                                        if (isset($error)) {
                                            echo "<div style='color: red'>" . $error . "</div>";
                                        }
                                        ?></h2>
                                    <form id="myform" enctype="multipart/form-data" action="" method="post"
                                          data-parsley-validate
                                          class="form-horizontal form-label-left">

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Faculty
                                                Name <span class="required" style="color: red">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <select name="faculty_name" class="select2_group form-control">
                                                    <?php
                                                    $query = mysql_query("SELECT * FROM faculty");
                                                    while ($rows = mysql_fetch_array($query)) {
                                                        ?>

                                                        <option value="<?php echo $rows['id'] ?>"
                                                        ><?php echo $rows['facultyName'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Department
                                                Name <span class="required" style="color: red">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <select name="department_name" class="select2_group form-control">
                                                    <?php
                                                    $query = mysql_query("SELECT * FROM department");
                                                    while ($rows = mysql_fetch_array($query)) {
                                                        ?>

                                                        <option value="<?php echo $rows['id'] ?>"
                                                        ><?php echo $rows['department_name'] ?></option>

                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Assessment
                                                Name <span class="required" style="color: red">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <input type="text" id="title" name="assessment_name" required="required"
                                                       class="form-control col-md-4 col-xs-8">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Batch
                                                Number <span class="required" style="color: red">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <input type="text" id="title" name="batch_number" required="required"
                                                       class="form-control col-md-4 col-xs-8">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Academic
                                                Session <span class="required" style="color: red">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <input type="text" id="field" name="session" required="required"
                                                       class="form-control col-md-4 col-xs-8">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Submission
                                                Last Date <span class="required" style="color: red">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <input type="text" id="datepicker" name="sub_date" required="required"
                                                       class="form-control col-md-4 col-xs-8">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="title">Late Submission Date:
                                                <span class="required" style="color: red">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-10">
                                                <input type="text" id="datepicker2" name="late_submit" required="required"
                                                       class="form-control col-md-4 col-xs-8">

                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <span class="btn btn-primary btn-file">
                                                <span class="fileupload-new">Upload Assignment Doc</span>
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
<script src="js/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>

<script>
    var dateToday = new Date();
    $(function () {
        $("#datepicker").datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            minDate: dateToday
        });
    });

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#myform").validate({
        rules: {
            field: {
                required: true,
                number: true
            }
        }
    });

</script>
<script>
    var dateToday = new Date();
    $(function () {
        $("#datepicker2").datepicker({
            numberOfMonths: 3,
            showButtonPanel: true,
            minDate: dateToday
        });
    });

    jQuery.validator.setDefaults({
        debug: true,
        success: "valid"
    });
    $("#myform").validate({
        rules: {
            field: {
                required: true,
                number: true
            }
        }
    });

</script>
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