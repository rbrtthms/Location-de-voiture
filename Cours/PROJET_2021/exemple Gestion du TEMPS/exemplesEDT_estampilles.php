
<?php 

echo " <h2> Calcul des informations à partir de la date </h2>";

//Positionner la zone de temps 
date_default_timezone_set('Europe/Paris');

période S1-A  : 15-09-2018/27-10-2018
férié [vacances]   : 28-10-2018/2-11-2018
réservé [dst]   : 5-11-2018/9-11-2018
férié [armistice] : 11-11-2018
réservé [akhaton] : 11-11-2018

//Autre date via mktime
$e1d = mktime(08, 00, 00, 09, 15, 2018);
echo "<br/>- estampille [15 sept 2018]: " . $e1d;

$e1f = mktime(18, 00, 00, 27, 10, 2018);
echo "<br/>- estampille [15 sept 2018]: " . $e1f;

$e1d = mktime(08, 00, 00, 28, 10, 2018);
echo "<br/>- estampille [15 sept 2018]: " . $e1d;

$e1f = mktime(18, 00, 00, 2, 11, 2018);
echo "<br/>- estampille [15 sept 2018]: " . $e1f;

?> 