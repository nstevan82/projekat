
<head>
	<link href='../css/izvestaj.css' rel='stylesheet'>
	<title>Izvestaj</title>

</style>
<?php
		include "../lib/class.baza.inc";
		include "../funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();
		
	 $datum=string2datum($_GET['datum']);
$blagajna=$_GET['blagajna'];



$datum=string2datum($_GET['datum']);

$rezultat= $mysqli->query("SELECT id FROM rac_blagajna WHERE broj='$blagajna' AND datum='$datum'");
while ($row=$rezultat->fetch_assoc())
{
$id_blagajne=$row['id'];
}


	 $rezultat= $mysqli->query("SELECT id,datum,opis,ulaz,aktivan,'0' AS izlaz FROM rac_blagajna 	 
	 WHERE rac_blagajna.aktivan=1 AND datum='$datum' AND broj='$blagajna'
	 UNION ALL
	 SELECT blagajna,'',opisi,'0',aktivan,izlaz AS izlaz
	 FROM rac_blagajna_izlaz WHERE aktivan=1 AND blagajna='$id_blagajne'	 
	 ");?>
	 
<div class="box">
<?php while ($row = $rezultat->fetch_assoc()) {
$row_array[]=$row;
}

?>



Blagajna na dan <?php echo 	$datum=date("d.m.Y", strtotime($datum));  ?>
</div>
		<div class="box">
			<table class="izvestaj" border=1 style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Opis</th><th>Ulaz</th><th>Izlaz</th></tr>
				<?php
				$i=1;
				$ulaz=0;
				$izlaz=0;
				foreach ($row_array AS $row)
				{
				$id=$row['id'];
				//$datum=date("d.m.Y", strtotime($_POST); 
				echo "<tr class='lista'><td>".$i."</td><td>".$row['opis']."</td><td>".number_format($row['ulaz'], 2, ',', '.')."</td><td>".number_format($row['izlaz'], 2, ',', '.')."</td></tr>";
				
			$i++;
			$ulaz=$ulaz+$row['ulaz'];
			$izlaz=$izlaz+$row['izlaz'];
				}
				
	$datum_upit=string2datum($datum);
	$rezultat1= $mysqli->query("
	SELECT SUM(ulaz) AS uk_ulaz,0 AS uk_izlaz FROM rac_blagajna
	WHERE rac_blagajna.aktivan=1 AND rac_blagajna.id<'$id_blagajne' AND rac_blagajna.datum<='$datum_upit'
	UNION
	SELECT 0 as uk_ulaz,SUM(izlaz) as uk_izlaz FROM rac_blagajna 	
	LEFT JOIN rac_blagajna_izlaz
	ON rac_blagajna_izlaz.blagajna=rac_blagajna.id
	WHERE rac_blagajna.aktivan=1 AND rac_blagajna_izlaz.aktivan=1 AND rac_blagajna.id<'$id_blagajne' AND rac_blagajna.datum<='$datum_upit'");// prikazi sve datume pre odabranog
	//datum<'$datum_upit
	$prethodni_saldo=0;
	while ($row = $rezultat1->fetch_assoc()) {
	$prethodni_saldo=$prethodni_saldo+($row['uk_ulaz']-$row['uk_izlaz']);
	$prethodni_ulaz=$row['uk_ulaz'];
	$prethodni_izlaz=$row['uk_izlaz'];
	}
	$prethodni_ulaz=$row['uk_ulaz'];
	$prethodni_izlaz=$row['uk_izlaz'];
	$ukupni_ulaz=$ulaz+$prethodni_ulaz;
	$ukupni_izlaz=$izlaz+$prethodni_izlaz;
				echo "<tr class='lista'><td style='text-align:left' colspan=2>Ukupno:</td><td>".number_format($ulaz, 2, ',', '.')."</td><td>".number_format($izlaz, 2, ',', '.')."</td></tr>";
				echo "<tr class='lista'><td colspan=1></td><td style='text-align:left'  colspan=2>Prethodni saldo:</td><td>".number_format($prethodni_saldo, 2, ',', '.')."</td></tr>";
				echo "<tr class='lista'><td colspan=1></td><td style='text-align:left'  colspan=2>Ukupni ulaz:</td><td>".number_format($ukupni_ulaz, 2, ',', '.')."</td></tr>";
				echo "<tr class='lista'><td colspan=1></td><td style='text-align:left'  colspan=2>Ukupni izlaz:</td><td>".number_format($ukupni_izlaz, 2, ',', '.')."</td></tr>";
				$saldo=$prethodni_saldo+$ulaz-$izlaz;
				echo "<tr class='lista'><td colspan=1></td><td style='text-align:left'  colspan=2>Saldo ".$_GET['datum'].":</td><td>".number_format($saldo, 2, ',', '.')."</td></tr>";	
?>
	</table>		
