<?php 

session_start();
session_destroy();?>
<!DOCTYPE html>
<html lang="en"><head>
<?php
// ako nema fajla dbparam.php znaci da aplikacija nije instalirana. 
// U tom slucaju preusmeri korisnika na instalaciju programa.
if (!file_exists("dbparam.php")) {
header("Location: install.php"); 
}

?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.png">

    <title>T-FIRMA</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom stilovi za ovaj templejt -->
    <link href="css/justified-nav.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <h3 class="text-muted">T-FIRMA</h3>
        <ul class="nav nav-justified">
          <li><a href="#">Home</a></li>
          <li><a href="webportal/zahtev.php">Posaljite zahtev</a></li>
          <li><a href="webportal/odgovori.php">Odgovori na zahteve</a></li>
		  <li><a href="webportal/brziodgovor.php">Brzi odgovori</a></li>
          <li><a href="webportal/pregled_telefona.php">Sluzbeni telefoni</a></li>
          
          <li><a href="webportal/about.php">O autoru</a></li>
        </ul>
      </div>

      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>T-firma</h1>
        <p class="lead">Predstavljamo vam proizvod nase softverske kuće, 
softver koji će koristiti svakoj ozbiljnijoj firmi kojoj je
potrebna evidencija podataka o radnicima, klijentima i robi..</p>
        <p><a class="btn btn-lg btn-success" href="http://www.taraba.in.rs">www.taraba.in.rs</a></p>
      </div>

      <!-- Red sa 3 kolone-->
      <div class="row">
        <div class="col-lg-4">
          <h2>Admin</h2>
		  <img src="img/admin.png" style="height:150px;width:150px;display: block;margin-left:auto;margin-right:auto">
          <p>Koristite admin modul da biste mogli da registrujete
		  i uređujete korisničke naloge. Ovde se takođe vrši:
		  <ul>
		  <li>dodela prava pristupa modulima.</li>
		  <li>sinhronizacija sa mail serverom.</li>
		  <li>sinhronizacija sa MySql serverom.</li>
		  </ul>
		  <br>	  
		  </p>
          <p><a class="btn btn-primary" href="login.php?modul='admin'">Uloguj se »</a></p>
        </div>
        <div class="col-lg-4">
		<h2>Kadrovska služba</h2>
		  <img src="img/user.png" style="height:150px;width:150px;display: block;margin-left:auto;margin-right:auto">
          <p>Ovaj modul služi za evidenciju zaposlenih lica u firmi.
          Na ovaj način se vrši evidencija svih podataka, a na osnovu
		  tih podataka se vrše proračuni godišnjih odmora, plata i td.
		  Modul takođe raspolaže i izveštajima koji se mogu konvertovati
		  u excel fajlove. Kompletna dokumentacija koja je potrebna
		  kadrovskoj službi jedne ozbiljne firme.
		  </p>
          <p><a class="btn btn-primary" href="login.php?modul='kadrovska'">Uloguj se »</a></p>
       </div>
        <div class="col-lg-4">
		<h2>E-šalter</h2>
		<img src="img/info_desk.png" style="height:150px;width:150px;display: block;margin-left:auto;margin-right:auto">
          <p>Komunikacija između klijenata i firme nikada nije bila
		  lakša i efikasnija. Namena ovog modula je da klijenti
		  svoje zahteve šalju direktno službama u firmi. 
		  Zaposleni u firmi obradjuju zahteve, a klijent redovno 
		  dobija obaveštenja o svakoj izmeni vezanoj za zahtev 
		  i to putem emaila, webportala, telefonom ili SMSom.</p><br>
          <p><a class="btn btn-primary" href="login.php?modul='faq'">Uloguj se »</a></p>
        </div>
      </div>
	  
	      <!-- Red sa 3 kolone-->
      <div class="row">
        <div class="col-lg-4">
          <h2>Evidencija ulaza/izlaza</h2>
		  <img src="img/ui.png" style="height:150px;width:250px;display: block;margin-left:auto;margin-right:auto">
          <p>Modul za evidenciju ulaza/izlaza služi za:
		  <ul>
		  <li>Evidenciju ulaza/izlaza zaposlenih.</li>
		  <li>Evidenciju prekovremenih sati.</li>
		  <li>Evidenciju kašnjenja.</li>
		  <li>Izradu kartica za zaposlene.</li>
		  <li>Moguca ugradnja info-pulta.</li>
		  </ul>
		  
		  </p>
          <p><a class="btn btn-primary" href="login.php?modul='ui'">Uloguj se »</a></p>
        </div>
        <div class="col-lg-4">
		<h2>Materijalno poslovanje</h2>
		  <img src="img/cabinet.png" style="height:150px;width:150px;display: block;margin-left:auto;margin-right:auto">
          <p>Sve što vam je potrebno za evidenciju nabavljene robe. <br>		  
		  <ul>
		  <li>Ulazne,izlazne fakture</li>
		  <li>Izvodi</li>
		  <li>Ulazni,izlazni delovodnik</li>
		  <li>KEPU</li>
		  <li>Otpremljena roba</li>
		  </ul>		  
		  </p>
          <p><a class="btn btn-primary" href="login.php?modul='materijalno'">Uloguj se »</a></p>
       </div>
        <div class="col-lg-4">
		<h2>E-magacin</h2>
		<img src="img/magacin.png" style="height:150px;width:150px;display: block;margin-left:auto;margin-right:auto">
          <p>Upravljanje magacinom.
		  Ovaj modul vam omogućava:
		  <ul>
		  <li>Evidenciju artikala u magacinu</li>
		  <li>Podrzan rad sa vise magacina</li>
		  <li>Izveštaje o radu magacina</li>
		  <li>Atraktivni grafički interfejs</li>
		  </ul>
		  </p><br>
          <p><a class="btn btn-primary" href="login.php?modul='magacin'">Uloguj se »</a></p>
        </div>
      </div>
	  <div class="col-lg-4">
		<h2>Mehanizacija</h2>
		<img src="img/kran.png" style="height:200px;width:200px;display: block;margin-left:auto;margin-right:auto">
          <p>Evidencija rada mašina.
		  Ovaj modul vam omogućava:
		  <ul>
		  <li>Evidencija rada broda</li>
		  <li>Evidencija rada dizalice</li>
		  <li>Izvestaje</li>
		  
		  </ul>
		  </p><br>
          <p><a class="btn btn-primary" href="login.php?modul='masine'">Uloguj se »</a></p>
        </div>
	  <div class="col-lg-4">
		<h2>Blagajna</h2>
		<img src="img/blagajna.png" style="height:200px;width:200px;display: block;margin-left:auto;margin-right:auto">
          <p>Blagajna novca i goriva.
		  Ovaj modul vam omogućava:
		  <ul>
		  <li>Evidenciju novca</li>
		  <li>Evidenciju goriva</li>
		  <li>Evidenciju plata</li>
		  <li>Izvestaje</li>
		  </ul>
		  </p><br>
          <p><a class="btn btn-primary" href="login.php?modul='blagajna'">Uloguj se »</a></p>
        </div>
		  <div class="col-lg-4">
		<h2>E-kancelarija</h2>
		<img src="img/eoffice.png" style="height:200px;width:200px;display: block;margin-left:auto;margin-right:auto">
          <p>
		  Ovaj modul vam omogućava:
		  <ul>
		  <li>Evidenciju ugovora</li>
		  <li>Evidenciju ponuda</li>		  
		  <li>Telefonski imenik</li>		  
		  <li>Izvestaje</li>
		  </ul>
		  </p><br>
          <p><a class="btn btn-primary" href="login.php?modul='eoffice'">Uloguj se »</a></p>
        </div>
      </div>


	  
	  
	  

      <!-- Futer sajta -->
      <div class="footer">
        <p style='text-align:center'>© # Taraba # 2013</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  

</body></html>