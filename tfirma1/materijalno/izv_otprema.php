<div class='box'>
<form method=post action='default.php'>
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_kupci WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'kupac','',id);
		?>
		&nbsp Svi kupci<input type=checkbox name=svi>
		&nbsp Godina<input type='text' name=godina value='<?php echo $akt_godina?>'>
		<input type='hidden' name=str value='izv_otprema'>
		<input type=submit name=prikazi value='Prikazi'>
		</form>
</div>

<?php 


if (isset($_POST['prikazi'])){
$kupac=$_POST['kupac'];
$godina=$_POST['godina'];
if (isset($_POST['svi'])) $svi=1;
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
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Kupac</th><th>Vrsta robe</th><th>Tezina</th></tr>
				<?php
				$i=1;
				$suma=0;
				while ($row = $rezultat->fetch_assoc()) 
				{			
				$id=$row['id1'];				
				if ($row['redosled']=='2') 
					echo "<tr class='lista' style='background:#7c88b0;color:white'><td></td><td><b>".$row['n_kupca']."</b></td><td><b>SALDO:</b></td><td><b>".number_format($row['tezina'], 2, ',', '.')."</b></td></tr>";	
				else {
					echo "<tr class='lista'><td>".$i."</td><td>".$row['n_kupca']."</td><td>".$row['n_robe']."</td><td>".number_format($row['tezina'], 2, ',', '.')."</td></tr>";				
					$suma=$suma+$row['tezina'];
					$i++;
				}
				}
echo "<tr class='lista'><td colspan=3>UKUPNO:</td><td>".number_format($suma, 2, ',', '.')."</td></tr>";				
				echo "</table>";
			
if ($svi==0) echo "<a href='izv_otprema1.php?godina=$godina&kupac=$kupac' target='_blanc'><img src='../img/printer.png'></img></a>";
else
echo "<a href='izv_otprema1.php?godina=$godina&kupac=$kupac&svi=1' target='_blanc'><img src='../img/printer.png'></img></a>";
echo "</div>";

}


?>