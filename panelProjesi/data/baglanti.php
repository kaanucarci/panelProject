<?php
include_once(SINIF."class.upload.php");
include_once(SINIF."DB.php");  
$DB= new DB(); 
$ayarlar=$DB->getInfo("ayarlar","WHERE ID=?",array(1),"ORDER BY ID ASC",1);

    if ($ayarlar != false) {
        $sitebaslik=$ayarlar[0]["baslik"];
        $siteanahtar=$ayarlar[0]["anahtar"];
        $siteaciklama=$ayarlar[0]["aciklama"];
        $siteURL=$ayarlar[0]["url"];
    }

?>