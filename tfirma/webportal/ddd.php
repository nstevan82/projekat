<?php
include "../lib/class.email.inc";
		$email=new email("wakawaki@yahoo.com","wakawaki@yahoo.com","naslov","ovo je poruka");
		$email->posalji();
		
		
		mail("wakawaki@yahoo.com","meee", "prouka", "fafa")

?>