<?php

require __DIR__ . '/../Database.php';
$database = new Database;
$users = $database->getLatLngUsers();

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);
header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
foreach ($users as $user) {
    
    // Add to XML document node
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("name", $user['name']);
    $newnode->setAttribute("email", $user['email']);
    $newnode->setAttribute("lat", $user['Lat']);
    $newnode->setAttribute("lng", $user['Long']);
}

echo $dom->saveXML();