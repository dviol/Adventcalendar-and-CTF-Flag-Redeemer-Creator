<?php
//UNCOMENT FOT DEBUGGING
//ini_set('display_errors', 1);
//error_reporting(~0);

$ex = $_GET['excercise'];
$val = $_GET['token'];
$myfile = fopen($ex."/".$ex, "r");
$stored = fgets($myfile);

//Checks if the given flag is same as the saved and updates according the xml file 
//Maybe in the future I just should create this XML file if it not exists like in makeToken.php, but yeah... learning and lazyness
if(password_verify($val, $stored)){

echo "<h1>You did Excercise $ex!!!</h1>";
$ex = $ex -1;
$xml = simplexml_load_file("solved.xml");
$node = $xml->exersize[$ex];
$node->solved = "true";
date_default_timezone_set('Europe/Berlin');
$node->date = date("d.m.y H:I:s");

$xml_file = fopen("solved.xml","w");
fwrite($xml_file,$xml->asXML());
fclose($xml_file);
}else{

echo "<h1>Sorry, try again</h1>";

}

echo "</br>";
echo '<a href="index.php">Go back</a>';
?>
