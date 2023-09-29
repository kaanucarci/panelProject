<?php
@session_start();
@ob_start();

define("DATA","data/");
define("SAYFA","include/");
define("SINIF","class/");
include_once(DATA."baglanti.php");
define("SITE",$siteURL);

if ($_POST) 
{
    if (!empty($_POST["tablo"]) && !empty($_POST["durum"]) && !empty($_POST["ID"])) 
    {
        $tablo=$DB->filter($_POST["tablo"]);
        $ID=$DB->filter($_POST["ID"]);
        $durum=$DB->filter($_POST["durum"]);
        $guncelle=$DB->sorguCalistir("UPDATE ".$tablo,"SET durum=? WHERE ID=?",array($durum,$ID),1);
        if ($guncelle != false) 
        {
            echo "TAMAM";
        }
        else
        {
            echo "HATA";
        }
    }   
    else
    {
        echo "BOS";
    }
}


?>


