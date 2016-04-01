	 <?php
include "../lib/class.baza.inc";
	 $mysqli=new Baza("../dbparam.php");
	 $mysqli->povezi();
if (isset($_GET['w']))
{ $w=$_GET['w'];
$izabrano=$_GET['izabrano'];
$izabrano=$izabrano;
$odgovoreno=$_GET['odg'];
//ako je izabrana opcija SVE USTANOVE prikazi sve...ako nije ukljuci filter
if ($izabrano!=1) {$rezultat=$mysqli->query("SELECT *,s48_klase.naziv AS nklase from s48_pitanja INNER JOIN s48_klase ON s48_pitanja.klasa=s48_klase.id WHERE pitanje LIKE UPPER('%".$w."%') AND odgovor LIKE UPPER('%".$odgovoreno."%') AND klasa='$izabrano'");}
else {$rezultat=$mysqli->query("SELECT *,s48_klase.naziv AS nklase FROM s48_pitanja INNER JOIN s48_klase ON s48_pitanja.klasa=s48_klase.id WHERE pitanje LIKE UPPER('%".$w."%') AND odgovor LIKE UPPER('%".$odgovoreno."%')");}
?>
	 <!-- lista korisnika-->
<table style="width:100%;margin-top:0;"> 
<caption style="text-align:left">PITANJA</caption>
<?php
$i=0;
echo "<tr><th style='max-width:3%'>Rb</th><th style='max-width:30%'>Pitanje i Odgovor</th><th style='max-width:30%'>Ustanova</th></tr>";
while ($row = $rezultat->fetch_assoc()) {
		$i++;
				echo "<tr id='pregled'><td rowspan=2 style='max-width:3%;' valign='top'><big>".$i."</big></a></td><td id='pitanje' style='max-width:30%;word-wrap: break-word'>".$row['pitanje']."</a></td><td rowspan=2  style='max-width:10%'><small>".$row['nklase']."</small></a></td></tr><tr><td id='odgovor' style='max-width:30%;word-wrap: break-word'><pre>".$row['odgovor']."</pre></td></tr>";
		}
	}
?></table><?php


?>