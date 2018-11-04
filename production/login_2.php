<?php
ob_start();
session_start();
require_once "../db_connection/config.php";
if (isset($_POST['submit'])) {

    try {
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            throw new Exception("Field Can't Empty");
        }
        $result = mysql_query("select * from studentinformation where st_email='$email' and st_password='$password' ");
        $num = mysql_num_rows($result);
        var_dump($num);
        if ($num == 1) {
            $_SESSION['user_email'] = $email;
            $_SESSION['user_type'] = "student";
            header('location:student_main.php');
        } else {
            $result2 = mysql_query("select * from managementinfo where email='$email' and password='$password' ");
            $num2 = mysql_num_rows($result2);
            if ($num2 == 1) {
                $_SESSION['user_email'] = $email;
                $qu = mysql_query("SELECT role,facultyName FROM managementinfo Where email='$email'");
                $result2 = mysql_fetch_array($qu);
                echo $result2[1];
                if (strcmp($result2[0], "ec_coordinator") == 0) {
                    $_SESSION['facultyName'] = $result2[1];
                    $_SESSION['user_type'] = "ec_coordinator";
                    header('location:ec_cordinator_main.php');
                } elseif (strcmp($result2[0], "ec_manager") == 0) {
                    $_SESSION['user_type'] = "ec_manager";
                    header('location:ec_manager_dashboard.php');
                } elseif (strcmp($result2[0], "admin") == 0) {
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_type'] = "admin";
                    header('location:admin_Dashboard.php');
                } else {
                    header('location:add_assessment.php');
                }
            } else {
                throw new Exception("Invalid Username or Password");
            }
        }

    } catch
    (Exception $e) {
        $error = $e->getMessage();
    }
}


if (isset($_POST['password_retrieve'])) {
    $retrieve_email = $_POST['re_email'];
    $name= $_POST['name'];
    try {
        if (empty($retrieve_email)) {
            throw new Exception("Enter Your Valid email Address");
        }
        mysql_query("INSERT INTO password_retrieve (name,email,confirmation) VALUES ('$name','$retrieve_email','pending')");

        $success_message = "Your Password will send within 24 Hours By System Admin";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
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
    <!-- Animate.css -->
    <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form id="demo-form2" action="" method="post" data-parsley-validate
                      class="form-horizontal form-label-left">
                    <h1>Login Form</h1>
                    <h2><?php
                        if (isset($success)) {
                            echo $success;
                        }
                        if (isset($error)) {
                            echo $error;
                        }
                        ?></h2>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-8" for="email">Email <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <input type="email" id="email" required="required" name="email"
                                   class="form-control col-md-4 col-xs-8">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-8" for="password">Password <span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <input type="password" id="password" name="password" required="required"
                                   class="form-control col-md-4 col-xs-8">
                        </div>
                    </div>
                    <div>
                        <div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-4">
                            <input type="submit" class="btn btn-success" value="Submit" name="submit"/>
                        </div>
                    </div>


                    <div class="clearfix"></div>

                    <div class="separator">
                        <a href="#signup" style="color: #00A000;" class="to_register"> Forget Your Password?</a>
                        </p>

                        <div class="clearfix"></div>
                        <br/>


                    </div>
                </form>
            </section>
        </div>


        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <?php
                if (isset($error_message)) {
                    echo "<p style=\"color: red;\">" . $error_message . "</p>";
                }
                if (isset($success_message)) {
                    echo $success_message;
                }
                ?>

                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                            </div>
                            <div class="modal-body">
                                <p>Some text in the modal.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>


                <form action="" method="post">
                    <h1>Forget Your Password</h1>
<!--                    <div>-->
<!--                        <p>Enter Your Email For Retrieve Your Password </p>-->
<!--                    </div>-->
                    <div>
                        <input type="text" name="name" class="form-control" placeholder="Name" required=""/>
                    </div>
                    <div>
                        <input type="email" name="re_email" class="form-control" placeholder="Email" required=""/>
                    </div>
                    <div>
                        <input class="btn btn-default submit" type="submit" name="password_retrieve" value="Submit"/>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" style="color: red" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br/><br/><br/>
                        <br/><br/><br/><br/>
                        <br/>
                        <br/>
                        <br/>
                        <br/>

                        <div>
                            <h1><i class="fa fa-paw"></i> Greenwich University!</h1>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>
