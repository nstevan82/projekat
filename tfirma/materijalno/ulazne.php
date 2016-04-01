<?php
		$godina=$_SESSION['godina'];
if (isset($_POST['unesi']) || isset($_POST['izmeni'])){

		$faktura_br=$_POST['faktura_br'];
		$dat_fak=string2datum($_POST['dat_fak']);
		$dat_val=string2datum($_POST['dat_val']);
		$iznos_fa=$_POST['iznos_fa'];
		$dobavljaci=$_POST['dobavljaci'];		
		$roba=$_POST['roba'];
		$porez=$_POST['porez'];
		$napomena=$_POST['napomena'];
		if (isset($_POST['id'])) $id=$_POST['id'];


if (isset($_POST['unesi'])){
	 	 
	   $rezultat= $mysqli->query("INSERT INTO rac_fakture (godina,faktura_br,dat_fak,dat_val,iznos_fa,porez,napomena,lice,usluga,tip,aktivan) VALUES ('$godina','$faktura_br','$dat_fak','$dat_val','$iznos_fa','$porez','$napomena','$dobavljaci','$roba','ulaz',1)");

		}
		if (isset($_POST['izmeni']))
		{
		$rezultat= $mysqli->query("UPDATE rac_fakture SET godina='$godina',dat_fak='$dat_fak',faktura_br='$faktura_br',dat_val='$dat_val',iznos_fa='$iznos_fa',porez='$porez',napomena='$napomena',lice='$dobavljaci',usluga='$roba' WHERE id='$id'");
	}
}	
	
	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_fakture");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
		?>
			<!-- ############### pretraga ##############################-->
	<div class="box">
	<form action="default.php" method=post>
		Datum fakture<input type=text name=dat_fakture placeholder="dd.mm.gggg">
		<input type=hidden name=str value='ulazne'>
		<input type=submit name=pretraga value="Trazi">
	</form>
</div>
		
		<?php
		
		if (isset($_POST['pretraga'])){ // ako je odabran datum fakture sa kojim se radi prikazi samo fakture tog datuma
	$_SESSION['ulazne']=string2datum($_POST['dat_fakture']);
	}	
	if (isset($_SESSION['ulazne'])){//zapamti datum fakture u $dat_ulaz_fakture
	$dat_ulaz_fakture=$_SESSION['ulazne'];
	$dat_ulaz_fakture=date("Y-m-d", strtotime($dat_ulaz_fakture));
	if ($dat_ulaz_fakture=='1970-01-01') $dat_ulaz_fakture='%%';
		
		
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_fakture WHERE aktivan=1 AND tip='ulaz' AND dat_fak like '%$dat_ulaz_fakture%' AND godina='$godina'","ulazne");
		$rezultat= $mysqli->query("SELECT *,rac_fakture.id AS id1 FROM rac_fakture LEFT JOIN rac_dobavljaci ON rac_fakture.lice=rac_dobavljaci.id  WHERE rac_fakture.aktivan=1  AND tip='ulaz' AND dat_fak like '%$dat_ulaz_fakture%' AND godina='$godina' ORDER BY dat_fak ASC LIMIT $pocetak,10");
		?>

		<div class="box">
		ULAZNE FAKTURE<br>
		<hr>
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>id</th><th>Dobavljac</th><th>Datum fakture</th><th>Br fakture</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$dat_fak=date("d.m.Y", strtotime($row['dat_fak'])); 				
				$link="default.php?str=ulazne&id=$id";				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$row['naziv']."</a></td><td><a href='$link'>".$dat_fak."</a></td><td><a href='$link'>".$row['faktura_br']."</a></td><td><a href='default.php?str=ulazne&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos nove ulazne fakture" onclick="sklopi('unesi')">
		</div>
<?php 
}



// ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE
$dat_fak1="";
$faktura_br1="";
$dat_val1="";
$iznos_fa1="";
$porez1="";
$napomena1="";
$dobavljac1="";
$lice1="";

// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_fakture WHERE id='$id' ");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$dat_fak1=date("d.m.Y", strtotime($row['dat_fak'])); 
				$faktura_br1=$row['faktura_br'];
				$dat_val1=date("d.m.Y", strtotime($row['dat_val'])); 
				$iznos_fa1=$row['iznos_fa'];
				$porez1=$row['porez'];
				$roba1=$row['usluga'];
				$dobavljaci1=$row['lice'];
				$napomena1=$row['napomena'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
		Faktura br:<br><input type="text" name="faktura_br" value='<?php echo $faktura_br1?>'><br>		
		Datum fakture:<br><input type="text" name="dat_fak" value='<?php echo $dat_fak1?>' placeholder='dd.mm.gggg'><br>		
		Datum valute:<br><input type="text" name="dat_val" value='<?php echo $dat_val1?>' placeholder='dd.mm.gggg'><br>		
		Dobavljac
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_dobavljaci");
		$mysqli->dropdown1($rezultat,'dobavljaci',$dobavljaci1,'id');
		?><br>
		Usluge
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_roba");
		$mysqli->dropdown1($rezultat,'roba',$roba1,'id');
		?><br>
		Iznos fakture:<br><input type="text" name="iznos_fa" value='<?php echo $iznos_fa1?>'><br>		
		Porez:<br><input type="text" name="porez" value='<?php echo $porez1?>' size=3>%<br>		
		Napomena:<br><textarea name='napomena'><?php echo $napomena1?></textarea><br>	
		<input type="hidden" value=ulazne name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
