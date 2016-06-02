<?php
$servidor              = 'localhost';      
$prefijo_usuario       = 'root';              
$contraseña_mysql      = '';         
$base_de_datos_mysql   = 'facebox'; 

$dbh = mysql_connect($servidor, $prefijo_usuario, $contraseña_mysql)
or die('Error: Database to host connection: '.mysql_error());

mysql_select_db($base_de_datos_mysql, $dbh)
or die('Error: Select database: '.mysql_error());

//Query of facebook database
$facebook = mysql_query('SELECT * FROM facebook',dbh)
or die(mysql_error());
 
//Output results
$facebook = mysql_query('SELECT * FROM facebook')
or die(mysql_error());

//Output results
if(!$facebook)
{
	$output_string='<p>Hubo un error ejecutando el QUERY:</p>'. mysql_error();
    mysql_close();
    echo json_encode($output_string);
}
elseif(!mysql_num_rows($facebook))
{
	$output_string='<p>No hay data disponible.</p>';
    mysql_close();
    echo json_encode($output_string);
}
else
	{
    $header = false;
	$output_string = "''";
    $output_string .=  '<table border="1">\n';
    while($row = mysql_fetch_assoc($facebook))
    {
        if(!$header)
        {
            $output_string .= '<tr>\n';
            foreach($row as $header => $value)
            {
                $output_string .= '<th>{$header}</th>\n';
            }
            $output_string .= '</tr>\n';
        }
        $output_string .= '<tr>\n';
        foreach($row as $value)
        {
            $output_string .= '<th>{$value}</th>\n';
        }
        $output_string .= '</tr>\n';
    }
    $output_string .= '</table>\n';
	

mysql_close();
// El siguiente echo es para devolver el resultado
echo json_encode($output_string);
	}

?>