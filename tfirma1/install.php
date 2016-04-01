<!doctype html>
<html lang="sr">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>


<?php
include "/lib/class.replacer.inc";
include "lib/class.baza.inc";
if (isset($_POST['dalje']))
{
?>
	<div class="box">
		<form method="post" action="install.php">
			<p><b>Registracija administratora</b></p>
			Korisnicko ime<br>
			<input type="text" name="user" required><br>
			Lozinka<br>
			<input type="password" name="pass" required><br>
			JMBG<br>
			<input type="text" name="jmbg"><br>
			<input type="submit" value="Dalje" name="dalje1">
		</form>
	</div>
<?php

}


if (!isset($_POST['dalje']))
{
?>
	<div class="box">
		<form method="post" action="install.php">
			<p><b>Unesite parametre mysql baze</b></p>
			Adresa mysql servera<br>
			<input type="text" name="adresa" required><br>
			Ime baze<br>	
			<input type="text" name="baza" required><br>
			Korisnicko ime<br>
			<input type="text" name="user" required><br>
			Lozinka<br>
			<input type="password" name="pass"><br>
			<input type="submit" value="Dalje" name="dalje">
		</form>
	</div>
<?php
}
if (isset($_POST['dalje']))
{
//unos podataka o parametrima baze u dbparam.php  <--ovo je za OOP
$red=array();
$adresa=$_POST['adresa'];
$user=$_POST['user'];
$pass=$_POST['pass'];
$baza=$_POST['baza'];
$red[0]="$adresa\n";
$red[1]="$user\n";
$red[2]="$pass\n";
$red[3]="$baza\n";
for($i=0;$i<4;$i++)
{
file_put_contents("dbparam.php", $red[$i], FILE_APPEND);
}
//unos podataka o parametrima baze u dbparam.php  <--ovo je za Proceduralni deo(kadrovska)
// obrisi kad prebacis kadrovsku u OOP
$red[0]="<?php \n";
$red[1]="	\$db_host ='$adresa';\n";
$red[2]="	\$db_user ='$user';\n";
$red[3]="	\$db_pass ='$pass';\n";
$red[4]="   \$db_name = '$baza';\n";
$red[5]="?> \n";
for($i=0;$i<6;$i++)
{
file_put_contents("dbparam_staro.php", $red[$i], FILE_APPEND);
}
// --------------------------------------------------
$mysqli=new mysqli($_POST['adresa'],$_POST['user'],$_POST['pass']);
echo "<br><div class='box'>Kreiram bazu podataka i sifarnike...<br>Unesite podatke o administratoru</div>";
$rezultat1 = $mysqli->query("CREATE DATABASE IF NOT EXISTS ".$baza); 
$mysqli->select_db($baza);

//zameni default ime baze u fajlu install.sql imenom baze koju je uneo korisnik

$upisBaze=new replacer();
$upisBaze->zameni("install.sql","kadrovska",$baza);

if (mysqli_connect_errno()) {
echo("<div class='box'>Nisam u mogucnosti da se povezem sa bazom. ".mysqli_connect_error()."</div>");
exit();
}
$fajl=file_get_contents('install.sql');
if (mysqli_connect_errno()) {
echo("<div class='box'>Nisam u mogucnosti da se povezem sa bazom. ".mysqli_connect_error()."</div>");
exit();
}
// procitaj install.sql i aktiviraj ga kao upit da bi uspostavio bazu podataka
$rezultat = $mysqli->multi_query($fajl);

//zameni ime baze koje je uneo korisnik u fajlu install.sql default imenom KADROVSKA
$upisBaze1=new replacer;
$upisBaze1->zameni("install.sql",$baza,"kadrovska");
}
if (isset($_POST['dalje1']))
{


$user=$_POST['user'];
$pass=$_POST['pass'];
$jmbg=$_POST['jmbg'];
$mysqli=new baza("dbparam.php");
$mysqli->povezi();
$mysqli->query("INSERT INTO adm_korisnici (username,password,jmbg,nalog) VALUES ('$user','$pass','$jmbg','admin')");//registruj admina
$mysqli->query("INSERT INTO adm_pristup (user,admin,efirma,s48) VALUES ('$user','1','1','1')");//doledi adminu prava pristupa svim modulima

echo("<div class='box'>Administrator prijavljen sa usernameom $user<br>
<a href='index.php'>Kliknite ovde da pocnete da koristite program</a>
</div>");
}
?>
</body>
</html>