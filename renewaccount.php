<?php

include_once ("z_db.php");


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





if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['renewtodo']))

{





$userid=mysqli_real_escape_string($con,$_POST["username"]);

$renewpckid=mysqli_real_escape_string($con,$_POST["package"]);

$query ="SELECT * FROM affiliateuser WHERE (username = '" . mysqli_real_escape_string($con,$_POST['username']) . "') AND (level = '" . mysqli_real_escape_string($con,"2") . "')";

if ($stmt = mysqli_prepare($con, $query)) {



    /* execute query */

    mysqli_stmt_execute($stmt);
	


    /* store result */

    mysqli_stmt_store_result($stmt);



    $num=mysqli_stmt_num_rows($stmt);



    /* close statement */

    mysqli_stmt_close($stmt);

	if($num==0)

	{

	$errormsg= "

<div class='alert alert-danger'>

                    <button type='button' class='close' data-dismiss='alert'>&times;</button>

                    <i class='fa fa-ban-circle'></i><strong>Please Fix Below Errors : </br></strong>Username Not Found, Try Again </div>"; //printing error if found in validation

			

	}

	else

	{	

		session_start();

		$_SESSION['username'] = $userid;

		$_SESSION['renewpckid'] = $renewpckid;



	

	print "

				<script language='javascript'>

					window.location = 'renewgateway.php?username=$userid';

				</script>

			";

	

	}

}

}











?>

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<meta charset="utf-8" />

<title>Renew Account</title>

<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="css/app.v1.css" type="text/css" />

<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->

<!--<style type="text/css">html {

    overflow-y: scroll;

background: url(images/login2.jpg) no-repeat center center fixed; 

  -webkit-background-size: cover;

  -moz-background-size: cover;

  -o-background-size: cover;

  background-size: cover;

}



</style>-->

<!--<div id="google_translate_element" align="right"></div><script type="text/javascript">

function googleTranslateElementInit() {

  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');

}

</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>-->

        

</head>

<body class="" >

<section class="vbox">
  
  <?php include ("header.php"); ?>

  <section>

    <section class="hbox stretch">

<?php include ("menu.php"); ?>

      <section id="content">

        <section class="hbox stretch">

          <section>
          <header class="header bg-white b-b b-light">

            <p><strong>Consumer & Loan Program - Additional Package Request | </strong>Please check in Payment History once your request has been approved.</p>

          </header>
          
          
          <section class="vbox">

              <section class="scrollable padder">

                <section class="row m-b-md">

                  <div class="col-sm-6">
          
          

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">

        <div class="list-group">

		<input type="hidden" name="renewtodo" value="post">

		<?php 

						if($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($errormsg)!=""))

						{

						print $errormsg;

						}

						?>
                        
                        <?php 

			if(isset($_GET["username"])){

			$aff=mysqli_real_escape_string($con,$_GET["username"]);

			$_SESSION['username'] = $aff;

			

			



	}		

			

			?>

          <div class="list-group">

            <input type="hidden" placeholder="Registered Username" class="form-control no-border" name="username" value="<?php if (isset($_SESSION['username'])){

			echo $_SESSION['username']; } ?>" readonly >

          </div>

		  

		  <div class="list-group-item">

		  <label>

            Select Package : 

		  <select name="package" placeholder="Select Package" required>

		  <?php $query="SELECT id,name,details,price,currency,tax FROM  packages ORDER BY tax ASC"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$pname="$row[name]";
	
	$pdetails="$row[details]";

	$pprice="$row[price]";

	$pcur="$row[currency]";

	$ptax="$row[tax]";

$total=$pprice*$ptax;

  print "<option value='$id'>$pname | $pdetails - $pcur $total </option>";

  

  }

  ?>

 

</select>

</label> 

</div>

          

        </div>

		        <button type="submit" class="btn btn-lg btn-primary btn-block">Send Additional Package Request For My Account</button>

   <!--     <div class="text-center m-t m-b"><a href="index.php"><small style="color:#ffffff;">Login Now</small></a></div>

        <div class="line line-dashed"></div>

        <p class="text-center m-t m-b"><a href="#"><small style="color:#ffffff;">Don't Have Account?</small></a></p>

        <a href="signup.php" class="btn btn-lg btn-default btn-block">Create an account</a>-->

      </form>

    </section>

  

</section>

<!-- footer -->

<?php /*?><footer id="footer">

  <div class="text-center padder">

     <p> <small style="color:#ffffff;"><?php $query="SELECT footer from settings where sno=0"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$footer="$row[footer]";

	print $footer;

	}

  ?></small> </p>

  </div>

</footer><?php */?>



                

                

              

            </section>

          </section>



</section>

        <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a> </section>

    </section>

  </section>

</section>

<!-- / footer -->

<!-- Bootstrap -->

<!-- App -->

<script src="js/app.v1.js"></script>

<script src="js/app.plugin.js"></script>

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

<script src="js/sortable/jquery.sortable.js"></script>



</body>

</html>