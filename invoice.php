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

		  <?php $query="SELECT id,fname,email,doj,active,username,address,pcktaken,expiry FROM  affiliateuser where username = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $aid="$row[id]";

 $regdate="$row[doj]";

 $name="$row[fname]";

 $address="$row[address]";

 $acti="$row[active]";

 $pck="$row[pcktaken]";

 $regexpiry="$row[expiry]";

 

 }

 ?>

  

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<meta charset="utf-8" />

<title>Invoice</title>

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

          <header class="header b-b b-light hidden-print">

            <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print Invoice</button>

            <p>Invoice</p>

          </header>

		  <?php $query="SELECT * FROM  settings"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $id="$row[invoicedetails]";

 $co="$row[coname]";

 

 }

 ?>

           <section class="scrollable wrapper"> 

            <div class="row">

              <div class="col-xs-6">

                <h4><?php print $co ?></h4>

                <?php print $id ?>

              </div>

              <div class="col-xs-6 text-right">

	              <p class="h4">Order Id : #<?php print $aid ?></p>

				<p><b>Registration Date : </b><?php print $regdate ?> </p>

				<p><b>Expiry Date : </b><?php print $regexpiry ?> </p>

                </div>

            </div>

            <div class="well m-t">

              <div class="row">

                <div class="col-xs-6"> <strong>TO:</strong>

                  <h4><?php print $name ?></h4>

                  <?php print $address ?>

                </div>

                <div class="col-xs-6"> <strong>SHIP TO:</strong>

                  <h4><?php print $name ?></h4>

                  <?php print $address ?>

                </div>

              </div>

            </div>

            <p class="m-t m-b">Order date: <strong><?php print $regdate ?></strong><br>

			<?php

			if ($acti==1)

			{

			$stats="<span class='label bg-success'>Completed- Paid/Activated</span><br>";

			}

			else

			{

			$stats="<span class='label bg-danger'>Pending - Activation/Payment</span><br>";

			}

			?>

              Order status: <?php print $stats ?>

              

            <div class="line"></div>

            <table class="table">

              <thead>

                <tr>

                  <th width="60">QTY</th>

                  <th>DESCRIPTION</th>

                  <th width="140">UNIT PRICE</th>

                  <th width="90">TOTAL</th>

                </tr>

              </thead>

              <tbody>

			  <?php $query="SELECT * FROM  packages where id=$pck"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $pname="$row[name]";

 $pdetails="$row[details]";

 $pprice="$row[price]";

 $pcur="$row[currency]";

 $ptax="$row[tax]";
 
 $ptax1="$row[tax1]";
 
 $ptax2="$ptax1/100";

 }

 ?>

			  

                <tr>

                  <td><?php print $ptax ?></td>

                  <td><?php print $pdetails ?></td>

                  <td><?php echo $pcur; echo $pprice?></td>

                  <td><?php echo $pcur; echo $pprice?></td>

                </tr>

               

                <tr>

                  <td colspan="3" class="text-right"><strong>Subtotal</strong></td>

                  <td><?php echo $pcur; echo $pprice?></td>

                </tr>

                <tr>

                  <td colspan="3" class="text-right no-border"><strong>Tax/VAT Included in Total</strong></td>

                  <td><?php echo $ptax1; echo "%"?></td>

                </tr>

                <tr>

                  <td colspan="3" class="text-right no-border"><strong>Total</strong></td>

                  <td><strong><?php echo $pcur; echo $pprice-$ptax2 ?></strong></td>

                </tr>

              </tbody>

            </table>

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