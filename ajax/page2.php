<?php
header('Access-Control-Allow-Origin:*');


$data = $_POST;
$retour = [];
if ($data["nom"] == "Smail"){
    $retour["nom"] = "Smail";
    $retour["nom1"] = "Smail1";
}else{
    $retour["nom"] = "Non Smail";
    $retour["nom1"] = "Non Smail1";
}
    
    echo json_encode($retour);