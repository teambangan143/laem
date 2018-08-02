<?php


include_once("z_db.php");


// Inialize session

session_start();

// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION['username'])) {

    print "

				<script language='javascript'>

					window.location = 'index.php';

				</script>

			";

}


$payto = $_SESSION['username'];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']) && (($_POST['todo']) == "paymentpost")) {


    $username = mysqli_real_escape_string($con, $_SESSION['username']);


    $status = "OK"; //initial status

    $msg = "";


    $rr = mysqli_query($con, "SELECT Id FROM affiliateuser WHERE username = '$username'");

    $r = mysqli_fetch_row($rr);

    $uid = $r[0];


    $rr = mysqli_query($con, "SELECT pcktaken FROM affiliateuser WHERE username = '$username'");

    $r = mysqli_fetch_row($rr);

    $pc = $r[0];


    $rr = mysqli_query($con, "SELECT mpay FROM packages WHERE id='$pc'");

    $r = mysqli_fetch_row($rr);

    $mpay = $r[0];


    $rr = mysqli_query($con, "SELECT tamount FROM affiliateuser WHERE username = '$username'");

    $r = mysqli_fetch_row($rr);

    $nr = $r[0];


    if ($nr < $mpay) {

        $msg = $msg . "You are not eligible for payment!!!! Contact support for more info.<BR>";

        $status = "NOTOK";

    }


    if ($status == "OK") {

        $totalpay = $nr - $mpay;

        $res11 = mysqli_query($con, "update affiliateuser set tamount=$mpay where username='$username'");

        $res1 = mysqli_query($con, "INSERT INTO payments (userid, payment_amount, createdtime) VALUES ('$uid', '$totalpay', NOW())");


        if ($res1) {

            $errormsg = "

<div class='alert alert-success'>

                    <button type='button' class='close' data-dismiss='alert'>&times;</button>

                    <i class='fa fa-ban-circle'></i><strong>Success : </br></strong>Your Payment Request Has Been Sent! Payment Will be Processed After Successful Verification On Time.</div>"; //printing error if found in validation


        } else {

            $errormsg = "

<div class='alert alert-danger'>

                    <button type='button' class='close' data-dismiss='alert'>&times;</button>

                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Some Technical Glitch Is There. Please Try Again Later Or Ask Admin For Help. </div>"; //printing error if found in validation


        }


    } else {


        $errormsg = "

<div class='alert alert-danger'>

                    <button type='button' class='close' data-dismiss='alert'>&times;</button>

                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>" . $msg . "</div>"; //printing error if found in validation


    }


}


?>

<!DOCTYPE html>

<html lang="en" class="app">

<head>

    <meta charset="utf-8"/>

    <title>LAEM Enterprises DashBoard</title>


    <meta name="description"
          content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>

    <!--    <link rel="stylesheet" href="css/app.v1.css" type="text/css"/>-->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.css" type="text/css"/>

    <link rel="stylesheet" href="js/getorgchart/getorgchart.css" type="text/css"/>


    <link rel="stylesheet" href="js/calendar/bootstrap_calendar.css" type="text/css"/>

    <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script> <![endif]-->


    <meta property="og:title" content="CMPC Intl Registration"/>

    <meta property="og:type" content="article"/>

    <meta property="og:image" content="http://cmpcintl.com/user/images/fblogo.jpg"/>

    <meta property="og:url" content="http://bit.ly/22XXxDW"/>

    <meta property="og:description" content="CMPC Intl Unlimited Opportunities"/>

</head>

<body class="">
<!--<section class="vbox">-->
<!---->
<!--    --><?php //include("header.php"); ?>
<!--    <section>-->
<!--        <section class="hbox stretch">-->
<!--                        --><?php //include("menu.php"); ?>
<!---->
<!--        </section>-->
<!--    </section>-->
<!--</section>-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="dashboard.php">Dashboard <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="placement.php">Placement</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <a href="logout.php" data-toggle="ajaxModal">Logout</a>
        </div>
    </div>
</nav>


<div id="people">
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Place account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="font-weight: bold;">Username</p>
                <input type="text" class="form-control" id="username"/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="addUsername">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script src="js/app.v1.js"></script>

<script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>

<script src="js/charts/easypiechart/jquery.easy-pie-chart.js"></script>

<script src="js/charts/sparkline/jquery.sparkline.min.js"></script>

<script src="js/charts/flot/jquery.flot.min.js"></script>

<script src="js/charts/flot/jquery.flot.tooltip.min.js"></script>

<script src="js/charts/flot/jquery.flot.spline.js"></script>

<script src="js/charts/flot/jquery.flot.pie.min.js"></script>

<script src="js/charts/flot/jquery.flot.resize.js"></script>

<script src="js/charts/flot/jquery.flot.grow.js"></script>

<script src="js/charts/flot/demo.js"></script>

<script src="js/calendar/bootstrap_calendar.js"></script>

<script src="js/calendar/demo.js"></script>

<script src="js/getorgchart/getorgchart.js"></script>

<script src="js/sortable/jquery.sortable.js"></script>

<script src="js/app.plugin.js"></script>

<script>

    $(function () {

        var sources = '';
        var orgChart = {};
        var nodeId = '';
        var pid = '';
        $.getJSON("/user/api/Placement.php", function (source) {
            var peopleElement = document.getElementById("people");
            sources = source;
            orgChart = new getOrgChart(peopleElement, {
                clickNodeEvent: clickHandler,
                maxDepth: 40,
                theme: "deborah",
                enableEdit: false,
                expandToLevel: 5,
                enableDetailsView: false,
                dataSource: sources
            });
        });

        function clickHandler(sender, args) {
            $('#myModal').modal('show');
            pid = args.node.pid;
            nodeId = args.node.id;
        }

        $('#addUsername').click(function (e) {
            e.preventDefault();
            var input = $('#username').val();
            // console.log(input);
            // console.log(nodeId);

            $.ajax({
                url: "/user/api/addplacement.php",
                method: 'post',
                data: {
                    username: input,
                    charts_id: nodeId
                },
                success: function(res){
                    console.log(res);
                    //window.location.href='{{route("carrier.index")}}';
                }
            });
            var nodeData = {Name: input};
            orgChart.updateNode(nodeId, pid, nodeData);
            $('#myModal').modal('hide');
            nodeId = '';
            pid = '';
        });
    });

</script>

</body>

</html>