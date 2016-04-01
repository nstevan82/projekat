<?php

/* gmail server */
//$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
//$hostname= '{imap.gmail.com:993/ssl/novalidate-cert}';
//include "efirma/lib/class.baza.inc";
$mysqli=new baza("../dbparam.php");
$mysqli->povezi();
//$mysqli->query("TRUNCATE TABLE s48_predmet_mail");
$hostname= '{mailcluster.loopia.se:993/ssl/novalidate-cert}'; //loopia mail server
$username = 'esalter@taraba.in.rs';
$password = 'tarabacha0s';

/* probaj da se konektujes */
$inbox = imap_open($hostname,$username,$password) or die('Ne mogu da se povezem na mail: ' . imap_last_error());
// probaj da nadjes email adrese posiljalaca

/* preuzmi emailove */
$emails = imap_search($inbox,'UNSEEN');

/* ako su vraceni emailovi, prodji kroz svaki... */
if($emails) {
	
	/* inicjalizuj output promenljivu */
	$output = '';
	
	/* postavi najnovije mailove na vrh */
	rsort($emails);
	
	/* ta svaki email... */
	foreach($emails as $email_number) {
		/* prikazi informacije specificne za ovaj email */
		$overview = imap_fetch_overview($inbox,$email_number,0);
		$message = imap_fetchbody($inbox,$email_number,2);
		/* prikazi informacije o headeru maila */
		$ime[$email_number]=$overview[0]->from;
		$naslov[$email_number]=$overview[0]->subject;
		$dat=$overview[0]->date;
		$datum[$email_number]=date("Y.m.d H:i:s", strtotime($dat));		
		$godina[$email_number]=date("Y", strtotime($dat));		
	
		$poruka[$email_number]=$message;
		/* prikazi telo emaila */
		$header = imap_headerinfo($inbox, $email_number);
		$fromaddr = $header->from[0]->mailbox . "@" . $header->from[0]->host;
		$adresa[$email_number]=$fromaddr;   //puni promenljivu $adresa nizom adresa
	}
} 
/* zatvori konekciju*/
imap_close($inbox);
$sql="";
foreach($adresa as $key=>$value){
//print $adresa[$key]." - ".$ime[$key]." - ".$naslov[$key]." - ".$poruka[$key]." - ".$datum[$key]." - ".$procitan[$key]." - ".$datum[$key]."<hr>";
// upisi u bazu sve nove mailove
$sql=$sql."INSERT INTO s48_predmet (sluzba,email,naslov,poruka,datum,godina,status,oemail,osms,otelefon,oweb,primljeno,aktivan) VALUES (1,'$adresa[$key]','$naslov[$key]','$poruka[$key]','$datum[$key]','$godina[$key]',1,1,0,0,0,'email',1);";
}
//$mysqli->zatvori();
$mysqli1=new baza("../dbparam.php");
$mysqli1->povezi();
$sql=(string)$sql;

$mysqli1->multiquery($sql) ;
//while ($mysqli1->next_result()) {;}
?>