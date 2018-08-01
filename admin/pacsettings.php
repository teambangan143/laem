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

<title>Packages Settings</title>

<meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />

<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<link rel="stylesheet" href="css/app.v1.css" type="text/css" />

<!--[if lt IE 9]> <script src="js/ie/html5shiv.js"></script> <script src="js/ie/respond.min.js"></script> <script src="js/ie/excanvas.js"></script> <![endif]-->

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        

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

            <p><strong>Important Instructions </strong> <b>1.</b> All Details Are Mandatory. <b>2. </b> Enter 0 to disable the referral level. <b>3.</b> Enter amounts in integer (1) or decimal (1.0).</p>

          </header>

          <section class="scrollable wrapper">

            <div class="row">

              

              <div class="col-sm-12 portlet">

                <section class="panel panel-success portlet-item">

                  <header class="panel-heading"> Packages Settings </header>

                  <section class="panel panel-default">

                  <header class="panel-heading bg-light">

                    <ul class="nav nav-tabs nav-justified">

                      <li class="active"><a href="#home" data-toggle="tab">Create Packages</a></li>

                      <li><a href="#profile" data-toggle="tab">Update Packages</a></li>

                      <li><a href="#messages" data-toggle="tab">Deactivate Packages</a></li>

                      

                    </ul>

                  </header>

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane active" id="home">

					  

					  

					  <div class="panel-body">

                    <form action="createpac.php" method="post">

                      <div class="form-group">

                        <label>Package Name</label>

                        <input type="text" class="form-control" placeholder="Enter Package Name" name="pckname">

                      </div>

                      <div class="form-group">

                        <label>Package Details</label>

                        <input type="textarea" class="form-control" placeholder="Intro of package" name="pckdetail">

                      </div>

					  

					  <div class="form-group">

                        <label>Package Price ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="pckprice" id="pckprice">

                      </div>

					  <div class="form-group">

                        <label>Quantity( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="pcktax" id="pcktax">

                      </div>
                      
                      <div class="form-group">

                        <label>Tax( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="pcktax1" id="pcktax1">

                      </div>

					  <div class="form-group">

					  <label>

            Select Currency : <br/>

		  <select name="currency">

		  <?php $query="SELECT id,name,code FROM  currency"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$curname="$row[name]";

	$curcode="$row[code]";

	

  print "<option value='$curcode'>$curname - $curcode </option>";

  

  }

  ?>

 

</select>

</label> 

<br/>

 <div class="form-group">

                        <label>Minimum Payout For User ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="User should earn minimum this money to send payment request, Like 50 or 100 and should not be 0" name="pckmpay" >

                      </div>

					  

					   <div class="form-group">

                        <label>Signup Bonus( Only Number )</label>

                        <input type="text" class="form-control" placeholder="User will receive bonus amount after signup. Like 10,20 or 0 to disable" name="pcksbonus" >

                      </div>



<div class="form-group">


                        <table width="100%" border="0">
  <tr>
    <td><label>Level 1 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev1" id="lev1" >
   </td>
    <td><label>Level 1 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev1pts" id="lev1pts">
                        <script>
    $('#lev1pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev1pts').val());
        var result = textone * texttwo;
        $('#lev1').val(result.toFixed());
    });
</script>

   </td>
  </tr>
  </table>


                      </div>

					  <div class="form-group">

                       <table width="100%" border="0">
  <tr>
    <td> <label>Level 2 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev2" id="lev2" ></td>
    <td> <label>Level 2 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev2pts" id="lev2pts">
                        <script>
    $('#lev2pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev2pts').val());
        var result = textone * texttwo;
        $('#lev2').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 3 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev3" id="lev3" ></td>
    <td><label>Level 3 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev3pts" id="lev3pts">
                        <script>
    $('#lev3pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev3pts').val());
        var result = textone * texttwo;
        $('#lev3').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 4 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev4" id="lev4" ></td>
    <td><label>Level 4 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev4pts" id="lev4pts">
                        <script>
    $('#lev4pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev4pts').val());
        var result = textone * texttwo;
        $('#lev4').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                       <table width="100%" border="0">
  <tr>
    <td> <label>Level 5 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev5" id="lev5" ></td>
    <td> <label>Level 5 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev5pts" id="lev5pts">
                        <script>
    $('#lev5pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev5pts').val());
        var result = textone * texttwo;
        $('#lev5').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 6 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev6" id="lev6" ></td>
    <td><label>Level 6 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev6pts" id="lev6pts">
                        <script>
    $('#lev6pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev5pts').val());
        var result = textone * texttwo;
        $('#lev6').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                       <table width="100%" border="0">
  <tr>
    <td> <label>Level 7 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev7" id="lev7" ></td>
    <td> <label>Level 7 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev7pts" id="lev7pts">
                        <script>
    $('#lev7pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev5pts').val());
        var result = textone * texttwo;
        $('#lev7').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                       <table width="100%" border="0">
  <tr>
    <td><label>Level 8 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev8" id="lev8" ></td>
    <td><label>Level 8 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev8pts" id="lev8pts">
                        <script>
    $('#lev8pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev8pts').val());
        var result = textone * texttwo;
        $('#lev8').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 9 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev9" id="lev9" ></td>
    <td><label>Level 9 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev9pts" id="lev9pts">
                        <script>
    $('#lev9pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev9pts').val());
        var result = textone * texttwo;
        $('#lev9').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 10 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev10" id="lev10"> </td>
    <td><label>Level 10 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev10pts" id="lev10pts">
                        <script>
    $('#lev10pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev10pts').val());
        var result = textone * texttwo;
        $('#lev10').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 11 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev11" id="lev11" ></td>
    <td><label>Level 11 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev11pts" id="lev11pts">
                        <script>
    $('#lev11pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev11pts').val());
        var result = textone * texttwo;
        $('#lev11').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 12 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev12" id="lev12" ></td>
    <td><label>Level 12 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev12pts" id="lev12pts">
                         <script>
    $('#lev12pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev12pts').val());
        var result = textone * texttwo;
        $('#lev12').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 13 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev13" id="lev13" ></td>
    <td><label>Level 13 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev13pts" id="lev13pts">
                        <script>
    $('#lev13pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev13pts').val());
        var result = textone * texttwo;
        $('#lev13').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                       <table width="100%" border="0">
  <tr>
    <td><label>Level 14 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev14" id="lev14" ></td>
    <td><label>Level 14 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev14pts" id="lev14pts">
                        <script>
    $('#lev14pts,#pcktax').keyup(function(){
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev14pts').val());
        var result = textone * texttwo;
        $('#lev14').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <div class="form-group">

                        <table width="100%" border="0">
  <tr>
    <td><label>Level 15 (Value)</label>

                        <input type="text" class="form-control-left" placeholder="Like 10,20" name="lev15" id="lev15" ></td>
    <td><label>Level 15 (Points)</label>

                        <input type="text" class="form-control-right" placeholder="Like 10,20" name="lev15pts" id="lev15pts">
                        <script>
    $('#lev15pts,#pcktax').keyup(function() {
        var textone;
        var texttwo;
        textone = parseFloat($('#pcktax').val());
		texttwo = parseFloat($('#lev15pts').val());
        var result = textone * texttwo;
        $('#lev15').val(result.toFixed());
    });
</script>
                        </td>
  </tr>
</table>


                      </div>

					  <!--<div class="form-group">

                       <label>Level 16 ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="lev16">

                      </div>

					  <div class="form-group">

                       <label>Level 17 ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="lev17">

                      </div>

					  <div class="form-group">

                        <label>Level 18 ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="lev18">

                      </div>

					  <div class="form-group">

                       <label>Level 19 ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="lev19">

                      </div>

					  

					  <div class="form-group">

                       <label>Level 20 ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Like 10,20" name="lev20">

                      </div>-->

					  <div class="form-group">

                       <label>Renew Day(s) ( Only Number )</label>

                        <input type="text" class="form-control" placeholder="Enter '99999' for no expiry or enter no of days like 30 (1 month), 60 (2 months), 365 (1 year) - This would be the expiry date for user account" name="renewdays">

                      </div>

					  <!--<div class="list-group-item">

		   

</div>-->



					  

					  

</div>

                      

                     <button type="submit" class="btn btn-lg btn-primary btn-block">I Have Filled And Checked All Details. Create Package For Me Now.</button>

                    </form>

                  </div>

					  

					  </div>

                      <!--<div class="tab-pane" id="profile"><form action="updatepck.php" method="post">

                      <div class="form-group">

                        <label>

            Select Package To Update/Edit : 

		  <select name="upackage">

		  <?php $query="SELECT id,name,price,currency,tax FROM  packages"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$pname="$row[name]";

	$pprice="$row[price]";

	$pcur="$row[currency]";

	$ptax="$row[tax]";

$total=$pprice+$ptax;

  print "<option value='$id'>$pname | Price - $pcur $total </option>";

  

  }

  ?>

 

</select>

                      

                      

					  

					  

</div>

                      

                     <button type="submit" class="btn btn-lg btn-primary btn-block">I Have Filled And Checked All Details. Update/Edit This Package For Me Now.</button>

                    </form></div>-->

                      <div class="tab-pane" id="messages"><div class="list-group-item">

					  <form action="deletepackage.php" method="post">

		  <label>

            Select Package To Delete : 

		  <select name="packagedelid">

		  <?php $query="SELECT id,name,price,currency,tax FROM  packages where active=1"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[id]";

	$pname="$row[name]";

	$pprice="$row[price]";

	$pcur="$row[currency]";

	$ptax="$row[tax]";

$total=$pprice*$ptax;

  print "<option value='$id'>$pname | Price - $pcur $total </option>";

  

  }

  ?>

 

</select>

</label> 



</div>



<button type="submit" class="btn btn-lg btn-primary btn-block">Oh Pls!! I Know What I'm Doing, Deactivate This Package For Me. (You cannot delete package, it can only be deactivated.)</button>

</form>

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