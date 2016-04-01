<?php

if (isset($_POST['unesi']) || isset($_POST['izmeni'])){
				$datum=string2datum($_POST['datum']);
				$predmet=$_POST['predmet'];
				$primaoc=$_POST['primaoc'];
				$napomena=$_POST['napomena'];
				
		if (isset($_POST['id'])) $id=$_POST['id'];


if (isset($_POST['unesi'])){
	  
	   $rezultat= $mysqli->query("INSERT INTO rac_delovodnik (godina,datum,predmet,posiljaoc,napomena,tip,aktivan) VALUES ('$akt_godina','$datum','$predmet','$primaoc','$napomena','izlaz',1)");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$rezultat= $mysqli->query("UPDATE rac_delovodnik SET godina='$akt_godina',datum='$datum',predmet='$predmet',posiljaoc='$primaoc',napomena='$napomena' WHERE id='$id'");
	}
}	
	
	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_delovodnik");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_delovodnik WHERE rac_delovodnik.aktivan=1 AND rac_delovodnik.tip='izlaz' AND godina='$akt_godina'","izlazni_delovodnik");
		$rezultat= $mysqli->query("SELECT *,rac_delovodnik.id AS id1 
		FROM rac_delovodnik LEFT JOIN rac_primaoci 
		ON rac_delovodnik.posiljaoc=rac_primaoci.id  
		WHERE rac_delovodnik.aktivan=1 AND rac_delovodnik.tip='izlaz' AND godina='$akt_godina'
		LIMIT $pocetak,10");
	  	?>

		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Broj</th><th>Datum</th><th>Primaoc</th><th>Predmet</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				$link="default.php?str=izlazni_delovodnik&id=$id&rb=$i";
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$datum."</a></td><td><a href='$link'>".$row['naziv']."</a></td><td><a href='$link'>".$row['predmet']."</a></td><td><a href='default.php?str=izlazni_delovodnik&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog predmeta" onclick="sklopi('unesi')">
		</div>
<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE

				$datum1="";
				$primaoc1=0;
				$predmet1="";
				$napomena1="";

// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_delovodnik WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$datum1=date("d.m.Y", strtotime($row['datum'])); 				
				$predmet1=$row['predmet'];
				$napomena1=$row['napomena'];
				$primaoc1=$row['posiljaoc'];
				$rb=$row['id'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
		IZLAZNI DELOVODNIK<br>
		<hr>
		Rb. <?php echo $_GET['rb'];?><br>
		Datum izlazni delovodnik:<br><input type="text" name="datum" value='<?php echo $datum1?>' placeholder='dd.mm.gggg'><br>		
		<?php
		if (!isset($posiljaoc)) $posiljaoc=0;
		$rezultat=$mysqli->query("SELECT * FROM rac_primaoci");
			$mysqli->dropdown1($rezultat,'primaoc',$primaoc1,'id');
		?>
		<br>
		Predmet:<br><input type="text" name="predmet" value='<?php echo $predmet1?>'><br>		
		<textarea name='napomena'><?php echo $napomena1 ?></textarea><br>
		<input type="hidden" value=izlazni_delovodnik name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
