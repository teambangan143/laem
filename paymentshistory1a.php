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

            <p><strong>Earning Release History| </strong>Red = Pending And Green = Completed</p>

            <button href="#" class="btn btn-sm btn-info pull-right" onClick="window.print();">Print Earnings Payment History</button>

          </header>

          <section class="scrollable wrapper">

            <div class="row">
              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading"> Your Payments Request List - Earnings</header>

                  <ul class="list-group alt">

				  <!-- Started Fetching Downline Of User-->

					<?php $query="SELECT Id FROM  affiliateuser where username = '".$_SESSION['username']."'"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

 $uid="$row[Id]";

}



$query2="SELECT * FROM  payments where userid = '$uid'"; 

 

 

 $result2 = mysqli_query($con,$query2);



while($row2 = mysqli_fetch_array($result2))

{

 $pa="$row2[payment_amount]";

 $ps="$row2[payment_status]";

 $ct="$row2[createdtime]";
 
 $ctrelease="$row2[release_date]";



if ($ps==1)

{

$status="success";

}

else

{

$status="danger";

}

$rowi="$row2[createdtime]";

$time = strtotime($rowi);
$paymentdate = date("M d, Y D", $time);

$rowo="$ctrelease";

$time = strtotime($rowo);
$paymentreleasedate = date("M d, Y D", $time);


  echo "<li class='list-group-item'>

                      <div class='media'> <span class='pull-left thumb-sm'><img src='images/a1.jpg' alt='John said' class='img-circle'></span>

                        <div class='pull-right text-$status m-t-sm'> <i class='fa fa-circle'></i> </div>

                        <div class='media-body'>

                          <div><a href='#'>Request Date: $paymentdate</a></div>
						  
						  <div><a href='#'>Payment Release Date: $paymentreleasedate</a></div>

                         <span class='pull-left text-muted'>Payment Amount : $row2[payment_amount]</span></div>

                      </div>

                    </li> ";

  

  //echo $row['fname'] . " " . $row['email'];

  //echo "<br>";

  }



 

 //if ($result = mysqli_query($con, $query)) {

 

 //mysqli_field_seek($result, 0);



    /* Get field information for all fields */

    //while ($finfo = mysqli_fetch_field($result)) {

	

	/* echo "<li class='list-group-item'>

                      <div class='media'> <span class='pull-left thumb-sm'><img src='images/a1.jpg' alt='John said' class='img-circle'></span>

                        <div class='pull-right text-success m-t-sm'> <i class='fa fa-circle'></i> </div>

                        <div class='media-body'>

                          <div><a href='#'>$finfo->fname</a></div>

                          <small class='text-muted'>E-Mail : $row[1] </small> <br><small class='text-muted'>E-Mail : $row[2] </small><br><small class='text-muted'>Date Of Joining : $row[3] </small></div>

                      </div>

                    </li> ";



        //printf("Name:     %s\n", $finfo->fname);

        //printf("E-Mail:    %s\n", $finfo->email);

        //printf("max. Len: %d\n", $finfo->doj);

        //printf("Flags:    %d\n", $finfo->active);

        //printf("Type:     %d\n\n", $finfo->type);

    }

    mysqli_free_result($result);

}



 

 /* if ($result = $con->query( $query)) {



    

   /* fetch row 

    $row = $result->fetch_row();

	echo "<li class='list-group-item'>

                      <div class='media'> <span class='pull-left thumb-sm'><img src='images/a1.jpg' alt='John said' class='img-circle'></span>

                        <div class='pull-right text-success m-t-sm'> <i class='fa fa-circle'></i> </div>

                        <div class='media-body'>

                          <div><a href='#'>$row[0]</a></div>

                          <small class='text-muted'>E-Mail : $row[1] </small> <br><small class='text-muted'>E-Mail : $row[2] </small><br><small class='text-muted'>Date Of Joining : $row[3] </small></div>

                      </div>

                    </li> ";



    //printf ("Name: %s  E-Mail: %s\n", $row[0], $row[1]);



    /* free result set*/

//$result->close();

//}

 //$i=0;

 //$num=$num1 - 1;

//while ($i < $num1)

//{

//$fname=mysqli_fetch_field($result,$num,"fname");

//$eemail=mysql_result($result,$num,"email");

//$ddoj=mysql_result($result,$num,"doj");

//$status=mysql_result($result,$num,"active");

//$i=$i+1;

//$num=$num-1;

//if ($active==1)

//{

//$status="Verified";

//}

//else

//{

//$status="Not Verified";

//}

//print "$fname";

//echo "	<tr><td>$i</td><td>$fname</td><td>$eemail</td><td class='price'>$ddoj</td><td class='total'>$status</td></tr>" ;





//} */

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