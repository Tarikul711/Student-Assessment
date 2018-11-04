<?php
ob_start();
session_start();
require_once '../db_connection/config.php';

if (!isset($_SESSION['user_email'])) {
    header('location:login_2.php');
}

// this for showall assignment page load funtion
$_SESSION['ec_manager'] = "ec_manager";

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


    <link rel="stylesheet" href="main.css">

    <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>

</head>

<body class="nav-md">

<style>
    .jumbotron {
        padding-top: 20px;
        padding-bottom: 10px;
        color: white;
        background-color: #4570a5;
    }

    .jumbotron > h1 {
        font-size: 75pt;
        font-family: "Times New Roman", Times, serif;
        margin: 0;
    }

    .jumbotron > p {
        margin: 0;
    }
</style>

<div class="container body">
    <div class="main_container">
        <?php require_once "main_left_side_menu.php" ?>
        <!-- top navigation -->
        <?php require_once "top_menu.php" ?>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="row">


                <form class="form-inline" action="" method="post">
                    <div class="form-group">
                        <label for="email">Faculty Name:</label>
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
                    <div class="form-group">
                        <label for="pwd">Academic Year:</label>
                        <select name="academin_year" class="select2_group form-control">
                            <option value="2017">2017</option>
                            <option value="2016">2016</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>


                <!--                <div id="population_chart" data-sort="false" data-width="800" class="jChart chart-lg"-->
                <!--                     name="Number of claims within each Faculty for each academic year.">-->
                <!---->
                <!---->
                <!--                    <div class="define-chart-row" data-color="#84d6ff" title="Arizona">10</div>-->
                <!--                    <div class="define-chart-row" data-color="#38BCFF" title="New Mexico">2</div>-->
                <!--                    <div class="define-chart-row" data-color="#00A9FF" title="Nevada">1</div>-->
                <!--                    <div class="define-chart-row" data-color="#008DD3" title="Colorado">5</div>-->
                <!--                    <div class="define-chart-row" data-color="#0074AA" title="Utah">3</div>-->
                <!--                    <div class="define-chart-row" data-color="#005882" title="California">9</div>-->
                <!---->
                <!--                </div>-->


                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="datatable-responsive_wrapper"
                             class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="row">
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="datatable-responsive"
                                           class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                           role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;"
                                           cellspacing="0" width="100%">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable-responsive"
                                                rowspan="1" colspan="1" aria-sort="ascending"
                                                aria-label="First name: activate to sort column descending">No
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive"
                                                rowspan="1" colspan="1"
                                                aria-label="Last name: activate to sort column ascending">Faculty Name

                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="datatable-responsive"
                                                rowspan="1" colspan="1"
                                                aria-label="Position: activate to sort column ascending">Claim Without
                                                Evidence.
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $checkValue = null;
                                        if (isset($_POST['submit'])) {
                                            $facultyName = $_POST['faculty_name'];
                                            $academin_year = $_POST['academin_year'];
                                            $checkValue = "TARIKUL";
                                            $query = mysql_query("SELECT COUNT(ec_id) FROM ecclaim,assesment WHERE ecclaim.assessment_Id=assesment.id AND facultyName='$facultyName' AND assesment.sessions='$academin_year'");
                                            $result = mysql_fetch_array($query);
//
//                                            $complete_query = mysql_query("SELECT COUNT(ec_id) FROM ecclaim,assesment WHERE ecclaim.assessment_Id=assesment.id AND facultyName='$facultyName' AND assesment.sessions='$academin_year' AND claimStatus='Complete'");
//                                            $result1 = mysql_fetch_array($complete_query);

                                            $complete_query2 = mysql_query("SELECT COUNT(ec_id) FROM ecclaim,assesment WHERE ecclaim.assessment_Id=assesment.id AND facultyName='$facultyName' AND assesment.sessions='$academin_year' AND claimStatus='Incomplete'");
                                            $result2 = mysql_fetch_array($complete_query2);
//                                        }

                                            ?>

                                            <tr role="row" class="even">
                                                <td tabindex="0" class="sorting_1">01</td>
                                                <td tabindex="0" class="sorting_1">Science</td>
                                                <td class="bg-primary"><?php echo $result2[0]; ?></td>
                                            </tr>

                                        <?php } else {
                                            ?>
                                            No Data Found
                                        <?php } ?>
                                        </tbody>
                                    </table>

                                    <?php
                                    if ($checkValue != null) {
                                    ?>
                                    <div id="population_chart" data-sort="false" data-width="800"
                                         class="jChart chart-lg"
                                         name="Claim Without Evidence">

                                        <div class="define-chart-row" data-color="#38BCFF"
                                             title="Without Evidence"><?php echo $result2[0] ?></div>
                                        <div class="define-chart-row" data-color="#84d6ff"
                                             title="Total Claim"><?php echo $result[0] ?></div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="dataTables_paginate paging_simple_numbers"
                                         id="datatable-responsive_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button previous disabled"
                                                id="datatable-responsive_previous"><a href="#"
                                                                                      aria-controls="datatable-responsive"
                                                                                      data-dt-idx="0" tabindex="0">Previous</a>
                                            </li>
                                            <li class="paginate_button active"><a href="#"
                                                                                  aria-controls="datatable-responsive"
                                                                                  data-dt-idx="1" tabindex="0">1</a>
                                            </li>
                                            <li class="paginate_button "><a href="#"
                                                                            aria-controls="datatable-responsive"
                                                                            data-dt-idx="2" tabindex="0">2</a></li>
                                            <li class="paginate_button "><a href="#"
                                                                            aria-controls="datatable-responsive"
                                                                            data-dt-idx="3" tabindex="0">3</a></li>
                                            <li class="paginate_button next" id="datatable-responsive_next"><a href="#"
                                                                                                               aria-controls="datatable-responsive"
                                                                                                               data-dt-idx="4"
                                                                                                               tabindex="0">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<!-- Bootstrap -->
<!--<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>-->
<!-- FastClick -->
<!--<script src="../vendors/fastclick/lib/fastclick.js"></script>-->
<!-- NProgress -->
<!--<script src="../vendors/nprogress/nprogress.js"></script>-->

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<script src="jchart.js"></script>
<script>
    $(document).ready(function () {
        $("#population_chart").jChart({x_label: "Population"});
        $("#colors_chart").jChart();
    });
</script>
</body>
</html>