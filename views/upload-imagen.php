<?php
if (array_key_exists('img',$_REQUEST)) {
    echo $_REQUEST['img'];

    $imgData = base64_decode(substr($_REQUEST['img'],22));
    $id = $_REQUEST['id'];

    $norad = isset($_GET["norad"]) ? $_GET["norad"]:NULL;

    //$file = 'uploads/imagen.png';
    $rutarc = "../firma/fir_";
    $no = $id;

    $file = $rutarc.$no.'.png';

    if (file_exists($file)) { unlink($file); }
        $fp = fopen($file, 'w');
        fwrite($fp, $imgData);
        fclose($fp);
}
?>