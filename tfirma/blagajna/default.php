<?php session_start();
if (!isset($_SESSION['level']) OR $_SESSION['blagajna']==0) die("Nemate prava za pristup ovom modulu");// ako nije logovan ne moze u modul?>
<!DOCTYPE HTML>
<head>
<link rel="stylesheet" href="css/template1.css">
<title>Racunovodstvo</title>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
$(function() {
$( '.datepicker' ).datepicker();
});
</script>
</head>

<body>
<header>
<table class='zaglavlje' style='margin:0px;padding:0px;' width:100%>
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
echo "GODINA:".$_SESSION['godina']."<br>";
$akt_godina=$_SESSION['godina'];
if (isset($_SESSION['blagajna'])){
echo "BLAGAJNA:".$_SESSION['odabrana_blagajna']."<br>";
$blagajna=$_SESSION['blagajna'];
}
if (isset($_SESSION['blagajna_gorivo'])){
echo "BLAGAJNA GORIVA:".$_SESSION['blagajna_gorivo'];
$blagajna_gorivo=$_SESSION['blagajna_gorivo'];
}
?>
</td>
<td style='font-size:150%;text-align:center;width:50%'>
BLAGAJNA<br>
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
	<li><a href="default.php?str=blagajna">Blagajna</a></li>
	<li><a href="default.php?str=blagajna_izlaz">Pravdanja(blagajna)</a></li>
	<li><a href="default.php?str=blagajna_gorivo">Blagajna goriva</a></li>
	<li><a href="default.php?str=blagajna_gorivo_izlaz">Pravdanja(gorivo)</a></li>
	<li><a href="default.php?str=isplate">Plate</a></li>
	</ul>
	<ul>
	<lh style="background-size:100%;text-decoration:undeline">Sifarnici</lh>
	<li><a href="default.php?str=objekti">Objekti</a></li>
	<lh style="background-size:100%;text-decoration:undeline">Izveštaji</lh>
	<li><a href="default.php?str=izv_blagajna">Blagajna</a></li>	
	<li><a href="default.php?str=izv_blagajna_goriva">Blagajna goriva</a></li>	
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
<p style="color:#000000">Copyright:Stevan Nikolic admin@taraba.in.rs</p>
</footer>
</body>
</html>