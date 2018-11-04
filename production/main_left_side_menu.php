<?php
if (!isset($_SESSION['user_email'])) {
    header('location:login_2.php');
}
//echo $_SESSION['user_email'];
//die();
?>


<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>User Profile </span></a>
        </div>

        <div class="clearfix"></div>

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <?php
                $user_type = $_SESSION['user_type'];
                if (strcmp($user_type, "student") == 0) {
                    ?>
                    <ul class="nav side-menu">
                        <li><a href="student_main.php"><i class="fa fa-home"></i> Dashboard</span></a>
                        </li>
                        <li><a href="new_assessment.php"><i class="fa fa-caret-up"></i> New Assessment </span></a>
                        </li>
                        <li><a href="student_profile.php"><i class="fa fa-edit"></i> Submitted Claim </span></a>
                        </li>
                        <li><a href="submit_claim.php"><i class="fa fa-desktop"></i> Submit Claim </span></a>
                        </li>
                        <li><a href="submit_assignment.php"><i class="fa fa-amazon"></i> Submit Assignment </span></a>
                        </li>
                        <li><a href="student_submitted_assignment.php"><i class="fa fa-asl-interpreting"></i> Submitted
                                Assignment </span></a>
                        </li>
                        <li><a href="student_claim_decision.php"><i class="fa fa-bookmark"></i> Claim Decision </span></a>
                        </li>

                    </ul>
                <?php }
                if (strcmp($user_type, "admin") == 0) {
                    ?>
                    <ul class="nav side-menu">
                        <li><a href="admin_Dashboard.php"><i class="fa fa-home"></i> Dashboard</span></a>
                        </li>
                        <li><a href="add_assessment.php"><i class="fa fa-home"></i> Create New Assessment </span></a>
                        </li>
                        <li><a href="assessment_list.php"><i class="fa fa-edit"></i> List All Assessment </span></a>
                        </li>
                        <li><a href="show_all_assessment.php"><i class="fa fa-desktop"></i> Show All Claim </span></a>
                        </li>
                        <li><a href="submitted_assignment_list.php"><i class="fa fa-desktop"></i> Submitted Assessment</span></a>
                        </li>
                        <li><a href="st_profile_management.php"><i class="fa fa-desktop"></i> Student Profile</span></a>
                        </li>
                        <li><a href="st_password_management.php"><i class="fa fa-desktop"></i> Password Management</span></a>
                        </li>
                    </ul>
                <?php }
                if (strcmp($user_type, "ec_coordinator") == 0) {
                    ?>

                    <ul class="nav side-menu">
                        <li><a href="ec_cordinator_main.php"><i class="fa fa-home"></i> Dashboard</span></a>
                        </li>
                        <li><a href="assessment_list.php"><i class="fa fa-home"></i> List All Assessment </span></a>
                        </li>
                        <li><a href="ec_show_all_assessment.php"><i class="fa fa-edit"></i> List Submitted Claim </span>
                            </a>
                        </li>
                        <li><a href="submitted_assignment_list.php"><i class="fa fa-desktop"></i> List Submitted
                                Assignment </span></a>
                        </li>
                    </ul>
                <?php }
                if (strcmp($user_type, "ec_manager") == 0) {
                    ?>
                    <ul class="nav side-menu">
                        <li><a href="ec_manager_dashboard.php"><i class="fa fa-home"></i> Dashboard</span></a>
                        </li>
                        <li><a href="report_main_page.php"><i class="fa fa-bar-chart"></i> Report</span></a>
                        </li>
                        <li><a href="assessment_list.php"><i class="fa fa-home"></i> Assignment List </span></a>
                        </li>
                        <li><a href="show_all_assessment.php"><i class="fa fa-edit"></i> List All Claim </span>
                            </a>
                        </li>
                        <li><a href="submitted_assignment_list.php"><i class="fa fa-desktop"></i> List Submitted
                                Assignment </span></a>
                        </li>
                    </ul>
                <?php } ?>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
