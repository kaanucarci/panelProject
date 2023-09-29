<?php
if (!empty($_GET["tablo"])) 
{
    $tablo=$DB->filter($_GET["tablo"]);
    $kontrol=$DB->getInfo("moduller", "WHERE tablo=? AND durum=?", array($tablo,1), "ORDER BY ID ASC", 1);
    if ($kontrol != false) 
    {
        
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"><?=$kontrol[0]["baslik"]?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Ana Sayfa</a></li>
              <li class="breadcrumb-item active"><?=$kontrol[0]["baslik"]?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

      <section class="content">
<div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <a href="<?=SITE?>Liste/<?=$kontrol[0]["tablo"]?>" class="btn btn-info" style="float:right; margin-bottom: 10px; margin-left:10px;"><i class="fas fa-bars"></i> LİSTE</a>
                    <a href="<?=SITE?>ekle/<?=$kontrol[0]["tablo"]?>" class="btn btn-success" style="float:right; margin-bottom: 10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
                </div>
            </div>
              
        
       <?php
         if ($_POST) 
         {
            
            if (!empty($_POST["kategori"]) && !empty($_POST["baslik"]) && !empty($_POST["anahtar"]) && !empty($_POST["description"]) && !empty($_POST["sirano"])) 
            {
                $ekle="";
                $kategori=$DB->filter($_POST["kategori"]);
                $baslik=$DB->filter($_POST["baslik"]);
                $anahtar=$DB->filter($_POST["anahtar"]);
                $selflink=$DB->selflink($baslik);
                $description=$DB->filter($_POST["description"]);
                $sirano=$DB->filter($_POST["sirano"]);
                $metin=$DB->filter($_POST["metin"],true);
                if (!empty($_FILES["resim"]["name"])) 
                {
                    
                    $yukle=$DB->upload("resim","../images/".$kontrol[0]["tablo"]."/");
                    if ($yukle!=false) 
                    { 
                      $ekle=$DB->sorguCalistir("INSERT INTO ".$kontrol[0]["tablo"],"SET baslik=?, selflink=?, kategori=?, metin=?, resim=?, anahtar=?, description=?, durum=?, sirano=?, tarih=?", array($baslik, $selflink, $kategori, $metin, $yukle, $anahtar, $description, 1, $sirano, date("Y-m-d")));
                    }
                    else
                    {
                     
                        ?>
                        <div class="alert alert-info">Resim yükleme işleminiz başarısız oldu!</div>
                        <?php
                    }
                }
                else 
                {
                  $ekle=$DB->sorguCalistir("INSERT INTO ".$kontrol[0]["tablo"],"SET baslik=?, selflink=?, kategori=?, metin=?, anahtar=?, description=?, durum=?, sirano=?, tarih=?", array($baslik, $selflink, $kategori, $metin, $anahtar, $description, 1, $sirano, date("Y-m-d")));
                }

                if ($ekle!=false) 
                {
                  ?>
                  <div class="alert alert-success">İşleminiz başarıyla gerçekleşti!</div>
                  <?php

                } 
                else 
                {
                  ?>
                  <div class="alert alert-danger">İşlem sırasında bir sorun oldu!</div>
                  <?php
                }
                
            }
            else 
            {
                ?>
                <div class="alert alert-danger">Boş bıraktığınız alanları doludurunuz!</div>
                <?php    
            }
         }
       ?>     

  <form action="#" method="post" enctype="multipart/form-data">    
    <div class="col-md-8">
        <div class="card-body card card-primary">
          <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                  <label>Kategori Seç</label>
                  <select class="form-control select2" style="width: 100%;" name="kategori">
                  <?php
                    $sonuc=$DB->kategoriGetir($kontrol[0]["tablo"],"","-1");
                    if ($sonuc!=false) 
                    {
                        echo $sonuc;
                    }
                    else 
                    {
                        $DB->tekKategori($kontrol[0]["tablo"]). "buraya yazdı";
                    }
                  ?>
                  </select>
                </div>
                <!-- /.form-group -->
            </div>
              <!-- /.col -->
              <div class="col-md-12">
                <div class="form-group">
                    <label>Başlık</label>
                    <input type="text" class="form-control" name="baslik" placeholder="Başlık">
                </div>    
              </div>      
              <div class="col-md-12">
                <div class="form-group">
                    <label>Açıklama</label>
                    <textarea class="textarea" placeholder="Açıklama Girin.." name="metin"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>    
              </div>      
              <div class="col-md-12">
                <div class="form-group">
                    <label>Anahtar</label>
                    <input type="text" class="form-control" name="anahtar" placeholder="Anahtar">
                </div>    
              </div>    
              <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Description">
                </div>    
              </div>    
              <div class="col-md-12">
                <div class="form-group">
                    <label>Resim</label>
                    <input type="file" class="form-control" name="resim" placeholder="Resim Seçiniz">
                </div>    
              </div>    
              <div class="col-md-12">
                <div class="form-group">
                    <label>Sıra No</label>
                    <input type="number" class="form-control" name="sirano" placeholder="Sıra No" style="width:250px">
                </div>    
              </div>    
              <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary">KAYDET</button>
                </div>
              </div>
          </div>
            <!-- /.row -->
        </div>
    </div> 
  </form>  
    </div>     
      </section>

</div>
  <!-- /.content-wrapper -->
  <?php
    }
    else {
        ?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>">
        <?php
        
    }

}
else {
    ?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>">
    <?php
}
  ?>