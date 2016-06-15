<?php

ob_start();  

//Get the ipconfig details using system commond  
system('ipconfig /all');  


// Capture the output into a variable  
$mycomsys=ob_get_contents();  

// Clean (erase) the output buffer  
ob_clean();
  
//echo utf8_encode($mycomsys).'<br>'; 

$macaddress="";
$find_mac = "Direcci";
//$find_mac = "Fhysical";  
//find the "Physical" & Find the position of Physical text  
$pmac = strpos($mycomsys, $find_mac);

if ($pmac === false) {
   // echo "La cadena '$find_mac' no fue encontrada en la cadena '$mycomsys'";
} else {
	$find_mac = "Fhysical";
	$macaddress=substr($mycomsys,($pmac+36),17);  
   // echo "La cadena '$find_mac' fue encontrada en la cadena '$mycomsys'";
   // echo " y existe en la posición $pmac"."<br>";
}


echo "esta en la posicion '$pmac'".'<br>';  
// Get Physical Address  

$macaddress=substr($mycomsys,($pmac+43),23);  
//Display Mac Address  

echo $macaddress;  

	
?>

