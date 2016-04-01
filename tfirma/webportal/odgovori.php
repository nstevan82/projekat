
<body>
<div id='big_wrapper' style="border:0px">
<?php include "header.php";?>
     <section id="main_section">
		
		<article>	 
<form action="odgovori.php" method="post">
Unesite broj vaseg zahteva &nbsp
<input type=text name="id">
<input type=submit value="Potrazi">
</form>	


	<?php
		if (isset($_POST['id'])){
		$brzahteva=$_POST['id'];
		$rezultat= $mysqli->query("SELECT *,s48_predmet.id as idPredmeta,s48_klase.naziv AS nsluzba,s48_klase.id AS sif_sluzba, s48_statusi.naziv AS nstatus FROM s48_predmet LEFT JOIN s48_klase on s48_predmet.sluzba=s48_klase.id LEFT JOIN s48_statusi ON s48_predmet.status=s48_statusi.id WHERE s48_predmet.id='$brzahteva'");
		?>
		<div class="box" >
		
				
				<?php
				$i=1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$naslov=$row['naslov'];
				$poruka=$row['poruka'];
				$godina=$row['godina'];
				$datum=$row['datum'];
				$status=$row['status'];
				$sif_sluzba=$row['sif_sluzba'];
				$oemail=$row['oemail'];
				$osms=$row['osms'];
				$otelefon=$row['otelefon'];
				$oweb=$row['oweb'];
			?>
				<p style="text-align:left">Broj:<?php echo $brzahteva?>-<?php echo $sif_sluzba?>-<?php echo $godina?>&nbsp&nbsp&nbsp&nbsp Datum:<?php echo $datum?></p>
				<p style="text-align:left">Naslov:<?php echo $naslov?></p>
				<p style="text-align:left"><?php 
				if ($oemail=='1') echo "Email:<input type=checkbox checked disabled>";else echo "Email:<input type=checkbox disabled>";
				if ($otelefon=='1') echo "Telefon:<input type=checkbox checked disabled>";else echo "Telefon:<input type=checkbox disabled>";
				if ($osms=='1') echo "SMS:<input type=checkbox checked disabled>";else echo "SMS:<input type=checkbox disabled>";
				if ($oweb=='1') echo "Webportal:<input type=checkbox checked disabled>";else echo "Webportal:<input type=checkbox disabled> ";?>
				</p>
				
				<textarea rows=10 name=tekst onfocus="blur()" style="width:50%"><?php echo $poruka ?></textarea>
				<?php
		}		?>
			
				
		</div>
		<?php	
		if (isset($_POST['id']))
		{				
		$rezultat= $mysqli->query("SELECT *,s48_statusi.naziv AS nstatus,s48_poruke.obradjivac AS nobradjivac FROM s48_poruke LEFT JOIN s48_statusi ON s48_poruke.status=s48_statusi.id WHERE brzahteva=$brzahteva");
	  	?>
		<div class="box">
			<table class="lista">
			<?php
				$i=1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id'];
				$datum = strtotime($row['datum']);
				$datum = date("d.m.Y", $datum);
				$poruka=$row['poruka'];
				$nobradjivac=$row['nobradjivac'];
				$nstatus=$row['nstatus'];
					
				?>
				<div class="box">
		
		<p style="text-align:left">Datum:<?php echo $datum?></p>
		<p style="text-align:left">
		</p>
		<p style="text-align:left">Status:<?php echo $nstatus;	?>
		<br>
		<textarea rows=5 name=tekst onfocus="blur()" style="width:50%"><?php echo $poruka ?></textarea><br>
		<?php echo "Obradjivac:".$nobradjivac; ?>
		</div>
		<?php
				$i=$i+1;
				}
				?>				
		</div>
		<?php	
		if (isset($_GET['id']))
		{
		?>
		<?php
		}
		}}
		?>
	</article>
 </section>
<?php include "footer.php"?>
 </div>
</div>

