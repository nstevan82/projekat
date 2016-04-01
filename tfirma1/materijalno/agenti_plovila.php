<?php

if (isset($_POST['unesi'])){
	$naziv=$_POST['naziv'];
	$sifra=$_POST['sifra'];
   
	   $rezultat= $mysqli->query("INSERT INTO rac_agenti (naziv,sifra,aktivan) VALUES ('$naziv','$sifra',1)");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$naziv=$_POST['naziv'];
		$sifra=$_POST['sifra'];
		$id=$_POST['id'];
		$rezultat= $mysqli->query("UPDATE rac_agenti SET naziv='$naziv',sifra='$sifra' WHERE id='$id'");
	}
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_agenti");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}

		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_agenti WHERE aktivan=1","agenti_plovila");

		$rezultat= $mysqli->query("SELECT * FROM rac_agenti WHERE aktivan=1 LIMIT $pocetak,10");
	  	?>

		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>id</th><th>Ime</th><th>Napomena</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id'];
				$naziv=$row['naziv'];
				$link="default.php?str=agenti_plovila&id=$id";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$row['naziv']."</a></td><td><a href='$link'>".$row['sifra']."</a></td><td><a href='default.php?str=agenti_plovila&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog agenta" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE
$naziv1="";
$sifra1="";

// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_agenti WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$naziv1=$row['naziv'];
				$sifra1=$row['sifra'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
		AGENTI PLOVILA<br>
		<hr>
		Naziv Agenta:<br><input type="text" name="naziv" value='<?php echo $naziv1?>'><br>	
		Napomena:<br><input type="text" name="sifra" value='<?php echo $sifra1?>'><br>		
		<input type="hidden" value=agenti_plovila name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
