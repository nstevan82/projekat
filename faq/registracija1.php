	 <?php
include "../lib/class.baza.inc";
	 $mysqli=new Baza();
	 $mysqli->povezi();
if (isset($_GET['user']))
{ 
$user=$_GET['user'];
//ako je izabrana opcija SVE USTANOVE prikazi sve...ako nije ukljuci filter
$rezultat=$mysqli->query("SELECT * FROM adm_korisnici WHERE username='".$user."'");}
$redovi = $rezultat->num_rows;
echo $redovi;

?>
	