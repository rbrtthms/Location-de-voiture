<?php 

$J = json_decode (
'{
"A":["promo", 1.5],
"M":["bi",3]
}'

, true

);

echo ("<pre>");
print_r($J);
echo ("</pre>");

$J['A'][1] += (int) 2;

echo ('nouvelle valeur de A.1 = ' . $J['A'][1] . "<br/>");



$I= json_encode ($J);
var_dump($J);


?>