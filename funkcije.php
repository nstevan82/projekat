<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>


<?php
function string2datum($datum)
{
return date("Y-m-d H:i:s",strtotime(str_replace('.','-',$datum)));
}
function dropdown($rezultat,$ime="",$kol1="",$kol2="")
{
echo "<select name='".$ime."'>";
WHILE ($row=mysql_fetch_array($rezultat))			
	{
	echo $_GET['id'];
	if ($_GET[$kol1]==$row[$kol2] AND $kol1!="") echo "<option value=".$row['id']." selected>".$row['naziv']."</option>";
	else
	echo "<option value='".$row['id']."'>".$row['naziv']."</option>";
	}
	echo "</select>";	
}


function obrisi($tabela1,$kolona,$tabela)
{
		if (isset($_POST['del_update'])) $vrednost=$_POST['del_update'];else $vrednost="";
		if (isset($_POST['del'])) $obrisan=$_POST['del'];else $obrisan="";
	
		brisanje("UPDATE $tabela SET $kolona=$vrednost WHERE $kolona=$obrisan",$obrisan,$tabela1);
		} //**********************	 kraj koda za brisanje stavke iz sifarnika
function brisanje($update,$obrisan,$tabela)
{
	if (isset($_POST['del_update']))
	{
	$vrednost=$_POST['del_update'];
	$obrisan=$_POST['del'];
	$rezultat=query($update);
	$rezultat=query("DELETE FROM $tabela WHERE id=$obrisan");
	}
	if (isset($_GET['del']))
	{
	$del=$_GET['del'];
	echo "PAZNJA!Ovaj podatak se vec koristi. Morate izabrati koji podatak ce zameniti obrisani podatak!<br>";
	$fajl=$_SERVER['PHP_SELF'];
	echo "<form action=$fajl method='post'>";
	$rezultat=query("SELECT * FROM $tabela");
	dropdown($rezultat,"del_update","","naziv");
	echo "<input type=hidden name=del value=$del>";
	echo "<input type=submit value=OK>";
	echo "</form>";
	}
}
function upload($fajl,$tip,$imefajla)
{
if ($tip=="slika") 
	{
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$folder="slike/";
	}
if ($tip=="word") 
	{
	$allowedExts = array("doc", "txt", "zip", "rar");
	$folder="cv/";
	}
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
   // echo "Upload: " . $_FILES["file"]["name"] . "<br>";
   // echo "Type: " . $_FILES["file"]["type"] . "<br>";
   // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
   //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists($folder . $imefajla))
      {
      echo $imefajla.".".$extension . " vec postoji. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"] ,
      $folder . $imefajla.".".$extension);
      //echo "Stored in: " . $folder . $_FILES["file"]["name"];
      }
    }
  }
else
  {
  if ($_FILES["file"]["tmp_name"]<>"") echo "Format fajla ne odgovara. Smanjite velicinu fajla ili promenite format";
  }
//a sad da upisemo sliku u bazu
$putanja=$folder . $imefajla.".".$extension;

//$imefajla predstavlja ujedno i $jmbg lica cija se slika unosi
$mysqli=new baza("..dbparam.php");
$rezultat=$mysqli->query("UPDATE ks_radnik SET slika='$putanja' WHERE jmbg=$imefajla");
}

function izracunajStaz($jmbg){
		$mysqli=new baza("..dbparam.php");
		$rezultat=$mysqli->query("SELECT sum(prestanak-pocetak) AS suma FROM ks_prethodni_staz WHERE jmbg=$jmbg");
		//$staz=podeliDatum($kraj-$pocetak);

		while($row=$rezultat->fetch_assoc());
			{
			$prethodniStaz=podeliDatum($row['suma']);
			}
	$pdan=$prethodniStaz[0];
	echo $pdan;
	$pmeseci=$prethodniStaz[1];
	$pgodina=$prethodniStaz[2];
	//if ($pdan>30) echo "svodjenje meseci+:".floor($pdan/30)." a ostatak je ".floor($pdan%30);
	if ($pdan>30) {
	$pmeseci+=floor($pdan/30);
	$pdan=floor($pdan%30);
	}
	//$rezultat=$mysqli->query("UPDATE ks_radnik SET dan=$pdan,meseci=$pmeseci,godina=$pgodina WHERE jmbg=$jmbg");//upisi novoizracunati prethodni radni staz u bazu
		}

function podeliDatum($datum){
			//echo "dana:".date("d", strtotime($row['suma'])); 
			//echo "meseci:".date("m", strtotime($row['suma'])); 
			//echo "godina:".date("Y", strtotime($row['suma'])); 
			// ako staz ima 5 ili 6 karaktera
			if (strlen($datum)==5 || strlen($datum)==6){
			$dan=substr($datum,strlen($datum)-2,2); 
			$meseci=substr($datum,strlen($datum)-4,2); 
			$godina=substr($datum,0,strlen($datum)-4); 
			}
			// ako staz ima 3 ili 4 karaktera
			if (strlen($datum)==3 || strlen($datum)==4){
			$dan=substr($datum,strlen($datum)-2,2); 
			$meseci=substr($datum,strlen($datum)-strlen($datum),strlen($datum)-2); 
			$godina=0; 
			}
			// ako staz ima 1 ili 2 karaktera
			if (strlen($datum)==1 || strlen($datum)==2){
				$dan=substr($datum,strlen($datum)-strlen($datum),strlen($datum)); 
				$meseci=0; 
				$godina=0; 
				}
				return array($dan,$meseci,$godina);
}				
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>



<script type="text/javascript" language="javascript">
function izmena_ulaza(){
alert('aaaa');
$document.getElementsByName('izmena_ulaza').style.display="block";
}
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
