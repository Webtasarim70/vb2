<?php
define('emre',true);
require_once "ust.php";


?>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
   <?php require_once "nav.php"; ?>
 </nav>
 <div class="content-wrapper">
  <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="index.php">Panel</a>
      </li>
      <li class="breadcrumb-item active">Yapılacak İşlemler</li>
    </ol>


    <div class="row">


    </div>
    <!-- Example DataTables Card-->
    <div class="card mb-3" style="padding:15px">

      <?php

      if (isset($_GET['info'])){

        $info=strip_tags(trim(get('info')));
        $apikey=$arow->site_apikey;
        $yunusemre = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$info."&key=".$apikey."&part=snippet");
        $videobilgi =json_decode($yunusemre,true);

              /*  echo "<pre>";
                print_r($videobilgi);
                echo "</pre>";
                */ 
                
                $sahibi=$videobilgi['items']['0']['snippet']['channelTitle'];
                $title=$videobilgi['items']['0']['snippet']['title'];
                $acikla=$videobilgi['items']['0']['snippet']['description'];
                $resim=$videobilgi['items']['0']['snippet']['thumbnails']['medium']['url'];
                $etiket=$videobilgi['items']['0']['snippet']['tags'];

                if (!$title) {
                  echo "<div class='alert alert-danger'>Başlık bulunmuyor</div> ";
                }else{

                  ?>
                  <div class="embed-responsive embed-responsive-21by9">

                    <iframe class="embed-responsive-item" width="475" height="300" style="height:500px;" src="https://www.youtube.com/embed/<?php echo $info; ?>" frameborder="0"></iframe>
                  </div>
                <hr>
         


          <?php 
            if (isset($_POST['videoekle'])){
                                    $baslik=post('baslik');
                                    $sef=sef_link($baslik);
                                    $sahibi=post('sahibi');
                                    $resim=post('resim');
                                    $url=post('videourl');
                                    $acik=$_POST['aciklama'];
                                    $etiket=post('etiket');
                                    $tarih =date('d.M.Y h:i:s');
                                    $kategori=post('kategori');
                                    $tavsiye=post('tavsiye');

                                    $sefyap= explode(',',$etiket);
                                    $dizi=array();
                                        foreach ($sefyap as $par){
                                            $dizi[]=sef_link($par);
                                        }
                                    $deger=implode(',', $dizi);

                              if (!$baslik || !$sahibi || !$resim || !$url || !$acik || !$etiket){
                                  echo "<div class='alert alert-danger'>Alanlar boş bırakılamaz</div>";
                              }else{
                                  $varmi=$db->prepare("SELECT * FROM videolar WHERE video_url=:url");
                                  $varmi->execute(array(':url'=>$url));
                                  if ($varmi->rowCount()){
                                      echo "<div class='alert alert-danger'>Bu video zaten sistemde kayıtlı bilader </div>";
                                  }else{
                                      $videoekle=$db->prepare('INSERT INTO videolar SET 
                                    video_sahibi             =:s,
                                    video_baslik             =:b,
                                    video_sef_baslik         =:sef,
                                    video_resim              =:r,
                                    video_url                =:u,
                                    video_aciklama           =:a,
                                    video_eklemetarihi      =:t,
                                    video_goruntulenme       =:g,
                                    video_durum              =:d,
                                    video_etiketler          =:e,
                                    video_tavsiye            =:tavsiye,
                                    video_kat                =:kategori,
                                    video_sefetiketler       =:sefe 
                                      ');

                                     $videoekle->execute(array(
                                             ':s'           =>$sahibi,
                                             ':b'           =>$baslik,
                                             ':sef'         =>$sef,
                                             ':r'           =>$resim,
                                             ':u'           =>$url,
                                             ':a'           =>$acik,
                                             ':t'           =>$tarih,
                                             ':g'           =>0,
                                             ':d'           =>1,
                                             ':e'           =>$etiket,
                                             ':tavsiye'     =>$tavsiye,
                                             ':kategori'    =>$kategori,
                                             ':sefe'        =>$deger
                                                                              ));

                                     if ($videoekle){
                                         echo  "<div class='alert alert-success'> Video Güncellendi</div>";
                                         header('Refresh:3;url=index.php');
                                     }else{
                                         echo  "<div class='alert alert-danger'> Tüh Ya birşeyler ters gitti şansa bak..</div>";
                                     }
                                     }
                              }

                            }else{


          ?>


              # video düzenleme formu
              <form class="form-horizontal" action="" method="POST">

                <div class="form-group">
                  <div class="col-lg-2 control-label" for="inputEmail"> Başlık </div>
                  <div class="col-lg-12">
                    <input  type="text" class="form-control" name="baslik" value="<?php echo $title;?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-2 control-label" for="inputEmail"> Video Sahibi </div>
                  <div class="col-lg-12">
                    <input  type="text" class="form-control" name="sahibi" value="<?php echo $sahibi;?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-2 control-label" for="inputEmail"> Video Resim</div>
                  <div class="col-lg-12">
                    <input  type="text" class="form-control" name="resim" value="<?php echo $resim;?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-2 control-label" for="inputEmail"> Video URL </div>
                  <div class="col-lg-12">
                    <input  type="text" class="form-control" name="videourl" value="<?php echo $info;?>">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-lg-2 control-label" for="inputEmail"> Video Açıklama </div>
                  <div class="col-lg-12">
                   <textarea  rows="10" class="form-control" name="aciklama"><?php echo $acikla;?></textarea>
                 </div>
               </div>



               <div class="form-group">
                <div class="col-lg-2 control-label" for="inputEmail"> Etiketler </div>
                <div class="col-lg-12">
                  <input  type="text" class="form-control" name="etiket" 
                  value="<?php foreach ($etiket as $row){ echo $row.", ";}  ?>">
                </div>
              </div>


                             <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Öne Çıkarılma</div>
                                     <div class="col-lg-12">
                                        <select name="tavsiye" class="form-control">
                                            <?php
                                                if ($row->video_tavsiye==1){
                                                    echo '<option value="1" selected>Öne Çıkarılmış  </option>  
                                                    <option value="2">Normal  </option>';
                                                }else{
                                                    echo '<option value="1"> Öne Çıkarılmış  </option>  
                                                    <option value="2" selected> Normal  </option>';

                                                }
                                            ?>

                                        </select>

                                     </div>
                                </div>





                        <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail">Kategorisi</div>
                                     <div class="col-lg-12">
                                        
                                      <select name="kategori" id="ana_kategori_id">
                                      <option value="0">Seç</option>
                                       <?php
                                            kategori_listele($ana_kategori_id)            
                                       ?>
                                      </select>

                                     </div>
                                </div>





                           <div class="form-group">
                <div class="col-lg-12 col-lg-offset-2">
                  <button type="submit" name="videoekle" class="btn btn-primary"> Videoyu Ekle!</button>
                </div>
              </div>
            </form>


                  <?php

               } }

              }

              ?>

              
          </div>


        </div>


        <?php require_once "alt.php"; ?>