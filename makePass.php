<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h2>Salted token saver</h2>
<h3>Please specify excersize</h3>
 <form action="/joanaChall/makePass.php">
        <select name="excersize">
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
        <select id="rand" name="alphabet">
		<option value="lAlpha">Lowercase only(a..z)</option>
		<option value="uAlpha">Uppercase only(A..Z)</option>
                <option value="alpha">Alpha only (a..zA..Z)</option>
                <option value="num">Numerical only(0..9)</option>
                <option value="alphanum">Alphanumerical (a..zA..Z0..1)</option>
        </select></br>
	<input onclick="removeDefaultText(this)" type="text" name="randL" id="lRand" value="40"> How many Chars<br>
  <input id="self"type="text" name="willbetoken" disabled>
  <input type="submit" value="Submit">
</form> 
<button onclick="toggleOwnToken()">Toggle own or random made token</button>
<script>
function removeDefaultText(id){
id.value = "";
}
function repopulateDefault(id){
id.value = "40";
}

if(performance.navigation.type == 1){
document.getElementById("lRand").value = "40";
}

//Toggles whether a random Token is chosen from the given alphabet, or an own Token is inserted
//Unly for this mode useful items will be enabled
function toggleOwnToken(){
var selfT = document.getElementById("self");
var randT = document.getElementById("rand");
var lRand = document.getElementById("lRand");

if(selfT.disabled){
selfT.disabled = false;
randT.disabled = true;
lRand.disabled = true;

}else{
selfT.disabled = true;
randT.disabled = false;
lRand.disabled = false;

}

}
</script>
</body>



<?php
//ENABLE FOR DEBUGGING
//ini_set('display_errors', 1);
//error_reporting(~0);

//Specify here where the unencrypted tokens are saved:
$tokenXMLPath = "tokens.xml";

if(isset($_GET['excersize']))
{
	
	$token = "";

	if(isset($_GET['alphabet'])){
		//Token will be random selected

		$wC = $_GET['alphabet'];

		$pool = [];

		//There is probably a better way, but this will add successifely an alphabet to the pool depending on the user choice
		if(strcmp($wC,"lAlpha") == 0 || strcmp($wC, "alpha") == 0 || strcmp($wC, "alphanum") == 0){

			$pool = array_merge($pool, range('a','z'));

		}

		if(strcmp($wC,"uAlpha") == 0 || strcmp($wC, "alpha") == 0 || strcmp($wC, "alphanum") == 0){
			$pool  = array_merge($pool, range('A','Z'));
		}


		if(strcmp($wC,"num") == 0 || strcmp($wC, "alphanum") == 0){
			$pool = array_merge($pool,range(0,9));
		}

		//Gets a random Key out of a given alphabet
		function randomKey($length, $po) {
		    $poolF = $po;
		    $key = "";
		    for($i=0; $i < $length; $i++) {
			$key .= $poolF[mt_rand(0, count($poolF) - 1)];
		    }
		    return $key;
		}
		
		$token = randomKey($_GET['randL'], $pool);

	}else{
		//Token will be specified by user

		$token = $_GET['willbetoken'];

	}

	echo "Token will be: " . $token . "</br>";
	$options = [
	    'cost' => 12,
	];
	//Token is being hashed and saved to the var outpass
	$outpass = password_hash($token, PASSWORD_BCRYPT, $options);
	
	$ex = $_GET['excersize'];
	
	//Does the unencrypted tokenfile already exist?		
	if(file_exists($tokenXMLPath)){
		$xml = simplexml_load_file($tokenXMLPath);
	}else{
		$xml = new SimpleXMLElement("<TOKENS></TOKENS>");
	}
	
	//Find the node of the excersize
	$foundToken = findNode($ex,$xml);

	if(is_null($foundToken)){
		//Node with value $ex not found, add new
		$xmlToken = $xml->addChild('token');
		$xmlToken -> addAttribute('id',$ex);
		$xmlToken -> addChild('value', $token);



	}else{
		//Update the token value
		$foundToken -> value = $token;
	}
	
	//Write the xml file
	$xmlFile = fopen($tokenXMLPath, "w");
	fwrite($xmlFile,$xml -> asXML());
	fclose($xmlFile);
	
	//Write the hashed token into $ex/$ex, eg 1/1
	$myfile = fopen($ex."/".$ex, "w");
	fwrite($myfile, $outpass);
	fclose($myfile); 
}

//Searches the node value $i in the $xml_file. Returns NULL if not found, else the node
function findNode($i, $xml_file){
        foreach($xml_file->token as $tokenf){
                if($tokenf->attributes()['id'] == $i){
                                return $tokenf;
                        }


                }   
        return NULL;

}

?>
</html>
