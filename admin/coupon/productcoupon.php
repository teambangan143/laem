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

?>

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<meta charset="utf-8" />

<title>Notifications Settings</title>

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

            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. </p>

          </header>

          <section class="scrollable wrapper">

            <div class="row">

              

              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading"> Notifications Settings </header>

                  <section class="panel panel-default">

                  <header class="panel-heading bg-light">

                    <ul class="nav nav-tabs nav-justified">

                      <li class="active"><a href="#home" data-toggle="tab">Post Notification</a></li>

                      <li><a href="#profile" data-toggle="tab">Delete/Deactivate Notification</a></li>

                                          

                    </ul>

                  </header>

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane active" id="home">

					  

					  

					  <div class="panel-body">

<?php

	

	if (isset($_POST['length'])) {

		include 'class.coupon.php';

		$id_number = $_POST['id_number'];

		$regdate = $_POST['regdate'];

		$no_of_coupons = $_POST['no_of_coupons'];

		$length = $_POST['length'];

		$prefix = $_POST['prefix'];

		$suffix = $_POST['suffix'];

		$numbers = $_POST['numbers'];

		$letters = $_POST['letters'];

		$symbols = $_POST['symbols'];

		$random_register = $_POST['random_register'] == 'true' ? false : true;

		$mask = $_POST['mask'] == '' ? false : $_POST['mask'];

		$coupons = coupon::generate_coupons($no_of_coupons, $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);

		foreach ($coupons as $key => $value) {

			echo $value."\n";

		}

		

		//$date1 = date('m/d/Y');
//
//$date2 = '12/31/2099';
//
//
//
//function returnDates($fromdate, $todate) {
//
//    $fromdate = \DateTime::createFromFormat('m/d/Y', $fromdate);
//
//    $todate = \DateTime::createFromFormat('m/d/Y', $todate);
//
//    return new \DatePeriod(
//
//        $fromdate,
//
//        new \DateInterval('P15D'),
//
//        $todate->modify('+15 day')
//
//    );
//
//}



//$datePeriod = returnDates($date1, $date2);
//
//$i = 1;
//
//foreach($datePeriod as $date) {
//
//	$i++;
//
//    echo $date->format('Y-m-d'),"\n";
//
//	if($i==8) break;
//
//}

		

		die();

	}



?>



<!DOCTYPE html>

<html>

<head>

	<title>Primera Klase - Coupon Code Generator</title>

	 <!-- Bootstrap -->

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				

				<form action="product.php" method="post" id="coupon_form">

					<table class="table table-striped">

						<tr>

							<th>Parameter</th>

							<th>Type</th>

							<th>Default</th>

							<th>Custom value</th>

						</tr>

                        <!--<tr>

							<th>Date Registered</th>

							<td>number</td>

							<td>6</td>

							<td><input class="form-control" type="text" name="regdate" min="1" maxlength="10" id="id_number" placeholder="YYYY-MM-DD"/></td>

						</tr>-->

                        <tr>

							<th>Member ID Number</th>

							<td>number</td>

							<td>6</td>

							<td><input class="form-control" type="text" name="id_number" min="1" maxlength="6" id="id_number" placeholder="Paste here ID number generated from Primera Klase admin"/></td>

						</tr>

                      <tr>

							<th>Discount Card Number</th>

							<td>number</td>

							<td>5</td>

							<td><input class="form-control" type="text" name="id_number" min="1" maxlength="5" id="disc_number" placeholder="Paste here ID number generated from Primera Klase admin"/></td>

						</tr>

						<tr>

							<th>Number of coupons</th>

							<td>number</td>

							<td>6</td>

							<td><input class="form-control" type="number" name="no_of_coupons" value="6" min="1"/></td>

						</tr>

						<tr>

							<th>Length</th>

							<td>number</td>

							<td>6</td>

							<td><input class="form-control" type="number" name="length" value="6" min="1" /></td>

						</tr>

						<tr>

							<th>Prefix</th>

							<td>string</td>

							<td></td>

							<td><input class="form-control" type="text" name="prefix" placeholder="prefix-" /></td>

						</tr>

						<tr>

							<th>Suffix</th>

							<td>string</td>

							<td></td>

							<td><input class="form-control" type="text" name="suffix" placeholder="-suffix" /></td>

						</tr>

						<tr>

							<th>Numbers</th>

							<td>boolean</td>

							<td>true</td>

							<td>

								<select class="form-control" name="numbers">

								  	<option value="false">False</option>

								  	<option selected value="true">True</option>

								</select>

							</td>

						</tr>

						<tr>

							<th>Letters</th>

							<td>boolean</td>

							<td>true</td>

							<td>

								<select class="form-control" name="letters">

								  	<option value="false">False</option>

								  	<option selected value="true">True</option>

								</select>

							</td>

						</tr>

						<tr>

							<th>Symbols</th>

							<td>boolean</td>

							<td>false</td>

							<td>

								<select class="form-control" name="symbols">

								  	<option selected value="false">False</option>

								  	<option value="true">True</option>

								</select>

							</td>

						</tr>

						<tr>

							<th>Random register</th>

							<td>boolean</td>

							<td>true</td>

							<td>

								<select class="form-control" name="random_register">

                               	  <option selected value="true">True</option>

								  	<option value="false">False</option>

								</select>

							</td>

						</tr>

						<tr>

							<th>Mask</th>

							<td>string or boolean</td>

							<td>false</td>

							<td><input class="form-control" type="text" name="mask" value="XXX-XXX" /></td>

						</tr>

					</table>

					<div class="col-md-offset-8 col-md-4">

						<button type="submit" class="btn btn-success pull-right">Generate</button>

						<br/>

						<br/>

					</div>

					<hr />

					<hr />

					<!--<div class="col-md-offset-8 col-md-4">

						<button type="button" onclick="exporttocsv()" class="btn btn-success pull-right">Export Codes to Excel</button>

					</div>-->

					<span class="col-md-offset-8 col-md-4">

					<textarea name="result" rows="3" readonly class="form-control" id="result" placeholder="Result here" style="width:100% !important; height:200px !important"></textarea>

					</span><br/><br/><br/><br/><br/>

				</form>

			</div>

		</div>

	</div>



	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="bootstrap/js/bootstrap.min.js"></script>



    <script type="text/javascript">

	$(document).ready(function(){

		$('#coupon_form').submit(function() {

			var id_number = $('input[name="id_number"]').val();

			var id_number = $('input[name="disc_number"]').val();

			var no_of_coupons = $('input[name="no_of_coupons"]').val();

			var length = $('input[name="length"]').val();

			var prefix = $('input[name="prefix"]').val();

			var suffix = $('input[name="suffix"]').val();

			var numbers = $('select[name="numbers"]').val();

			var letters = $('select[name="letters"]').val();

			var symbols = $('select[name="symbols"]').val();

			var random_register = $('select[name="random_register"]').val();

			var mask = $('input[name="mask"]').val();



			$('#result').load('index.php', {

				id_number: id_number,

				no_of_coupons: no_of_coupons,

				length: length,

				prefix: prefix,

				suffix: suffix,

				numbers: numbers,

				letters: letters,

				symbols: symbols,

				random_register: random_register,

				mask: mask

			});

			return false;

		});

	});



	function exporttocsv() {

		if ($('#result').val()) {

			var a = document.createElement('a');

			with (a) {

				href='data:text/csv;charset=iso-8859-1;base64,' + window.btoa($('#result').val());

				download=$('input[name="id_number"]').val() + $('input[name="disc_number"]').val() + '.csv';

			}

			document.body.appendChild(a);

			a.click();

			document.body.removeChild(a);

	        }



        };

	</script>

</body>

</html>



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