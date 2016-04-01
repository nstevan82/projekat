<?php include "header.php";
?>
<body>
<div id='big_wrapper'>
     <section id="main_section">
		<?php include "meni.php" ?>
		<article>	 
		<?php
	

		$brzahteva=$_GET['id'];
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
		
		<p style="text-align:left">Broj:<?php echo $id?>&nbsp Datum:<?php echo $datum?></p>
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
		?>
	</article>
 </section>
<?php include "footer.php"?>
 </div>
</div>
