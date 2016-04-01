<!DOCTYPE HTML>
<html lang='sr' style="background:url('img/pozadina.jpg');background-repeat:no-repeat;background-attachment:fixed;background-size:100%">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-16">
      
      <title>E-SALTER</title>
      <link rel="stylesheet" href="../style.css">
<?php 
session_start();
// ako nije logovan i ako nema pristup modulu ne moze u modul
if (!isset($_SESSION['level']) OR $_SESSION['s48']==0) die("Nemate prava za pristup ovom modulu");
include "../lib/class.baza.inc";
require "../funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();
?>
</head>
<header style="background:url('img/header.png');background-size:cover;background-height;150px;width:100%px;height:150px;background-repeat:no-repeat;display:-webkit-box;display:-moz-box;background-width:100%;min-width:950px">
<!-- slika u gornjem levom uglu -->
<div style='position:relative;left:50px;top:50px;display:-webkit-box;display:-moz-box;-webkit-box-orient:horizontal;-moz-orient:horizontal;height:80px;background-repeat:no-repeat;padding-top:10px;padding-left:10px;'>
<h1 style='position:absolute;left:150px;font-size:20px;text-shadow:0px 0px 15px black;color:WHITE;max-width:500px'>E-SALTER online zahtevi</h1>
</div>
<div style='position:relative;top:60px;'>
<br>
<img src="img/grb.png" style='height:100px;width:100px;'>
</div>
</div>
</header><br>

