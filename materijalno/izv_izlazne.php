<form action="default.php" method="post">
<div class="box">
<?php
		$rezultat=$mysqli->query("SELECT * FROM rac_kupci WHERE aktivan=1");
		$mysqli->dropdown($rezultat,'kupci','kupci','id');?>

		<input type="text"  size=11 name="datum_od" placeholder="datum od">&nbsp-&nbsp
		<input type="text"  size=11 name="datum_do" placeholder="datum do">
		<input type="hidden" name=str value="izv_izlazne">
		<input type=submit name=trazi value="Prikazi">
		</form>
</div>
		<?php		
/*
	 SELECT *,rac_usluge.naziv AS n_usluge 
	 FROM rac_fakture 
	 LEFT JOIN rac_usluge  ON rac_fakture.usluga=rac_usluge.id 
	 LEFT JOIN rac_izvodi ON rac_fakture.faktura_br=rac_izvodi.brfa   
	 WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND lice=$kupac

	 
	 FROM rac_izvodi 
	 RIGHT JOIN rac_fakture ON rac_izvodi.brfa=rac_fakture.faktura_br 
	 WHERE faktura_br<>0 AND rac_izvodi.aktivan=1 AND rac_fakture.tip='izlaz' AND rac_fakture.lice=$kupac
	 
*/
if (isset($_POST['trazi'])){
$kupac=$_POST['kupci'];

$datum_od=date("Y-m-d", strtotime($_POST['datum_od']));
$datum_do=date("Y-m-d", strtotime($_POST['datum_do']));

	 $rezultat= $mysqli->query("SELECT * FROM rac_kupci WHERE id='$kupac'");
	 WHILE ($row=$rezultat->fetch_assoc()){
	 $naziv_kupca=$row['naziv'];	 
	 }

	 
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
FROM rac_izvodi 
WHERE rac_izvodi.aktivan=1 AND kupac='$kupac' AND (dat_izv BETWEEN '$datum_od' and '$datum_do')
GROUP BY brfa ) grupisanje 
ORDER BY faktura_br,red ,dat_fak ) AS izlazi 
ON ulazi.faktura_br=izlazi.faktura_br 
ORDER BY dat_ulaza,izlazi.faktura_br,izlazi.red ,izlazi.red_izlaz,izlazi.dat_fak
	 
	 
	 
	 
	 */
	 $god=date("Y",strtotime($_POST['datum_od']))-1;
	  $poc_stanje= $mysqli->query("SELECT * FROM rac_pocetno_stanje WHERE godina='$god' AND korisnik='$kupac' AND tip='izlazne'");
	   WHILE ($row=$poc_stanje->fetch_assoc()){
	 $pocetnoStanje=$row['iznos'];}

	 
	 
	 
	 $rezultat= $mysqli->query("
	 
	 
SELECT *,ulazi.dat AS dat_ulaza 
FROM 
( SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_fakture.lice,dat_fak as dat,1 AS red_izlaz
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac') AS ulazi 
right join 
( 
SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_fakture.lice,dat_fak as dat,1 AS red_izlaz 
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac' 
UNION ALL 
SELECT brfa,dat_izv,'00.00.0000','0.00',uplate,'',1 AS red,kupac,'',2 AS red_izlaz  
FROM rac_izvodi WHERE rac_izvodi.aktivan=1 AND kupac='$kupac' 
UNION ALL 
SELECT *,2,'' AS red,'',2 as red_izlaz
FROM ( SELECT faktura_br,dat_fak,rac_fakture.dat_val,sum(iznos_fa),'0.00' AS uplate,'sum_duguje' AS n_usluge 
FROM rac_fakture LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 
WHERE rac_fakture.aktivan=1 AND tip='izlaz' AND rac_fakture.lice='$kupac'
GROUP BY faktura_br 
UNION ALL 
SELECT brfa AS faktura_br,dat_izv,'00.00.0000','0.00',sum(uplate),'sum_platio' AS red 
FROM rac_izvodi 
WHERE rac_izvodi.aktivan=1 AND kupac='$kupac'
GROUP BY brfa ) grupisanje 
ORDER BY faktura_br,red ,dat_fak ) AS izlazi 
ON ulazi.faktura_br=izlazi.faktura_br 
ORDER BY dat_ulaza,izlazi.faktura_br,izlazi.red ,izlazi.red_izlaz,izlazi.dat_fak




	 ");
			;
	 ?>
		<div class="box">
		<?php 
			 echo "POCETNO STANJE:".$pocetnoStanje;
		echo $naziv_kupca." na dan:".date("d.m.Y")."<br>"; 	?>
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum fakture</th><th>Br. fakture</th><th>Datum valute</th><th>Usluga</th><th>Duguje</th><th>Platio</th><th></th></tr>
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
				if ($dat_fak=='01.01.1970' && $row['dat_fak']<=$datum_do) $dat_fak='';/*izmena */
				if ($dat_val=='01.01.1970' or $dat_val=='30.11.-0001') $dat_val='//';			
				if ($row['dat_val']=="SUMA") echo "<tr class='lista'><td></td><td>".$row['dat_fak']."</td><td>".$row['faktura_br']."</td><td></td><td>SUMA:</td><td>".number_format($row['sumau'], 2, ',', '.')."</td><td>11</td></tr>";
				elseif ($row['n_usluge']=="sum_duguje" && $row['dat_fak']<=$datum_do) {
			/* izmena */	if ($row['dat_fak']>=$datum_od) 
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Duguje:</b></td><td><b>".number_format($row['iznos_fa'], 2, ',', '.')."</b></td></tr>";
				$medjuzbir_duguje=1;
				$v_medjuvrednost_duga=$row['iznos_fa'];
				}
				elseif ($row['n_usluge']=="sum_platio" && $row['dat_fak']<=$datum_do) /* izmena */{
				
			/* izmena */	if ($row['dat_fak']>=$datum_od) 
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
		if ($godina_row<>date("Y",strtotime($row['dat_fak'])) && $row['n_usluge']<>"pocetno stanje") {
			echo "<tr class='lista' style='background:#A5AFFD'><td></td><td>01.01.".($godina_row+1)."</td><td></td><td></td><td><b>POCETNO STANJE:</b></td><td><b>".number_format(($pocetnoStanje), 2, ',', '.')."</b></td><td></td></tr>";
			$i=1;
			}
		}
	/* izmena */ if ($row['dat_fak']<=$datum_do && $row['dat_fak']>=$datum_od && $row['faktura_br']<>"0") 	
	echo "<tr class='lista' style='border-top:1px solid black'><td>".$i."</td><td>".$dat_fak."</td><td>".$row['faktura_br']."</td><td>".$dat_val."</td><td>".$row['n_usluge']."</td><td>".number_format($row['iznos_fa'], 2, ',', '.')."</td><td>".number_format($row['uplate'], 2, ',', '.')."</td></tr>";
	$godina_row=date("Y",strtotime($row['dat_fak'])); /* ubaci da pamti prethodnu godinu, da bi pokazao pocetno stanje na narednoj godini*/
	
			$duguje=$duguje+$row['iznos_fa'];
			$platio=$platio+$row['uplate'];
			$i++;
			
			}
			
				}
	/*izmena */if ($row['dat_fak']<=$datum_do && $row['dat_fak']>=$datum_od) 
	echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($v_medjuvrednost_duga-$v_medjuvrednost_placanja), 2, ',', '.')."</b></td></tr>";				
	echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SUMA:</b></td><td><b>".number_format($duguje, 2, ',', '.')."</b></td></td><td><b>".number_format($platio, 2, ',', '.')."</b></td><td></td></tr>";
	echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($duguje-$platio), 2, ',', '.')."</b></td></td><td></td><td></td></tr>";
				?>
			</table>			
	
	<?php
	echo "<a href='izv_izlazne1.php?kupac=$kupac&godina=$akt_godina&naziv_kupca=$naziv_kupca&datum_do=$datum_do&datum_od=$datum_od' target='_blanc'><img src='../img/printer.png'></img></a>";
	}
	?>