<form action="default.php" method="post">
<div class="box">
<?php
		$Vei0ij40kkwq=$Vkb4v4hyhajp->query("SELECT * FROM rac_dev_kupci WHERE aktivan=1");
		$Vkb4v4hyhajp->dropdown($Vei0ij40kkwq,'kupci','kupci','id');?>
		<input type="hidden" name=str value="izv_dev_izlazne">	
		<input type="text"  size=11 name="datum_od" placeholder="datum od">&nbsp-&nbsp
		<input type="text"  size=11 name="datum_do" placeholder="datum do">
		<input type=submit name=trazi value="Prikazi">
		</form>
</div>
		<?php		

if (isset($_POST['trazi'])){
$V4rafkd3eibx=$_POST['kupci'];
$datum_od=date("Y-m-d", strtotime($_POST['datum_od']));
$datum_do=date("Y-m-d", strtotime($_POST['datum_do']));
	 $Vei0ij40kkwq= $Vkb4v4hyhajp->query("
		 SELECT *,ulazi.dat AS dat_ulaza FROM
	 (
	 SELECT faktura_br,dat_fak,rac_dev_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_dev_fakture.lice,dat_fak as dat,1 AS red_izlaz
	 FROM rac_dev_fakture 
	 LEFT JOIN rac_usluge  ON rac_dev_fakture.usluga=rac_usluge.id 		 
	 WHERE rac_dev_fakture.aktivan=1 AND tip='izlaz' AND rac_dev_fakture.lice=$V4rafkd3eibx AND (dat_fak BETWEEN '$datum_od' and '$datum_do')
) AS ulazi
right join
(	 
	 SELECT faktura_br,dat_fak,rac_dev_fakture.dat_val,iznos_fa,'0.00' AS uplate,rac_usluge.naziv AS n_usluge,1 AS red,rac_dev_fakture.lice,dat_fak as dat,1 AS red_izlaz
	 FROM rac_dev_fakture 
	 LEFT JOIN rac_usluge  ON rac_dev_fakture.usluga=rac_usluge.id 		 
	 WHERE rac_dev_fakture.aktivan=1 AND tip='izlaz' AND rac_dev_fakture.lice=$V4rafkd3eibx AND (dat_fak BETWEEN '$datum_od' and '$datum_do') 
	 UNION ALL
	 SELECT brfa,dat_izv,'00.00.0000','0.00',uplate,'',1 AS red,kupac,'',2 AS red_izlaz  
	 FROM rac_dev_izvodi
	 WHERE rac_dev_izvodi.aktivan=1 AND kupac=$V4rafkd3eibx AND (dat_izv BETWEEN '$datum_od' and '$datum_do') 
	 
	  
	UNION ALL
	SELECT *,2,'' AS red,'',2 as red_izlaz FROM (
		SELECT faktura_br,dat_fak,rac_dev_fakture.dat_val,sum(iznos_fa),'0.00' AS uplate,'sum_duguje' AS n_usluge
		FROM rac_dev_fakture 
		LEFT JOIN rac_usluge  ON rac_dev_fakture.usluga=rac_usluge.id 		 
		WHERE rac_dev_fakture.aktivan=1 AND tip='izlaz' AND rac_dev_fakture.lice=$V4rafkd3eibx AND (dat_fak BETWEEN '$datum_od' and '$datum_do')
		GROUP BY faktura_br
	UNION ALL
	 SELECT brfa AS faktura_br,dat_izv,'00.00.0000','0.00',sum(uplate),'sum_platio' AS red
	 FROM rac_dev_izvodi
	 WHERE rac_dev_izvodi.aktivan=1  AND kupac=$V4rafkd3eibx AND AND (dat_izv BETWEEN '$datum_od' and '$datum_do') 
	 GROUP BY brfa
		) grupisanje
ORDER BY faktura_br,red	,dat_fak
) AS izlazi
ON ulazi.faktura_br=izlazi.faktura_br
ORDER BY dat_ulaza,izlazi.red,izlazi.red_izlaz,izlazi.dat_fak

	 ");?>

		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum fakture</th><th>Br. fakture</th><th>Datum valute</th><th>Usluga</th><th>Duguje</th><th>Platio</th><th></th></tr>
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
				elseif ($Vicgg1kpov5s['n_usluge']=="sum_duguje") {echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Duguje:</b></td><td><b>".number_format($Vicgg1kpov5s['iznos_fa'], 2, ',', '.')."</b></td></tr>";
				$Vvgebdkm2akp=1;
				$Vzbtpwpjmo5c=$Vicgg1kpov5s['iznos_fa'];
				}
				elseif ($Vicgg1kpov5s['n_usluge']=="sum_platio") {echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>Platio:</b></td><td><b>".number_format($Vicgg1kpov5s['uplate'], 2, ',', '.')."</b></td></tr>";
				$Vvgebdkm2akp=0;
				$Vjird1mwpp14=1;
				$V33rwvzl5yjw=$Vicgg1kpov5s['uplate'];
				}
				ELSE{
				if ($Vvgebdkm2akp==1 || $Vjird1mwpp14==1) {
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($Vzbtpwpjmo5c-$V33rwvzl5yjw), 2, ',', '.')."</b></td></tr>";				
				$Vvgebdkm2akp=0;
				$Vjird1mwpp14=0;
				$V33rwvzl5yjw=0;
				$Vzbtpwpjmo5c=0;
				}
			echo "<tr class='lista' style='border-top:1px solid black'><td>".$Vrciwsslarg4."</td><td>".$V3tv4q4lmsl1."</td><td>".$Vicgg1kpov5s['faktura_br']."</td><td>".$V10njl4nji5p."</td><td>".$Vicgg1kpov5s['n_usluge']."</td><td>".number_format($Vicgg1kpov5s['iznos_fa'], 2, ',', '.')."</td><td>".number_format($Vicgg1kpov5s['uplate'], 2, ',', '.')."</td></tr>";
			$Vddpviuwotzl=$Vddpviuwotzl+$Vicgg1kpov5s['iznos_fa'];
			$V4mf4cmk0ynu=$V4mf4cmk0ynu+$Vicgg1kpov5s['uplate'];
			$Vrciwsslarg4++;
			}
			
				}
				echo "<tr style='background:#A5AFFD'><td></td><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($Vzbtpwpjmo5c-$V33rwvzl5yjw), 2, ',', '.')."</b></td></tr>";				
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SUMA:</b></td><td><b>".number_format($Vddpviuwotzl, 2, ',', '.')."</b></td></td><td><b>".number_format($V4mf4cmk0ynu, 2, ',', '.')."</b></td><td></td></tr>";
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td><b>SALDO:</b></td><td><b>".number_format(($Vddpviuwotzl-$V4mf4cmk0ynu), 2, ',', '.')."</b></td></td><td></td><td></td></tr>";
				?>
			</table>
			
	<?php
		echo "<a href='izv_dev_izlazne1.php?kupac=$V4rafkd3eibx&godina=$V0qmlm2aq14j&datum_do=$datum_do&datum_od=$datum_od' target='_blanc'><img src='../img/printer.png'></img></a>";
	}
	?>