<?php include "header.php";
?>
<body>
<div id='big_wrapper'>
     <section id="main_section">
		<?php include "meni.php" ?>
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
 
$rezultat=$mysqli->query("INSERT INTO s48_predmet (godina,datum,naslov,sluzba,poruka,status,email,telefon,oemail,otelefon,osms,oweb,primljeno) VALUES ('$godina','$datum','$naslov',$sluzba,'$poruka',$status,'$email','$telefon',$oemail,$otelefon,$osms,$oweb,'salter')");
?>
<script>
alert('Vas zahtev je zaveden. Mozete uskoro ocekivati odgovor.');
</script>
<?php
}
?>
<form action="zahtev.php" method="post">
Preko ovog formulara mozete da posaljete zahtev odredjenom sektoru
nase ustanove. Zahtev se takodje moze poslati:
<ol>
<li>Slanjem emaila na admin@taraba.in.rs</li>
<li>Pozivom na br telefona xxx-xxx</li>
<li>Slanjem SMSa na broj xxx-xxx</li>
</ol>
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
$mysqli=new Baza("../dbparam.php");
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
