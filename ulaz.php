
<div class=box>
<form action=default.php method=post>
Odaberite magacin &nbsp
<?php
		$rezultat=$mysqli->query("SELECT * FROM mag_skladista WHERE aktivan=1");
		$mysqli->dropdown($rezultat,'skladista','id');
		?>
<input type=submit value='Prikazi' name=trazi>
<input type=hidden name=str value='ulaz'>
</form>
</div>

<?php
if (isset($_POST['trazi']) || isset($_GET['id']) || isset($_POST['unesi']) || isset($_POST['izmeni'])){
if (isset($_POST['trazi'])) {
							$_SESSION['skladista']=$_POST['skladista'];
							$skladista=$_POST['skladista'];
							}
							if (isset($_SESSION['skladista'])) $skladista=$_SESSION['skladista'];
if (isset($_POST['unesi']) || isset($_POST['izmeni'])){
				$datum=string2datum($_POST['datum']);
				$roba=$_POST['roba'];				
				$vrednostu=$_POST['vrednostu'];				
				$sredstvo=$_POST['sredstvo'];				
				$kolicina=$_POST['kolicina'];				
				$komada=$_POST['komada'];				
				$br_prijave=$_POST['br_prijave'];
				$vlasnik=$_POST['vlasnik'];				
				$skladiste_unos=$_POST['skladiste_unos'];				
				$godina=$_SESSION['godina'];				
		if (isset($_POST['id'])) $id=$_POST['id'];


if (isset($_POST['unesi'])){
	  
	  $rezultat=$mysqli->query("SELECT MAX(broj) as maxbroj 
	  FROM mag_ulaz
	  WHERE skladiste='$skladiste_unos' AND godina='$godina'");
	  while ($row = $rezultat->fetch_assoc()) {
	  $last_id=$row['maxbroj'] + 1; 
	  };
	   $rezultat= $mysqli->multiquery("
	   INSERT INTO mag_ulaz (vrednostu,sredstvo,kolicina,komada,skladiste,godina,datum,roba,br_prijave,vlasnik,aktivan) 
	   VALUES ('$vrednostu','$sredstvo','$kolicina','$komada','$skladiste_unos','$godina','$datum','$roba','$br_prijave','$vlasnik',1);	
	   UPDATE mag_ulaz set broj=$last_id WHERE id=LAST_INSERT_ID()
	   ");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$rezultat= $mysqli->query("UPDATE mag_ulaz SET 
		skladiste='$skladiste_unos',
		godina=$godina, 
		datum='$datum',
		roba='$roba',
		vrednostu='$vrednostu',
		sredstvo='$sredstvo',
		kolicina='$kolicina',
		komada='$komada',
		br_prijave='$br_prijave',
		vlasnik='$vlasnik' 
		WHERE id='$id'");
	}
}	
	
	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"mag_ulaz");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
	
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM mag_ulaz 
		WHERE 
		godina='$akt_godina' 
		AND skladiste='$skladista'  
		AND aktivan=1 ","ulaz");
		$rezultat= $mysqli->query("
		SELECT *, mag_ulaz.id AS id1,mag_vlasnici.naziv AS n_vlasnika, mag_robe.naziv AS n_robe FROM mag_ulaz 
		LEFT JOIN mag_vlasnici ON mag_ulaz.vlasnik=mag_vlasnici.id
		LEFT JOIN mag_robe ON mag_ulaz.roba=mag_robe.id		
		WHERE godina='$akt_godina' 
		AND skladiste='$skladista' 
		AND mag_ulaz.aktivan=1 
		LIMIT $pocetak,10");
	  	?>

		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum</th><th>Vlasnik</th><th>Br. prijave</th><th></th></tr>
				<?php
				$i=10*($_GET['strana'])+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				$link="default.php?str=ulaz&id=$id&rb=$i";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$datum."</a></td><td><a href='$link'>".$row['n_vlasnika']."</a></td><td><a href='$link'>".$row['br_prijave']."</a></td><td><a href='default.php?str=ulaz&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Novi ulaz" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE

				$datum1="";
				$roba1=0;
				$br_prijave1="";
				$vlasnik1=0;
				$skladiste_unos1=$_POST['skladista'];
				$sredstvo1='';				
				$kolicina1='';				
				$komada1='';	
				$vrednostu1='';	


// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){

		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM mag_ulaz WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{	
				$_SESSION['br_ulaza']=$row['broj'];
				$id1=$row['id'];
				$datum1=date("d.m.Y", strtotime($row['datum'])); 				
				$roba1=$row['roba'];
				$br_prijave1=$row['br_prijave'];								
				$vlasnik1=$row['vlasnik'];				
				$skladiste_unos1=$row['skladiste'];	
				$sredstvo1=$row['sredstvo'];				
				$kolicina1=$row['kolicina'];				
				$komada1=$row['komada'];					
				$vrednostu1=$row['vrednostu'];			
				}
				
		$rezultat= $mysqli->query("SELECT * FROM mag_skladista WHERE id='$skladiste_unos1'");
		while ($row = $rezultat->fetch_assoc()) 
				{	$_SESSION['odabrano_skladiste']=$row['naziv'];}				
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
		Mesto u magacinu<br>
		<hr>
		<?php
		$rezultat=$mysqli->query("SELECT * FROM mag_skladista WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'skladiste_unos',$skladista,'id');
		?>
		<br>
		Datum prijave:<br><input type="text" name="datum" value='<?php echo $datum1?>' placeholder="dd.mm.gggg"><br>		
		<?php
		$rezultat=$mysqli->query("SELECT * FROM mag_robe WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'roba',$roba1,'id');
		?>	
		<br>
		Br. prijave:<br><input type="text" name="br_prijave" value='<?php echo $br_prijave1?>'><br>		
		<?php
		$rezultat=$mysqli->query("SELECT * FROM mag_vlasnici WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'vlasnik',$vlasnik1,'id');
		?>						
		<br>
		<hr>
		Prevozno sredstvo:<br><input type="text" name="sredstvo" value='<?php echo $sredstvo1?>'><br>		
		Kolicina:<br><input type="text" name="kolicina" value='<?php echo $kolicina1?>'> &nbsp kg<br>		
		Komada:<br><input type="text" name="komada" value='<?php echo $komada1?>'> &nbsp kom/Pcs<br>		
		Vrednost ulaza:<br><input type="text" name="vrednostu" value='<?php echo $vrednostu1?>'><br>		
		<input type="hidden" value=ulaz name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
<?php
}
?>