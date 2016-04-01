<?php
class replacer
{
public function zameni($fajl,$var1,$var2){
//otvori fajl i preuzmi podatke
$data = file_get_contents($fajl);
// zameni default ime tabele 'kadrovska' u naziv tabele koju je uneo korisnik
$data = str_replace($var1, $var2, $data);
//snimi sql fajl
file_put_contents($fajl, $data);
}
}
?>