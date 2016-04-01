<head>
	<link href='../css/izvestaj.css' rel='stylesheet'>
	<title>Izvestaj</title>
</head>
<?php
		include "../lib/class.baza.inc";
include "../funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();
$dobavljac=$_GET['dobavljac'];
$datum_do=$_GET['datum_do'];
$datum_od=$_GET['datum_od'];


$odabrana_godina=$_GET['odabrana_godina'];
$rezultat= $mysqli->query("SELECT * FROM rac_dobavljaci WHERE id='$dobavljac'");
	 WHILE ($row=$rezultat->fetch_assoc()){
	 $naziv_dobavljaca=$row['naziv'];	 
	 }

	 $rezultat= $mysqli->query("	 
	 select desna_strana.faktura_br,desna_strana.dat_fak,desna_strana.dat_val,desna_strana.iznos_fa,desna_strana.isplate,desna_strana.n_roba,desna_strana.red,desna_strana.lice,leva_strana.dat_fak as datum_ulaza
	 from
	 	 (SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS isplate,rac_roba.naziv AS n_roba,1 AS red,rac_fakture.lice
	 FROM rac_fakture 
	 LEFT JOIN rac_roba  ON rac_fakture.usluga=rac_roba.id 		 
	 WHERE rac_fakture.aktivan=1 AND tip='ulaz' AND lice=$dobavljac AND(dat_fak BETWEEN '2014-01-01' and '$datum_do'))
AS leva_strana

right join
(
	 SELECT faktura_br,dat_fak,rac_fakture.dat_val,iznos_fa,'0.00' AS isplate,rac_roba.naziv AS n_roba,1 AS red,rac_fakture.lice
	 FROM rac_fakture 
	 LEFT JOIN rac_roba  ON rac_fakture.usluga=rac_roba.id 		 
	 WHERE rac_fakture.aktivan=1 AND tip='ulaz' AND lice=$dobavljac AND godina=$odabrana_godina and (dat_fak BETWEEN '2014-01-01' and '$datum_do')
	 UNION ALL
	 SELECT brdob,dat_izv,'00.00.0000','0.00',isplate,'',2 AS red,dobavljac
	 FROM rac_izvodi
	 WHERE rac_izvodi.aktivan=1  AND dobavljac=$dobavljac AND (dat_izv BETWEEN '2014-01-01' and '$datum_do')
	 
	UNION
	SELECT *,3,'' AS red  FROM (
		SELECT faktura_br,dat_fak,rac_fakture.dat_val,sum(iznos_fa),'0.00' AS isplate,'sum_duguje' AS n_roba 
		FROM rac_fakture 
		LEFT JOIN rac_usluge ON rac_fakture.usluga=rac_usluge.id 		 
		WHERE rac_fakture.aktivan=1 AND tip='ulaz' AND lice=$dobavljac AND (dat_fak BETWEEN '2014-01-01' and '$datum_do')
		GROUP BY faktura_br
		UNION ALL
	 SELECT brdob,dat_izv,'00.00.0000','0.00',sum(isplate),'sum_platio' AS red
	 FROM rac_izvodi
	 WHERE rac_izvodi.aktivan=1  AND dobavljac=$dobavljac AND (dat_izv BETWEEN '2014-01-01' and '$datum_do')
	 GROUP BY brdob
		) grupisanje
ORDER BY faktura_br,red	,dat_fak)
as desna_strana
ON leva_strana.faktura_br=desna_strana.faktura_br
ORDER BY datum_ulaza,faktura_br,red	,dat_fak
	 ");?>
<h4 style='text-align:center'>ULAZNE FAKTURE</h4>
		<div class="box">
			<?php echo $naziv_dobavljaca." na dan: ".date("d.m.Y")."<br>"; 	?>
			<table class="izvestaj" border=1 style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum fakture</th><th>Br. fakture</th><th>Datum valute</th><th>Roba</th><th>Duguje</th><th>Uplatio</th></tr>
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
				if ($dat_fak=='01.01.1970') $dat_fak='';
				if ($dat_val=='01.01.1970' or $dat_val=='30.11.-0001') $dat_val='//';			
				if ($row['dat_val']=="SUMA") echo "<tr class='lista'><td></td><td></td><td>".$row['faktura_br']."</td><td></td><td>SUMA:</td><td>".number_format($row['sumau'], 2, ',', '.')."</td><td>11</td></tr>";
				elseif ($row['n_roba']=="sum_duguje") {echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Duguje:</b></td><td><b>".number_format($row['iznos_fa'], 2, ',', '.')."</b></td></tr>";
				$medjuzbir_duguje=1;
				$v_medjuvrednost_duga=$row['iznos_fa'];
				}
				elseif ($row['n_roba']=="sum_platio") {echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Platio:</b></td><td><b>".number_format($row['isplate'], 2, ',', '.')."</b></td></tr>";
				$medjuzbir_duguje=0;
				$medjuzbir_platio=1;
				$v_medjuvrednost_placanja=$row['isplate'];
				}
				ELSE{
				if ($medjuzbir_duguje==1 || $medjuzbir_platio==1) {
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($v_medjuvrednost_duga-$v_medjuvrednost_placanja), 2, ',', '.')."</b></td></tr>";				
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
			echo "<tr class='lista' style='border-top:1px solid black'><td>".$i."</td><td>".$dat_fak."</td><td>".$row['faktura_br']."</td><td>".$dat_val."</td><td>".$row['n_roba']."</td><td>".number_format($row['iznos_fa'], 2, ',', '.')."</td><td>".number_format($row['isplate'], 2, ',', '.')."</td></tr>";
			
			$godina_row=date("Y",strtotime($row['dat_fak'])); /* ubaci da pamti prethodnu godinu, da bi pokazao pocetno stanje na narednoj godini*/
			$duguje=$duguje+$row['iznos_fa'];
			$platio=$platio+$row['isplate'];
			$i++;
			}
			
				}
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($v_medjuvrednost_duga-$v_medjuvrednost_placanja), 2, ',', '.')."</b></td></tr>";				
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SUMA:</b></td><td><b>".number_format($duguje, 2, ',', '.')."</b></td></td><td><b>".number_format($platio, 2, ',', '.')."</b></td><td></td></tr>";
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($duguje-$platio), 2, ',', '.')."</b></td></td><td></td><td></td></tr>";
				?>
			</table>
			
