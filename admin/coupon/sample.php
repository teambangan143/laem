<?php


include_once ("../z_db.php");
	

	if (isset($_POST['length'])) {

		include 'class.coupon.php';

	/*	$id_number = $_POST['id_number'];

		$regdate = $_POST['regdate'];*/

		$no_of_coupons = $_POST['no_of_coupons'];

		$length = $_POST['length'];

		$prefix = $_POST['prefix'];

		$suffix = $_POST['suffix'];

		$numbers = 'true';

		$letters = 'true';

		$symbols = 'false';

		$random_register = 'false';

		$mask = $_POST['mask'] == '' ? false : $_POST['mask'];

		$coupons = coupon::generate_coupons($no_of_coupons, $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask);

		foreach ($coupons as $key => $value) {

			echo $value."\n";

		}

		

		//$date1 = date('m/d/Y');
//
//$date2 = '12/31/2099';
//
//
//
//function returnDates($fromdate, $todate) {
//
//    $fromdate = \DateTime::createFromFormat('m/d/Y', $fromdate);
//
//    $todate = \DateTime::createFromFormat('m/d/Y', $todate);
//
//    return new \DatePeriod(
//
//        $fromdate,
//
//        new \DateInterval('P15D'),
//
//        $todate->modify('+15 day')
//
//    );
//
//}



//$datePeriod = returnDates($date1, $date2);
//
//$i = 1;
//
//foreach($datePeriod as $date) {
//
//	$i++;
//
//    echo $date->format('Y-m-d'),"\n";
//
//	if($i==8) break;
//
//}

		

		die();

	}



?>



<!DOCTYPE html>

<html>

<head>


	 <!-- Bootstrap -->

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

	<div class="container">

		<div class="row">

			<div class="col-md-12">

				

				<form action="sample.php" method="post" id="coupon_form">

					<table class="table table-striped">

						<tr>

							<th>Parameter</th>

							<th>Type</th>

							<th>Default</th>

							<th>Custom value</th>

						</tr>

                        <!--<tr>

							<th>Date Registered</th>

							<td>number</td>

							<td>6</td>

							<td><input class="form-control" type="text" name="regdate" min="1" maxlength="10" id="id_number" placeholder="YYYY-MM-DD"/></td>

						</tr>-->

                    <!--    <tr>

							<th>Member ID Number</th>

							<td>WeDo ID</td>

							<td>&nbsp;</td>

							<td><select data-required="true" class="form-control" name="id_number" required>

                                <option value="">Please choose</option>

								<?php $query="SELECT Id,username FROM  affiliateuser where level=2 ORDER BY username ASC"; 

 

 

 $result = mysqli_query($con,$query);



while($row = mysqli_fetch_array($result))

{

	$id="$row[Id]";

	$pname="$row[username]";
	


  print "<option value='$id'>$id  $pname</option>";

  

  }

  ?>

								</select></td>

						</tr>

                      <tr>

							<th>Discount Card Number</th>

							<td>number</td>

							<td>5</td>

							<td><input class="form-control" type="text" name="id_number" min="1" maxlength="5" id="disc_number" placeholder="Paste here ID number generated from Primera Klase admin"/></td>

						</tr>-->

						<tr>

							<th>No of Product Coupons</th>

							<td>number</td>

							<td>1</td>

							<td><input class="form-control" type="number" name="no_of_coupons" value="1" min="1"/></td>

						</tr>

						<!--<tr>

							<th>Length</th>

							<td>number</td>

							<td>9</td>

							<td>--><input class="form-control" type="hidden" name="length" value="9" min="1" /><!--</td>

						</tr>-->

						<tr>

							<th>Prefix</th>

							<td>string</td>

							<td></td>

							<td><input class="form-control" type="text" name="prefix" placeholder="prefix-" /></td>

						</tr>

						<tr>

							<th>Suffix</th>

							<td>string</td>

							<td></td>

							<td><input class="form-control" type="text" name="suffix" placeholder="-suffix" /></td>

						</tr>

						<!--<tr>

							<th>Numbers</th>

							<td>boolean</td>

							<td>true</td>

							<td>

								<select class="form-control" name="numbers" type="hidden">

								  	<option value="false">False</option>

								  	<option selected value="true">True</option>

								</select>

							</td>

						</tr>-->

						<!--<tr>

							<th>Letters</th>

							<td>boolean</td>

							<td>true</td>

							<td>

								<select class="form-control" name="letters" type="hidden">

								  	<option value="false">False</option>

								  	<option selected value="true">True</option>

								</select>

							</td>

						</tr>-->

						<!--<tr>

							<th>Symbols</th>

							<td>boolean</td>

							<td>ture</td>

							<td>

								<select class="form-control" name="symbols" type="hidden">

								  	<option selected value="true">True</option>

								  	<option value="false">False</option>

								</select>

							</td>

						</tr>-->

						<!--<tr>

							<th>Random register</th>

							<td>boolean</td>

							<td>true</td>

							<td>

								<select class="form-control" name="random_register" type="hidden">

                               	  <option selected value="true">True</option>

								  	<option value="false">False</option>

								</select>

							</td>

						</tr>-->

						<!--<tr>

							<th>Mask</th>

							<td>string or boolean</td>

							<td>false</td>

							<td>--><input class="form-control" type="hidden" name="mask" value="XXX-XXX" /><!--</td>

						</tr>-->

					</table>

					<div class="col-md-offset-8 col-md-4">

						
                        
                        <button type="submit" class="btn btn-success pull-right">Generate</button>

						<br/>

						<br/>

					</div>

					<hr />

					<hr />

					<div class="col-md-offset-8 col-md-4">

						<button type="button" onclick="exporttocsv()" class="btn btn-success pull-right">Export Codes to Excel</button>

					</div>
                    
                    

					<span class="col-md-offset-8 col-md-4">

					<textarea name="result" rows="3" class="form-control" id="result" placeholder="Result here" style="width:100% !important; height:200px !important"></textarea>

					</span><br/><br/><br/><br/><br/>

				</form>

			</div>

		</div>

	</div>



	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="bootstrap/js/bootstrap.min.js"></script>



    <script type="text/javascript">

	$(document).ready(function(){

		$('#coupon_form').submit(function() {

		//	var id_number = $('input[name="id_number"]').val();

			var no_of_coupons = $('input[name="no_of_coupons"]').val();

			var length = $('input[name="length"]').val();

			var prefix = $('input[name="prefix"]').val();

			var suffix = $('input[name="suffix"]').val();

			var numbers = $('select[name="numbers"]').val();

			var letters = $('select[name="letters"]').val();

			var symbols = $('select[name="symbols"]').val();

			var random_register = $('select[name="random_register"]').val();

			var mask = $('input[name="mask"]').val();



			$('#result').load('sample.php', {

				//id_number: id_number,

				no_of_coupons: no_of_coupons,

				length: length,

				prefix: prefix,

				suffix: suffix,

				numbers: numbers,

				letters: letters,

				symbols: symbols,

				random_register: random_register,

				mask: mask

			});

			return false;

		});

	});



	function exporttocsv() {

		if ($('#result').val()) {

			var a = document.createElement('a');

			with (a) {

				href='data:text/csv;charset=iso-8859-1;base64,' + window.btoa($('#result').val());

				download=$('input[name="id_number"]').val() +  '.csv';

			}

			document.body.appendChild(a);

			a.click();

			document.body.removeChild(a);

	        }



        };

	</script>

</body>

</html>

