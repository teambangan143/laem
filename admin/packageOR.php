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

<title>Package Payment Requests Approval</title>

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

            <p><strong>Important Instructions </strong> <b>1.</b>Please verify User's Referral status before making the payment.<b> 2. </b> Records are shown from newest to oldest.</p>

          </header>

          <section class="scrollable wrapper">

            <div class="row">

              

              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading">Additional Package Payment Requests Approval<span class="pull-right"> Total Number Package Acquired:
                  
                  <?php

				  
				  /*$qupack="SELECT * FROM  packages"; 

$repack = mysqli_query($con,$qupack);

while($rpk = mysqli_fetch_array($repack))

{

	$pckidpk="$rpk[id]";

	$pcknamepk="$rpk[name]";

	$pckpricepk="$rpk[price]";
	
	$pckqtypk="$rpk[tax]";
	
	$totalpk= $pckpricepk*$pckqtypk; */
	





/* $resultrow = mysqli_query($con,"SELECT affiliateuserpackage.Id, affiliateuserpackage.memberId, affiliateuserpackage.pcktakenID,
 COUNT (packages.id) as packages FROM affiliateuserpackage LEFT INNER JOIN packages ON affiliateuserpackage.pcktakenID = packages.id 
 GROUP BY packages.id WHERE affiliateuserpackage.payment_status=1"); */

	
				  
 //$resultrow = mysqli_query($con,"SELECT count(*) as count FROM  affiliateuserpackage where pcktakenID=$pckidpk and payment_status=1");
 
 /* $resultrow = mysqli_query($con,"SELECT pcktakenID FROM  affiliateuserpackage where pcktakenID=$pckidpk and payment_status=1");

$rowresult = mysqli_fetch_row($resultrow);

$numrowsresult = $rowresult[0]; 
{

print_r(array_count_values($numrowsresult));

}*/
 
 // $querysum="SELECT count(*) as count FROM  affiliateuserpackage where pcktakenID=$pckidpk and payment_status=1 GROUP BY pcktakenID"; 
  
  
/*   $querysum = mysqli_query($con,"SELECT affiliateuserpackage.Id, affiliateuserpackage.memberId, affiliateuserpackage.pcktakenID,
 COUNT (packages.id) as packages FROM affiliateuserpackage LEFT INNER JOIN packages ON affiliateuserpackage.pcktakenID = packages.id 
 GROUP BY packages.id WHERE affiliateuserpackage.payment_status=1"); */
 
 

					
	$querysum = mysqli_query($con,"
	SELECT aup.Id, aup.memberId, aup.payment_status,
	COUNT(aup.pcktakenID) as total 
	FROM affiliateuserpackage as aup, packages as rpk
	INNER JOIN affiliateuserpackage on aup.pcktakenID = rpk.id
	WHERE aup.payment_status=1
    GROUP BY aup.pcktakenID");				


 $result3 = mysqli_query($con,$querysum);


while($row3 = mysqli_fetch_assoc($result3))

{
	$totalshare = $row3['total'];
	
	
}

echo $totalshare;
  
  
   



?>
                  </span></header>
                  
                  
                  

                  <section class="panel panel-default">

                  <header class="panel-heading bg-light">

                    <ul class="nav nav-tabs nav-justified">

                      <li class="active"><a href="#home" data-toggle="tab"></a></li>

                       

                    </ul>

                  </header>

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane active" id="home">

					  

					  

					  <div class="panel-body">

                    

					  



            

        

             

              <div class="table-responsive">

                <table class="table table-striped m-b-none" data-ride="datatables">

                  <thead>

                    <tr>

                     

                      <th width="10%">Request Id</th>

					  

                      <th width="15%">Username</th>

                      <th width="8%">Status</th>

					  <th width="15%">Request Date</th>


					  <th width="15%">Package Taken</th>

					  <th width="15%">Pay Status</th>

					  <!--<th width="15%">OR Number</th>-->

					  <th width="50%">Action</th>

                    </tr>

                  </thead>

                  <tbody>

				  <?php 
				  
				  
				   
				  
				  

				   $q="SELECT * FROM  affiliateuserpackage ORDER BY id DESC"; 

 

 

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

	$pstatus="Completed";

	}

	else if($prstatus==0)

	{

	$pstatus="Pending";

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
	
	$pckqty="$r[tax]";

	$pckcur="$r[currency]";

	$pcksbonus="$r[sbonus]";
	
	$total= $pckprice*$pckqty;

  }
  

  


	

  print "<tr>

				  

				  <td>

				  $prid

				  </td>

				  

				  <td>

				  User ID: $id <br><b>$username</b>

				  </td>

				  <td>

				  $status

				  </td>

				  

				  <td>

				  $prdate

				  </td>

				  <td>

				  <b>$pckname </b> <br/> $pckcur $total 

				  </td>

				  <td>

				  $pstatus

				  </td>";

				   /*<td>

				  $sendto

				  </td>*/
		  

		print "		  <td>";
				  
				  if($prstatus==1)

	{

	print "<span class='text-info'><b>Paid & Activated</b></span><br><br>";
	
	print "<a href='deletepaymentOR.php?payid=$prid' class='label_edit bg-danger'><span style='padding-bottom:15px;'>Delete Addt'l Package</span></a><br> <br>";

	}

	else if($prstatus==0)

	{

	print "<a href='makepaymentOR.php?payid=$prid' class='label_edit bg-success'><span style='padding-bottom:15px;'>Launch Request</span></a> <br> <br>";
	
	print "<a href='deletepaymentREQ.php?payid=$prid' class='label_edit bg-danger'><span style='padding-bottom:15px;'>Delete Request</span></a><br> <br>";

	}

	else

	{

	print "<a href='#' class='btn btn-default btn-sm'>Unknown Status</a>";

	}
		  

				  

				  if($active==1)

	{

	//print "<a href='deactivateuser.php?username=$username' class='label_edit bg-danger'>De-Activate</a>";

	}

	else if($active==0)

	{

	print "<a href='activateuser.php?username=$username' class='label_edit bg-success'>Activate</a>";

	}

	else

	{

	print "<a href='#' class='btn btn-default btn-sm'>Unknown Status</a>";

	}

 

		print"		  </p>

				  </td>

				  

				  </tr>";

  }

  }

  ?>

				  

                  </tbody>

                </table>

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