<?php

include_once ("z_db.php");

// Inialize session

session_start();

// Check, if username session is NOT set then this page will jump to login page

if (!isset($_SESSION['adminidusername'])) {

        print "

				<script language='javascript'>

					window.location = 'index.php';

				</script>

			";

}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']))

{

// Collect the data from post method of form submission // 





$con1 = mysqli_connect("localhost", "cmpcintl_nash", "74F2JrXehV5P", "cmpcintl_xzel");

$uname=mysqli_real_escape_string($con,$_POST['username']);
$orno=mysqli_real_escape_string($con,$_POST['orno']);
$doj1=mysqli_real_escape_string($con,$_POST['doj']);
$ptax1=$ptax;


	

$date1 = date();
$date2 = '12/31/2099';
$value = 1700 * (30/100);
$ORno = $orno;


function returnDates($fromdate, $todate) {

    $fromdate = \DateTime::createFromFormat('m/d/Y', $fromdate);

    $todate = \DateTime::createFromFormat('m/d/Y', $todate);

    return new \DatePeriod(

        $fromdate->modify('+15 day'),

        new \DateInterval('P15D'),

        $todate->modify('+15 day')

    );

}



$datePeriod = returnDates($date1, $date2);


$i = 1;

foreach($datePeriod as $date) {

	$offer=$i++;
    echo $value,"\n";
	echo $date->format('Y-m-d'),"\n";
	$date2 = $date->format('Y-m-d');
    echo "</br>";
mysqli_query($con,"INSERT into `paymentsclp` (userid,ORno,payment_amount,payment_date) VALUES ('$uname','$ORno','$value','$date2')");	
	

	if($offer==5) break;

}





}



?>

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<meta charset="utf-8" />

<title>Users</title>

<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="css/app.v1.css" type="text/css" />

<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->

<!--<div id="google_translate_element" align="right"></div><script type="text/javascript">

function googleTranslateElementInit() {

  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');

}

</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->

 

</head>

<body class="">

<section class="vbox">

  <header class="bg-white header header-md navbar navbar-fixed-top-xs box-shadow">

    <div class="navbar-header aside-md dk"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="#nav"> <i class="fa fa-bars"></i> </a> <a href="dashboard.php" class="navbar-brand"><img src="images/logo.png" class="m-r-sm"><?php $query="SELECT header from settings where sno=0"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$header="$row[header]";

	print $header;

	}

  ?></a> <a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user"> <i class="fa fa-cog"></i> </a> </div>

  
<?php include ("../google_trans.php"); ?>
    

    <ul class="nav navbar-nav navbar-right m-n hidden-xs nav-user user">

      

      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="thumb-sm avatar pull-left"> <img src="images/a0.jpg"> </span> <?php

		  $sql="SELECT fname FROM  affiliateuser WHERE username='".$_SESSION['adminidusername']."'";

		  if ($result = mysqli_query($con, $sql)) {



    /* fetch associative array */

    while ($row = mysqli_fetch_row($result)) {

        print $row[0];

    }



}



   

	   

	   ?> <b class="caret"></b> </a>

       <ul class="dropdown-menu animated fadeInRight">

          <span class="arrow top"></span>

          <li> <a href="profile.php">Profile</a> </li>

          <li class="divider"></li>

          <li> <a href="logout.php" data-toggle="ajaxModal" >Logout</a> </li>

        </ul>

      </li>

    </ul>

  </header>

  <section>

    <section class="hbox stretch">

      <?php include ("menu_admin.php"); ?>

      <section id="content">

        <section class="vbox">

          <header class="header bg-white b-b b-light">

            <p><strong>Important Instructions </strong> <b>-</b> Official Receipt Registration Form</p>

          </header>

          <section class="scrollable wrapper">

            <div class="row">

              

              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading"> Users Settings </header>

                  <section class="panel panel-default">

                  

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane active" id="home">

					  

					  

					  <div class="panel-body">

                    

					  

<div class="table-responsive">

                <form action="date.php" method="post">

                    <section class="panel panel-default">

                      <header class="panel-heading">

                        <span class="h4">Register</span>

                      </header>

                      <div class="panel-body">

					  

                        <p class="text-muted">Please fill the information to continue</p>

						<?php 

						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status=="NOTOK"))

						{

						print $errormsg;

						}

						?>

<div class="form-group">

						<label>Username</label>

                            <select data-required="true" class="form-control m-t" name="username" required>

                                <option value="">Please choose</option>

								<?php $query="SELECT Id,username,doj FROM  affiliateuser where level=2 ORDER BY username ASC"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[Id]";

	$pname="$row[username]";
	
	$doj="$row[doj]";
	
	$pctaken="$row[pctaken]";


  print "<option value='$id'>$pname</option>";

  

  }

  ?>

								</select><br> <div class="form-group">

						<label>Package</label>

                            <select data-required="true" class="form-control m-t" name="package" required>

                                <option value="">Please choose</option>

								<?php $query="SELECT id,name,price,currency,tax FROM  packages"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$pname="$row[name]";

	$pprice="$row[price]";

	$pcur="$row[currency]";

	$ptax="$row[tax]";

$total=$pprice*$ptax;

  print "<option value='$id'>$pname </option>";

  

  }

  ?>

								</select>

                          </div>

<br>
                                <!--<div class="form-group">

                          <label>Official Receipt Number</label>

                          <input name="orno" type="text" class="form-control" maxlength="5" data-required="true">

                        </div>-->
                        <div class="form-group">

                          <label>Date Registered</label>

                          <input name="doj" type="date" class="form-control" maxlength="5" data-required="true">

                        </div>
                        <footer class="panel-footer text-right bg-light lter">

                        <button type="submit" class="btn btn-lg btn-primary btn-block">I Have Filled And Checked All Details. Update/Edit This Username For Me Now.</button>

                      </footer>

                          </div>


</form>

              </div>


                    

                  </div>

					  

					  </div>



                    </div>
                    

                  </div>
                  
                  
                  
                   
                  
                  
                  

                </section>

                </section>

                

              </div>

            </div>

          </section>

        </section>

        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>

    </section>

  </section>

</section>

<!-- Bootstrap -->

<!-- App -->

<script src="js/app.v1.js"></script>

<script src="js/jquery.ui.touch-punch.min.js"></script>

<script src="js/jquery-ui-1.10.3.custom.min.js"></script>

<script src="js/app.plugin.js"></script>

</body>

</html>