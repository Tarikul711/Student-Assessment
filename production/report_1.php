<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    >
    <link rel="stylesheet" href="main.css">

    <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<!--    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>-->
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
    <script src="jchart.js"></script>
    <script>
        $(document).ready(function () {
            $("#population_chart").jChart({x_label: "Population"});
            $("#colors_chart").jChart();
        });
    </script>
</head>
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
<body>
<?php //require_once "main_left_side_menu.php" ?>
<!-- top navigation -->
<div id="population_chart" data-sort="false" data-width="800" class="jChart chart-lg"
     name="North American Regional Population Loss 2014">
    <div class="define-chart-row" data-color="#84d6ff" title="Arizona">500000</div>
    <div class="define-chart-row" data-color="#38BCFF" title="New Mexico">217500</div>
    <div class="define-chart-row" data-color="#00A9FF" title="Nevada">119000</div>
    <div class="define-chart-row" data-color="#008DD3" title="Colorado">78000</div>
    <div class="define-chart-row" data-color="#0074AA" title="Utah">466000</div>
    <div class="define-chart-row" data-color="#005882" title="California">326000</div>

    <div class="define-chart-footer">100000</div>
    <div class="define-chart-footer">200000</div>
    <div class="define-chart-footer">300000</div>
    <div class="define-chart-footer">400000</div>
    <div class="define-chart-footer">500000</div>
</div>


</body>
</html>
		