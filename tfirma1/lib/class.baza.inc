<?php 
interface IBaza{
  public function povezi();
  public function query($query);
  public function zatvori();
  public function dropdown($rezultat,$ime,$kol1,$kol2);
  public function obrisi($tabela1,$kolona,$tabela);
  public function brisanje($update,$obrisan,$tabela);
  public function dropdownAjax($rezultat,$ime="",$kol1="",$kol2="",$ajax);
  }
class Baza implements IBaza{
   public $conn;
   public $query;
   public $server;
   public $korisnik;
   public $lozinka;
   public $imeBaze;
   public $array=array();
   public $fp;
   public function __construct($file){
	$this->fp = @fopen($file, 'r'); 
	if ($this->fp) { 
	$this->array = explode("\n", fread($this->fp, filesize($file))); 
	}
	$this->server=$this->array[0];
	$this->korisnik=$this->array[1];
	@$this->lozinka=$this->array[2];
	$this->imeBaze=$this->array[3];;
   }
 
   
   
   public function povezi(){
        //$this->conn=mysqli_connect($this->server,$this->korisnik,$this->lozinka,$this->imeBaze);
		   $this->conn=mysqli_connect('s410.loopia.se','wakawaki@t15096','mysqlcha0s','taraba_in_rs');
   }
   
   public function query($query){
		
		$myFile = "../admin/config.cfg";
		$broj= fopen($myFile, 'r');
		$broj_redova = fgets($broj);
		fclose($broj);		
		// funkcija koja zamenjuje LIMIT X,10 intervalom koji je unet u admin panelu
if (preg_match("/[LIMIT]+[\s]+[0-9]+[,]+[0-9]/", $query)) {
$query=substr($query, 0, -2);   
$query=$query.$broj_redova;	
;}

    return mysqli_query($this->conn,$query);
   }
   public function multiquery($sql){
echo $sql;
 //return mysqli_multi_query($this->conn,$query);

$sql=strip_tags($sql) ;//skini glupe html tagove zbog kojih nijeradi
  
 if (mysqli_multi_query($this->conn,$sql))
{
  do
    {
    // Store first result set
    if ($result=mysqli_store_result($this->conn))
      {
      while ($row=mysqli_fetch_row($result))
        {
        printf("%s\n",$row[0]);
        }
      mysqli_free_result($this->conn);
      }
    }
  while (mysqli_next_result($this->conn));
  mysqli_next_result($this->conn);
}
 
 
 
 
   }
   public function insert_id(){
   return $this->mysqli->insert_id;  
}
   public function zatvori(){
      mysqli_close($this->conn);
   }
   public function dropdown($rezultat,$ime="",$kol1="",$kol2="",$red="naziv")
{

/* 
1.attr = upit   
2.attr=naziv SELECT polja 
3.attr=Vrednost koja se dobija preko $_GET 
4.attr=vrednost koja se poredi sa 3.atrr 
5.attr kolona iz baze koja ce se prikazati u padajucem meniju 
*/

	echo "<select name='".$ime."'>";
	WHILE ($row = $rezultat->fetch_assoc())			
	{
	if ($_GET[$kol1]==$row[$kol2] AND $kol1!="") echo "<option value=".$row['id']." selected>".$row[$red]."</option>";
	else
	echo "<option value='".$row['id']."'>".$row[$red]."</option>";
	}
	echo "</select>";
}
public function dropdown1($rezultat,$ime="",$kol1="",$kol2="",$red="naziv")
{

/* 
1.attr = upit   
2.attr=naziv SELECT polja 
3.attr=Vrednost koja se dobija od izabranog reda tabele
4.attr=vrednost koja se poredi sa 3.atrr 
5.attr kolona iz baze koja ce se prikazati u padajucem meniju 
*/

	echo "<select name='".$ime."'>";
	WHILE ($row = $rezultat->fetch_assoc())			
	{
	if ($kol1==$row[$kol2] AND $kol1!="") echo "<option value=".$row['id']." selected>".$row[$red]."</option>";
	else
	echo "<option value='".$row['id']."'>".$row[$red]."</option>";
	}
	echo "</select>";
}
public function obrisi($tabela1,$kolona,$tabela)
{
		if (isset($_POST['del_update'])) $vrednost=$_POST['del_update'];else $vrednost="";
		if (isset($_POST['del'])) $obrisan=$_POST['del'];else $obrisan="";
		$this->brisanje("UPDATE $tabela SET $kolona=$vrednost WHERE $kolona=$obrisan",$obrisan,$tabela1);
		} //**********************	 kraj koda za brisanje stavke iz sifarnika
public function brisanje($update,$obrisan,$tabela)
{
	echo "update je ".$update;
	if (isset($_POST['del_update']))
	{
	$vrednost=$_POST['del_update'];
	$obrisan=$_POST['del'];
	$rezultat=$this->query($update);
	$rezultat=$this->query("DELETE FROM $tabela WHERE id=$obrisan");
	}
	if (isset($_GET['del']))
	{
	$del=$_GET['del'];
	echo "PAZNJA!Ovaj podatak se vec koristi. Morate izabrati koji podatak ce zameniti obrisani podatak!<br>";
	$fajl=$_SERVER['PHP_SELF'];
	echo "<form action=$fajl method='post'>";
	$rezultat=$this->query("SELECT * FROM $tabela");
	$this->dropdown($rezultat,"del_update","","naziv");
	echo "<input type=hidden name=del value=$del>";
	echo "<input type=submit value=OK>";
	echo "</form>";
	}
	}
public function dropdownAjax($rezultat,$ime="",$kol1="",$kol2="",$ajax)
{
echo "<select name='".$ime."' id='pretraga'onChange=".$ajax.">";
WHILE ($row = $rezultat->fetch_assoc())			
	{
	echo $_GET['id'];
	if ($_GET[$kol1]==$row[$kol2] AND $kol1!="") echo "<option value=".$row['id']." selected>".$row['naziv']."</option>";
	else
	echo "<option value='".$row['id']."'>".$row['naziv']."</option>";
	}
	echo "</select>";	
}
public function deaktiviraj($id,$tabela)
{
$q="UPDATE ".$tabela." SET aktivan=0 WHERE id=".$id;
$rezultat=$this->query($q);
}
public function aktiviraj($id,$tabela)
{
$q="UPDATE ".$tabela." SET aktivan=1 WHERE id=".$id;
$rezultat=$this->query($q);
}
public function paginacija($sql){
				
		$myFile = "../admin/config.cfg";
		$broj= fopen($myFile, 'r');
		$broj_redova = fgets($broj);
		fclose($broj);		
		// funkcija koja zamenjuje LIMIT X,10 intervalom koji je unet u admin panelu

if (preg_match("/[LIMIT]+[\s]+[0-9]+[,]+[0-9]/", $sql)) {
$sql=substr($sql, 0, -2);   
$sql=$sql.$broj_redova;

;}


		$rezultat=$this->query($sql);
		if ($rezultat)
		{

		
			WHILE ($row = $rezultat->fetch_assoc())	
			{
			$broj=$row['broj'];
			for ($i=0;$i<ceil($broj/$broj_redova);$i++)
				{if (!isset($_GET['strana'])) $_GET['strana']=ceil($broj/$broj_redova)-1;
				if ($i==$_GET['strana']) echo "<a href='".$_SERVER['PHP_SELF']."?strana=$i&pretraga=1' style='text-shadow:0px 0px 15px darkorange;color:orange;font-weight:bold;'>[".$i."]</a>";
				else echo "<a href='".$_SERVER['PHP_SELF']."?strana=$i&pretraga=1'>[".$i."]</a>";
				}
			}
		}
	if (ISSET($_GET['strana'])) $pocetak=$_GET['strana']*$broj_redova;
	else
	$pocetak=0;
	return $pocetak;
}	



public function paginacija1($sql,$page)
{

		
		$myFile = "../admin/config.cfg";
		$broj= fopen($myFile, 'r');
		$broj_redova = fgets($broj);
		fclose($broj);		
		// funkcija koja zamenjuje LIMIT X,10 intervalom koji je unet u admin panelu
if (preg_match("/[LIMIT]+[\s]+[0-9]+[,]+[0-9]/", $sql)) {
$sql=substr($sql, 0, -2);   
$sql=$sql.$broj_redova;	

;}



		echo "<div class='box'>";


		$rezultat=$this->query($sql);
		
		if ($rezultat)
		{
			WHILE ($row = $rezultat->fetch_assoc())	
			{
			$broj=$row['broj'];
			
			for ($i=0;$i<ceil($broj/$broj_redova);$i++)
				{if (!isset($_GET['strana'])) $_GET['strana']=ceil($broj/$broj_redova)-1;
				if ($i==$_GET['strana']) echo "<a href='default.php?strana=$i&str=$page&pretraga=1' style='text-shadow:0px 0px 15px darkorange;color:orange;font-weight:bold;'>[".$i."]</a>";
				else echo "<a href='".$_SERVER['PHP_SELF']."?strana=$i&str=$page&pretraga=1'>[".$i."]</a>";
				}
			}
			
		}
		
	if (ISSET($_GET['strana'])) $pocetak=$_GET['strana']*$broj_redova;	
	else
	$pocetak=0;	
	echo "</div>";
		
	return $pocetak;
	
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
      //echo "Snimljeno u: " . $folder . $_FILES["file"]["name"];
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
$rezultat=$this->query("UPDATE ks_radnik SET slika='$putanja' WHERE jmbg=$imefajla");
}
}
