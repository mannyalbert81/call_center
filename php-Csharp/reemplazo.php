<?php

$cadena = "Esta es la cadena de ejemplo para sustituir un caracter";
echo $cadena;
$resultado = str_replace("a", "A", $cadena);
echo "La cadena resultante es: " . $resultado;
 
$cadena2 = "Esta es la cadena de ejemplo para sustituir una cadena";
echo $cadena2;
$resultado2 = str_replace("cadena", "CADENA", $cadena2);
echo "La cadena resultante es: " . $resultado2;

?>