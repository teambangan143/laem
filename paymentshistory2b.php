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

<!DOCTYPE html>

<html lang="en" class="app">

<head>

<meta charset="utf-8" />

<title>Payment History</title>

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

        <section class="vbox">

          <header class="header bg-white b-b b-light">

            <p><strong>Payment History | </strong>Red = Pending And Green = Completed</p>

            <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print Payment History</button>

          </header>

          <section class="scrollable wrapper">

            <div class="row">
            
            
            
            
            
            
            
            
            
            
           

				  

				  <!-- Started Fetching Downline Of User-->

					<?php $query="SELECT Id FROM  affiliateuser where username = '".$_SESSION['username']."'";

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $uid="$row[Id]";

}



$query2="SELECT * FROM  paymentsclp where userid = '$uid' ORDER BY id ASC"; 

 

 

 $result2 = mysqli_query($con,$query2);



while($row2 = mysqli_fetch_array($result2))


{
	


 $pa="$row2[payment_amount]";

 $ps="$row2[payment_date]";

 $ct="$row2[ORno]";



if ($ps==1)

{

$status="success";

}

else

{

$status="danger";

}

$rowi="$row2[payment_date]";

$time = strtotime($rowi);
$paymentdate = date("M d, Y D", $time);




  }


?>

<!-- End Fetching Downline Of User-->

          
          
          
          
          
                    

            <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading"> Your Maintenance Payment History <span class="pull-right"> Total Number of Maintenance:
                  
                  <?php
                  $querysum="SELECT count(share) as count FROM  affiliateusermaintenance where memberID = '$uid'"; 


 $result3 = mysqli_query($con,$querysum);


while($row3 = mysqli_fetch_array($result3))

{
	$totalshare = "$row3[0]";
	
	
}

echo "$totalshare";

?>
                  </span>
                  </header>

                  <ul class="list-group alt">

				  <!-- Started Fetching Downline Of User-->

					<?php $query="SELECT Id FROM  affiliateuser where username = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $uid="$row[Id]";

}



$query2="SELECT * FROM  affiliateusermaintenance where memberID = '$uid'"; 

$result2 = mysqli_query($con,$query2);

while($row2 = mysqli_fetch_array($result2))

{

 $amount="$row2[amount]";
 
 $share="$row2[share]";
 
 $orno="$row2[ORno]";
 
 $rd="$row2[releasedate]";

 $ps="$row2[getpayment]";

 $ct="$row2[doj]";



if ($ps==1)

{

$status="success";



}

else

{

$status="danger";


}

$rowi=$rd;

$time = strtotime($rowi);
$paymentdate = date("M d, Y D", $time);


  echo "<li class='list-group-item'>

                      <div class='media'> 

                        <div class='pull-right text-$status m-t-sm'> <i class='fa fa-circle'></i> </div>
						

                        <div class='media-body'>

                          <div>Official Receipt Number: <h4>$orno</h4></div>

                         <span class='pull-left text-muted'><strong>Payed Amount :</strong> Php $amount</span> <span class='pull-right text-muted'><strong>Date:</strong> $paymentdate</span> <br></div>

                      </div>

                    </li> ";



  }


?>

<!-- End Fetching Downline Of User-->

                    

                    

                   

                  </ul>

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