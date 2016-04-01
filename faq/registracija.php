<body >
<script>
function proveriKorisnika()
{
var user=document.getElementById('user').value
var xmlHttp;
 
if (user.length==0)
  {
  document.getElementById("user").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// kod za IE7+, Firefox, Chrome, Opera, Safari
  xmlHttp=GetXmlHttpObject();
    }
else
  {// kod za IE6, IE5
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  var user=document.getElementsByName('user')[0].value;
  var url="registracija1.php";
   url=url+"?user="+user;
   
xmlHttp.onreadystatechange=function()
  {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
	if (xmlHttp.responseText==0) {alert("Nepostojeci korisnik. Registrujte ga u admin panelu");return false}
	if (xmlHttp.responseText==1) return true;
	}
  }
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
</script>
<?php include "header.php" ;?>
<script src="../httpobj.js"></script>
<div id='big_wrapper'>
<?php 

if (isset($_POST['unesi']))  
{
$grupa=$_POST["klasa"];
$user=$_POST["user"];
$rezultat=$mysqli->query("INSERT INTO s48_korisnici (user,grupa) VALUES ('$user','$grupa')");
}
?>
     <section id="main_section">
		<?php include "meni.php" ?>
		<article>
		<div class="box">
			<form method="post" action="registracija.php">
			Korisnicko Ime
			<br>
			<input type="text" name=user id=user onBlur="proveriKorisnika()">
			<br>
		Javno preduzece/odeljenje<br>
		<?php
		$rezultat=$mysqli->query("SELECT * FROM s48_klase");
		$mysqli->dropdown($rezultat,"klasa","","id");
		?>
		<br>
		<input type="submit" value="Registruj" name="unesi"><input type="reset" name=reset>
			</form>
		</div>
		</article>
	</section>
<?php include "footer.php"?>
 </div>
 

