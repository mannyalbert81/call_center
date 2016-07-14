<?php
class AyudaReport{
    
function Redirect($url, $permanent = false)
{
    header('Location: ' . '/FrameworkMVC/view/ireports/'.$url, true, $permanent ? 301 : 302);

    exit();
}
    //Helpers para las vistas
}
?>
