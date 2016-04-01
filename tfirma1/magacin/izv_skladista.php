<div class=box>
		<form action='default.php' method='post'>
		Magacin:
		<?php
		$rezultat=$mysqli->query("SELECT * FROM mag_skladista WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'skladiste_unos',$skladista,'id');
		?>
		&nbsp Broj:<input type=text name='broj'>
		&nbsp Godina:<input type=text name='godina' placeholder='gggg'>
		<input type=hidden name=str value='izv_skladista'>
		<input type=submit name=prikazi value='Prikazi'>
		</form>
</div>

<?php
if (isset($_POST['prikazi'])){
$godina=$_POST['godina'];
$skladiste=$_POST['skladiste_unos'];
$broj=$_POST['broj'];

$rezultat= $mysqli->query("
		SELECT *,mag_vlasnici.naziv AS n_vlasnika,mag_robe.naziv AS n_robe, mag_skladista.naziv AS n_skladista
		FROM mag_ulaz 		
		LEFT JOIN mag_skladista ON mag_ulaz.skladiste=mag_skladista.id
		LEFT JOIN mag_robe ON mag_ulaz.roba=mag_robe.id
		LEFT JOIN mag_vlasnici ON mag_ulaz.vlasnik=mag_vlasnici.id
		WHERE godina='$godina' 
		AND skladiste='$skladiste' 
		AND broj='$broj' 
		AND mag_ulaz.aktivan=1");
		echo "<div class='box' style='max-width:100%'>";
	echo "<b><u>MAGACINSKA KARTICA NA DAN: ".date('d.m.Y')."</u></b><br>";
				while ($row = $rezultat->fetch_assoc()) {
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				echo "Skladiste / Warehouse:".$row['n_skladista']."<br>";
				echo "Pozicija / Position:".$row['broj']."/".$row['godina']."<br>";
				echo "Broj prijave / Registration No.:".$row['br_prijave']."<br>";
				echo "Datum prijave / Date of Registr.:".$datum."<br>";
				echo "Roba / Goods:".$row['n_robe']."<br>";
				echo "Vlasnik / Owner:".$row['n_vlasnika']."<br><br>";				
				}

	$rezultat= $mysqli->query("SELECT id,datum,broj,godina,br_prijave AS br_pozicije,sredstvo,kolicina,komada,aktivan,'ulaz' AS tip,'0' as kolicinai,'0' as komadai,vrednostu,'0' AS vrednosti FROM mag_ulaz
	 WHERE mag_ulaz.aktivan=1 AND godina='$godina' AND broj='$broj' AND skladiste='$skladiste'
	 UNION ALL
	 SELECT 0,datumi,'','',br_odjave AS br_pozicije,'',0,0,mag_ulaz.aktivan,'izlaz' AS tip,mag_izlaz.kolicina AS kolicinai,mag_izlaz.komada as komadai,'0',vrednosti
	 FROM mag_ulaz LEFT JOIN mag_izlaz ON mag_ulaz.id=mag_izlaz.id_ulaza
	 WHERE mag_ulaz.aktivan=1 AND br_ulaza='$broj' AND skladiste='$skladiste' AND godina='$godina' AND mag_izlaz.aktivan=1
	 ");?>
	 



	
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum<br>uskladistenja</th><th>Pozicija<br>upisa</th><th>Car Act.<br>Customs doc.</th><th>Prevozno<br>sredstvo</th><th>Ulaz robe<br>kg</th><th>Ulaz robe<br>(kom/pcs)</th><th>Ocarinjeno<br>Izlaz kg</th><th>Ocarinjeno<br>Izlaz kom</th><th>Stanje<br>Kolicina</th><th>Stanje<br>Komada</th><th>Vrednost</th></tr>
				<?php
				$i=1;
				$kolicina=0;
				$komada=0;
				$ukupni_izlaz_kolicina=0;
				$ukupni_izlaz_komada=0;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				$id=$row['id'];
				//$datum=date("d.m.Y", strtotime($_POST); 
				$kolicina=$kolicina+$row['kolicina']-$row['kolicinai'];
				$komada=$komada+$row['komada']-$row['komadai'];				
				$vrednost=$vrednost+$row['vrednostu']-$row['vrednosti'];

				if ($row['broj']!='') {
				echo "<tr class='lista'><td>".$i."</td><td>".$datum."</td><td>".$row['broj']."/".$row['godina']."</td><td>".$row['br_pozicije']."</td><td>".$row['sredstvo']."</td><td>".$row['kolicina']."</td><td>".$row['komada']."</td><td>0</td><td>0</td><td>$kolicina</td><td>$komada</td><td>".number_format($row['vrednostu'], 2, ',', '.')."</td></tr>";
				$ukupni_ulaz_kolicina=$row['kolicina'];
				$ukupni_ulaz_komada=$row['komada'];
				}
				else echo "<tr class='lista'><td>".$i."</td><td>".$datum."</td><td>".$row['broj']."/".$row['godina']."</td><td>".$row['br_pozicije']."</td><td>".$row['sredstvo']."</td><td>0</td><td>0</td><td>".$row['kolicinai']."</td><td>".$row['komadai']."</td><td>$kolicina</td><td>$komada</td><td>".number_format($row['vrednosti'], 2, ',', '.')."</td></tr>";

				
				
			$i++;
			
			$ukupni_izlaz_kolicina=$ukupni_izlaz_kolicina+$row['kolicinai'];
			$ukupni_izlaz_komada=$ukupni_izlaz_komada+$row['komadai'];
		/*	$ulaz=$ulaz+$row['ulaz'];
			$izlaz=$izlaz+$row['izlaz'];*/
				}
				echo "<tr class='lista'><td colspan=5>UKUPNO/TOTAL:</td><td>".$ukupni_ulaz_kolicina."</td><td>".$ukupni_ulaz_komada."<td>$ukupni_izlaz_kolicina</td><td>$ukupni_izlaz_komada</td><td>".($ukupni_ulaz_kolicina-$ukupni_izlaz_kolicina)."</td><td>".($ukupni_ulaz_komada-$ukupni_izlaz_komada)."</td><td>".number_format($vrednost, 2, ',', '.')."</td></tr>";
				echo "</table>";

				
				
				
				
				
				
				
				
				
echo "<a href='izv_skladista1.php?godina=$godina&skladiste=$skladiste&broj=$broj' target='_blanc'><img src='../img/printer.png'></img></a>";

echo "</div>";
}



?>