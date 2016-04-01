<?php
if (!isset($_SESSION['br_ulaza'])) {
	echo "<div class=box>Odaberite blagajnu za koju uredjujete izlaz (iz opcije [Izlaz])</div>";
	die();
	}
if (isset($_POST['unesi'])){
	$datum=string2datum($_POST['datum']);
	$kolicina=$_POST['kolicina'];
	$br_ulaza=$_SESSION['br_ulaza'];
	$komada=$_POST['komada'];
	$vrednosti=$_POST['vrednosti'];
	$br_odjave=$_POST['br_odjave'];
	$rezultat= $mysqli->query("INSERT INTO mag_izlaz (datumi,vrednosti,kolicina,br_ulaza,komada,br_odjave,id_ulaza,aktivan) VALUES ('$datum','$vrednosti','$kolicina','$br_ulaza','$komada','$br_odjave',$id_ulaza,1)");	   
		}
		if (isset($_POST['izmeni']))
		{
		$datum=string2datum($_POST['datum']);
		$kolicina=$_POST['kolicina'];
		$komada=$_POST['komada'];
		$br_odjave=$_POST['br_odjave'];
		$vrednosti=$_POST['vrednosti'];
		$br_ulaza=$_SESSION['br_ulaza'];
		$id=$_POST['id'];
		$rezultat= $mysqli->query("UPDATE mag_izlaz SET 
		komada='$komada', 
		kolicina='$kolicina',	
		vrednosti='$vrednosti',
		br_ulaza='$br_ulaza',
		br_odjave='$br_odjave',
		datumi='$datum'	
		WHERE id='$id'");
	}
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"mag_izlaz"); //deaktiviraj manipulaciju
		}

		$pocetak=$mysqli->paginacija1("SELECT COUNT(mag_izlaz.ID) AS broj FROM 
		(
		SELECT * FROM 
		mag_ulaz 
		WHERE skladiste='$skladista') AS mag_ulaz1
		
		
		LEFT JOIN mag_izlaz		
		ON mag_ulaz1.id=mag_izlaz.id_ulaza
		WHERE mag_izlaz.aktivan=1 
		AND skladiste='$skladista'
		AND br_ulaza='$br_ulaza'
		AND mag_ulaz1.aktivan=1
		AND mag_izlaz.aktivan=1
		AND godina=$akt_godina
		","izlaz");

		$rezultat= $mysqli->query("SELECT *,mag_izlaz.id AS id1		
		FROM 
		(
		SELECT * FROM 
		mag_ulaz 
		WHERE skladiste='$skladista') AS mag_ulaz1
		
		LEFT JOIN mag_izlaz		
		ON mag_ulaz1.id=mag_izlaz.id_ulaza
		WHERE mag_izlaz.aktivan=1 
		AND skladiste='$skladista'
		AND br_ulaza='$br_ulaza'
		AND mag_ulaz1.aktivan=1
		AND mag_izlaz.aktivan=1
		AND godina=$akt_godina
		LIMIT $pocetak,10");
	  	?>

		<div class="box">
		<?php if (isset($_SESSION['br_ulaza'])) echo "<b>Pozicija:".$_SESSION['br_ulaza']."/".$_SESSION['odabrano_skladiste']."</b><br>";?>
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Kolicina</th><th>Komada</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$kolicina=$row['kolicina'];
				$link="default.php?str=izlaz&id=$id";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$row['kolicina']."</a></td><td><a href='$link'>".$row['komada']."</a></td><td><a href='default.php?str=izlaz&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog izlaza" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE
$kolicina1="";
$br_ulaza1="";
$komada1="";
$br_odjave1="";
$vrednosti1="";
$datum1="";
// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM mag_izlaz WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$datum1=date("d.m.Y", strtotime($row['datumi'])); 
				$id1=$row['id'];
				$kolicina1=$row['kolicina'];
				$br_ulaza1=$row['br_ulaza'];
				$komada1=$row['komada'];
				$br_odjave1=$row['br_odjave'];
				$vrednosti1=$row['vrednosti'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?> >
<form method="post" action="default.php">
Datum izlaza:<br>
<input type="text" name="datum" value='<?php echo $datum1?>' placeholder="dd.mm.gggg"><br>	
Kolicina<br>
<input type=text name=kolicina value='<?= $kolicina1?>'><br>
Komada<br>
<input type=text name=komada value=<? echo $komada1 ?> ><br>
Carinski akt/Customs document<br>
<input type=text name=br_odjave value=<? echo $br_odjave1 ?> ><br>
Vrednost izlaza<br>
<input type=text name=vrednosti value=<? echo $vrednosti1 ?> ><br>
		<input type="hidden" value=izlaz name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>

