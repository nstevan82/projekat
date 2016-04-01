
<!DOCTYPE HTML>
<html lang='sr'>
<head>
      <meta charset="utf-8" />
      <title>Pregled telefona</title>
</head>
<?php
include "portalhead.php";
include "../lib/class.baza.inc";
echo "<br>";
$mysqli=new baza("../dbparam.php");
$mysqli->povezi();
include "../funkcije.php";
include "../lib/class.excel.inc";
if (isset($_GET['excel'])) excelReport();
$rezultat=$mysqli->query("set names utf-8;");
$rezultat=$mysqli->query("SELECT *,ks_sektor.naziv as naz_sektora FROM ks_radnik LEFT JOIN ks_sektor ON ks_radnik.sektor=ks_sektor.id RIGHT JOIN (SELECT jmbg,broj,ks_tip_telefona.naziv AS ntip FROM ks_telefoni INNER JOIN ks_tip_telefona ON ks_telefoni.tip=ks_tip_telefona.id WHERE ks_telefoni.tip='3') AS tel ON ks_radnik.jmbg=tel.jmbg ORDER BY sektor ASC ");
echo "<table border=1 style='width:90%;margin-left:5%;margin-right:10%'>";
echo "<tr><th colspan=9 style='text-align:center;background:#d7d7d7;'>Pregled podataka o telefonima na dan ".date('d.m.Y')."</th></tr>";
echo "<tr><th>Sektor</th><th>jmbg</th><th>Prezime</th><th>Ime</th><th>Tip</th><th>Broj</th></tr>";
while ($row = $rezultat->fetch_assoc()) 
{
echo "<tr><td>".$row['naz_sektora']."</td><td>".$row['jmbg']."</td><td>".$row['prezime']."</td><td>".$row['ime']."</td><td>".$row['ntip']."</td><td>".$row['broj']."</td></tr>";
}
?>
</table><br>
<table>
<!--<tr><td rowspan=2><img src='../img/excel.png' style='width:50px;height:50px'></td><td><a href='pregled_telefona.php?excel=pregled_telefona'>Generisi excel</a></td></tr>
<tr><td style='background:white'><a href='pregled_telefona.xls'>Preuzmi excel</a></td> !-->
</table>
<?php
function excelReport(){
	$excel_doc=new excel();
	$excel_doc->setPutanja(getcwd()."pregled_telefona.xls");
	$rezultat=$mysqli->query("SELECT *,ks_sektor.naziv as naz_sektora FROM ks_radnik
LEFT JOIN ks_sektor ON ks_radnik.sektor=ks_sektor.id
RIGHT JOIN (SELECT jmbg,broj,ks_tip_telefona.naziv AS ntip FROM ks_telefoni INNER JOIN ks_tip_telefona ON ks_telefoni.tip=ks_tip_telefona.id WHERE ks_telefoni.tip='3') AS tel ON ks_radnik.jmbg=tel.jmbg
ORDER BY sektor ASC");
$i=2;
$excel_doc->kreirajXLS(array("A1","B1","C1","D1","E1","F1"),array("Sektor","JMBG","Prezime","Ime","Tip","Broj"));
$excel_doc->setColumnWidth("A:A","30");
$excel_doc->setColumnWidth("B:B","20");
$excel_doc->setColumnWidth("C:C","20");
$excel_doc->setColumnWidth("D:D","20");
$excel_doc->setColumnWidth("E:E","10");
$excel_doc->setColumnWidth("F:F","10");
$excel_doc->setColumnFormat("B:B","#############");
while ($row = $rezultat->fetch_assoc()) {
	$excel_doc->dodajXLS(array("A".$i,"B".$i,"C".$i,"D".$i,"E".$i,"F".$i ),array($row['naz_sektora'],$row['jmbg'],$row['prezime'],$row['ime'],$row['ntip'],$row['broj']));
	$i++;
	}
}
?>

