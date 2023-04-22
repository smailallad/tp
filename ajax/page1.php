<?php
header('Access-Control-Allow-Origin:*');

echo ('<h3>GET</h3>');
print_r($_GET);
echo ('<h3>POST</h3>');
print_r($_POST["nom"]);
echo ('<h3>FILES</h3>');
print_r($_FILES);