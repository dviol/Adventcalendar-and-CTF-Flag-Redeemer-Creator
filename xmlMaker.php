<?php
$xml = new SimpleXMLElement('<xml/>');

for ($i = 1; $i <= 24; ++$i) {
    $track = $xml->addChild("exersize");
    $track->addChild('number', $i);
    $track->addChild('solved', "false");
    $track->addChild('date', "");
}

Header('Content-type: text/xml');
print($xml->asXML())

?>
