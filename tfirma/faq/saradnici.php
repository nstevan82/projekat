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
	$klasa=$_POST['klasa'];
	$user=$_POST['user'];
	$id=$_POST['id'];
	$rezultat=query("INSERT INTO s48_korisnici(user,grupa) VALUES ('$user','$klasa')");
	}
	if (isset($_POST['izmeni']))
	{
	$klasa=$_POST['klasa'];
	$user=$_POST['user'];
	$id=$_POST['id'];
	$rezultat=$mysqli->query("UPDATE s48_korisnici SET grupa='$klasa', user='$user' WHERE id='$id'");
	
	}
		if (isset($_GET['del']))
	{
		$del=$_GET['del'];
		//$mysqli->obrisi("s48_korisnici","klasa","s48_korisnici");// kod vezan za brisanje stavke iz sifarnika 
// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$rezultat=$mysqli->query("DELETE FROM s48_korisnici WHERE id=$del");
		$mysqli->deaktiviraj($del,'s48_korisnici');
	}
	$pocetak=$mysqli->paginacija("SELECT COUNT(s48_korisnici.id) as broj FROM s48_korisnici LEFT JOIN s48_klase on s48_korisnici.grupa=s48_klase.id WHERE s48_korisnici.aktivan=1");
	$rezultat=$mysqli->query("SELECT * ,s48_korisnici.id as id1, s48_klase.naziv as nklasa  FROM s48_korisnici LEFT JOIN s48_klase on s48_korisnici.grupa=s48_klase.id LEFT JOIN adm_korisnici on s48_korisnici.user=adm_korisnici.username  WHERE s48_korisnici.aktivan=1 ORDER BY s48_korisnici.grupa LIMIT $pocetak,10 ");
?>
<div class="box">
<table class="lista">
<tr><th>Redni broj</th><th>Ustanova</th><th>Ime i prezime</th><th>Telefon</th><th>e-mail</th><th>Korisnik</th><th></th></tr>
<?php
$rb=1;
while ($row = $rezultat->fetch_assoc()) 
{$id=$row['id1'];
$ustanova=$row['nklasa'];
$ime=$row['ime'];
$prezime=$row['prezime'];
$telefon=$row['telefon'];
$email=$row['email'];
if (isset($_GET['strana'])) $broj=$_GET['strana']*10+$rb;
else $broj=$rb;
$link="saradnici.php?id=$id&ustanova=".urlencode($row['nklasa'])."&ime=".urlencode($row['ime'])."&prezime=".urlencode($row['prezime'])."&email=".urlencode($row['email'])."&telefon=".urlencode($row['telefon'])."&grupa=".urlencode($row['grupa'])."&user=".urlencode($row['username']);
echo "<tr><td><a href=$link>".$broj."</a></td><td><small><a href=$link>".$row['nklasa']."</a></small></td><td><a href=$link>".$row['ime']." ".$row['prezime']."</a></td><td><a href=$link>".$row['telefon']."</a></td><td><a href=$link>".$row['email']."</a></td><td><a href=$link>".$row['user']."</a></td><td><a href='saradnici.php?del=$id'>x</a></td></tr>";
$rb++;
}
?>
</table>

</div>
<?php	
	if (isset($_GET['id']))
	{
	?>
<form method="post" action="saradnici.php" id="unesi" style="display:box">
Izmena podataka
	 <div class="box">	 
     <p>Kategorija<br>
	<?php 
	$user=$_GET['user'];
	?>
	 </p>
	 <p>Ustanova:<br><?php
	 $rezultat=$mysqli->query("SELECT * FROM s48_klase");
		$mysqli->dropdown($rezultat,"klasa","grupa","id");?>
	  </p>
	 <p>Korisnicko ime:<br><input type=text name="user" value=<?php echo $user ?>></p>
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
<form method="post" action="saradnici.php" id="unesi" style="display:none">
Unos podataka
	 <div class="box">	 
     	<p>	Ustanova
		<?php
		$rezultat=$mysqli->query("SELECT * FROM s48_klase");
		$mysqli->dropdown($rezultat,"klasa","","naziv");
		?>
		</p>
	 <p>Korisnicko ime:<br><input type=text name="user"></p>
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
