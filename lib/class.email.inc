<?php
class email {
private $toEmail;
private $fromEmail;
private $subject;
private $message;

public function __construct($toEmail, $fromEmail, $subject, $message) {
    $this->toEmail = $toEmail;
    $this->fromEmail = $fromEmail;
    $this->subject = $subject;
    $this->message= $message;
}
function posalji() {
    //$contents = "Odgovor:". $this->message;
	$contents = "Posiljalac: www.taraba.in.rs<br />Naslov: ".$this->subject."<br />Poruka: ".$this->message;
    //$headers = "From:steva";
	$from="esalter@taraba.in.rs";
    $headers = "" .
               "Reply-To:" . $from . "\r\n" .
               "X-Mailer: PHP/" . phpversion();
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";   
	
	
	
    $sendmail = mail($this->toEmail, $this->subject, $this->message,$headers,"-fE-salter") or die('nece');
    }
}
?>