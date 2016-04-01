<?php

if (isset($_POST['unesi']) || isset($_POST['izmeni'])){

		$naziv=$_POST['naziv'];
		$sifra=$_POST['sifra'];
		$pib=$_POST['pib'];
		$adresa=$_POST['adresa'];
		$telefon=$_POST['telefon'];
		if (isset($_POST['id'])) $id=$_POST['id'];


if (isset($_POST['unesi'])){
	  
	   $rezultat= $mysqli->query("INSERT INTO rac_dev_kupci (naziv,sifra,pib,adresa,telefon,aktivan) VALUES ('$naziv','$sifra','$pib','$adresa','$telefon',1)");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$naziv=$_POST['naziv'];
		$sifra=$_POST['sifra'];
		$pib=$_POST['pib'];
		$adresa=$_POST['adresa'];
		$telefon=$_POST['telefon'];
		$id=$_POST['id'];
		$rezultat= $mysqli->query("UPDATE rac_dev_kupci SET naziv='$naziv',sifra='$sifra',pib='$pib',adresa='$adresa',telefon='$telefon' WHERE id='$id'");
	}
}	
	
	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_dev_kupci");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_dev_kupci WHERE aktivan=1","dev_kupci");
		$rezultat= $mysqli->query("SELECT * FROM rac_dev_kupci WHERE aktivan=1 LIMIT $pocetak,10");
	  	?>

		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>id</th><th>Naziv</th><th>Sifra</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id'];
				$naziv=$row['naziv'];
				$link="default.php?str=dev_kupci&id=$id";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$row['naziv']."</a></td><td><a href='$link'>".$row['sifra']."</a></td><td><a href='default.php?str=dev_kupci&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog kupca" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE
$naziv1="";
$sifra1="";
$pib1="";
$adresa1="";
$telefon1="";


// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_dev_kupci WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$naziv1=$row['naziv'];
				$sifra1=$row['sifra'];
				$pib1=$row['pib'];
				$adresa1=$row['adresa'];
				$telefon1=$row['telefon'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
		Devizni kupci<br>
		Sifra kupca:<br><input type="text" name="sifra" value='<?php echo $sifra1?>'><br>		
		Naziv kupca:<br><input type="text" name="naziv" value='<?php echo $naziv1?>'><br>		
		PIB:<br><input type="text" name="pib" value='<?php echo $pib1?>'><br>		
		Adresa:<br><input type="text" name="adresa" value='<?php echo $adresa1?>'><br>		
		Telefon:<br><input type="text" name="telefon" value='<?php echo $telefon1?>'><br>		
		<input type="hidden" value=dev_kupci name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
