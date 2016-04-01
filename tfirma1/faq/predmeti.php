<?php include "header.php";
include "../lib/class.email.inc";
include "pokupi_mailove.php" ;
?>
<body>
<div id='big_wrapper'>
     <section id="main_section">
		<?php include "meni.php" ;
		?>
		<article>	 
		<?php
		if (isset($_POST['poruka']))
		{
		$id=$_POST['id'];
		$odgovor=$_POST['odgovor'];
		$status=$_POST['status'];
		$email=$_POST['email'];
		$obradjivac=$_SESSION['user'];
		$datum=date("Y-n-j");
		$rezultat= $mysqli->query("INSERT INTO s48_poruke (brzahteva,poruka,datum,obradjivac,status) VALUES ('$id','$odgovor','$datum','$obradjivac','$status')");
		$rezultat= $mysqli->query("UPDATE s48_predmet set status='$status' WHERE id='$id'");
		$odgovor="Postovani, ovo je obavestenje e-kancelarije o statusu Vaseg zahteva <br>:".$odgovor;
		$email=new email($email,"Sistem za obavestavanje","Obavestenje o Vasem zahtevu",$odgovor);
		$email->posalji();
		}
		/*
		if (isset($_POST['izmeni']))
		{
			$naziv=$_POST['naziv'];
			$id=$_POST['id'];
			$naziv=$_POST['naziv'];
			$rezultat= $mysqli->query("UPDATE s48_klase SET naziv='$naziv' WHERE id='$id'");
		}*/
		if (isset($_REQUEST['del'])) {
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
//		obrisi("s48_klase","klasa","s48_pitanja");// kod vezan za brisanje stavke iz sifarnika 
		$mysqli->deaktiviraj($_REQUEST['del'],'s48_predmet');
		// u tabeli s48_korisnici zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		if (isset($_POST['del_update'])){
			$vrednost=$_POST['del_update'];
			$obrisan=$_POST['del'];
			
			$rezultat= $mysqli->query("UPDATE s48_korisnici SET grupa='$vrednost' WHERE grupa='$obrisan'");
			}
		}
		
		
		
		$pocetak=$mysqli->paginacija("SELECT COUNT(s48_predmet.id) AS broj FROM s48_predmet LEFT JOIN s48_klase on s48_predmet.sluzba=s48_klase.id LEFT JOIN s48_statusi ON s48_predmet.status=s48_statusi.id");
		$rezultat= $mysqli->query("SELECT *,s48_predmet.id as idPredmeta,DATE_ADD(s48_predmet.datum, INTERVAL 1 DAY) AS prekosutra,s48_klase.naziv AS nsluzba,s48_klase.id AS sif_sluzba, s48_statusi.naziv AS nstatus FROM s48_predmet LEFT JOIN s48_klase on s48_predmet.sluzba=s48_klase.id LEFT JOIN s48_statusi ON s48_predmet.status=s48_statusi.id WHERE s48_predmet.aktivan=1 LIMIT ".$pocetak.",10");
	
		
		?>
		<div class="box" style="padding:1px;margin:1px">
			<table class="lista" style="padding:1px;margin:1px">
				<tr><th>id</th><th>Broj<th>Sluzba</th><th>Naslov</th><th>Status</th><th>Datum<br>prijema</th><th>Status</th><th></th></tr>
				<?php
				$i=1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['idPredmeta'];
				$status=$row['nstatus'];
				$status=$row['status'];
				$naslov=$row['naslov'];
				$sluzba=$row['nsluzba'];
				$poruka=$row['poruka'];
				$godina=$row['godina'];
				$sif_sluzba=$row['sif_sluzba'];
				$datum = strtotime($row['datum']);
				
			//	echo $row['prekosutra'];
				$datum = date("d.m.Y", $datum);
				$email=$row['email'];
				$oemail=$row['oemail'];
				$osms=$row['osms'];
				$oweb=$row['oweb'];
				$otelefon=$row['otelefon'];
				$link="predmeti.php?id=".$id."&sluzba=".urlencode($sluzba)."&naslov=".urlencode($naslov)."&status=".urlencode($status)."&poruka=".urlencode($poruka)."&sif_sluzba=".urlencode($sif_sluzba)."&godina=".urlencode($godina)."&datum=".urlencode($datum)."&email=".urlencode($email)."&oemail=".urlencode($oemail)."&otelefon=".urlencode($otelefon)."&osms=".urlencode($osms)."&oweb=".urlencode($oweb)."&status=".urlencode($status);
				if (date("d.m.Y")>strtotime($datum."+ 1 days"))	echo "<tr><td>".$i."</td><td>".$id."</td><td><a href='".$link."'>".$row['nsluzba']."</a></td><td style='max-width:30%'><a href=".$link.">".$row['naslov']."</a></td><td><a href=".$link.">".$row['nstatus']."</a></td><td style='max-width:30%;background:red;border-color:#ff0000'><a href=".$link.">".$datum."</a></td><td><a href=".$link.">".$row['nstatus']."</a></td><td><a href='predmeti.php?del=$id'>x</a></td></tr>";
				else echo "<tr><td>".$i."</td><td>".$id."</td><td><a href='".$link."'>".$row['nsluzba']."</a></td><td style='max-width:30%'><a href=".$link.">".$row['naslov']."</a></td><td><a href=".$link.">".$row['nstatus']."</a></td><td style='max-width:30%'><a href=".$link.">".$datum."</a></td><td><a href=".$link.">".$row['nstatus']."</a></td><td><a href='predmeti.php?del=$id'>x</a></td></tr>";
				
				$i=$i+1;
				}
				?>
			</table>
			
		</div>
		<?php	
		if (isset($_GET['id']))
		{
		$naslov=$_GET['naslov'];
		$poruka=$_GET['poruka'];
		$godina=$_GET['godina'];
		$datum=$_GET['datum'];
		$status=$_GET['status'];
		$sif_sluzba=$_GET['sif_sluzba'];
		$id=$_GET['id'];
		$oemail=$_GET['oemail'];
		$oweb=$_GET['oweb'];
		$email=$_GET['email'];
		?>
		<form method="post" action="predmeti.php">
		<div class="box">
		
		<p style="text-align:left">Broj:<?php echo $id?>-<?php echo $sif_sluzba?>-<?php echo $godina?>&nbsp&nbsp&nbsp&nbsp Datum:<?php echo $datum?></p>
		<p style="text-align:left">Naslov:<?php echo $naslov?></p>
		<p style="text-align:left"><?php 
		if ($oemail=='1') echo "Email:<input type=checkbox checked>";else echo "Email:<input type=checkbox>";
		if ($otelefon=='1') echo "Telefon:<input type=checkbox checked>";else echo "Telefon:<input type=checkbox>";
		if ($osms=='1') echo "SMS:<input type=checkbox checked>";else echo "SMS:<input type=checkbox>";
		if ($oweb=='1') echo "Webportal:<input type=checkbox checked>";else echo "Webportal:<input type=checkbox>";?>
		</p>
		<p style="text-align:left">Status:
		<?php 
		$rezultat=$mysqli->query("SELECT * FROM s48_statusi");
		$mysqli->dropdown($rezultat,"status","status","id");
		?>
		<br>
		<textarea rows=10 name=tekst onfocus="blur()" style="width:50%"><?php echo $poruka ?></textarea>
		<p style="text-align:left">Odgovor:<br>
		<textarea rows=10 name=odgovor style="width:50%"></textarea></p>
		<input type=hidden name="izmeni" value="izmeni">
		<input type=hidden name="email" value=<?php echo $email?>>
		<input type=text name="email" value=<?php echo $email?>>
		<input type=hidden name="id" value='<?php echo $_GET['id'];?>'>
		
		<input type="submit" value="Odgovori" name="poruka"><a href='odgovori.php?id=<?php echo $id?>'><input type=button value="Pregled odgovora"></a>
		</div>
		</form>	 
		<?php
		}
		
		/** ******* Ovaj kod stoji ovde za slucaj da se pravi zavodjenje zahteva preko ove forme **********************************
		if (!isset($_GET['id']))
		{
		?>
		<form method="post" action="kategorije.php" id="unesi" style="display:none">
			Unos nove kategorije
			<div class="box">	 
				Naziv:<br><input type="text" name="naziv"><br>
				<input type=hidden name="unesi" value="unesi">
				<input type="submit" value="Unesi">
			</div>
		</form>	 
		<?php
		}
		*/?>
	</article>
 </section>
<?php include "footer.php"?>
 </div>
</div>
