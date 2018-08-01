<?php
 
$con = mysqli_connect("localhost", "cmpcintl_nash", "74F2JrXehV5P", "cmpcintl_xzel");
 
?>




<?php
		$date1 = date('m/d/Y');

$date2 = '12/31/2099';

$value = '1530';

$totalrefear=0;



function returnDates($fromdate, $todate) {

    $fromdate = \DateTime::createFromFormat('m/d/Y', $fromdate);

    $todate = \DateTime::createFromFormat('m/d/Y', $todate);

    return new \DatePeriod(

        $fromdate->modify('+15 day'),

        new \DateInterval('P15D'),

        $todate->modify('+15 day')

    );

}



$datePeriod = returnDates($date1, $date2);


$i = 1;

foreach($datePeriod as $date) {

	$offer=$i++;
    echo $value,"\n";
	echo $date->format('Y-m-d'),"\n";
	$date2 = $date->format('Y-m-d');
    echo "</br>";
mysqli_query($con,"INSERT into `paymentsclp` (payment_amount,payment_date) VALUES ('$value','$date2')");	
	

	if($offer==5) break;

	
	
}

echo "Total:", $totalrefear=$value*5;
echo "</br>";
	echo "New record created successfully";




?>