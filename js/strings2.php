<?php
header('Content-type: text/html; charset=UTF-8');

if(count($_POST) > 0) {
   echo "Données reçues en POST:";
   foreach($_POST as $v)
      echo strrev(utf8_decode($v)).":";
}
elseif(count($_GET) > 0) {
   echo "Données reçues en GET:";
   foreach($_GET as $v)
      echo strrev($v).":";
}

if(count($_POST) == 0 && count($_GET) == 0)
	echo 'Aucune donnée n\'a été reçue par "'.basename($_SERVER["PHP_SELF"]).'"...';
