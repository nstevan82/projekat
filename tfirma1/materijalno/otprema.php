<?php

if (isset($_POST['unesi']) || isset($_POST['izmeni'])){
		$vre_poc=$_POST['vre_poc'];
		$vre_zav=$_POST['vre_zav'];

		$plovilo_br=$_POST['plovilo_br'];
		$dat_poc=string2datum($_POST['dat_poc']);
		$dat_zav=string2datum($_POST['dat_zav']);		
		$datum=string2datum($_POST['datum']);
		$agent=$_POST['agent'];		
		$kupac=$_POST['kupci'];					
		$plovilo_br=$_POST['plovilo_br'];		
		$tezina=$_POST['tezina'];
		$napomena=$_POST['napomena'];	
		$vrstarobe=$_POST['vrstarobe'];	
		if (isset($_POST['id'])) $id=$_POST['id'];

if (isset($_POST['unesi'])){	 	 
	   $rezultat= $mysqli->query("INSERT INTO rac_otprema (godina,plovilo_br,vre_poc,vre_zav,dat_poc,dat_zav,tezina,napomena,agent,kupac,datum,vrstarobe, aktivan) VALUES ('$akt_godina','$plovilo_br','$vre_poc','$vre_zav','$dat_poc','$dat_zav','$tezina','$napomena','$agent','$kupac','$datum','$vrstarobe',1)");
		}
		if (isset($_POST['izmeni']))
		{
		$rezultat= $mysqli->query("UPDATE rac_otprema SET godina=$akt_godina,dat_poc='$dat_poc',vre_poc='$vre_poc',vre_zav='$vre_zav',plovilo_br='$plovilo_br',dat_zav='$dat_zav',tezina='$tezina',napomena='$napomena',agent='$agent',kupac='$kupac',datum='$datum',vrstarobe='$vrstarobe' WHERE id='$id'");
	}
}	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_otprema");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_otprema WHERE godina='$akt_godina' AND aktivan=1","otprema");
		$rezultat= $mysqli->query("SELECT *,rac_otprema.id as id1 FROM rac_otprema LEFT JOIN rac_kupci ON rac_otprema.kupac=rac_kupci.id WHERE godina='$akt_godina'  AND rac_otprema.aktivan=1 LIMIT $pocetak,10");
	  	?>

		<div class="box">
		OTPREMA
		<hr>
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>id</th><th>Kupac</th><th>Datum pocetka</th><th>Datum zavrsetka</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$dat_poc=date("d.m.Y", strtotime($row['dat_poc'])); 				
				$dat_zav=date("d.m.Y", strtotime($row['dat_zav'])); 
				$datum=date("d.m.Y", strtotime($row['datum'])); 	
				$link="default.php?str=otprema&id=$id";				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$row['naziv']."</a></td><td><a href='$link'>".$dat_poc."</a></td><td><a href='$link'>".$dat_zav."</a></td><td><a href='default.php?str=otprema&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos nove otpreme" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE
$dat_poc1="";
$plovilo_br1="";
$dat_zav1="";
$tezina1="";
$napomena1="";
$napomena1="";
$agent1="";
$vre_poc1="";
$vre_zav1="";
$agent1="";
$datum1="";
$kupci1="";
$vrstarobe1="";


// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_otprema WHERE id='$id' ");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$dat_poc1=date("d.m.Y", strtotime($row['dat_poc'])); 
				$plovilo_br1=$row['plovilo_br'];
				$dat_zav1=date("d.m.Y", strtotime($row['dat_zav'])); 
				$tezina1=$row['tezina'];
				$napomena1=$row['napomena'];
				$agent1=$row['agent'];
				$vre_poc1=$row['vre_poc'];
				$vre_zav1=$row['vre_zav'];
				$datum1=date("d.m.Y", strtotime($row['datum'])); 
				if ($datum1=="01.01.1970") $datum1='';
				if ($dat_poc1=="01.01.1970") $dat_poc1='';
				if ($dat_zav1=="01.01.1970") $dat_zav1='';
				$kupci1=$row['kupac'];
				$vrstarobe1=$row['vrstarobe'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">

		Datum<input name=datum type=text value='<?php echo $datum1 ?>' size='10' placeholder='dd.mm.gggg'>/
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_kupci  WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'kupci',$kupci1,'id');
		?><br>
		Agent:
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_agenti  WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'agent',$agent1,'id');
		?><br>		
		Broj plovila:<br><input type="text" name="plovilo_br" value='<?php echo $plovilo_br1?>'><br>	
		Vrsta robe:
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_vrsta_robe  WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'vrstarobe',$vrstarobe1,'id');
		?><br>	
		
		Datum pocetka:<br><input type="text" name="dat_poc" value='<?php echo $dat_poc1?>' placeholder='dd.mm.gggg'><br>
		Vreme pocetka:<br><input type="text" name="vre_poc" value='<?php echo $vre_poc1?>' placeholder='ss:mm:ss'><br>		
		Datum zavrsetka:<br><input type="text" name="dat_zav" value='<?php echo $dat_zav1?>' placeholder='dd.mm.gggg'><br>				
		Vreme zavrsetka:<br><input type="text" name="vre_zav" value='<?php echo $vre_zav1?>' placeholder='ss:mm:ss'><br>				
		Tezina(t):<br><input type="text" name="tezina" value='<?php echo $tezina1?>'><br>				
		Napomena:<br><textarea name='napomena'><?php echo $napomena1?></textarea><br>	
		<input type="hidden" value=otprema name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>

	