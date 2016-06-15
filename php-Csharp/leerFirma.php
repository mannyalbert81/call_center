
<?php
if (!$almacén_cert = file_get_contents("C:\Users\User\Desktop\firma_byron\byron_giovanny_tamayo_silva.p12")) {
    echo "Error: No se puede leer el fichero del certificado\n";
    exit;
}

if (openssl_pkcs12_read($almacén_cert, $info_cert, "mi_clave_secreta")) {
    echo "Información del certificado\n";
    print_r($info_cert);
} else {
    echo "Error: No se puede leer el almacén de certificados.\n";
    exit;
}
?>
