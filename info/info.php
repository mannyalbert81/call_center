<?php
        //Modifica la direccion partiendo de tu carpera de instalación del Tomcat
 
        //$direccion_javabrige="C://wamp//htdocs//JavaBridge//java//Java.inc";
		$direccion_javabrige="C://Users//ManuelAlberto//git//coactiva//JavaBridge//java//Java.inc";


    require_once($direccion_javabrige);
     
    $system = new Java('java.lang.System');
    echo 'Java version=' . $system->getProperty('java.version') . '<br />';
    echo 'Java vendor=' . $system->getProperty('java.vendor') . '<br />';
    echo 'OS=' . $system->getProperty('os.name') . ' ' .
    $system->getProperty('os.version') . ' on ' .
    $system->getProperty('os.arch') . ' <br />';
 
    $formatter = new Java('java.text.SimpleDateFormat', "EEEE, MMMM dd, yyyy 'at' h:mm:ss a zzzz");
    echo $formatter->format(new Java('java.util.Date'));
?>