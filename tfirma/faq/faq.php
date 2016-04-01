<body>
<?php include "header.php" ?>
<div id='big_wrapper'>
     <section id="main_section">
     <?php include "meni.php" ?>
     <article>	 
	 <?php
//if (!isset($_SESSION['jmbg'])) die ('Niste odabrali radnika. Kliknite na opciju <b>Radnik</b> u meniju da biste odabrali radnika.');// provera da li je odabran radnik
	if (isset($_POST['unesi']))
	{
	$kategorija=$_POST['klasa'];
	$pitanje=$_POST['pitanje'];
	$odgovor=$_POST['odgovor'];
	$odgovor=str_replace("","* ",$odgovor);
	$rezultat= $mysqli->query("INSERT INTO s48_pitanja(pitanje,odgovor,klasa) VALUES ('$pitanje','$odgovor','$kategorija')");
	}
	if (isset($_POST['izmeni']))
	{
	$kategorija=$_POST['kategorija'];
	$pitanje=$_POST['pitanje'];
	$odgovor=$_POST['odgovor'];
	
	$odgovor=str_replace("","* ",$odgovor);
			
	$id=$_POST['id'];
	$rezultat= $mysqli->query("UPDATE s48_pitanja SET pitanje=$pitanje,odgovor=$odgovor,klasa=$kategorija WHERE id='$id'");
	}
		if (isset($_GET['del']))
	{
		$del=$_GET['del'];
		//obrisi("s48_klase","klasa","s48_pitanja");// kod vezan za brisanje stavke iz sifarnika 
// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		$rezultat= $mysqli->query("DELETE FROM s48_pitanja WHERE id=$del");
	}
	$pocetak=$mysqli->paginacija("SELECT COUNT(pitanje) as broj FROM s48_pitanja LEFT JOIN s48_klase on s48_pitanja.klasa=s48_klase.id ");
	$rezultat= $mysqli->query("SELECT * ,s48_pitanja.id as id1, s48_klase.naziv as nklasa  FROM s48_pitanja LEFT JOIN s48_klase on s48_pitanja.klasa=s48_klase.id LIMIT $pocetak,10");
?>
<div class="box">
<table class="lista">
<tr><th>Redni broj</th><th>Pitanje</th><th>Odgovor</th><th>Klasa</th><th></th></tr>
<?php
$rb=1;
WHILE ($row = $rezultat->fetch_assoc())
{$id=$row['id1'];
$pitanje=$row['pitanje'];
$odgovor=$row['odgovor'];
$vrsta=$row['klasa'];
if (isset($_GET['strana'])) $broj=$_GET['strana']*10+$rb;
else $broj=$rb;
$link="faq.php?id=$id&pitanje='".urlencode($row['pitanje'])."'&odgovor='".urlencode($row['odgovor'])."'&vrsta=".urlencode($row['klasa']);
echo "<tr><td><a href=$link>".$broj."</a></td><td style='text-align:left'><a href=$link>".$row['pitanje']."</a></td><td style='text-align:justify'><a href=$link>".$row['odgovor']."</a></td><td><small><a href=$link>".$row['nklasa']."</a></small></td><td><a href='faq.php?del=$id'>x</a></td></tr>";
$rb++;
}
?>
</table>
<input type="button" value="Dodaj pitanje" onclick="sklopi('unesi')">
</div>
<?php	
	if (isset($_GET['id']))
	{
	?>
<form method="post" action="faq.php" id="unesi" style="display:box">
Izmena podataka
	 <div class="box">	 
     <p>Kategorija<br>
	<?php 
	$odgovor=$_GET['odgovor'];
	$pitanje=$_GET['pitanje'];
	$vrsta=$_GET['vrsta'];
	
	$rezultat=$mysqli->query("SELECT * FROM s48_klase");
	$mysqli->dropdown($rezultat,'kategorija','vrsta','id');
			
	?>
	 </p>
	 <p>Pitanje:<br><textarea name="pitanje" cols="90" rows="10" n><?php echo $pitanje ?></textarea></p>
	 <p>Odgovor:<br><textarea name="odgovor" cols="90" rows="10" n><?php echo $odgovor ?></textarea></p>

	<input type=hidden name=id value=<?php echo $_GET['id']; ?>>
	 <input type=hidden name="izmeni" value="izmeni">
	 <input type="submit" value="Izmeni">
	 </div>
</form> 
	<?php
	}
if (!isset($_GET['id']))
{
?>
<form method="post" action="faq.php" id="unesi" style="display:none">
Unos pitanja
	 <div class="box">	 
     	<p>	Kategorija
		
		<?php
		$rezultat= $mysqli->query("SELECT * FROM s48_klase");
		$mysqli->dropdown($rezultat,"klasa","","naziv");
		?>
		</p>
	 <p>Pitanje:<br><textarea cols="90" rows="10" name="pitanje" ></textarea></p>
	 <p>Odgovor:<br><textarea cols="90" rows="10" name="odgovor"></textarea></p>
	 <input type=hidden name="unesi" value="unesi">
	 <input type="submit" name="unesi "value="Unesi">
	 </div>
</form>	 
<?php
}
?>
	</article>
 </section>
<?php include "footer.php"?>
 </div>
</div>
</html>