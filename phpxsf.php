<?php
$lokasine = sys_get_temp_dir().DIRECTORY_SEPARATOR.'phpx'.DIRECTORY_SEPARATOR;

if(!is_dir($lokasine)){

    // download zip + extract
    chdir(sys_get_temp_dir());
    mkdir("phpx");
    file_put_contents($lokasine.'phpx.zip', file_get_contents('https://www.php-proxy.com/download/php-proxy.zip'));
    $zip = new ZipArchive;
    $res = $zip->open($lokasine.DIRECTORY_SEPARATOR.'phpx.zip');
    if ($res === TRUE) {
    $zip->extractTo($lokasine);
    $zip->close();
        //echo 'extracted';
    } else {
        //echo 'failed extract';
    }


    // setting config
    file_put_contents($lokasine.'config.php', str_replace("\$config['app_key'] = '';", "\$config['app_key'] = '1';", file_get_contents($lokasine.'config.php')));
    file_put_contents($lokasine.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'main.php', str_replace("index.php", "", file_get_contents($lokasine.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'main.php')));
    file_put_contents($lokasine.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'url_form.php', str_replace("index.php", "", file_get_contents($lokasine.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'url_form.php')));

}


    // run //
    chdir($lokasine);
    include "index.php";
?>
