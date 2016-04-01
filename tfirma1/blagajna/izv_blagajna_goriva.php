<form action="default.php" method="post">
<div class="box">

        Za koji datum<input type=text name=datum placeholder="dd.mm.gggg">
		<input type="hidden" name=str value="izv_blagajna_goriva">		
		<input type=submit name=trazi value="Prikazi">
		</form>
</div>
<?php

if (isset($_POST['datum'])){
$blagajna_goriva=$_POST['blagajna_goriva'];



$datum=string2datum($_POST['datum']);

$rezultat= $mysqli->query("SELECT id FROM rac_blagajna_gorivo WHERE datum='$datum'");
while ($row=$rezultat->fetch_assoc())
{
$id_blagajne=$row['id'];
}


	 $rezultat= $mysqli->query("SELECT rac_blagajna_gorivo.id,datum,rac_objekti.naziv AS opis,ulaz,rac_blagajna_gorivo.aktivan,'0' AS izlaz FROM rac_blagajna_gorivo 	 
	 LEFT JOIN rac_objekti ON rac_blagajna_gorivo.objekat=rac_objekti.id
	 WHERE rac_blagajna_gorivo.aktivan=1 AND datum='$datum'  AND rac_blagajna_gorivo.tip='ulaz'
	 UNION ALL
	 SELECT broj,'',rac_objekti.naziv AS opis,'0',rac_blagajna_gorivo.aktivan,ulaz AS izlaz
	 FROM rac_blagajna_gorivo 
	 LEFT JOIN rac_objekti ON rac_blagajna_gorivo.objekat=rac_objekti.id
	 WHERE rac_blagajna_gorivo.aktivan=1 AND rac_blagajna_gorivo.tip='izlaz' AND datum='$datum'  
	 ");?>
	 
<div class="box">
<?php while ($row = $rezultat->fetch_assoc()) {
$row_array[]=$row;
}

?>



Blagajna goriva na dan <?php echo 	$datum=date("d.m.Y", strtotime($datum));  ?>
</div>
		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
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
	SELECT SUM(ulaz) AS uk_ulaz,0 AS uk_izlaz FROM rac_blagajna_gorivo
	WHERE rac_blagajna_gorivo.aktivan=1 AND rac_blagajna_gorivo.datum<'$datum_upit' AND tip='ulaz'
	UNION
	SELECT 0 as uk_ulaz,SUM(ulaz) as uk_izlaz FROM rac_blagajna_gorivo 		
	WHERE rac_blagajna_gorivo.aktivan=1 AND rac_blagajna_gorivo.datum<'$datum_upit'	
	AND rac_blagajna_gorivo.tip='izlaz'
	");// prikazi sve datume pre odabranog
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
				echo "<tr class='lista'><td colspan=1></td><td style='text-align:left'  colspan=2>Saldo ".$_POST['datum'].":</td><td>".number_format($saldo, 2, ',', '.')."</td></tr>";	
?>
	</table>
	<?php
			echo "<a href='izv_blagajna_goriva1.php?datum=$datum' target='_blanc'><img src='../img/printer.png'></img></a>";
	}
	?>