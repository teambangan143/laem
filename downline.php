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

<title>Downline</title>

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

<?php include ("menu_downline.php"); ?>

      <section id="content">

        <section class="vbox">

          <header class="header bg-white b-b b-light">

            <p><!--Red = Unverified/Unpaid Account  AND Green = Verified/Paid Account ||--> USERNAME: <?php

		  $sql="SELECT username FROM  affiliateuser WHERE username='".$_SESSION['username']."'";

		  if ($result = mysqli_query($con, $sql)) {
    /* fetch associative array */
    while ($row = mysqli_fetch_row($result)) {

        print "<span class='text-info'><b>".$row[0]."</b></span>";
    }
}
 ?></p>
            
            <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print</button>

          </header>

          <section class="scrollable wrapper">

            <div class="row">

              

              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading"> Your Referral List </header>

                  <ul class="list-group alt">

				  <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-dark"><h4 class="text-danger"><b>Level 1</b></h4>(DIRECT REFERRAL)

				  

									  

				  </div>
                  
                  
                  

				  <!-- Started Fetching Downline Of User-->

					<?php 
					
						

  



$totalref=0;

$totalrefear=0;

$totalrefearadd=0;

$query="SELECT Id,fname,email,doj,active,username,pcktaken,referedby FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

  $result = mysqli_query($con,$query);

while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

	$pcktook="$row[pcktaken]";
	
	$idnum1="$row[Id]";
	


	$qu="SELECT level1 FROM  packages where id = $pcktook"; 
		

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll1="$r[0]";
	


$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row1a = mysqli_fetch_array($resultpack))

{


	$pname="$row1a[name]";

	$pprice="$row1a[price]";

	$pcur="$row1a[currency]";


}




}

if ($ac==1)

{

$status="success";

$totalrefear=$totalrefear+$ll1;




}

else

{

$status="danger";

}





$rowi="$row[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);


$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum1 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level1 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack1="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack1 = mysqli_query($con,$querypack1);

while($row1a1 = mysqli_fetch_array($resultpack1))

{


	$pname1="$row1a1[name]";

	$pprice1="$row1a1[price]";

	$pcur1="$row1a1[currency]";


}


	
}

$i=0;$i++;


if ($prstatus==1)

{

$status1="success";

$pname1add="Recent Saving Acquired:" .$pname1;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{
$pname1add="";
$status1="danger";

}

}




  echo "<li class='list-group-item'>
  
  

                      <div class='media'>
					  
					  
					  

                        <div class='pull-right text-$status m-t-sm' style='font-size: x-large'> <i class='fa fa-star text-danger hover-rotate'></i> </div>
						
						

                        <div class='media-body'>
						
						<div class='text-success'>ID: <b>$idnum1</b> </div>

                          <div class='h4 block text-info'>$row[username]</div>

                         <small class='text-muted'>E-Mail : $row[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Package Acquired: $pname</small>
						 
						 <br><small class='text-muted'>"; print_r($pname1add); echo"</small>
						 </div>

                      </div>

                    </li> ";

  

  

  }



 

print "</br> <P><b>&nbsp;&nbsp;&nbsp;Total Earnings - </b>$pckcur $totalrefear</p>

";


?>



				  

                </section>

              </div>

			  

			  

			  

			  <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-danger-ltest"><h4><b>Level 2</b></h4></div>
                  
                  

				  <!-- Started Fetching Downline Of User-->

				  

<?php 

$totalrefear=0;

$totalrefearadd=0;

$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);



while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $pcktook="$row22[pcktaken]";
 
 $idnum2="$row22[Id]";

	$qu="SELECT level2 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll2="$r[0]";
	
	
	$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row2a = mysqli_fetch_array($resultpack))

{


	$pname="$row2a[name]";

	$pprice="$row2a[price]";

	$pcur="$row2a[currency]";


}

}

if ($ac2==1)

{

$status2="success";

$totalrefear=$totalrefear+$ll2;

}

else

{

$status2="danger";

}


$rowi="$row22[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);




$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum2 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level2 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack2="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack2 = mysqli_query($con,$querypack2);

while($row1a2 = mysqli_fetch_array($resultpack2))

{


	$pname2="$row1a2[name]";

	$pprice2="$row1a2[price]";

	$pcur2="$row1a2[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname2add="Recent Saving Acquired:".$pname2;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}





  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status2 m-t-sm'> <i class='fa fa-heart'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum2</b> </div>

                          <div class='h4 block text-info'>$row22[username]</div>

                         <small class='text-muted'>E-Mail : $row22[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname2add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row[username]</b></span></small>
						 
						 
						 </div>

                      </div>

                    </li> ";

  

  

  }



 }

 print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>
 ";

?>



				  

                </section>

              </div>

			  

			  		  <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-danger-ltest"><h4><b>Level 3</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 

					

$totalrefear=0;		

$totalrefearadd=0;			

$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 $pcktook="$row33[pcktaken]";
 
 $idnum3="$row33[Id]";

	$qu="SELECT level3 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll3="$r[0]";
	
	$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row3a = mysqli_fetch_array($resultpack))

{


	$pname="$row3a[name]";

	$pprice="$row3a[price]";

	$pcur="$row3a[currency]";


}
	

}

if ($ac3==1)

{

$status3="success";

$totalrefear=$totalrefear+$ll3;

}

else

{

$status3="danger";

}


$rowi="$row33[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);



$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum3 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level3 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack3="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack3 = mysqli_query($con,$querypack3);

while($row1a3 = mysqli_fetch_array($resultpack3))

{


	$pname3="$row1a3[name]";

	$pprice3="$row1a3[price]";

	$pcur3="$row1a3[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname3add="Recent Saving Acquired:" .$pname3;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}




  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status3 m-t-sm'> <i class='fa fa-thumbs-up'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum3</b> </div>

                          <div class='h4 block text-info'>$row33[username]</div>

                         <small class='text-muted'>E-Mail : $row33[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname3add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row22[username]</b></span></small></div>

                      </div>

                    </li> ";

  

  

  }



 }

 }

  print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>
  ";

?>



				  

                </section>

              </div>

			  

			  

			  <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-danger-ltest"><h4><b>Level 4</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 

$totalrefear=0;

				$totalrefearadd=0;	

					$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 

 $query44="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername3'"; 

 $result44 = mysqli_query($con,$query44);

 while($row44 = mysqli_fetch_array($result44))

{

 $ac4="$row44[active]";

 $countusername4="$row44[username]";

 $pcktook="$row44[pcktaken]";
 
 $idnum4="$row44[Id]";

	$qu="SELECT level4 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll4="$r[0]";
	
	$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row4a = mysqli_fetch_array($resultpack))

{


	$pname="$row4a[name]";

	$pprice="$row4a[price]";

	$pcur="$row4a[currency]";


}

}

 

if ($ac4==1)

{

$status4="success";

$totalrefear=$totalrefear+$ll4;

}

else

{

$status4="danger";

}

$rowi="$row44[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);



$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum4 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level4 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack4="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack4 = mysqli_query($con,$querypack4);

while($row1a4 = mysqli_fetch_array($resultpack4))

{


	$pname4="$row1a4[name]";

	$pprice4="$row1a4[price]";

	$pcur4="$row1a4[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname4add="Recent Saving Acquired:" .$pname4;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}



echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status4 m-t-sm'> <i class='fa fa-arrow-circle-up'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum4</b> </div>

                          <div class='h4 block text-info'>$row44[username]</div>

                         <small class='text-muted'>E-Mail : $row44[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname4add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row33[username]</b></span></small></div>

                      </div>

                    </li> ";

  

  

  }



 }

 }

 }

 print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>
 ";

?>



				  

                </section>

              </div>

			  

			  

			  <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-success"><h4><b>Level 5</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 



$totalrefear=0;
$totalrefearadd=0;	
					$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 

 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'"; 

 $result44 = mysqli_query($con,$query44);

 while($row44 = mysqli_fetch_array($result44))

{

 $ac4="$row44[active]";

 $countusername4="$row44[username]";

 $query55="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername4'"; 

 $result55 = mysqli_query($con,$query55);

 while($row55 = mysqli_fetch_array($result55))

{



$ac5="$row55[active]";

 $countusername5="$row55[username]";

 $pcktook="$row55[pcktaken]";
 
 $idnum5="$row55[Id]";

$qu="SELECT level5 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll5="$r[0]";
	
	$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row5a = mysqli_fetch_array($resultpack))

{


	$pname="$row5a[name]";

	$pprice="$row5a[price]";

	$pcur="$row5a[currency]";


}
	

}

 

if ($ac5==1)

{

$status5="success";

$totalrefear1=$totalrefear + ($ll5 * (20/100));

//$totalrefeardiscount=($totalrefear1 * (80/100)) - $totalrefear;

//$discount=$totalrefeardiscount - $totalrefear1;
//$discount=$totalrefeardiscount - ($totalrefeardiscount * (80/100));

$totalrefear=$totalrefear1;

}

else

{

$status5="danger";

}


$rowi="$row55[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);


$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum5 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level5 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack5="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack5 = mysqli_query($con,$querypack5);

while($row1a5 = mysqli_fetch_array($resultpack5))

{


	$pname5="$row1a5[name]";

	$pprice5="$row1a5[price]";

	$pcur5="$row1a5[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname5add="Recent Saving Acquired:".$pname5;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}


  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status5 m-t-sm'> <i class='fa fa-check-square'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum5</b> </div>

                          <div class='h4 block text-info'>$row55[username]</div>

                         <small class='text-muted'>E-Mail : $row55[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname5add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row44[username]</b></span></small></div>

                      </div>

                    </li> ";

  

  

  }

}

 }

 }

 }

 print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>";

?>



				  

                </section>

              </div>

			  

			    <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-warning-ltest"><h4><b>Level 6</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 

$totalrefear=0;		

$totalrefearadd=0;			

$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 

 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'"; 

 $result44 = mysqli_query($con,$query44);

 while($row44 = mysqli_fetch_array($result44))

{

 $ac4="$row44[active]";

 $countusername4="$row44[username]";

 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'"; 

 $result55 = mysqli_query($con,$query55);

 while($row55 = mysqli_fetch_array($result55))

{

$ac5="$row55[active]";

 $countusername5="$row55[username]";

$query66="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'"; 

 $result66 = mysqli_query($con,$query66);

 while($row66 = mysqli_fetch_array($result66))

{



$ac6="$row66[active]";

 $countusername6="$row66[username]";

 $pcktook="$row66[pcktaken]";
 
 $idnum6="$row66[Id]";

$qu="SELECT level6 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll6="$r[0]";
	
	$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row6a = mysqli_fetch_array($resultpack))

{


	$pname="$row6a[name]";

	$pprice="$row6a[price]";

	$pcur="$row6a[currency]";


}

}

  

if ($ac6==1)

{

$status6="success";

$totalrefear=$totalrefear+$ll6;

}

else

{

$status6="danger";

}

$rowi="$row66[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);


$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum6 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level6 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack6="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack6 = mysqli_query($con,$querypack6);

while($row1a6 = mysqli_fetch_array($resultpack6))

{


	$pname6="$row1a6[name]";

	$pprice6="$row1a6[price]";

	$pcur6="$row1a6[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname6add="Recent Saving Acquired:" .$pname6;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}

  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status6 m-t-sm'> <i class='fa fa-coffee'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum6</b> </div>

                          <div class='h4 block text-info'>$row66[username]</div>

                         <small class='text-muted'>E-Mail : $row66[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname6add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row55[username]</b></span></small></div>

                      </div>

                    </li> ";

  

  

  }

  }

}

 }

 }

 }

  print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>";

?>



				  

                </section>

              </div>

			  

			  

			  			    <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-warning-ltest"><h4><b>Level 7</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 

$totalrefear=0;		

$totalrefearadd=0;			

$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 

 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'"; 

 $result44 = mysqli_query($con,$query44);

 while($row44 = mysqli_fetch_array($result44))

{

 $ac4="$row44[active]";

 $countusername4="$row44[username]";

 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'"; 

 $result55 = mysqli_query($con,$query55);

 while($row55 = mysqli_fetch_array($result55))

{

$ac5="$row55[active]";

 $countusername5="$row55[username]";

$query66="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'"; 

 $result66 = mysqli_query($con,$query66);

 while($row66 = mysqli_fetch_array($result66))

{



$ac6="$row66[active]";

 $countusername6="$row66[username]";

 $query77="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername6'"; 

 $result77 = mysqli_query($con,$query77);

 while($row77 = mysqli_fetch_array($result77))

{

	$ac7="$row77[active]";

 $countusername7="$row77[username]";

 $pcktook="$row77[pcktaken]";
 
 $idnum7="$row77[Id]";

$qu="SELECT level7 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll7="$r[0]";
	
	$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row7a = mysqli_fetch_array($resultpack))

{


	$pname="$row7a[name]";

	$pprice="$row7a[price]";

	$pcur="$row7a[currency]";


}

}

  

if ($ac7==1)

{

$status7="success";

$totalrefear=$totalrefear+$ll7;

}

else

{

$status7="danger";

}

$rowi="$row77[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);


$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum7 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level7 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack7="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack7 = mysqli_query($con,$querypack7);

while($row1a7 = mysqli_fetch_array($resultpack7))

{


	$pname7="$row1a7[name]";

	$pprice7="$row1a7[price]";

	$pcur7="$row1a7[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname7add="Recent Saving Acquired:" .$pname7;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}



  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status7 m-t-sm'> <i class='fa fa-rocket'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum7</b> </div>

                          <div class='h4 block text-info'>$row77[username]</div>

                         <small class='text-muted'>E-Mail : $row77[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname7add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row66[username]</b></span></small></div>

                      </div>

                    </li> ";

  

}

  }

  }

}

 }

 }

 }

  print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>";

?>



				  

                </section>

              </div>

			  			    <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-warning-ltest"><h4><b>Level 8</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 

$totalrefear=0;		

$totalrefearadd=0;				

$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 

 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'"; 

 $result44 = mysqli_query($con,$query44);

 while($row44 = mysqli_fetch_array($result44))

{

 $ac4="$row44[active]";

 $countusername4="$row44[username]";

 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'"; 

 $result55 = mysqli_query($con,$query55);

 while($row55 = mysqli_fetch_array($result55))

{

$ac5="$row55[active]";

 $countusername5="$row55[username]";

$query66="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'"; 

 $result66 = mysqli_query($con,$query66);

 while($row66 = mysqli_fetch_array($result66))

{



$ac6="$row66[active]";

 $countusername6="$row66[username]";

 $query77="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername6'"; 

 $result77 = mysqli_query($con,$query77);

 while($row77 = mysqli_fetch_array($result77))

{

		$countusername7="$row77[username]";

	$query88="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername7'"; 

 $result88 = mysqli_query($con,$query88);

 while($row88 = mysqli_fetch_array($result88))

{

	$ac8="$row88[active]";

 $countusername8="$row88[username]";

 $pcktook="$row88[pcktaken]";
 
 $idnum8="$row88[Id]";

$qu="SELECT level8 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll8="$r[0]";
	
	$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row8a = mysqli_fetch_array($resultpack))

{


	$pname="$row8a[name]";

	$pprice="$row8a[price]";

	$pcur="$row8a[currency]";


}

}

  

if ($ac8==1)

{

$status8="success";

$totalrefear=$totalrefear+$ll8;

}

else

{

$status8="danger";

}

$rowi="$row88[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);


$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum8 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level8 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack8="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack8 = mysqli_query($con,$querypack8);

while($row1a8 = mysqli_fetch_array($resultpack8))

{


	$pname8="$row1a8[name]";

	$pprice8="$row1a8[price]";

	$pcur8="$row1a8[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname8add="Recent Saving Acquired:" .$pname8;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}

  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status8 m-t-sm'> <i class='fa fa-trophy'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum8</b> </div>

                          <div class='h4 block text-info'>$row88[username]</div>

                         <small class='text-muted'>E-Mail : $row88[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname8add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row77[username]</b></span></small></div>

                      </div>

                    </li> ";

} 

}

  }

  }

}

 }

 }

 }

  print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>";

?>



				  

                </section>

              </div>			  

			  

			  

			  

			  

			  

			  

			 

<!-- End Fetching Downline Of User-->

                    

                    

                   

				    <div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-warning-ltest"><h4><b>Level 9</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 

$totalrefear=0;		

$totalrefearadd=0;			

$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 

 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'"; 

 $result44 = mysqli_query($con,$query44);

 while($row44 = mysqli_fetch_array($result44))

{

 $ac4="$row44[active]";

 $countusername4="$row44[username]";

 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'"; 

 $result55 = mysqli_query($con,$query55);

 while($row55 = mysqli_fetch_array($result55))

{

$ac5="$row55[active]";

 $countusername5="$row55[username]";

$query66="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'"; 

 $result66 = mysqli_query($con,$query66);

 while($row66 = mysqli_fetch_array($result66))

{



$ac6="$row66[active]";

 $countusername6="$row66[username]";

 $query77="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername6'"; 

 $result77 = mysqli_query($con,$query77);

 while($row77 = mysqli_fetch_array($result77))

{

		$countusername7="$row77[username]";

	$query88="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername7'"; 

 $result88 = mysqli_query($con,$query88);

 while($row88 = mysqli_fetch_array($result88))

{

	

 $countusername8="$row88[username]";

 $query99="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername8'"; 

 $result99 = mysqli_query($con,$query99);

 while($row99 = mysqli_fetch_array($result99))

{

	

 $countusername9="$row99[username]";

 

 $ac9="$row99[active]";

 $pcktook="$row99[pcktaken]";
 
 $idnum9="$row99[Id]";

$qu="SELECT level9 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll9="$r[0]";

$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row9a = mysqli_fetch_array($resultpack))

{


	$pname="$row9a[name]";

	$pprice="$row9a[price]";

	$pcur="$row9a[currency]";


}

}

  

if ($ac9==1)

{

$status9="success";

$totalrefear=$totalrefear+$ll9;

}

else

{

$status9="danger";

}

$rowi="$row99[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);


$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum9 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level9 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack9="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack9 = mysqli_query($con,$querypack9);

while($row1a9 = mysqli_fetch_array($resultpack9))

{


	$pname9="$row1a9[name]";

	$pprice9="$row1a9[price]";

	$pcur9="$row1a9[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname9add="Recent Saving Acquired:" .$pname9;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}


  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status9 m-t-sm'> <i class='fa fa-gift'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum9</b> </div>

                          <div class='h4 block text-info'>$row99[username]</div>

                         <small class='text-muted'>E-Mail : $row99[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname9add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row88[username]</b></span></small></div>

                      </div>

                    </li> ";

}

} 

}

  }

  }

}

 }

 }

 }

  print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>";

?>



				  

                </section>

              </div>			  

			  

			  

			  

			  

			  

			  

			 

<!-- End Fetching Downline Of User-->



<div class="col-lg-3">

                <section class="panel panel-default">

                  <div class="panel-body bg-success"><h4><b>Level 10</b></h4></div>

				  <!-- Started Fetching Downline Of User-->

					<?php 

$totalrefear=0;		

$totalrefearadd=0;			

$query="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $ac="$row[active]";

 $countusername="$row[username]";

 $query22="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername'"; 

 $result22 = mysqli_query($con,$query22);

 

while($row22 = mysqli_fetch_array($result22))

{

 $ac2="$row22[active]";

 $countusername2="$row22[username]";

 $fname22="$row22[fname]";

 

 $query33="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername2'"; 

 $result33 = mysqli_query($con,$query33);

 while($row33 = mysqli_fetch_array($result33))

{

$ac3="$row33[active]";

 $countusername3="$row33[username]";

 

 $query44="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername3'"; 

 $result44 = mysqli_query($con,$query44);

 while($row44 = mysqli_fetch_array($result44))

{

 $ac4="$row44[active]";

 $countusername4="$row44[username]";

 $query55="SELECT fname,email,doj,active,username FROM  affiliateuser where referedby = '$countusername4'"; 

 $result55 = mysqli_query($con,$query55);

 while($row55 = mysqli_fetch_array($result55))

{

$ac5="$row55[active]";

 $countusername5="$row55[username]";

$query66="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername5'"; 

 $result66 = mysqli_query($con,$query66);

 while($row66 = mysqli_fetch_array($result66))

{



$ac6="$row66[active]";

 $countusername6="$row66[username]";

 $query77="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername6'"; 

 $result77 = mysqli_query($con,$query77);

 while($row77 = mysqli_fetch_array($result77))

{

		$countusername7="$row77[username]";

	$query88="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername7'"; 

 $result88 = mysqli_query($con,$query88);

 while($row88 = mysqli_fetch_array($result88))

{

	

 $countusername8="$row88[username]";

 $query99="SELECT fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername8'"; 

 $result99 = mysqli_query($con,$query99);

 while($row99 = mysqli_fetch_array($result99))

{

	

 $countusername9="$row99[username]";

 $query10="SELECT Id,fname,email,doj,active,username,pcktaken FROM  affiliateuser where referedby = '$countusername9'"; 

 $result10 = mysqli_query($con,$query10);

 while($row10 = mysqli_fetch_array($result10))

{

 $countusername10="$row10[username]";

 $ac10="$row10[active]";

 $pcktook="$row10[pcktaken]";
 
 $idnum10="$row10[Id]";

$qu="SELECT level10 FROM  packages where id = $pcktook"; 

$re = mysqli_query($con,$qu);

while($r = mysqli_fetch_array($re))

{

	$ll10="$r[0]";

$querypack="SELECT name,price,currency FROM  packages where id = $pcktook"; 

 $resultpack = mysqli_query($con,$querypack);

while($row10a = mysqli_fetch_array($resultpack))

{


	$pname="$row10a[name]";

	$pprice="$row10a[price]";

	$pcur="$row10a[currency]";


}


}

  

if ($ac10==1)

{

$status10="success";

$totalrefear10=$totalrefear + ($ll10 * (20/100));



$totalrefear=$totalrefear10;

}

else

{

$status10="danger";

}

$rowi="$row10[doj]";

$time = strtotime($rowi);
$doj = date("M d, Y D", $time);



$q="SELECT Id,memberID,pcktakenID,payment_status,doj,discount,getpayment FROM  affiliateuserpackage where memberID = $idnum10 ORDER BY id ASC"; 


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
	
	
	
	$qu1="SELECT level10 FROM  packages where id = $pramount"; 
		

$re1 = mysqli_query($con,$qu1);

while($r1 = mysqli_fetch_array($re1))

{

	$ll1a="$r1[0]";
	


$querypack10="SELECT name,price,currency FROM  packages where id = $pramount"; 

 $resultpack10 = mysqli_query($con,$querypack10);

while($row1a10 = mysqli_fetch_array($resultpack10))

{


	$pname10="$row1a10[name]";

	$pprice10="$row1a10[price]";

	$pcur10="$row1a10[currency]";


}


	
}

$i=0;$i++;

if ($prstatus==1)

{

$status1="success";

$pname10add="Recent Saving Acquired:" .$pname10;
$totalrefearadd=$totalrefearadd+$ll1a;


}

else if ($prid=="")

{

$status1="danger";

}

}


  echo "<li class='list-group-item'>

                      <div class='media'>

                        <div class='pull-right text-$status10 m-t-sm'> <i class='fa fa-check-square'></i> </div>

                        <div class='media-body'>

                          <div class='text-success'>ID: <b>$idnum10</b> </div>

                          <div class='h4 block text-info'>$row10[username]</div>

                         <small class='text-muted'>E-Mail : $row10[email]</small> <br><small class='text-muted'>Date Registered : $doj </small><br><small class='text-muted'>Initial Savings Package Taken : $pname</small><br><small class='text-muted'>"; print_r($pname10add); echo"</small><br><br>Referred By - <span class='text-danger'><b>$row99[username]</b></span></small></div>

                      </div>

                    </li> ";

}

} 

}

}

  }

  }

}

 }

 }

 }

  print "</br> <P><b>&nbsp;&nbsp;&nbsp; Total Earnings - </b>$pckcur $totalrefear</p>";

?>



				  

                </section>

              </div>			  

			  

			  

 

				   

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