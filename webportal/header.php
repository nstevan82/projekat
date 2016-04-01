<!DOCTYPE HTML>
<html lang='sr' style="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-16">
      <title>E-SALTER</title>
      <link rel="stylesheet" href="../style.css">
<?php 
session_start();

include "../lib/class.baza.inc";
include "../faq/funkcije.php";
	   $mysqli=new Baza("../dbparam.php");
	   $mysqli->povezi();
?>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <!-- Custom stilovi za ovaj templejt -->
    <link href="../css/justified-nav.css" rel="stylesheet">
</head>
    <div class="container" style="width:100%;margin-right:auto;margin-left:auto">
      <div class="masthead">
        <h3 class="text-muted" style="text-align:left">E-FIRMA</h3>
        <ul class="nav nav-justified">
          <li><a href="../index.php">Home</a></li>
          <li><a href="zahtev.php">Posaljite zahtev</a></li>
          <li><a href="odgovori.php">Odgovori na zahteve</a></li>
		  <li><a href="brziodgovor.php">Brzi odgovori</a></li>
          <li><a href="pregled_telefona.php">Sluzbeni telefoni</a></li>
          <li><a href="about.php">O autoru</a></li>
        </ul>
      </div>
	  </div>
<a href="../index.php">
<header>
    <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.png">
    <title>E-FIRMA</title>
</header>
</a>


