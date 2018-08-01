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

            <p><strong>Purchased Package History</strong></p>

            <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print History</button>

          </header>

          <section class="scrollable wrapper">

            <div class="row">
              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading">List of Purchased Package Acquired</header>

                  <div class="col-lg-12">

<section class="panel panel-default">


<div class="panel-body">

<div class="table-responsive">

                <table class="table table-striped m-b-none" data-ride="datatables">

                  <thead>

                    <tr>

                     <th width="7%">Ref ID</th>

                      <th width="25%">Description</th>

					  <th width="15%">Amount</th>

                      <th width="15%">Date</th>

                      <th width="8%">Status</th>

					<!--  <th width="15%">Request Date</th>


					  <th width="15%">Package Taken</th>

					  <th width="15%">Pay Status</th>

					  <th width="15%">OR Number</th>

					  <th width="50%">Action</th>-->

                    </tr>

                  </thead>

                  <tbody>
                  <?php

		  $sql="SELECT Id,pcktaken,doj,launch FROM  affiliateuser WHERE username='".$_SESSION['username']."'";

		  if ($result = mysqli_query($con, $sql)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_array($result)) {

       $idnum="$row[Id]";
	   $idpctaken="$row[pcktaken]";
	   $iddoj="$row[doj]";
	   $idlaunch="$row[launch]";
	   
    }
	
	
	
	if($idlaunch==1)

	{

	$ipstatus="<span class='text-info'><strong>Pre-Activated</strong></span>";

	}

	else if($idlaunch==0)

	{

	$ipstatus="<span class='text-danger'><strong>Pending Approval</strong></span>";

	}

	else

	{

	$ipstatus="Unknown";

	}
	
	
	
}
  $qu2="SELECT * FROM  packages where id = $idpctaken"; 

$re2 = mysqli_query($con,$qu2);

while($r2 = mysqli_fetch_array($re2))

{

	$pckid2="$r2[id]";

	$pckname2="$r2[name]";

	$pckprice2="$r2[price]";
	
	$pckdetails2="$r2[details]";
	
	$pckqty2="$r2[tax]";

	$pckcur2="$r2[currency]";

	$pcksbonus2="$r2[sbonus]";
	
	$total2= $pckprice2*$pckqty2;

  }

  
  
  

	

  print "<tr>
               <td>
			   ID NO: <b>$idnum</b>

				  </td>
				  
				  <td>

				  $pckdetails2

				  </td>

                  <td>
	  
				  $pckcur2 $total2

				  </td>

				  <td>

                  $iddoj

				  </td>

				  <td>
				  
                  $ipstatus

				  </td>";
 ?>
                  
                  
               <?php $q="SELECT * FROM  affiliateuserpackage where memberID = $idnum ORDER BY id ASC"; 

 

 

 $r123 = mysqli_query($con,$q);



while($ro = mysqli_fetch_array($r123))

{

	

	$prid="$ro[Id]";

	$pruid="$ro[memberID]";

	$pramount="$ro[pcktakenID]";

	$prstatus="$ro[payment_status]";

	$prdate="$ro[doj]";
	
	$prdiscount="$ro[discount]";
	
	$prgpay="$ro[getpayment]";

	

$qum="SELECT Id,userID,affiliateuserpackageID,payment_amount,ORno FROM  paymentsclp where affiliateuserpackageID = $prid"; 

 

 

 $rem = mysqli_query($con,$qum);



while($rm = mysqli_fetch_array($rem))

{

	$mainid="$rm[Id]";

	$mainuserid="$rm[userID]";

	$mainaffiliateuserpackageid="$rm[affiliateuserpackageID]";

	$mainpaymentamount="$rm[payment_amount]";

	$mainorno="$rm[ORno]";
	

  }	

				  

$query="SELECT * FROM  affiliateuser where Id=$pruid "; 

$result = mysqli_query($con,$query);

$i=0;

while($row = mysqli_fetch_array($result))

{

	
	$id="$row[Id]";

	$username="$row[username]";

	$fname="$row[fname]";

	$email="$row[email]";

	$mobile="$row[mobile]";

	$active="$row[active]";

	$doj="$row[doj]";

	$country="$row[country]";

	$ear="$row[tamount]";

	$ref="$row[referedby]";

	$pck="$row[pcktaken]";

	$getpayment="$row[getpayment]";

	$bn="$row[bankname]";

	$acname="$row[accountname]";

	$accno="$row[accountno]";

	$ifsc="$row[ifsccode]";

	$acct="$row[accounttype]";

	if($acct==1)

	{

	$acctype="Current";

	}

	else if($acct==2)

	{

	$acctype="Savings";

	}

	else{

	$acctype="Not Found";

	}

	

/*	if($prstatus==1)

	{

	$sendto=$mainorno;


	}

	else{

	
	$sendto="<input type='text' class='form-control' data-required='true' name='orno' id='orno' value='' required>";

	}*/

	

	if($active==1)

	{

	$status="Active";

	}

	else if($active==0)

	{

	$status="InActive";

	}

	else

	{

	$status="Unknown";

	}

	

	if($prstatus==1)

	{

	$pstatus="<span class='text-success'>Activated</span>";

	}

	else if($prstatus==0)

	{

	$pstatus="<span class='text-danger'><strong>Pending Approval</strong></span>";

	}

	else

	{

	$pstatus="Unknown";

	}

	

$qu="SELECT * FROM  packages where id = $pramount"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$pckid="$r[id]";

	$pckname="$r[name]";

	$pckprice="$r[price]";
	
	$pckdetails="$r[details]";
	
	$pckqty="$r[tax]";

	$pckcur="$r[currency]";

	$pcksbonus="$r[sbonus]";
	
	$total= $pckprice*$pckqty;

  }
  
  
print"
  

  
  <tr>

				  
               <td>

				  $prid

				  </td>
				  
				  <td>

				  
				  $pckdetails
				  

				  </td>

                  <td>

				  $pckcur $total
				  

				  </td>

				  <td>

                  
				  $prdate
				  

				  </td>

				  <td>
				  
                  
				  $pstatus

				  </td>

				  ";

  

		print"		  </p> 

				  </td>

				  

				  </tr>";

  

  }}

  ?>   
                  
                  
                                    
                  
  </tbody>

   </table>

 </div>                
                  
</div>          
</section>
</div>


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