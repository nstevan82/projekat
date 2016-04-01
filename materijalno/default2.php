<!DOCTYPE HTML>
<html lang='sr' style="background:url('img/pozadina.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:100%">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-16">
      
      <title>Magacinsko poslovanje</title>
      <link rel="stylesheet" href="style2.css">
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>
<script type="text/javascript" language="javascript">
$(document).ready(function() {
 $(".unesi").slideUp();
});

function sklopi(paragraf)
{
  
    $("#"+paragraf).slideToggle();
  
  /* *** ovo je stari javascript kod....ostavi ga za svaki slucaj ***
parag=document.getElementById(paragraf).style
if (parag.display=="block")
              parag.display="none"
			  else
			  parag.display="block"
			  */
}

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
function validacijaBroja(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}

</script>
</head>
<header>
</header>

<body>
<div id='big_wrapper'>
     <section id="main_section" style="border:1px solid red;width:90%;padding:10px;">
		    <div id='meni'>
<h3>Knjizenje</h3>
<p class="naslov" onclick="sklopi('upis')">Podaci</p>
<ul class="meni">
<li id="upis" class="meni" ><a href="radnik.php">Nabavka materijala</a></li>
<li class="meni"><a href="radni_odnos.php">Trebovanje materijala</a></li>
<li class="meni"><a href="radni_odnos.php">MM dostavnica</a></li>

</ul>
</p>
<p class="naslov" onclick="sklopi('sifarnici')">Godine i podaci</p>
<ul class="meni">
<li id="sifarnici" class="meni"><a href="radno_mesto.php">Postavi aktivnu godinu</a></li>
<li class="meni"><a href="default.php?str=banke">Banke</a></li>
<li class="meni"><a href="default.php?str=dobavljaci">Dobavljaci</a></li>
<li class="meni"><a href="default.php?str=kupci">Kupci</a></li>



</ul>
</p>
<p class="naslov" onclick="sklopi('izvestaji')">Izvestaji</p>
<ul class="meni">
<li class="meni" id="izvestaji"><a href="pregled_zaposlenih.php">Kartica</a></li>
<li class="meni"><a href="izv_deca.php">Popisna lista</a></li>

</ul>
</p>
<p height=20px><a href="../"> IZLAZ </a></p>
</div>		<section class="content">	 
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

<footer id="the_footer">
<strong>www.taraba.in.rs</strong><br>
<small>Program izradio:Stevan Nikolic. Sva prava zadrzana</small>
</footer> </div>
</div>