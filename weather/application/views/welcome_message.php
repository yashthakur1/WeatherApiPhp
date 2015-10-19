<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<?php
//~ http://api.worldweatheronline.com/free/v1/weather.ashx?key=xxxxxxxxxxxxxxxxx&q=SW1&num_of_days=3&format=xml

// Database Details
$mysql_hostname = "localhost";
$mysql_user     = "root"; //Can change according to the database details
$mysql_password = "";    //Can change according to the database details. *( current case no password set)
$mysql_database = "weather"; // Database name


// Methods to check connection with database.
$bd = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Oops some thing went wrong");
mysqli_select_db($bd,$mysql_database) or die("Oops some thing went wrong");






//Minimum request
//Can be city,state,country, zip/postal code, IP address, longtitude/latitude. If long/lat are 2 elements, they will be assembled. IP address is one element.
$City=$_POST["city"];
$State=$_POST["state"];
echo "city- ".$City,"State- ".$State;
$loc_array= Array($City,$State);		//data validated in foreach.
$api_key="29ae6fae85e088882d0e163a229cf";		//should be embedded in your code, so no data validation necessary, otherwise if(strlen($api_key)!=24)
$num_of_days=2;					//data validated in sprintf

// loop to store array values
$loc_safe=Array();
foreach($loc_array as $loc){
	$loc_safe[]= urlencode($loc);
}
$loc_string=implode(",", $loc_safe);

//To add more conditions to the query, just lengthen the url string eg.(Format='XML' or 'JSON') *use any one Tag XML or JSON
$basicurl=sprintf('http://api.worldweatheronline.com/free/v2/weather.ashx?key=%s&q=%s&num_of_days=%s',//By Default Set to XML
	$api_key, $loc_string, intval($num_of_days));

print $basicurl . "<br />";// displays the actual api link passed in the browser.

//Premium API
$premiumurl=sprintf('http://api.worldweatheronline.com/premium/v1/premium-weather-V2.ashx?key=%s&q=%s&num_of_days=%s',
	$api_key, $loc_string, intval($num_of_days));
//Method to navigate through xml datanodes recieved in response.
$xml_response = file_get_contents($basicurl);
$xml = simplexml_load_string($xml_response);


printf("<p>Current wind speed is %s mph blowing to %s</p>",
	$xml->current_condition->windspeedMiles, $xml->current_condition->winddir16Point );
printf ("<h1>TEMPERATURE : %s</h1>",$xml->current_condition->temp_C."C");
$location=(string)$xml->request->query;
$temperature=(string)$xml->current_condition->temp_C;
$time=date("h:i:sa");//Used for displaying current time.and storing the value in the variable.
$humidity=(string)$xml->current_condition->humidity;
// Display Current humidity and Temperature
echo "<h1>location :".$location."</h1>";
echo "<h1>Humidity :".$humidity."</h1>";

// Insert Display Data into Mysql Database.(database name "weather")
$sql   = "INSERT INTO `data` (Location, Temperature,Humidity,Time) VALUES ('$location', '$temperature C','$humidity','$time')";//Query to insert data into databse "weather" Table "data"
mysqli_query($bd,$sql);

print "Finished database query<br/>";//Prints after data is transfered in database.

// UnComment below area to see the xml tags on the browser.
/*
print "<pre>";
print_r($xml);
print "</pre>";*/
?>

</body>
</html>
