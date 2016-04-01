<?php

if (isset($_POST['unesi'])){
	$naziv=$_POST['naziv'];
	$sifra=$_POST['sifra'];
   
	   $rezultat= $mysqli->query("INSERT INTO rac_banke (naziv,sifra,aktivan) VALUES ('$naziv','$sifra',1)");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$naziv=$_POST['naziv'];
		$sifra=$_POST['sifra'];
		$id=$_POST['id'];
		$rezultat= $mysqli->query("UPDATE rac_banke SET naziv='$naziv',sifra='$sifra' WHERE id='$id'");
	}
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_banke");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_banke WHERE aktivan=1","banke");
		$rezultat= $mysqli->query("SELECT * FROM rac_banke WHERE aktivan=1 LIMIT $pocetak,10");
	  	?>

		<div class="box">
			<table class="lista">
				<tr><th>id</th><th>Naziv</th><th>Sifra</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id'];
				$naziv=$row['naziv'];
				$link="default.php?str=banke&id=$id";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$row['naziv']."</a></td><td><a href='$link'>".$row['sifra']."</a></td><td><a href='default.php?str=banke&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos nove banke" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE
$naziv1="";
$sifra1="";

// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_banke WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$naziv1=$row['naziv'];
				$sifra1=$row['sifra'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"  ?> >	
<form method="post" action="default.php">
		Banke<br>
		Sifra banke:<br><input type="text" name="sifra" value='<?php echo $sifra1?>'><br>		
		Naziv banke:<br><input type="text" name="naziv" value='<?php echo $naziv1?>'><br>		
		<input type="hidden" value=banke name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
