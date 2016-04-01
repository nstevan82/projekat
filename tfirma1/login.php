<!DOCTYPE HTML>
<head>
<html lang="sr">
<title>Prijava na sistem</title>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div class="box">
<?php 
include_once "lib/class.baza.inc";
include_once "lib/class.user.inc";
if (isset($_POST['user'])&& isset($_POST['pass'])) 
{


	$mysqli=new Baza("dbparam.php");
	$mysqli->povezi();
	$user=addslashes($_POST['user']); //protiv sql injekcije
	$pass=addslashes($_POST['pass']); //protiv sql injekcije
	$pass=md5($pass);
	$rezultat=$mysqli->query("SELECT * FROM adm_korisnici WHERE username='$user' AND password='$pass'");
	$i=0;
	while ($row = $rezultat->fetch_assoc()) 
	{
		$i++;
		$korisnik=new user;
		if (mysqli_num_rows($rezultat)>0){
		$id=$korisnik->update_id($row['id']);
		$user1=$korisnik->update_user($row['username']);
		$pass1=$korisnik->update_pass($row['password']);
		$level=$korisnik->update_level($row['nalog']);
		$jmbg=$korisnik->update_jmbg($row['jmbg']);
		if ($user=$user1 && $pass=$pass1)
		   {session_start();
			$_SESSION['user']=$user1;
			$_SESSION['level']=$level;
			$rezultat=$mysqli->query("SELECT * FROM adm_pristup WHERE user='$user1'");
			while ($row = $rezultat->fetch_assoc()) 
			{
			$_SESSION['admin']=$row['admin'];
			$_SESSION['ui']=$row['ui'];
			$_SESSION['s48']=$row['s48'];
			$_SESSION['kadrovska']=$row['kadr'];
			$_SESSION['magacin']=$row['magacin'];
			$_SESSION['materijalno']=$row['materijalno'];
			$_SESSION['blagajna']=$row['blagajna'];
			$_SESSION['ekancelarija']=$row['ekancelarija'];
			$_SESSION['mehanizacija']=$row['mehanizacija'];			
			}
			$rezultat=$mysqli->query("SELECT * FROM ks_firma");	
			while ($row = $rezultat->fetch_assoc()) {
			$_SESSION['firma_naziv']=$row['naziv'];
			$_SESSION['firma_sediste']=$row['sediste'];
			$_SESSION['firma_adresa']=$row['adresa'];
			$_SESSION['firma_pib']=$row['pib'];
			}	
			echo "<a href='".@$_POST['modul']."/index.php'>Cestitamo, $user1, uspesno ste se ulogovali. Kliknite ovde za pristup modulu</a>";
			}
		}
				else echo "Pogresna lozinka, pokusajte ponovo<br>";
	}
if (!isset($_SESSION['user'])) echo "Pogresna lozinka ili korisnicko ime<br>";
}
?>

<form method="POST" action="login.php">
<img src="img/login.png" width="200px" height="200px"><br>
Korisnicko ime<br><input type="text" name=user><br>
Lozinka<br><input type="password" name=pass><br><br>
<?php if (isset($_REQUEST['modul'])) 
	{
	$modul=$_REQUEST['modul'];
	echo "<input type=hidden name=modul value=".$modul.">";
	}
?>
<input type="submit" value="Prijavi se"><a href="index.php"><input type="button" value="Nazad"></a>
</form>
</div>
</body>
</html>