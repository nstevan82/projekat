<?php include "header.php";
?>
<body>
<div id='big_wrapper'>
     <section id="main_section">
		<?php include "meni.php" ?>
		<article>	 
		<?php
		if (isset($_POST['unesi']))
		{
		$naziv=$_POST['naziv'];
	   
	   
	   $rezultat= $mysqli->query("INSERT INTO s48_statusi (naziv) VALUES ('$naziv')");
	   
		}
		if (isset($_POST['izmeni']))
		{
			$naziv=$_POST['naziv'];
			$id=$_POST['id'];
			$rezultat= $mysqli->query("UPDATE s48_statusi SET naziv='$naziv' WHERE id='$id'");
	}
		if (isset($_REQUEST['del'])) {
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		$mysqli->obrisi("s48_statusi","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli s48_statusi zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		if (isset($_POST['del_update'])){
			$vrednost=$_POST['del_update'];
			$obrisan=$_POST['del'];
			
			$rezultat= $mysqli->query("UPDATE s48_korisnici SET grupa='$vrednost' WHERE grupa='$obrisan'");
			}
		}
		$pocetak=$mysqli->paginacija("SELECT COUNT(ID) AS broj FROM s48_statusi");
		$rezultat= $mysqli->query("SELECT * FROM s48_statusi LIMIT $pocetak,10");
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
				echo "<tr><td>".$i."</td><td><a href='statusi.php?id=$id&naziv=$naziv'>".$row['naziv']."</a></td><td><a href='statusi.php?del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<input type="button" value="Unos novog statusa" onclick="sklopi('unesi')">
		</div>
		<?php	
		if (isset($_GET['id']))
		{
		?>
		<form method="post" action="statusi.php">

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
		<form method="post" action="statusi.php" id="unesi" style="display:none">
			Unos nove kategorije
			
			<?php 
		
		
		
		?>
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
