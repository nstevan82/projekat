<?php include "header.php" ?>
<body>
<div id='big_wrapper'>
     <section id="main_section">
		<?php include "meni.php" ?>
		<article>	 
		<?php
		if (isset($_POST['unesi']))
		{
		$naziv=$_POST['naziv'];
		$rezultat= $mysqli->query("INSERT INTO s48_klase (naziv) VALUES ('$naziv')");
		}
		if (isset($_POST['izmeni']))
		{
			$naziv=$_POST['naziv'];
			$id=$_POST['id'];
			$naziv=$_POST['naziv'];
			$rezultat= $mysqli->query("UPDATE s48_klase SET naziv='$naziv' WHERE id='$id'");
		}
		if (isset($_REQUEST['del'])) {
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//obrisi("s48_klase","klasa","s48_pitanja");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli s48_korisnici zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		
		$mysqli->deaktiviraj($_REQUEST['del'],'s48_klase');
		if (isset($_POST['del_update'])){
			$vrednost=$_POST['del_update'];
			$obrisan=$_POST['del'];
			
			$rezultat= $mysqli->query("UPDATE s48_korisnici SET grupa='$vrednost' WHERE grupa='$obrisan'");
			}
		}
		$pocetak=$mysqli->paginacija("SELECT COUNT(ID) AS broj FROM s48_klase WHERE aktivan=1");
		//$rezultat= $mysqli->query("SELECT * FROM s48_klase LIMIT $pocetak,10");
		$rezultat= $mysqli->query("SELECT * FROM s48_klase WHERE aktivan=1 LIMIT $pocetak,10");
		
		?>
		<div class="box">
			<table class="lista">
				<tr><th>id</th><th>Naziv</th><th></th></tr>
				<?php
				$i=1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id'];
				$naziv=$row['naziv'];
				echo "<tr><td>".$i."</td><td><a href='kategorije.php?id=$id&naziv=$naziv'>".$row['naziv']."</a></td><td><a href='kategorije.php?del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<input type="button" value="Unos nove ustanove" onclick="sklopi('unesi');">
		</div>
		<?php	
		if (isset($_GET['id']))
		{
		?>
		<form method="post" action="kategorije.php">
		Izmena kategorije
		<div class="box">	 
		Naziv:<br><input type="text" name="naziv"   value='<?php echo $_GET['naziv'] ?>'><br>
		<input type=hidden name="izmeni" value="izmeni">
		<input type=hidden name="id" value='<?php echo $_GET['id'];?>'>
		<input type="submit" value="Unesi">
		</div>
		</form>	 
		<?php
		}
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
		?>
	</article>
 </section>
<?php include "footer.php"?>
 </div>
</div>
