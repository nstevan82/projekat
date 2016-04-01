<?php session_start();
if (!isset($_SESSION['level']) OR $_SESSION['magacin']==0) die("Nemate prava za pristup ovom modulu");// ako nije logovan ne moze u modul
?>
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
<!-- <div class="zaglavlje" style="text-align:left;padding:15px;padding-bottom:0px"> -->
<table  class='zaglavlje' style='margin:0px;padding:0px;' width:100%>
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
if (isset($_SESSION['br_ulaza'])){
echo "MESTO:".$_SESSION['br_ulaza']."<br>";
//echo "ID_ulaza:".$_SESSION['id_ulaza']."<br>";
$br_ulaza=$_SESSION['br_ulaza'];
$id_ulaza=$_SESSION['id_ulaza'];
}
if (isset($_SESSION['skladista'])){
echo "SKLADISTE:".$_SESSION['skladista'];
$skladista=$_SESSION['skladista'];
}
?>
</td>
<td style='font-size:150%;text-align:center;width:50%'>
E-MAGACIN<br>
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
<!-- </div> -->
<nav></nav>
</header>
<div id="wrapper">
<aside>
<ul>
	<li><a href="default.php?str=odabir_godine">Odabir godine</a></li>	
	<li><a href="default.php?str=ulaz">Ulaz</a></li>		
	<li><a href="default.php?str=izlaz">Izlaz</a></li>		
	</ul>
	<ul>
	<lh style="background-size:100%;text-decoration:undeline">Sifarnici</lh>
	<li><a href="default.php?str=skladista">Skladista</a></li>
	<li><a href="default.php?str=vlasnici">Vlasnici</a></li>
	<li><a href="default.php?str=robe">Robe</a></li>
	<lh style="background-size:100%;text-decoration:undeline">Izveštaji</lh>
	<li><a href="default.php?str=izv_skladista">Skladista</a></li>	
	<li><a href="default.php?str=izv_stanje">Stanje</a></li>	
	
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
<p style="color:#000000;">Copyright:Stevan Nikolic admin@taraba.in.rs</p>
</footer>
</body>
</html>