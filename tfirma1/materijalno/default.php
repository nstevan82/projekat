
<?php 
ini_set('display_errors',1); 
 error_reporting(E_ALL);

ini_set('error_reporting', E_ALL);
session_start();
if (!isset($_SESSION['level']) OR $_SESSION['materijalno']==0) die("Nemate prava za pristup ovom modulu");// ako nije logovan ne moze u modul?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" href="css/template1.css">
<title>Materijalno poslovanje</title>
<link rel="stylesheet" href="css/jquery-ui.css">


<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>

<script>
$(document).ready(function() {
//na mestima gde je iznos spreciti unos zapete. Unosi se tacka
    $('.iznos').keypress(function(key) {	
        if(key.charCode == 44) return false;
    });
	});


</script>
<script>
$(function() {
$( '.datepicker' ).datepicker();
});
</script>

</head>

<body>
<header>

<table  class='zaglavlje' style='margin:0px;padding:0px;border:1px' width:100%>
<tr>
<td style='width:20px;max-height:20px;'>
<img src='../img/user.png' style='width:70px;height:70px'>
</td>
<td style='width:20px;'>
<?php 
echo "Korisnik:".$_SESSION['user']."<br>";

if (isset($_POST['odaberi_godinu'])){//ako je uneta godina aktiviraj sesiju GODINA sa vrednoscu unete godine
$_SESSION['godina']=$_POST['odabrana_godina'];
}

if (!isset($_SESSION['godina'])) $_SESSION['godina']=date("Y");
echo "GODINA:".$_SESSION['godina'];
$akt_godina=$_SESSION['godina'];
?>
</td>
<td style='font-size:150%;text-align:center;width:50%'>
MATERIJALNO POSLOVANJE<br>
<?php echo $_SESSION['firma_naziv'];?><br>
<?php echo $_SESSION['firma_adresa'];?><br>
</td>
<td style='width:15%;text-align:right'>
Autor programa:<br>
Stevan Nikolic<br>
admin@taraba.in.rs
</td>
<td style='width:10%;'>
<img style='width:80px;height:80px;' src='../img/big_logo.png'><br>
</td>
</tr>
</table>







<nav></nav>
</header>
<div id="wrapper">
<aside>
<ul>
	<li><a href="default.php?str=odabir_godine">Odabir godine</a></li>
	<li><a href="default.php?str=ulazni_delovodnik">Ulazni delovodnik</a></li>
	<li><a href="default.php?str=izlazni_delovodnik">Izlazni delovodnik</a></li>
	<li><a href="default.php?str=izvodi">Izvodi</a></li>
	<li><a href="default.php?str=dev_izvodi">Izvodi(dev)</a></li>
	<li><a href="default.php?str=ulazne">Ulazne fakture</a></li>
	<li><a href="default.php?str=dev_ulazne">Ulazne fakture(dev)</a></li>	
	<li><a href="default.php?str=izlazne">Izlazne fakture</a></li>
	<li><a href="default.php?str=poc_izlazne">Pocetno stanje Izlazne fakture</a></li>
		<li><a href="default.php?str=poc_ulazne">Pocetno stanje Ulazne fakture</a></li>
	<li><a href="default.php?str=dev_izlazne">Izlazne fakture(dev)</a></li>
	<li><a href="default.php?str=otprema">Otprema</a></li>	
	<li><a href="default.php?str=kepu">KEPU</a></li>	
	</ul>
	<ul>
	<lh style="background-size:100%;text-decoration:undeline">Sifarnici</lh>
	<li><a href="default.php?str=banke">Banke</a></li>
	<li><a href="default.php?str=usluge">Usluge</a></li>
	<li><a href="default.php?str=roba">Roba</a></li>
	<li><a href="default.php?str=kupci">Kupci</a></li>
	<li><a href="default.php?str=dev_kupci">Devizni kupci</a></li>
	<li><a href="default.php?str=posiljaoci">Posiljaoci</a></li>
	<li><a href="default.php?str=primaoci">Primaoci</a></li>
	<li><a href="default.php?str=dobavljaci">Dobavljaci</a></li>
	<li><a href="default.php?str=dev_dobavljaci">Devizni dobavljaci</a></li>
	<li><a href="default.php?str=agenti_plovila">Agenti plovila</a></li>
	<li><a href="default.php?str=vrsta_robe">Vrsta robe</a></li>
	<lh style="background-size:100%;text-decoration:undeline">Izveštaji</lh>
	<li><a href="default.php?str=izv_izlazne">Izlazne fakture</a></li>
	<li><a href="default.php?str=izv_dev_izlazne">Izlazne fakture(dev)</a></li>
	<li><a href="default.php?str=izv_ulazne">Ulazne fakture</a></li>
	<li><a href="default.php?str=izv_dev_ulazne">Ulazne fakture(dev)</a></li>
	<li><a href="default.php?str=izv_izvodi">Izvodi</a></li>	
	<li><a href="default.php?str=izv_dev_izvodi">Izvodi(dev)</a></li>
	<li><a href="default.php?str=izv_otprema">Otprema</a></li>
	<li><a href="default.php?str=izv_otprema_roba">Otpremljena roba</a></li>
	<li><a href="../index.php">Izlaz</a></li>
</ul>
</aside>
<section id="main">
<?php 
include "../lib/class.baza.inc";
include "../funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();
if (isset($_REQUEST['str']))
{
include $_REQUEST['str'].".php";
}
?>
</section>
</div>
<footer>
<p style="color:#000000">Copyright:Stevan Nikolić admin@taraba.in.rs</p>
</footer>
</body>
</html>