<head>
	<link href='../css/izvestaj.css' rel='stylesheet'>
	<title>Izvestaj</title>
</head>
<?php
		include "../lib/class.baza.inc";
		include "../funkcije.php";
	   $Vkb4v4hyhajp=new Baza("../dbparam.php");
	   $Vkb4v4hyhajp->povezi();
		

$V24imcqdcpvk=$_GET['dobavljac'];
	 $datum_do=$_GET['datum_do'];
	$datum_od=$_GET['datum_od'];
	$odabrana_godina=$_GET['odabrana_godina'];
$Vei0ij40kkwq= $Vkb4v4hyhajp->query("SELECT * FROM rac_dev_dobavljaci WHERE id='$V24imcqdcpvk'");
	 WHILE ($Vicgg1kpov5s=$Vei0ij40kkwq->fetch_assoc()){
	 $Vb4jfmbhorvo=$Vicgg1kpov5s['naziv'];	 
	 }
	 $Vei0ij40kkwq= $Vkb4v4hyhajp->query("	 
	 select desna_strana.faktura_br,desna_strana.dat_fak,desna_strana.dat_val,desna_strana.iznos_fa,desna_strana.isplate,desna_strana.n_roba,desna_strana.red,desna_strana.lice,leva_strana.dat_fak as datum_ulaza
	 from
	 	 (SELECT faktura_br,dat_fak,rac_dev_fakture.dat_val,iznos_fa,'0.00' AS isplate,rac_roba.naziv AS n_roba,1 AS red,rac_dev_fakture.lice
	 FROM rac_dev_fakture 
	 LEFT JOIN rac_roba  ON rac_dev_fakture.usluga=rac_roba.id 		 
	 WHERE rac_dev_fakture.aktivan=1 AND tip='ulaz' AND lice=$V24imcqdcpvk AND (dat_fak BETWEEN '$datum_od' and '$datum_do'))
AS leva_strana

right join
(
	 SELECT faktura_br,dat_fak,rac_dev_fakture.dat_val,iznos_fa,'0.00' AS isplate,rac_roba.naziv AS n_roba,1 AS red,rac_dev_fakture.lice
	 FROM rac_dev_fakture 
	 LEFT JOIN rac_roba  ON rac_dev_fakture.usluga=rac_roba.id 		 
	 WHERE rac_dev_fakture.aktivan=1 AND tip='ulaz' AND lice=$V24imcqdcpvk AND (dat_fak BETWEEN '$datum_od' and '$datum_do')
	 UNION ALL
	 SELECT brdob,dat_izv,'00.00.0000','0.00',isplate,'',2 AS red,dobavljac
	 FROM rac_dev_izvodi
	 WHERE rac_dev_izvodi.aktivan=1  AND dobavljac=$V24imcqdcpvk AND (dat_izv BETWEEN '$datum_od' and '$datum_do')
	 
	UNION
	SELECT *,3,'' AS red  FROM (
		SELECT faktura_br,dat_fak,rac_dev_fakture.dat_val,sum(iznos_fa),'0.00' AS isplate,'sum_duguje' AS n_roba 
		FROM rac_dev_fakture 
		LEFT JOIN rac_usluge ON rac_dev_fakture.usluga=rac_usluge.id 		 
		WHERE rac_dev_fakture.aktivan=1 AND tip='ulaz' AND lice=$V24imcqdcpvk AND (dat_fak BETWEEN '$datum_od' and '$datum_do')
		GROUP BY faktura_br
		UNION ALL
	 SELECT brdob,dat_izv,'00.00.0000','0.00',sum(isplate),'sum_platio' AS red
	 FROM rac_dev_izvodi
	 WHERE rac_dev_izvodi.aktivan=1  AND dobavljac=$V24imcqdcpvk AND (dat_izv BETWEEN '$datum_od' and '$datum_do')
	 GROUP BY brdob
		) grupisanje
ORDER BY faktura_br,red	,dat_fak)
as desna_strana
ON leva_strana.faktura_br=desna_strana.faktura_br
ORDER BY datum_ulaza,faktura_br,red	,dat_fak 	
	 ");?>
<h4 style='text-align:center'>DEVIZNE ULAZNE FAKTURE</h4>
		<?php echo $Vb4jfmbhorvo." na dan: ".date("d.m.Y")."<br>"; 	?>
		<div class="box">
			<table class="izvestaj" border=1 style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum fakture</th><th>Br. fakture</th><th>Datum valute</th><th>Roba</th><th>Duguje</th><th>Uplatio</th><th></th></tr>
				<?php
				$Vrciwsslarg4=1;
				$Vddpviuwotzl=0;
				$V4mf4cmk0ynu=0;
				$Vvgebdkm2akp=0;
				$Vjird1mwpp14=0;
				$V33rwvzl5yjw=0;
				$Vzbtpwpjmo5c=0;
				while ($Vicgg1kpov5s = $Vei0ij40kkwq->fetch_assoc()) 
				{				
				$V3tv4q4lmsl1=date("d.m.Y", strtotime($Vicgg1kpov5s['dat_fak'])); 				
				$V10njl4nji5p=date("d.m.Y", strtotime($Vicgg1kpov5s['dat_val'])); 
				
				if ($V3tv4q4lmsl1=='01.01.1970') $V3tv4q4lmsl1='';
				if ($V10njl4nji5p=='01.01.1970' or $V10njl4nji5p=='30.11.-0001') $V10njl4nji5p='//';			
				if ($Vicgg1kpov5s['dat_val']=="SUMA") echo "<tr class='lista'><td></td><td></td><td>".$Vicgg1kpov5s['faktura_br']."</td><td></td><td>SUMA:</td><td>".number_format($Vicgg1kpov5s['sumau'], 2, ',', '.')."</td><td>11</td></tr>";
				elseif ($Vicgg1kpov5s['n_roba']=="sum_duguje") {echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Duguje:</b></td><td><b>".number_format($Vicgg1kpov5s['iznos_fa'], 2, ',', '.')."</b></td></tr>";
				$Vvgebdkm2akp=1;
				$Vzbtpwpjmo5c=$Vicgg1kpov5s['iznos_fa'];
				}
				elseif ($Vicgg1kpov5s['n_roba']=="sum_platio") {echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Platio:</b></td><td><b>".number_format($Vicgg1kpov5s['isplate'], 2, ',', '.')."</b></td></tr>";
				$Vvgebdkm2akp=0;
				$Vjird1mwpp14=1;
				$V33rwvzl5yjw=$Vicgg1kpov5s['isplate'];
				}
				ELSE{
				if ($Vvgebdkm2akp==1 || $Vjird1mwpp14==1) {
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($Vzbtpwpjmo5c-$V33rwvzl5yjw), 2, ',', '.')."</b></td></tr>";				
				$Vvgebdkm2akp=0;
				$Vjird1mwpp14=0;
				$V33rwvzl5yjw=0;
				$Vzbtpwpjmo5c=0;
				}
			echo "<tr class='lista' style='border-top:1px solid black'><td>".$Vrciwsslarg4."</td><td>".$V3tv4q4lmsl1."</td><td>".$Vicgg1kpov5s['faktura_br']."</td><td>".$V10njl4nji5p."</td><td>".$Vicgg1kpov5s['n_roba']."</td><td>".number_format($Vicgg1kpov5s['iznos_fa'], 2, ',', '.')."</td><td>".number_format($Vicgg1kpov5s['isplate'], 2, ',', '.')."</td></tr>";
			$Vddpviuwotzl=$Vddpviuwotzl+$Vicgg1kpov5s['iznos_fa'];
			$V4mf4cmk0ynu=$V4mf4cmk0ynu+$Vicgg1kpov5s['isplate'];
			$Vrciwsslarg4++;
			}
			
				}
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($Vzbtpwpjmo5c-$V33rwvzl5yjw), 2, ',', '.')."</b></td></tr>";				
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SUMA:</b></td><td><b>".number_format($Vddpviuwotzl, 2, ',', '.')."</b></td></td><td><b>".number_format($V4mf4cmk0ynu, 2, ',', '.')."</b></td><td></td></tr>";
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($Vddpviuwotzl-$V4mf4cmk0ynu), 2, ',', '.')."</b></td></td><td></td><td></td></tr>";
				?>
			</table>
			
