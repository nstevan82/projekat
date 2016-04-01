<head>
	<link href='../css/izvestaj.css' rel='stylesheet'>
	<title>Izvestaj</title>
</head>
<div class="box">
<?php
include "../lib/class.baza.inc";
include "../funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();
?>
</div>
		<?php		
/*
SELECT *,ulazi.dat AS dat_ulaza 
FROM 
( SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_fakture.lice,dat_fak as dat,1 AS red_izlaz
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac' AND (dat_fak BETWEEN '$datum_od' and '$datum_do')) AS ulazi 
right join 
( 
SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_fakture.lice,dat_fak as dat,1 AS red_izlaz 
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac' AND (dat_fak BETWEEN '$datum_od' and '$datum_do')
UNION ALL 
SELECT brfa,dat_izv,'00.00.0000','0.00',uplate,'',1 AS red,kupac,'',2 AS red_izlaz  
FROM rac_izvodi WHERE rac_izvodi.aktivan=1 AND kupac='$kupac' AND (dat_izv BETWEEN '$datum_od' and '$datum_do')
UNION ALL 
SELECT *,2,'' AS red,'',2 as red_izlaz
FROM ( SELECT faktura_br,dat_fak,rac_fakture.dat_val,sum(iznos_fa),'0.00' AS uplate,'sum_duguje' AS n_usluge 
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac' AND (dat_fak BETWEEN '$datum_od' and '$datum_do')
GROUP BY faktura_br 
UNION ALL 
SELECT brfa AS faktura_br,dat_izv,'00.00.0000','0.00',sum(uplate),'sum_platio' AS red 
FROM rac_izvodi WHERE rac_izvodi.aktivan=1 AND kupac='$kupac' AND (dat_izv BETWEEN '$datum_od' and '$datum_do')
GROUP BY brfa ) grupisanje 
ORDER BY faktura_br,red ,dat_fak ) AS izlazi 
ON ulazi.faktura_br=izlazi.faktura_br 
ORDER BY dat_ulaza,izlazi.faktura_br,izlazi.red ,izlazi.red_izlaz,izlazi.dat_fak
*/
$kupac=$_GET['kupac'];
$akt_godina=$_GET['godina'];
$datum_do=$_GET['datum_do'];
$datum_od=$_GET['datum_od'];

	 $rezultat= $mysqli->query("	 
SELECT *,ulazi.dat AS dat_ulaza 
FROM 
( SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_fakture.lice,dat_fak as dat,1 AS red_izlaz
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac'  AND (dat_fak BETWEEN '2014-01-01' and '$datum_do')) AS ulazi 
right join 
( 
SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_fakture.lice,dat_fak as dat,1 AS red_izlaz 
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac' AND (dat_fak BETWEEN '2014-01-01' and '$datum_do')
UNION ALL 
SELECT brfa,dat_izv,'00.00.0000','0.00',uplate,'',1 AS red,kupac,'',2 AS red_izlaz  
FROM rac_izvodi WHERE rac_izvodi.aktivan=1 AND kupac='$kupac'   AND (dat_izv BETWEEN '2014-01-01' and '$datum_do')
UNION ALL 
SELECT *,2,'' AS red,'',2 as red_izlaz
FROM ( SELECT faktura_br,dat_fak,rac_fakture.dat_val,sum(iznos_fa),'0.00' AS uplate,'sum_duguje' AS n_usluge 
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac'  AND (dat_fak BETWEEN '2014-01-01' and '$datum_do')
GROUP BY faktura_br 
UNION ALL 
SELECT brfa AS faktura_br,dat_izv,'00.00.0000','0.00',sum(uplate),'sum_platio' AS red 
FROM rac_izvodi 
WHERE rac_izvodi.aktivan=1 AND kupac='$kupac'  AND (dat_izv BETWEEN '2014-01-01' and '$datum_do')
GROUP BY brfa ) grupisanje 
ORDER BY faktura_br,red ,dat_fak ) AS izlazi 
ON ulazi.faktura_br=izlazi.faktura_br 
ORDER BY dat_ulaza,izlazi.faktura_br,izlazi.red ,izlazi.red_izlaz,izlazi.dat_fak

	 ");?>
<h4 style='text-align:center'>IZLAZNE FAKTURE</h4>
		<div class="box">
		<?php  
		$naziv_kupca=$_GET['naziv_kupca'];
		 echo "<b>".$naziv_kupca." na dan:".date("d.m.Y")."</b><br>";
		
		
		
		?>
			<table class="izvestaj" border=1 style="diplay:block;width:100%;text-align:center">
				<tr><th>Rb</th><th>Datum fakture</th><th>Br. fakture</th><th>Datum valute</th><th>Usluga</th><th>Duguje</th><th>Platio</th></tr>
				<?php
				$i=1;
				$duguje=0;
				$platio=0;
				$medjuzbir_duguje=0;//okidac da li je prosao sumu dugovanja ** ovo sluzi za medjuzbir SALDO
				$medjuzbir_platio=0;//okidac da li je prosao sumu placanja ** ovo sluzi za medjuzbir SALDO
				$v_medjuvrednost_placanja=0;//ovo prikazuje koliko je zbirno placeno u odredjenoj grupi
				$v_medjuvrednost_duga=0;//ovo prikazuje koliko je zbirno dugovanje u odredjenoj grupi
				while ($row = $rezultat->fetch_assoc()) 
				{				
				$dat_fak=date("d.m.Y", strtotime($row['dat_fak'])); 				
				$dat_val=date("d.m.Y", strtotime($row['dat_val'])); 
				//if ($dat_val=='00.00.0000') $dat_val='';
				if ($dat_fak=='01.01.1970' && $row['dat_fak']<=$datum_do && $row['dat_fak']>=$datum_od) $dat_fak='';
				if ($dat_val=='01.01.1970' or $dat_val=='30.11.-0001') $dat_val='//';			
				if ($row['dat_val']=="SUMA") echo "<tr class='lista'><td></td><td></td><td>".$row['faktura_br']."</td><td></td><td>SUMA:</td><td>".number_format($row['sumau'], 2, ',', '.')."</td><td>11</td></tr>";
				elseif ($row['n_usluge']=="sum_duguje" && $row['dat_fak']<=$datum_do) {
				
				/* izmena */	if ($row['dat_fak']>=$datum_od)
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Duguje:</b></td><td><b>".number_format($row['iznos_fa'], 2, ',', '.')."</b></td></tr>";
				$medjuzbir_duguje=1;
				$v_medjuvrednost_duga=$row['iznos_fa'];
				}
			/*izmena */	elseif ($row['n_usluge']=="sum_platio" && $row['dat_fak']<=$datum_do)  
				{
				if ($row['dat_fak']>=$datum_od)
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Platio:</b></td><td><b>".number_format($row['uplate'], 2, ',', '.')."</b></td></tr>";
				$medjuzbir_duguje=0;
				$medjuzbir_platio=1;
				$v_medjuvrednost_placanja=$row['uplate'];
				}
				ELSE{
				if ($medjuzbir_duguje==1 || $medjuzbir_platio==1) {
				if ($row['dat_fak']>=$datum_od) echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($v_medjuvrednost_duga-$v_medjuvrednost_placanja), 2, ',', '.')."</b></td></tr>";				
				$medjuzbir_duguje=0;
				$medjuzbir_platio=0;
				$v_medjuvrednost_placanja=0;
				$v_medjuvrednost_duga=0;
				}
			/*izmena Pocetno stanje - ako se promenila godina ili ako red nije pocetno stanje*/ 
			if (ISSET($godina_row)){
			if ($godina_row<>date("Y",strtotime($row['dat_fak'])) && $row['n_usluge']<>"pocetno stanje") 
			{
			echo "<tr class='lista' style='background:#A5AFFD'><td></td><td>01.01.".($godina_row+1)."</td><td></td><td></td><td><b>POCETNO STANJE:</b></td><td><b>".number_format(($duguje-$platio), 2, ',', '.')."</b></td><td></td></tr>";
			$i=1;
			}
			}
	/* izmena */		if ($row['dat_fak']<=$datum_do && $row['dat_fak']>=$datum_od && $row['faktura_br']<>"") 	
			echo "<tr class='lista' style='border-top:1px solid black'><td>".$i."</td><td>".$dat_fak."</td><td>".$row['faktura_br']."</td><td>".$dat_val."</td><td>".$row['n_usluge']."</td><td>".number_format($row['iznos_fa'], 2, ',', '.')."</td><td>".number_format($row['uplate'], 2, ',', '.')."</td></tr>";
			$godina_row=date("Y",strtotime($row['dat_fak'])); /* ubaci da pamti prethodnu godinu, da bi pokazao pocetno stanje na narednoj godini*/
			$duguje=$duguje+$row['iznos_fa'];
			$platio=$platio+$row['uplate'];
			$i++;
			}
			
				}
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($v_medjuvrednost_duga-$v_medjuvrednost_placanja), 2, ',', '.')."</b></td></tr>";				
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SUMA:</b></td><td><b>".number_format($duguje, 2, ',', '.')."</b></td></td><td><b>".number_format($platio, 2, ',', '.')."</b></td><td></td></tr>";
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($duguje-$platio), 2, ',', '.')."</b></td></td><td></td><td></td></tr>";
				?>
			</table>			
	
