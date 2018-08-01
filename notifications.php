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

?>

		  <?php $query="SELECT id,fname,email,doj,active,username,address,pcktaken FROM  affiliateuser where username = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $aid="$row[id]";

 $regdate="$row[doj]";

 $name="$row[fname]";

 $address="$row[address]";

 $acti="$row[active]";

 $pck="$row[pcktaken]";

 

 }

 ?>

  

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<meta charset="utf-8" />

<title>Notifications</title>

<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="css/app.v1.css" type="text/css" />

<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->



        

</head>

<body class="">

<section class="vbox">

<?php include ("header.php"); ?>

  <section>

    <section class="hbox stretch">

<?php include ("menu.php"); ?>

      <section id="content">

        <section class="vbox bg-white">

		<section class="scrollable padder">

          <header class="header b-b b-light hidden-print">

            

            <p>Notifications / Messages / News / Achievements</p>

          </header>

		  <div class="col-lg-12">

                <!-- .accordion -->

				<br/>

				<br/>

				<?php 

				$query="SELECT * FROM notifications where valid=1 ORDER BY id DESC"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $noid="$row[id]";

 $nosubject="$row[subject]";

 $nobody="$row[body]";

 $nodate="$row[posteddate]";



				

				echo"

                <div class='panel-group m-b' id='accordion2'>

                  <div class='panel panel-default'>

                    <div class='panel-heading'> <a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' href='#collapseOne'><b>$nosubject</b> Msg id - $noid </a> </div>

                    <div id='collapseOne' class='panel-collapse in'>

                      <div class='panel-body text-sm'>$nobody </div>

					  <div class='panel-body text-sm'><b>Posted by - </b>Admin on <b>$nodate </b></div>

                    </div>

                  </div>

				</div> ";

				}

				?>

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

<script src="js/app.plugin.js"></script>

</body>

</html>