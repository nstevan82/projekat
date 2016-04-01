<head>
	<link href='../css/izvestaj.css' rel='stylesheet'>
	<title>Izvestaj</title>

</style>
<?php
		include "../lib/class.baza.inc";
		include "../funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();


$godina=$_GET['godina'];
$skladiste=$_GET['skladiste'];

echo "<b>PREGLED STANJA ROBE U JAVNO CARINSKO SKLADISTE 'TOMI TRADE': DOO</b><br><br>";

	$rezultat= $mysqli->query("
SELECT id,opis, datum, broj, godina, br_pozicije, sredstvo, kolicina ,  komada, aktivan, tip, kolicinai, komadai, vrednostu, vrednosti, vlasnik,sum(sumakolicine) AS sum_kolicina, sum(sumakomada) AS sum_komada
FROM
(
	SELECT id,roba AS opis, datum, broj, godina, br_pozicije, sredstvo, sum( kolicina ) AS kolicina , sum( komada ) AS komada, aktivan, tip, sum(kolicinai) AS kolicinai, sum(komadai) AS komadai, vrednostu, vrednosti, vlasnik,sum( kolicina ) - sum( kolicinai ) AS sumakolicine,sum( komada ) - sum( komadai ) AS sumakomada
FROM (	
	SELECT mag_ulaz.id,mag_robe.naziv AS roba,datum,broj,mag_ulaz.godina AS godina,br_prijave AS br_pozicije,sredstvo,kolicina,komada,mag_ulaz.aktivan,'ulaz' AS tip,'0' as kolicinai,'0' as komadai,vrednostu,'0' AS vrednosti,mag_vlasnici.naziv AS vlasnik
	FROM mag_ulaz
	LEFT JOIN mag_vlasnici ON mag_ulaz.vlasnik=mag_vlasnici.id
	LEFT JOIN mag_robe ON mag_ulaz.roba=mag_robe.id
	 WHERE mag_ulaz.aktivan=1 AND godina='$godina' AND skladiste='$skladiste'
	 UNION ALL
	 SELECT 0,mag_robe.naziv AS roba,datumi,br_ulaza AS broj,mag_ulaz.godina,mag_ulaz.br_prijave AS br_pozicije,'',0,0,mag_ulaz.aktivan,'izlaz' AS tip,sum(mag_izlaz.kolicina) AS kolicinai,sum(mag_izlaz.komada) as komadai,'0',vrednosti,mag_vlasnici.naziv AS vlasnik
	 FROM mag_ulaz LEFT JOIN mag_izlaz ON mag_ulaz.id=mag_izlaz.id_ulaza
	 LEFT JOIN mag_vlasnici ON mag_ulaz.vlasnik=mag_vlasnici.id
	 LEFT JOIN mag_robe ON mag_ulaz.roba=mag_robe.id
	 WHERE mag_ulaz.aktivan=1  AND skladiste='$skladiste' AND godina='$godina' AND mag_izlaz.aktivan=1
	 GROUP BY broj,tip
	 order by broj)
	 as suma 
	 GROUP BY broj,tip 
	 )
	 AS sumasumarum
	 GROUP BY broj
	 ");?>
			<table  class="izvestaj" border=1 style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum<br>uskladistenja</th><th>Redni broj<br>upisa</th><th>Broj car.<br>dokumenta</th><th>Vlasnik</th><th>Opis</th><th>Stanje neocarinjene robe<br>Kg</th><th>Stanje neocarinjene robe<br>Kom</th></tr>
				<?php
				$i=1;

				while ($row = $rezultat->fetch_assoc()) 
				{
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				$id=$row['id'];				
				if ($row['broj']!='') {
				echo "<tr class='lista'><td>".$i."</td><td>".$datum."</td><td>".$row['broj']."/".$row['godina']."</td><td>".$row['br_pozicije']."</td><td>".$row['vlasnik']."</td><td>".$row['opis']."</td><td>".($row['sum_kolicina'])."</td><td>".($row['sum_komada'])."</td></tr>";
				$i++;
				}
			
				}
				echo "</table>";
?>
</div>