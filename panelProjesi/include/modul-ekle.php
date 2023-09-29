 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Modül Paneli</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>index.php?sayfa=home">Ana Sayfa</a></li>
              <li class="breadcrumb-item active">Modül Paneli</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<section class="content">
    <div class="container-fluid">

        <?php
            if ($_POST) {
              $calistir=$DB->modulEkle();
              if ($calistir != false) 
              {
                  echo '<div class="alert alert-success">Başarılı</div>';
                  ?>
                  <meta http-equiv="refresh" content="2;url=<?=SITE?>">
                  <?php
              }
              else 
              {
                  echo '<div class="alert alert-danger">Başarısız</div>';
              }
            }

        ?>

        <div class="col-md-6">
            <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Modül Tanımlama Ekranı</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="#" method="post">
                        <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Modül İsmini Giriniz</label>
                            <input type="text" class="form-control" name="baslik" id="exampleInputEmail1" placeholder="Modül Girin">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="durum" value="1" checked="checked">
                            <label class="form-check-label" for="exampleCheck1">Aktif Yap</label>
                        </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">MODÜL EKLE</button>
                        </div>
                    </form>
            </div>
        </div> 
</section>      
    </div>
 </div>
   