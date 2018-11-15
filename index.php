<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h2>Go to your challenge</h2>
 <!--Chooser, which will show the challenge html document-->
 <form action="/joanaChall/index.php">
	<select name="excercise">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
	</select></br>
  <input type="submit" value="Submit">
</form> 

<?php

if(!empty($_GET)){
//Includes the excercise of this given document
include($_GET['excercise']."/excercise.html");
}


?>
<h2>Upload your Flag</h2>

 <form action="/joanaChall/checkToken.php">
	<select name="excercise">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
		<option value="13">13</option>
		<option value="14">14</option>
		<option value="15">15</option>
		<option value="16">16</option>
		<option value="17">17</option>
		<option value="18">18</option>
		<option value="19">19</option>
		<option value="20">20</option>
		<option value="21">21</option>
		<option value="22">22</option>
		<option value="23">23</option>
		<option value="24">24</option>
	</select></br>
  Token: <input type="text" name="token"><br>
  <input type="submit" value="Submit">
</form> 

<?php
//UNCOMMENT FOR DEBUGGING
//ini_set('display_errors', 1);
//error_reporting(~0);
$xml = simplexml_load_file("solved.xml");

echo '<table style="width:100%" >';
$green = "#50f442";
$red   = "#f45642";
$color = "";
$l = 0;

//Checks wether the excercise is solved according to solved.xml in a 4 Rows and 6 columns table

for ( $i = 1; $i <= 4; ++$i){
	echo "<tr>";
	for( $j = 1; $j <= 6; ++$j){
		$node = $xml->exersize[$l];
		if(strcmp($node->solved,"true") == 0){
			$color = $green;
		}else{
			$color = $red;
		}
		echo "<th bgcolor=$color>";
		echo strval($l+1);
		echo "</br>";
		echo $node->date;	
		echo "</th>";
		$l++;
	}
	echo "</tr>";
}
echo "</table>";
?>


</body>


</html>
