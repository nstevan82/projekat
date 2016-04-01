

<body>
<div id='big_wrapper' style="border:0px">
<?php include "header.php";?>
     <section id="main_section">
		
		<article>	

<div class="box">
	<?php
	if (isset($_POST['submit']))
{
$godina=date('Y');
$naslov=$_POST['naslov'];
$poruka=$_POST['tekst'];
$telefon=$_POST['telefon'];
$sluzba=$_POST['sluzba'];
$status=1;
$email=$_POST['email'];

$datum=date("Y-n-j");

if (isset($_POST['otelefon'])) $otelefon=1 ;else $otelefon=0;
if (isset($_POST['oemail'])) $oemail=1 ;else $oemail=0; 
if (isset($_POST['osms'])) $osms=1;else $osms=0;
if (isset($_POST['oweb'])) $oweb=1;else $oweb=0;
 
$rezultat=$mysqli->query("INSERT INTO s48_predmet (godina,datum,naslov,sluzba,poruka,status,email,telefon,oemail,otelefon,osms,oweb,primljeno,aktivan) VALUES ('$godina','$datum','$naslov',$sluzba,'$poruka',$status,'$email','$telefon',$oemail,$otelefon,$osms,$oweb,'web',1)");
$last_id=$mysqli->insert_id;
echo $last_id;
?>
<div class="box">
Vas zahtev je zaveden pod brojem <strong><?php echo $last_id ?></strong> <br>Zapamtite ovaj broj, trebace vam kada budete trazili odgovor na Vas zahtev. 
</div>
<script>
alert("Zahtev uspesno zaveden")
</script>

<?php
}
?>
<form action="zahtev.php" method="post">
Preko ovog formulara mozete da posaljete zahtev odredjenom sektoru
nase ustanove. <br>Zahtev se takodje moze poslati:
<ul style="text-align:justify;margin-left:30%;margin-right:auto">
<li>Licnim dolaskom na adresu xxxxxxx broj xx</li>
<li>Slanjem emaila na esalter@taraba.in.rs</li>
<li>Pozivom na br telefona xxx-xxx (trenutno nije u funkciji)</li>
<li>Slanjem SMSa na broj xxx-xxx (trenutno nije u funkciji)</li>
</ul>
<p>Naslov &nbsp <input type=text name=naslov  required></p>
<p>Email &nbsp <input type=email name=email></p>
<p>Telefon &nbsp <input type=text name=telefon></p>
Tekst zahteva ili pitanje<br>
<textarea cols=30 rows=10 name=tekst required></textarea><br>
<hr>
Obavestenja i odgovor zelim da dobijem na sledeci nacin<br>
Emailom<input type=checkbox name=oemail value=0 chechked=false>&nbsp Telefonom<input type=checkbox name=otelefon value=0 chechked=false>&nbsp SMSom<input type=checkbox name=osms value=0 chechked=false>&nbsp Webportal<input type=checkbox name=oweb value=0 chechked=false>
<hr>
<?php
$mysqli=new Baza();
$mysqli->povezi();
$rezultat=$mysqli->query("SELECT * FROM s48_klase");

echo "<div style='margin-left:auto;margin-right:auto;width:50%'>";
echo "<p style='text-align:justify'>Odaberite Sektor kome saljete zahtev:</p>";
while($row=$rezultat->fetch_assoc())
{
if ($row['id']>1) echo "<p style='text-align:justify'><input type=radio name=sluzba value=".$row['id']." required>".$row['naziv']."</p>";
}
?>
</div>
<input type="submit" value="Posalji" name=submit>
</form>
</div>
	</article>
 </section>
<?php include "footer.php"?>
 </div>
</div>
