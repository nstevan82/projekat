<form action="default.php" method="post">
<div class="box">

        Za koji datum<input type=text name=datum placeholder="dd.mm.gggg">
		<input type="hidden" name=str value="izv_blagajna">
		<input type=submit name=trazi value="Prikazi">
		</form>
</div>
<?php

if (isset($_POST['datum'])){


$datum=string2datum($_POST['datum']);
	 $rezultat= $mysqli->query("SELECT * FROM rac_blagajna WHERE aktivan=1 AND datum='$datum'");?>
	 
<div class="box">
Blagajna na dan <?php echo 				$datum=date("d.m.Y", strtotime($datum));  ?>;
</div>
		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum</th><th>Opis</th><th>Ulaz</th><th>Izlaz</th></tr>
				<?php
				$i=1;
				$ulaz=0;
				$izlaz=0;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id'];
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				echo "<tr class='lista'><td>".$i."</td><td>".$datum."</td><td>".$row['opis']."</td><td>".number_format($row['ulaz'], 2, ',', '.')."</td><td>".number_format($row['izlaz'], 2, ',', '.')."</td></tr>";
			$i++;
			$ulaz=$ulaz+$row['ulaz'];
			$izlaz=$izlaz+$row['izlaz'];
				}
	$datum_upit=string2datum($datum);
	$rezultat1= $mysqli->query("SELECT SUM(ulaz),SUM(izlaz) FROM rac_blagajna WHERE aktivan=1 AND datum<'$datum_upit'");// prikazi sve datume pre odabranog
	while ($row = $rezultat1->fetch_assoc()) {
	$prethodni_saldo=$row['SUM(ulaz)']-$row['SUM(izlaz)'];
	$prethodni_ulaz=$row['SUM(ulaz)'];
	$prethodni_izlaz=$row['SUM(izlaz)'];
	}
		$prethodni_ulaz=$row['SUM(ulaz)'];
	$prethodni_izlaz=$row['SUM(izlaz)'];
	$ukupni_ulaz=$ulaz+$prethodni_ulaz;
	$ukupni_izlaz=$izlaz+$prethodni_izlaz;
				echo "<tr class='lista'><td style='text-align:left' colspan=3>Ukupno:</td><td>".number_format($ulaz, 2, ',', '.')."</td><td>".number_format($izlaz, 2, ',', '.')."</td></tr>";
				echo "<tr class='lista'><td colspan=2></td><td style='text-align:left'  colspan=2>Prethodni saldo:</td><td>".number_format($prethodni_saldo, 2, ',', '.')."</td></tr>";
				echo "<tr class='lista'><td colspan=2></td><td style='text-align:left'  colspan=2>Ukupni ulaz:</td><td>".number_format($ukupni_ulaz, 2, ',', '.')."</td></tr>";
				echo "<tr class='lista'><td colspan=2></td><td style='text-align:left'  colspan=2>Ukupni izlaz:</td><td>".number_format($ukupni_izlaz, 2, ',', '.')."</td></tr>";
				$saldo=$prethodni_saldo+$ulaz-$izlaz;
				echo "<tr class='lista'><td colspan=2></td><td style='text-align:left'  colspan=2>Saldo ".$_POST['datum'].":</td><td>".number_format($saldo, 2, ',', '.')."</td></tr>";

	

?>

	</table>
			
	<?php
	}
	?>