<div class='box'>
<form action='default.php' method=post>
<input type=text name=mesec placeholder='mesec(cifra)'>
<input type=text name=godina placeholder='godina' value='<?= $akt_godina;?>'>
<input type=hidden name=str value='isplate'>
<input type=submit name=pretraga value='Prikazi'>
</form>
</div>
<?php
if (isset($_POST['pretraga'])){
$_SESSION['mesec']=$_POST['mesec'];
$_SESSION['godina']=$_POST['godina'];
}
if (ISSET($_SESSION['mesec'])) $mesec=$_SESSION['mesec'];
else $mesec=0;
if (ISSET($_SESSION['godina'])) $godina=$_SESSION['godina'];
else $godina=$akt_godina;

if (isset($_POST['unesi']) || isset($_POST['izmeni'])){
				$datum=string2datum($_POST['datum']);
				$bruto=$_POST['bruto'];
				$neto=$_POST['neto'];
				$fond=$_POST['fond'];
				$radnik=$_POST['radnik'];
				$mesec=$_POST['mesec'];
		if (isset($_POST['id'])) $id=$_POST['id'];



		
		
		

if (isset($_POST['unesi'])){
	  
	   $rezultat= $mysqli->query("INSERT INTO rac_isplata (godina,datum,bruto,neto,fond,radnik,mesec,aktivan) VALUES ('$akt_godina','$datum','$bruto','$neto','$fond','$radnik','$mesec',1)");
	   
		}
		if (isset($_POST['izmeni']))
		{
		$rezultat= $mysqli->query("UPDATE rac_isplata SET godina='$akt_godina',mesec='$mesec',datum='$datum',bruto='$bruto',neto='$neto',fond='$fond',radnik='$radnik' WHERE id='$id'");
	}
}	
	
	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_isplate");
		// obrisi("brisi stavku iz tabele $prve, a zameni podatak u koloni $druga koja se nalazi u tabeli $treca")
		//$mysqli->obrisi("mg_magacini","status","s48_predmet");// kod vezan za brisanje stavke iz sifarnika 
		// u tabeli mg_magacini zameni podatak o obrisanoj tabeli u koloni grupa, podatkom o tabeli u koju su prebacena pitanja i odgovori
		}
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_isplata WHERE aktivan=1 AND mesec='$mesec' AND godina='$godina'","isplate");
		$rezultat= $mysqli->query("SELECT *,rac_isplata.id AS id1 FROM rac_isplata LEFT JOIN ks_radnik ON rac_isplata.radnik=ks_radnik.id  
		WHERE rac_isplata.aktivan=1  AND mesec='$mesec' AND rac_isplata.godina='$godina' LIMIT $pocetak,10");
	  	?>

		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Rb</th><th>Datum</th><th>Zaposleni</th><th>Bruto</th><th>Neto</th><th>Fond h</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				while ($row = $rezultat->fetch_assoc()) 
				{
				$id=$row['id1'];
				$datum=date("d.m.Y", strtotime($row['datum'])); 
				$link="default.php?str=isplate&id=$id";
				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$datum."</a></td><td>".$row['ime']." ".$row['prezime']."</td><td><a href='$link'>".$row['bruto']."</a></td><td><a href='$link'>".$row['neto']."</a></td><td><a href='$link'>".$row['fond']."</a></td><td><a href='default.php?str=kupci&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog stanja" onclick="sklopi('unesi')">
		</div>



<?php // ##### ako je izabrano nesto iz tabele ######
//ovde upisi defaultne vrednosti da budu PRAZNE

				$datum1="";
				$radnik1=0;
				$bruto1="";
				$neto1="";
				$fond1="";
				$mesec1="";


// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze

		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_isplata WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$datum1=date("d.m.Y", strtotime($row['datum'])); 				
				$bruto1=$row['bruto'];
				$neto1=$row['neto'];
				$radnik=$row['radnik'];			
				$fond1=$row['fond']; 				
				$mesec1=$row['mesec']; 	
				
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">
		Mesec<br>
		<input type="text" name="mesec" value='<?php echo $mesec1?>' placeholder='(1 - 12)'><br>		
		Isplate<br>
		Datum isplate:<br><input type="text" name="datum" value='<?php echo $datum1?>' placeholder='dd.mm.gggg'><br>		
		<?php
		if (!isset($radnik)) $radnik=0;
		$rezultat=$mysqli->query("SELECT *,CONCAT(ime,' ',prezime,' ',jmbg) AS naziv FROM ks_radnik");
			$mysqli->dropdown1($rezultat,'radnik',$radnik,'id');
		?>
		<br>
		Bruto:<br><input type="text" name="bruto" value='<?php echo $bruto1?>'><br>		
		Neto:<br><input type="text" name="neto" value='<?php echo $neto1?>'><br>		
		Fond casova:<br><input type="text" size=5 name="fond" value='<?php echo $fond1?>'>&nbsp h<br>		
		
		<input type="hidden" value=isplate name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
