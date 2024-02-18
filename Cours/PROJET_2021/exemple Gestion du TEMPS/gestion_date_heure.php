
<?php 

echo " <h2> Calcul des informations à partir de la date </h2>";

//Positionner la zone de temps 
date_default_timezone_set('Europe/Paris');


//date courante, via time 
echo "<h2> Date courante </h2>";
$date_courante = Array('annee'=>date('Y'), 'mois'=>date('m'), 'jour'=>date('d')); 
print_r($date_courante); 
echo "<br/>";
$m = date('m');  //13, 10, 2018
$j = date('d');
$a = date('Y');
$estamp1 = mktime(00, 01, 11, $m, $j, $a); 
$date_complete = date('l jS \of F Y h:i:s A', $estamp1);
echo "<br/>- Date complete du jour courant: " . $date_complete ;
echo "<br/>- Valeur de l'estampille courante, évaluée en minutes : " . $estamp1; 

////Autre date via mktime
echo "<h2> Autre date </h2>";
$estamp2 = mktime(00, 02, 10, $m, $j, $a);
$date_complete = date('l jS \of F Y h:i:s A', $estamp2);
echo "Date complete : " . $date_complete ;
echo "<br/>- Valeur de cette autre estampille, évaluée en minutes : " . $estamp2; 

//quantième
$quantieme = date("z",$estamp2);
echo "<br/> - Quantième : " . $quantieme; 

//année
echo "<br/> - Année : " . date("Y", $estamp2);

//nom du mois
echo "<br/> - mois : " . date("F", $estamp2);

//nom du mois
echo "<br/> - index annuel du mois : " . date("n", $estamp2);

//jour 
$jour = date("l", $estamp2);
echo "<br/> - Jour : " . $jour;

//Index hebdomadaire du mois
echo "<br/> - Index hebdomadaire du jour : " . date("w", $estamp2);
echo "<br/> - Index hebdomadaire du jour : " . date("j", $estamp2);

//Index hebdomadaire du jour (anglais) 
$ijour = date("jS", $estamp2);
echo "<br/> - Index hebdomadaire du jour (anglais) : " . $ijour;

//temps HMS
echo "<br/>";
echo "<br/> - temps : " . date("h:i:s", $estamp2);

//temps H
echo "<br/> - heure de la journée : " . date("h", $estamp2);

//temps HM
echo "<br/> - heure et minutes passées : " . date("h:i", $estamp2);

//temps M
echo "<br/> - minutes passées  : " . date("i", $estamp2);

//temps S
echo "<br/> - secondes passées  : " . date("s", $estamp2);

//temps h:S
echo "<br/> - heures et secondes passées  : " . date("h:s", $estamp2);


////Différence entre la date courante et l'autre date 
echo "<h2>Différence entre la date du jour et l'autre date</h2>";
$diff = $estamp2-$estamp1;
echo "Différence évaluée en minutes : " . $diff ;

////Ajout d'une durée à une estampille
echo "<h2>Ajout d'une durée en minutes à une estampille</h2>";
$estamp3 = $estamp1+ $diff;
echo "- Estampille initiale, l'estampille courante : " . $estamp1 ;
echo "<br/>- Durée à ajouter, évaluée en minutes : " . $diff ;
echo "<br/>- Estampille résultante, celle de l'autre date : " . $estamp3; 
$date_complete = date('l jS \of F Y h:i:s A', $estamp3);
echo "<br/>- Date complete : " . $date_complete ;


////Récupération automatique en cas d'erreur de date
echo "<h2>Récupération automatique en cas d'erreur de date</h2>";

$estamp = mktime(12, 01, 60, 13, 10, 2018);
$date_complete = date('l jS \of F Y h:i:s A', $estamp);
echo "- Date complete du jour 10 dans le 13ème mois  : <br/>" . $date_complete;

$estamp = mktime(12, 01, 60, 9, 31, 2018);
$date_complete = date('l jS \of F Y h:i:s A', $estamp);
echo "<br/> - Date complete du jour 31 de septembre  : <br/>" . $date_complete;

////date en français
echo "<h2>Mettre une date en français </h2>";
$Mois=array('janvier', 'février', 'mars', 'avril', 
			'mai', 'juin', 'juillet', 'août', 
			'septembre', 'octobre', 'novembre', 'décembre'); 

$Jour=array('dimanche', 'lundi', 'mardi', 'mercredi', 
			'jeudi', 'vendredi', 'samedi'); 

$date=$Jour[date("w", $estamp2)].' '. date("j", $estamp2).' '. $Mois[date("n", $estamp2)-1]; 
echo "- Date : " . $date; //affiche la date du jour, comme 'samedi 6 octobre' 

?> 