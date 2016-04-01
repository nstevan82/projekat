<?php
class enkripcija
{
private $key;
private $encrypted;
private $decrypted;
public function __construct($key) {
$this->key=$key;
}
public function enkriptuj($string)
{
//za enkriptovanje:
	$this->encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $string, MCRYPT_MODE_ECB);
return $this->encrypted;
}
public function dekriptuj($string)
{
$this->encrypted=$string;
	//za dekriptovanje:
	$this->decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $this->encrypted, MCRYPT_MODE_ECB);
	return $this->decrypted;
}
}

?>