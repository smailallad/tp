<?php

function cellExcel($c){
    if (is_numeric($c)){
        if ($c > 26){
            if ($c % 26 == 0){
                return chr(intdiv($c,26)+63). chr(($c % 26)+90);
            }else{
                return chr(intdiv($c,26)+64). chr(($c % 26)+64);
            }
        }else{
            return chr($c+64);
        }
    }else{
        return false;
    }
}
echo ("<br>");
for ($i=1; $i <500 ; $i++) { 
    echo ($i." = " .cellExcel($i)); 
    echo ("<br>");
}
