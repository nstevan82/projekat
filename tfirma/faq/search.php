<body  onload="showHint('%')">
<script type="text/javascript" src="../ajaxobj.js"></script>
<script>

function GetXmlHttpObject()
{

var xmlHttp=null;
try{
// Firefox, Opera 8.0+, Safari
xmlHttp=new XMLHttpRequest();
}
catch(e){
//Internet explorer
try{
	xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
}
catch(e){
		xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
function showHint()
{
var str=document.getElementById('pitanje').value
var xmlHttp;
  
if (str.length==0)
  {
  document.getElementById("pitanje").innerHTML="";
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
  var izabrano=document.getElementsByName('klasa')[0].value;
  var odgovoreno=document.getElementsByName('odg')[0].value;
  var url="pregled1a.php";
   url=url+"?w="+str+"&izabrano="+izabrano+"&odg="+odgovoreno;
xmlHttp.onreadystatechange=function()
  {
 if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
    {
	document.getElementById("response").innerHTML=xmlHttp.responseText;
	}
  }
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}
</script>
<div id='big_wrapper'>
<?php 
include "../class.database.php";
include "header.php" ;
?>
 <section id="main_section">
     
 	 <article>
<!-- forma za pretragu-->
	 <div id="box">
	 <form action="pregled.php" method="post" name="forma">
	 <span style="position:relative;left:-170px;width:60px">Potrazi odgovor</span><span style="position:relative;left:-10px;width:100px">Potrazi pitanje</span>
	 <span style="position:relative;right:-170px;width:280px">Ustanova</span><br>
	 <input type="text" name="odg" id="pronadjiodgovor" onkeyup="showHint()" value='%' onload="showHint('%')">
	 <input type="text" name="pitanje" id="pitanje" onkeyup="showHint(this.value)" value='%' onload="showHint('%')">
	<?php		
	$rezultat= $mysqli->query("SELECT * FROM s48_klase ORDER BY naziv");
	$mysqli->querydropdownajax($rezultat,"klasa","","id","'showHint()'");
	?>
	 </form>
	 </div>
	 <div class="box" id="response" style="max-width:800px;margin-left:0px;margin-right:10px">
	 </div>
<!-- kraj forme za pretragu-->
<?php

if (isset($_POST['id']))
{ $id=$_POST['id'];

$nalog=$_POST['level'];
$pass=$_POST['password'];
$jmbg=$_POST['jmbg'];
$rezultat= $mysqli->query("UPDATE adm_korisnici set nalog=$nalog, password=$pass,jmbg=$jmbg WHERE id='".$id."'");

}
//--- ako se klikne na necije korisnicko ime -----
if (isset($_GET['id']))
{
		$id=$_GET['id'];
		$pass=$_GET['pass'];
		$level=$_GET['level'];
		$jmbg=$_GET['jmbg'];
		$pitanje=$_GET['jmbg'];
?>
<div class="box" id="box">
<form method="post" action="pregled.php">
Lozinka<br><input type=text name=password value='<?php echo $pass ?>'><br>
JMBG<br><input type=jmbg name=jmbg value='<?php echo $jmbg ?>'><br>
Nivo pristupa
<br>
	<select name=level>
	<option value='user' <?php if ($level=="user") echo "selected" ?>>user</option>
	<option value='admin'  <?php if ($level=="admin") echo "selected" ?>>admin</option>
	</select>
<br>
<input type="hidden" name="update" value='<?php echo $pitanje ?>'>
<input type="hidden" name=id value='<?php echo $id ?>'>
<input type="submit" value="izmeni">
</form>
</div>
<?php
}
?>
<script>
//deo skripta za ajax -- fokusira na textbox i postavlja kursor na kraj
document.getElementById("pitanje").focus();
document.getElementById("pitanje").setSelectionRange(1000,1000);
</script>
	</article>
	<!-- kraj liste korisnika -->
	</section>
<?php include "footer.php"?>
 </div>
 

