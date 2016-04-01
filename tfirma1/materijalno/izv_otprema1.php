

<head>
	<link href='../css/izvestaj.css' rel='stylesheet'>
	<title>Izvestaj</title>

</style>
<?php
		include "../lib/class.baza.inc";
		include "../funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();
	   
$kupac=$_GET['kupac'];
$godina=$_GET['godina'];
if (isset($_GET['svi'])) $svi=1;
else 
$svi=0;

if ($svi==1){
$rezultat= $mysqli->query("
SELECT kupac,vrstarobe,rac_otprema.id AS id1, rac_vrsta_robe.naziv AS n_robe, rac_kupci.naziv AS n_kupca, tezina AS tezina,'1' AS redosled
FROM rac_otprema
LEFT JOIN rac_vrsta_robe ON rac_otprema.vrstarobe=rac_vrsta_robe.id
LEFT JOIN rac_kupci ON rac_otprema.kupac=rac_kupci.id
WHERE rac_otprema.aktivan=1 AND godina='$godina'

UNION ALL

SELECT kupac,vrstarobe,rac_otprema.id AS id1, rac_vrsta_robe.naziv AS n_robe, rac_kupci.naziv AS n_kupca, sum(tezina) AS tezina,'2' AS redosled
FROM rac_otprema
LEFT JOIN rac_vrsta_robe ON rac_otprema.vrstarobe=rac_vrsta_robe.id
LEFT JOIN rac_kupci ON rac_otprema.kupac=rac_kupci.id
WHERE rac_otprema.aktivan=1 AND godina='$godina'
GROUP BY kupac, vrstarobe
ORDER BY kupac,vrstarobe,redosled
");}

else
$rezultat= $mysqli->query("
SELECT kupac,vrstarobe,rac_otprema.id AS id1, rac_vrsta_robe.naziv AS n_robe, rac_kupci.naziv AS n_kupca, tezina AS tezina,'1' AS redosled
FROM rac_otprema
LEFT JOIN rac_vrsta_robe ON rac_otprema.vrstarobe=rac_vrsta_robe.id
LEFT JOIN rac_kupci ON rac_otprema.kupac=rac_kupci.id
WHERE rac_otprema.aktivan=1 AND godina='$godina' AND rac_otprema.kupac='$kupac'

UNION ALL

SELECT kupac,vrstarobe,rac_otprema.id AS id1, rac_vrsta_robe.naziv AS n_robe, rac_kupci.naziv AS n_kupca, sum(tezina) AS tezina,'2' AS redosled
FROM rac_otprema
LEFT JOIN rac_vrsta_robe ON rac_otprema.vrstarobe=rac_vrsta_robe.id
LEFT JOIN rac_kupci ON rac_otprema.kupac=rac_kupci.id
WHERE rac_otprema.aktivan=1 AND godina='$godina' AND rac_otprema.kupac='$kupac'
GROUP BY kupac, vrstarobe
ORDER BY kupac,vrstarobe,redosled
");







?>
<div class='box'>
<?php echo "<b><u>IZVESTAJ OTPREME NA DAN: ".date('d.m.Y')." ZA $godina. GODINU.</u></b><br><br>"; ?>
			<table class="izvestaj" border=1 style="diplay:block;width:100%">
				<tr class='lista' style='background:#7c88b0;color:white;text-align:center;font-weight:bold'><td>Rb</td><td>Kupac</td><td>Vrsta robe</td><td>Tezina</td></tr>
				<?php
				$i=1;

				while ($row = $rezultat->fetch_assoc()) 
				{			
				$id=$row['id1'];				
				if ($row['redosled']=='2') 
					echo "<tr class='lista' style='background:#7c88b0;color:white'><td></td><td><b>".$row['n_kupca']."</b></td><td><b>SALDO:</b></td><td><b>".number_format($row['tezina'], 2, ',', '.')."</b></td></tr>";	
				else {
					echo "<tr class='lista'><td>".$i."</td><td>".$row['n_kupca']."</td><td>".$row['n_robe']."</td><td>".number_format($row['tezina'], 2, ',', '.')."</td></tr>";				
					$i++;
					$suma=$suma+$row['tezina'];
				}
				}
				echo "<tr class='lista'><td colspan=3>UKUPNO:</td><td>".number_format($suma, 2, ',', '.')."</td></tr>";	
				echo "</table>";
?>
</div>