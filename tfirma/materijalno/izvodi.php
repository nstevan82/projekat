

<?php
if (isset($_POST['unesi']) || isset($_POST['izmeni'])){
		$br_izvoda=$_POST['br_izvoda'];
		$dat_izv1=date("d.m.Y", strtotime($_POST['dat_izv'])); 

		$br_izvoda1=$_POST['br_izvoda'];
		$dat_izv=string2datum($_POST['dat_izv']);
		$isplate=$_POST['isplate'];
		$brdob=$_POST['brdob'];
		$brfa=$_POST['brfa'];
		$uplate=$_POST['uplate'];
		$napomena=$_POST['napomena'];
		$banke=$_POST['banke'];
		$kupci=$_POST['kupci'];
		$dobavljaci=$_POST['dobavljaci'];		
		$banka=$_POST['banke'];
		$kupac=$_POST['kupci'];
		$dobavljac=$_POST['dobavljaci'];
		$id=$_POST['id'];
		if (isset($_POST['unesi'])){
	   $rezultat= $mysqli->query("INSERT INTO rac_izvodi (godina,banka,kupac,dobavljac,br_izvoda,dat_izv,isplate,uplate,napomena,brdob,brfa,aktivan) VALUES ('$akt_godina','$banke','$kupci','$dobavljaci','$br_izvoda','$dat_izv','$isplate','$uplate','$napomena','$brdob','$brfa',1)");
		}
		if (isset($_POST['izmeni']))
		{
		$rezultat= $mysqli->query("UPDATE rac_izvodi SET godina='$akt_godina',dat_izv='$dat_izv',br_izvoda='$br_izvoda',isplate='$isplate',uplate='$uplate',napomena='$napomena',brdob='$brdob',brfa='$brfa',dobavljac=$dobavljac,kupac=$kupac,banka=$banka WHERE id='$id'");
	}
}	
	if (isset($_REQUEST['del'])) {
		$rezultat= $mysqli->deaktiviraj($_REQUEST['del'],"rac_izvodi");
		}
		
		?>
		<div class="box">
	<form action="default.php" method=post>
			Banka:
			<?php		
			$rezultat=$mysqli->query("SELECT * FROM rac_banke WHERE aktivan=1");
			$mysqli->dropdown1($rezultat,'banke','','id');
			?>			
		<input type=hidden name=str value='izvodi'>
		<input type=submit name=pretraga value="Trazi">
		<input type=checkbox name=svebanke>Pretrazi sve banke
	</form>
</div>

<?php
if (isset($_POST['pretraga'])){ // ako je odabrana banka sa kojom se radi prikazi samo izvode sa tom bankom
	$_SESSION['banka']=$_POST['banke'];
	if (isset($_POST['svebanke'])) $_SESSION['banka']='%';
	}	
	if (isset($_SESSION['banka'])){//zapamti banku u sesiji banka
$odabrana_banka=$_SESSION['banka'];



		
		$pocetak=$mysqli->paginacija1("SELECT COUNT(ID) AS broj FROM rac_izvodi WHERE banka like '$odabrana_banka' AND godina='$akt_godina' AND aktivan=1","izvodi");
		$rezultat= $mysqli->query("
		SELECT *,rac_izvodi.id AS id1,rac_banke.naziv AS n_banke,rac_kupci.naziv AS kupac1,rac_dobavljaci.naziv AS dobavljac1 FROM rac_izvodi 
		LEFT JOIN rac_kupci ON rac_izvodi.kupac=rac_kupci.id 
		LEFT JOIN rac_dobavljaci ON rac_izvodi.dobavljac=rac_dobavljaci.id
		LEFT JOIN rac_banke ON rac_izvodi.banka=rac_banke.id
		WHERE banka like '$odabrana_banka' AND godina='$akt_godina' AND rac_izvodi.aktivan=1
		ORDER BY br_izvoda 
		LIMIT $pocetak,10");
	  	?>
		<div class="box">

<?php
while ($row = $rezultat->fetch_assoc()) {
$banka=$row['n_banke'];
$row_array[]=$row;
}
echo "IZVODI:".$banka."<br>";
?>		
		<hr>
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Id</th><th>Datum izvoda</th><th>Bbr.izvoda</th><th>Kupac</th><th>Dobavljac</th><th></th></tr>
				<?php
				$i=$pocetak+1;
				foreach($row_array as $row)
				{
				$id=$row['id1'];
				$dat_izv=date("d.m.Y", strtotime($row['dat_izv'])); 				
				$link="default.php?str=izvodi&id=$id";				
				echo "<tr class='lista'><td>".$i."</td><td><a href='$link'>".$dat_izv."</a></td><td><a href='$link'>".$row['br_izvoda']."</a></td><td><a href='$link'>".$row['kupac1']."</a></td><td><a href='$link'>".$row['dobavljac1']."</a></td><td><a href='default.php?str=izvodi&del=$id'>x</a></td></tr>";
				$i=$i+1;
				}
				?>
			</table>
			<br>
			<input type="button" value="Unos novog izvoda" onclick="sklopi('unesi')">
		</div>
<?php 
}

// ##### ako je izabrano nesto iz tabele ######
	//ovde upisi defaultne vrednosti da budu PRAZNE
//	$dat_izv1="";
//	$br_izvoda1="";
	$dat_val1="";
	$isplate1="";
	$uplate1="";
	$napomena1="";
	$brfa1="";
	$brdob1="";
	$dobavljaci="";
	$kupci=0;
// #####################################################################
// a ako je korisnik kliknuo na odredjeni red iscitaj vrednosti iz baze
// #####################################################################
		if (isset($_GET['id'])){
		$id=$_GET['id'];
		$rezultat= $mysqli->query("SELECT * FROM rac_izvodi WHERE id='$id'");
		while ($row = $rezultat->fetch_assoc()) 
				{
				$id1=$row['id'];
				$dat_izv1=date("d.m.Y", strtotime($row['dat_izv'])); 
				$br_izvoda1=$row['br_izvoda'];
				$dat_val1=date("d.m.Y", strtotime($row['dat_val'])); 
				$isplate1=$row['isplate'];
				$uplate1=$row['uplate'];
				$napomena1=$row['napomena'];
				$brfa1=$row['brfa'];
				$brdob1=$row['brdob'];
				$banke=$row['banka'];
				$kupci=$row['kupac'];
				$dobavljaci=$row['dobavljac'];
				}
}
?>	
		
<div class="box" id='unesi' <?php if (!isset($_GET['id'])) echo "style='display:none'"?>>
<form method="post" action="default.php">	
		Broj izvoda:<br><input type="text" name="br_izvoda" value='<?php echo $br_izvoda1?>'><br>		
		datum izvoda:<br><input type="text" name="dat_izv" value='<?php echo $dat_izv1?>' placeholder='dd.mm.gggg'><br>			
			Banka
			<?php			
			$rezultat=$mysqli->query("SELECT * FROM rac_banke WHERE aktivan=1");
			$mysqli->dropdown1($rezultat,'banke',$banke,'id');
			?><br>
		
		
		
	<fieldset>
			<legend>Kupac:</legend>
			Kupac:
			<?php		
			$rezultat=$mysqli->query("SELECT * FROM rac_kupci WHERE aktivan=1");
			$mysqli->dropdown1($rezultat,'kupci',$kupci,'id');
			?><br>
		
			Uplate:<input type="text" name="uplate"  class='iznos'  value='<?php echo $uplate1?>'><br>	
			Br FA:<input type="text" name="brfa" value='<?php echo $brfa1; ?>' size="4" >
			<br>
	</fieldset>
		<fieldset>
			<legend>Dobavljac:</legend>
		Dobavljac:
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_dobavljaci WHERE aktivan=1");
		$mysqli->dropdown1($rezultat,'dobavljaci',$dobavljaci,'id');
		?>		
		<br>		
		Isplate:<input type="text" class='iznos' name="isplate" value='<?php echo $isplate1; ?>'><br>
		Br.Fa dobavljaca<input type="text" name="brdob" value='<?php echo $brdob1; ?>' size="4" >
		</fieldset>	
		Opis promene:<br><textarea name='napomena'><?php echo $napomena1?></textarea><br>	
		<input type="hidden" value=izvodi name="str">
		<?php if (isset($id1)) echo "<input type=hidden name=id value='$id1'>";
		if (isset($_GET['id'])) echo "<input type='submit' value='Izmeni' name='izmeni'>";
		else echo "<input type='submit' value='Unesi' name='unesi'>";
		?>		
		</form>	 
	</div>
