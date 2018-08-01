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

            <p><strong>Important Instructions </strong> <b>1.</b> If you find unknown status of user, then kindly edit the user profile and update the status.<b> 2. </b> Records are shown from newest to oldest.</p>

          </header>

          <section class="scrollable wrapper">

            <div class="row">

              

              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading"> Users Settings </header>

                  <section class="panel panel-default">

                  <header class="panel-heading bg-light">

                    <ul class="nav nav-tabs nav-justified">

                      <li class="active"><a href="#home" data-toggle="tab">Registered Users</a></li>

                       

                    </ul>

                  </header>

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane active" id="home">

					  

					  

					  <div class="panel-body">

                    

					  

<div class="table-responsive">

                <table class="table table-striped b-t b-light">

                  <thead>

                    <tr>

                     

                      <th width="18%">User id/Order id</th>

					  <th width="15%">Username</th>

					  <th width="15%">Sponsor</th>

					  <th width="8%">Earnings</th>

					  <th width="15%">Package Taken</th>

					  <th width="15%">Reg. Date</th>

					  <th width="15%">Status</th>

					  <th width="50%">Action</th>

                    </tr>

                  </thead>

                  <tbody>

				  <?php $query="SELECT * FROM  affiliateuser where level=2 ORDER BY id DESC"; 

 

 

 $result = mysqli_query($con,$query);

$i=0;

while($row = mysqli_fetch_array($result))

{

	

	$id="$row[Id]";

	$username="$row[username]";

	$fname="$row[fname]";
	
	$lname="$row[lname]";
	
	$fullname="$fname $lname";

	$email="$row[email]";

	$mobile="$row[mobile]";

	$active="$row[active]";

	$doj="$row[doj]";

	$country="$row[country]";

	$ear="$row[tamount]";

	$ref="$row[referedby]";

	$pck="$row[pcktaken]";

	$lprofile="$row[launch]";

	

	if($active==1)

	{

	$status="Active/Paid";

	}

	else if($active==0)

	{

	$status="UnActive/Unpaid";

	}

	else

	{

	$status="Unknown";

	}

	

	$qu="SELECT * FROM  packages where id = $pck"; 

 

 

 $re = mysqli_query($con,$qu);



while($r = mysqli_fetch_array($re))

{

	$pckid="$r[id]";

	$pckname="$r[name]";

	$pckprice="$r[price]";

	$pckcur="$r[currency]";

	$pcksbonus="$r[sbonus]";

  }

	

  print "<tr>

				  

				  <td>

				  $id

				  </td>

				  <td>

				  $username

				  </td>

				  

				  <td>

				  $ref

				  </td>

				  

				  <td>

				  $ear

				  </td>

				  <td>

				  <b>$pckname </b> <br/> $pckcur $pckprice 

				  </td>

				  <td>

				  $doj

				  </td>

				  <td>

				  

				  $status

				  </td>

				  <td>

				 

				  <a href='updateuser.php?username=$username' class='label_edit bg-success'><span style='padding-bottom:10px;'>Edit User</span></a><br/>

				  <a href='deleteuser.php?username=$username' class='label bg-danger'>Delete User</a> <br/><br/>
				  
				  <a href='deactivateuser.php?username=$username' class='label_edit bg-primary'>De-Activate User</a>

				  ";

				  

				  if($lprofile==0)

	{
		
		/*echo "<br/><label>OR No.:</label>

                          <input type='text' class='form-control' data-required='true' name='orno' id='orno' value='<?php echo $orno; ?>' required>  ";*/

	print "<br/><a href='launchprofile.php?username=$username' class='btn btn-sm btn-info pull-left'>Launch</a>";

	}	  
/*else
{

		
		echo "<br/><label>OR No.:</label>

                          <input type='text' class='form-control' data-required='true' name='orno' id='orno' value='.&var.' required>  ";

	print "<a href='date.php' class='btn btn-sm btn-info pull-left'>Register OR</a>";
	  
	
}*/
			
			
	

	

				  

		print"		  </p> 

				  </td>

				  

				  </tr>";

  

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