<?php
if (!isset($_SESSION['blagajna'])) {
	echo "<div class=box>Odaberite blagajnu za koju uredjujete izlaze (iz opcije [Blagajna])</div>";
	die();
	}
if (isset($_POST['unesi'])){
	$izlaz=$_POST['izlaz'];
	$blagajna=$_SESSION['blagajna'];
	$opisi=$_POST['opisi'];
	$rezultat= $mysqli->query("INSERT INTO rac_blagajna_izlaz (izlaz,blagajna,opisi,aktivan) VALUES ('$izlaz','$blagajna','$opisi',1)");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$izlaz=$_POST['izlaz'];
		$opisi=$_POST['opisi'];
		$blagajna=$_SESSION['blagajna'];
		$id=$_POST['id'];
		$rezultat= $mysqli->query("UPDATE rac_blagajna_izlaz SET opisi='$opisi',izlaz='$izlaz',blagajna='$blagajna' WHERE id='$id'");
	}
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_blagajna_izlaz"); //deaktiviraj manipulaciju
		}

		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_blagajna_izlaz WHERE aktivan=1 AND blagajna='$blagajna'","blagajna_izlaz");

		$rezultat= $mysqli->query("SELECT *,rac_blagajna_izlaz.id AS id1
		FROM rac_blagajna_izlaz		
		WHERE rac_blagajna_izlaz.aktivan=1 
		AND blagajna='$blagajna'
		LIMIT $pocetak,10");
	  	?>

		<div class="box">
		<?php if (isset($_SESSION['blagajna'])) echo "<b>RADNI NALOG:".$_SESSION['blagajna']."/".$akt_godina."</b><br>";?>
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>izlaz</th><th>Opis</th><th></th></tr>
				<?php
				$i=10*($_GET['strana'])+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$izlaz=$row['izlaz'];
				$link="default.php?str=blagajna_izlaz&id=$id";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$row['izlaz']."</a></td><td><a href='$link'>".$row['opisi']."</a></td><td><a href='default.php?str=blagajna_izlaz&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog izlaza" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE
$izlaz1="";
$blagajna1="";
$opisi1="";
// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_blagajna_izlaz WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$izlaz1=$row['izlaz'];
				$blagajna1=$row['blagajna'];
				$opisi1=$row['opisi'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
<input type=text name=izlaz value='<?= $izlaz1?>'><br>
Opis izlaza<br>
<textarea name=opisi><? echo $opisi1 ?></textarea>
		<input type="hidden" value=blagajna_izlaz name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
