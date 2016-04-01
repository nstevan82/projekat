
<div class=box>
<form action=default.php method=post>
Odaberi datum<input type=text name=date placeholder="dd.mm.gggg">
<input type=submit value='Prikazi' name=trazi>
<input type=hidden name=str value='blagajna_gorivo'>
</form>
</div>

<?php
if (isset($_POST['trazi']) || isset($_GET['id']) || isset($_POST['unesi']) || isset($_POST['izmeni'])){
if (isset($_POST['trazi'])) $_SESSION['dat_pretrage_b']=$_POST['date'];
if (isset($_POST['unesi']) || isset($_POST['izmeni'])){
				$datum=string2datum($_POST['datum']);
				$opis=$_POST['opis'];
				$ulaz=$_POST['ulaz'];
					
				$objekat=$_POST['objekat'];		
				$godina=$_SESSION['godina'];
		if (isset($_POST['id'])) $id=$_POST['id'];


if (isset($_POST['unesi'])){
	  
	   $rezultat= $mysqli->query("INSERT INTO rac_blagajna_gorivo (godina,datum,ulaz,objekat,tip,aktivan) VALUES ('$godina','$datum','$ulaz','$objekat','ulaz',1)");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$rezultat= $mysqli->query("UPDATE rac_blagajna_gorivo 
		SET 
		godina=$godina, 
		objekat=$objekat, 
		datum='$datum',		
		ulaz='$ulaz',
		opisu='$opisu' 
		WHERE id='$id'");
	}
}	
	
	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_blagajna_gorivo");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
		$date=string2datum($_SESSION['dat_pretrage_b']);//datum za koji se trazi blagajna_gorivo
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_blagajna_gorivo WHERE godina='$akt_godina' AND datum='$date' AND aktivan=1 ","blagajna_gorivo");
		$rezultat= $mysqli->query("SELECT *,rac_blagajna_gorivo.id AS id1, rac_objekti.naziv AS n_objekta
		FROM rac_blagajna_gorivo 
		LEFT JOIN rac_objekti ON rac_blagajna_gorivo.objekat=rac_objekti.id
		WHERE rac_blagajna_gorivo.godina='$akt_godina' AND rac_blagajna_gorivo.aktivan=1  AND datum='$date' 
		LIMIT $pocetak,10");
	  	?>

		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum</th><th>Objekat</th><th>Vrednost</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				$link="default.php?str=blagajna_gorivo&id=$id&datum=$datum";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$datum."</a></td><td><a href='$link'>".$row['n_objekta']."</a></td><td><a href='$link'>".number_format($row['ulaz'], 2, ',', '.')."</a></td><td><a href='default.php?str=blagajna_gorivo&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog stanja" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE

				$datum1="";
				$opis1="";
				$ulaz1="";
				$opisu1="";
				$objekat1=0;
				


// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$_SESSION['blagajna_gorivo_datum']=$_GET['datum'];
		$_SESSION['blagajna_gorivo']=$_GET['id'];
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_blagajna_gorivo WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$datum1=date("d.m.Y", strtotime($row['datum'])); 				
				$opis1=$row['opis'];
				$ulaz1=$row['ulaz'];								
							
				$objekat1=$row['objekat'];	
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
		Blagajna_gorivo<br>
		<hr>
		Datum:<br><input type="text" name="datum" value='<?php echo $datum1?>' placeholder="dd.mm.gggg"><br>		
					
		Ulaz:<br><input type="text" name="ulaz" value='<?php echo $ulaz1?>'><br>		
		<input type=hidden name="opisu"><?php echo $opisu1?>			
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_objekti WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'objekat',$objekat1,'id');
		?><br>
		<input type="hidden" value=blagajna_gorivo name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
<?php
}
?>