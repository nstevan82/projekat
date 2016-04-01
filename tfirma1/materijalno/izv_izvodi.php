<div class="box">
<form action='default.php' method=post>
Datum:<input type=text name=datum placeholder="dd.mm.gggg">&nbsp
		<?php		
		$rezultat=$mysqli->query("SELECT * FROM rac_banke WHERE aktivan=1");
			$mysqli->dropdown1($rezultat,'banke','','id');
		?>
&nbsp Br izvoda<input type=text name=izv_br><br>
<input type=hidden name=str value='izv_izvodi'>
<input type=submit name=pretraga value="Prikazi">
</form>
</div>

<?php
if (isset($_POST['pretraga'])){
$izv_br=$_POST['izv_br'];
$banka=$_POST['banke'];
$datum=string2datum($_POST['datum']);
	
		
$rezultat= $mysqli->query("SELECT *,rac_kupci.naziv AS n_kupca,rac_dobavljaci.naziv AS n_dobavljaca
FROM rac_izvodi 
LEFT JOIN rac_kupci ON rac_izvodi.kupac=rac_kupci.id 
LEFT JOIN rac_banke on rac_izvodi.banka=rac_banke.id
LEFT JOIN rac_dobavljaci on rac_izvodi.dobavljac=rac_dobavljaci.id
WHERE rac_izvodi.aktivan=1 
AND dat_izv='$datum' 
AND banka='$banka'
AND br_izvoda = '$izv_br' 
ORDER BY br_izvoda");

		echo "<div class='box'>";
		echo "PROMET PREKO ZIRO RACUNA NA DAN ".$_POST['datum']."<br>";
		
$rezultat1= $mysqli->query("SELECT naziv FROM rac_banke WHERE id='$banka'");
		
		echo "Izvod br. ".$izv_br." za banku:";
		WHILE ($row=$rezultat1->fetch_assoc()){
		echo $row['naziv'];
		}
		echo "</div>";

?>
		<div class="box">
			<table class="lista" style="diplay:block;width:100%">
				<tr><th>Opis</th><th>Datum izvoda</th><th>Kupac</th><th>Dobavljac</th><th>Isplata</th><th>Uplata</th></tr>
				<?php
				$i=1;
				$uplata=0;
				$isplata=0;
				
				while ($row = $rezultat->fetch_assoc()) 
				{
				$dat_izv=date("d.m.Y", strtotime($row['dat_izv'])); 								
				echo "<tr class='lista'><td>".$row['napomena']."</td><td>".$dat_izv."</a></td><td>".$row['n_kupca']."</td><td>".$row['n_dobavljaca']."</td><td>".number_format($row['isplate'], 2, ',', '.')."</td><td>".number_format($row['uplate'], 2, ',', '.')."</td></tr>";
			$i++;
			$uplata=$uplata+$row['uplate'];
			$isplata=$isplata+$row['isplate'];
				}
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td>Uplate:</td><td>".number_format($uplata, 2, ',', '.')."</td></tr>";	
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td>Isplate:</td><td>".number_format($isplata, 2, ',', '.')."</td></tr>";	
			echo "<tr class='lista'><td></td><td></td><td></td><td></td><td>Saldo:</td><td>".number_format(($uplata-$isplata), 2, ',', '.')."</td></tr>";	
				?>
			</table>
<?php 

$izv_br=$_POST['izv_br'];
$banka=$_POST['banke'];
$datum=string2datum($_POST['datum']);
		echo "<a href='izv_izvodi1.php?izv_br=$izv_br&banka=$banka&datum=$datum' target='_blanc'><img src='../img/printer.png'></img></a>";
} ?>