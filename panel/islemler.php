<?php
# echo !defined("emre")? die(''): null;
define('emre',true);


require_once "ust.php"; ?>

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
          $islem=@get('islem');
            switch ($islem){

                case 'videoduzenle':
                    if (isset($_SESSION['oturum'])){
                        $id=@get('id');
                        $sec=$db->prepare("SELECT * FROM videolar WHERE video_id=:id");

                        $sec->execute(array(':id'=>$id));
                        if ($sec->rowCount()){
                            $row=$sec->fetch(PDO::FETCH_OBJ);

                                #form gönderilmiş ise
                            if (isset($_POST['videoguncelle'])){
                                    $baslik=post('baslik');
                                    $sef=sef_link($baslik);
                                    $sahip=post('sahip');
                                    $resim=post('resim');
                                    $url=post('videourl');
                                    $acik=$_POST['aciklama'];
                                    $etiket=post('etiket');
                                    $durum=post('durum');

                                    $sefyap= explode(',',$etiket);
                                    $dizi=array();
                                        foreach ($sefyap as $par){
                                            $dizi[]=sef_link($par);
                                        }
                                        $deger=implode(',', $dizi);

                                  if (!$baslik || !$sahip || !$resim || !$url || !$acik || !$etiket){
                                  echo "<div class='alert alert-danger'>Alanlar boş bırakılamaz</div>";
                                 }else{
                                  $varmi=$db->prepare("SELECT * FROM videolar  WHERE video_url=:url AND video_id !=:id");
                                  $varmi->execute(array(':url'=>$url, ':id'=>$id));
                                  if ($varmi->rowCount()){
                                      echo "<div class='alert alert-danger'>Bu video zaten sistemde kayıtlı bilader </div>";
                                  }else{
                                      $videoguncelle=$db->prepare('UPDATE videolar SET 
                                    video_sahibi             =:s,
                                    video_baslik             =:b,
                                    video_sef_baslik         =:sef,
                                    video_resim              =:r,
                                    video_url                =:u,
                                    video_aciklama           =:a,
                                    video_durum              =:d,
                                    video_etiketler          =:e,
                                    video_sefetiketler       =:et 
                                      WHERE video_id=:id');
                                     $videoguncelle->execute(array(
                                             ':s'           =>$sahip,
                                             ':b'           =>$baslik,
                                             ':sef'         =>$sef,
                                             ':r'           =>$resim,
                                             ':u'           =>$url,
                                             ':a'           =>$acik,
                                             ':d'           =>$durum,
                                             ':e'           =>$etiket,
                                             ':et'          =>$deger,
                                             ':id'          =>$id
                                     ));

                                     if ($videoguncelle){
                                         echo  "<div class='alert alert-success'> Video Güncellendi</div>";
                                         header('Refresh:3;url=index.php');
                                     }else{
                                         echo  "<div class='alert alert-danger'> Tüh Ya birşeyler ters gitti şansa bak..</div>";
                                     }
                                     }
                                }

                            }

                ?>
                         # video düzenleme formu
                            <form class="form-horizontal" action="" method="POST">

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Başlık </div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="baslik" value="<?php echo $row->video_baslik ?>">
                                     </div>
                                </div>

                                 <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Video Sahibi </div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="sahip" value="<?php echo $row->video_sahibi ?>">
                                     </div>
                                </div>

                                 <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Video Resim</div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="resim" value="<?php echo $row->video_resim ?>">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Video URL </div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="videourl" value="<?php echo $row->video_url ?>">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Video Açıklama </div>
                                     <div class="col-lg-12">
                                     <textarea  rows="10" class="form-control" name="aciklama"><?php echo $row->video_aciklama;?></textarea>
                                     </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Etiketler </div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="etiket" value="<?php echo $row->video_etiketler ?>">
                                     </div>
                                </div>


                               <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Video Durumu</div>
                                     <div class="col-lg-12">
                                        <select name="durum" class="form-control">
                                            <?php
                                                if ($row->video_durum==1){
                                                    echo '<option value="1" selected>Onaylı  </option>  
                                                    <option value="2">Onay Bekliyor  </option>';
                                                }else{
                                                    echo '<option value="1">Onaylı  </option>  
                                                    <option value="2" selected>Onay Bekliyor  </option>';

                                                }
                                            ?>

                                        </select>

                                     </div>
                                </div>

                             <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Öne Çıkarılma</div>
                                     <div class="col-lg-12">
                                        <select name="durum" class="form-control">
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
                                        
                                      <select name="ana_kategori_id" id="ana_kategori_id">
                                      <option value="0">Seç</option>
                                       <?php
                                            kategori_listele($ana_kategori_id)            
                                       ?>
                                      </select>

                                     </div>
                                </div>





                                <div class="form-group">
                                    <div class="col-lg-12 col-lg-offset-2">
                                        <button type="submit" name="videoguncelle" class="btn btn-primary"> Videoyu Güncelle</button>
                                    </div>
                                 </div>
                            </form>


                <?php }
                    }

                break;


                case 'adminduzenle':
                    if (isset($_SESSION['oturum'])){
                        $id=@get('id');
                        $sec=$db->prepare("SELECT * FROM admin WHERE admin_id=:id");

                        $sec->execute(array(':id'=>$id));
                        if ($sec->rowCount()){
                            $row=$sec->fetch(PDO::FETCH_OBJ);

                            #form gönderilmiş ise
                            if (isset($_POST['yoneticiguncelle'])){

                                $eposta=post('eposta');
                                $isim=post('adsoyad');
                                $sifre=post('sifre');
                                $sifreli=sha1(md5($sifre));

                                #eposta isim boş bırakılmaz
                                if (!$eposta || !$isim){
                                    echo "<div class='alert alert-danger'>Yönetici ismi ve E-postası boş bırakılamaz</div>";
                                }else {
                                   #daha önceden kayıtlımı
                                   $varmi=$db->prepare("SELECT * FROM admin WHERE admin_posta=:posta AND admin_id=:id !=id");
                                   $varmi->execute(array(':posta'=>$eposta, ':id'=>$id));
                                       if ($varmi->rowCount()){
                                        echo "<div class='alert alert-danger'>Bu yönetici daha önceden kaydedilmiş</div>";
                                       }else{
                                           #e posta formatı dogrumu?
                                           # if (filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                                           # echo "<div class='alert alert-danger'>E posta formatı hatalı kontrol ediniz.</div>";
                                          # }else{
                                                   if ($_POST['sifre']==""){
                                                    #sifre boş ise
                                                    $guncelle=$db->prepare("UPDATE admin SET admin_posta=:p, admin_isim=:i WHERE admin_id=:id");
                                                    $guncelle->execute(array(':p'=>$eposta, ':i'=>$isim, ':id'=>$id));

                                                        if ($guncelle){
                                                          echo "<div class='alert alert-success'>Yönetici güncellendi parolası değiştirilmedi.</div>";
                                                          header('refresh:3;url=yoneticiler.php');
                                                        }else{
                                                            echo "<div class='alert alert-danger'>Bir hata oluştu</div>";
                                                        }
                                                    }else{
                                                      #sifre boş  değil ise

                                                         $guncelle2=$db->prepare("UPDATE admin SET admin_posta=:p, admin_sifre=:sifre, admin_isim=:i WHERE admin_id=:id");
                                                         $guncelle2->execute(array(':p'=>$eposta,':sifre'=>$sifreli, ':i'=>$isim, ':id'=>$id));

                                                        if ($guncelle2){
                                                          echo "<div class='alert alert-success'>Yönetici güncellendi.....</div>";
                                                          header('refresh:3;url=yoneticiler.php');
                                                        }else{
                                                            echo "<div class='alert alert-danger'>Bir hata oluştu</div>";
                                                        }
                                                    }
                                       }
                                }
                            }
                          ?>
                                #yonetici düzenleme formu
                            <form class="form-horizontal" action="" method="POST">

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Yönetici Eposta </div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="eposta" value="<?php echo $row->admin_posta ?>">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail3"> Yönetici Ad Soyad </div>
                                    <div class="col-lg-12">
                                        <input  value="<?php echo $row->admin_isim ?>" type="text" class="form-control" name="adsoyad" placeholder="Ad Soyad">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail3"> Yönetici Şifre</div>
                                    <div class="col-lg-12">
                                      <div style="color:red"> * Değiştirmek istemiyorsanız boş bırakınız. </style> </div>
                                        <input type="text" class="form-control" name="sifre" placeholder="Sifre">
                                    </div>
                                </div>
                            <div class="form-group">
                                <div class="col-lg-12 col-lg-offset-2">
                                    <button type="submit" name="yoneticiguncelle" class="btn btn-primary"> Yönetici Güncelle</button>
                                </div>
                            </div>
                            </form>

                            <?php
                            
                        }else{
                            echo "<div class='alert alert-danger'>hata oluştu, bekleyiniz</div>";
                            header('Location:yoneticiler.php');
                        }
                    }
                    break;


                  case 'yeniyonetici':


                       if (isset($_POST['yoneticiekle'])){

                           $eposta=post('eposta');
                           $isim=post('adsoyad');
                           $sifre=post('sifre');
                           $sifreli=sha1(md5($sifre));

                           #alanlar boş bırakılmasın
                           if (!$sifre || !$isim || !$eposta ){
                                                                   echo "<div class='alert alert-danger'>Yönetici ismi, E-posta ve şifre boş bırakılamaz</div>";

                           }else{
                               #daha önceden kayıtlımı
                                $varmi=$db->prepare("SELECT * FROM admin WHERE admin_posta=:posta");
                                $varmi->execute(array(':posta'=>$eposta));
                                if ($varmi->rowCount()){
                                echo "<div class='alert alert-danger'>Bu yönetici daha önceden kaydedilmiş</div>";
                                }else{
                                     #e posta formatı dogrumu?
                                            if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                                           echo "<div class='alert alert-danger'>E posta formatı hatalı kontrol ediniz.</div>";
                                }else{
                                                 $guncelle2=$db->prepare("INSERT INTO admin SET admin_posta=:p, admin_sifre=:sifre, admin_isim=:i");
                                                 $guncelle2->execute(array(':p'=>$eposta,':sifre'=>$sifreli, ':i'=>$isim));
                                                 if ($guncelle2){
                                                          echo "<div class='alert alert-success'>Yönetici güncellendi.....</div>";
                                                          header('refresh:3;url=yoneticiler.php');
                                                        }else{
                                                            echo "<div class='alert alert-danger'>Bir hata oluştu</div>";
                                                        }

                                            }


                                }
                           }


                       }else{



                  ?>
                  #yonetici ekleme formu
                            <form class="form-horizontal" action="" method="POST">

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Yönetici Eposta </div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="eposta" placeholder="E posta">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail3"> Yönetici Ad Soyad </div>
                                    <div class="col-lg-12">
                                        <input  type="text" class="form-control" name="adsoyad" placeholder="Ad Soyad">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail3"> Yönetici Şifre</div>
                                    <div class="col-lg-12">
                                    <input type="text" class="form-control" name="sifre" placeholder="Sifre">
                                    </div>
                                </div>
                            <div class="form-group">
                                <div class="col-lg-12 col-lg-offset-2">
                                    <button type="submit" name="yoneticiekle" class="btn btn-primary"> Yönetici Ekle</button>
                                </div>
                            </div>
                            </form>
                  <?php }

                  break;

                case 'ayarduzenle':
                # `ayar_id`, `site_url`, `site_baslik`, `site_keyw`, `site_desc`, `site_duyuru`, `site_footer`, `site_apikey`

                if (isset($_POST['ayarguncelle'])){
                    $id=1;
                    $url=post('url');
                    $baslik=post('baslik');
                    $anahtar=post('anahtar');
                    $acik=post('acik');
                    $duyuru=@$_POST['duyuru'];
                    $altbilgi=post('altbilgi');
                    $apikey=post('apikey');

                   $ayarla=$db->prepare('UPDATE ayarlar SET 
                        site_url         =:u,
                        site_baslik      =:b,
                        site_keyw        =:k,
                        site_desc        =:d,
                        site_duyuru      =:du,
                        site_footer      =:f,
                        site_apikey      =:api
                                            ');
                   $ayarla->execute(array(
                           ':u'         =>$url,
                           ':b'         =>$baslik,
                           ':k'         =>$anahtar,
                           ':d'         =>$acik,
                           ':du'        =>$duyuru,
                           ':f'         =>$altbilgi,
                           ':api'       =>$apikey

                   ));

                       if ($ayarla){
                        echo "<div class='alert alert-success'>Ayarlar güncellendi.....</div>";
                        header('refresh:3;url=index.php');
                                                        }else{
                        echo "<div class='alert alert-danger'>Bir hata oluştu</div>";
                                                        }

                }else{
                       


                ?>
                   #ayar düzenleme formu
                            <form class="form-horizontal" action="" method="POST">

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Site Anasayfa Url</div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="url" value="<?php echo $arow->site_url ?>">
                                     </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Site Başlığı</div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="baslik" value="<?php echo $arow->site_baslik ?>">
                                     </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Site Açıklama</div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="acik" value="<?php echo $arow->site_desc ?>">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Site Anahtar Kelimeler</div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="anahtar" value="<?php echo $arow->site_keyw ?>">
                                     </div>
                                </div>
                                
                                 <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Site Alt Bilgi</div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="altbilgi" value="<?php echo $arow->site_footer ?>">
                                     </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Site Apikey</div>
                                     <div class="col-lg-12">
                                    <input  type="text" class="form-control" name="apikey" value="<?php echo $arow->site_apikey ?>">
                                     </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-lg-2 control-label" for="inputEmail"> Site Duyuru</div>
                                     <div class="col-lg-12">
                                      <textarea name="duyuru" class="form-control" rows="10"><?php echo $arow->site_duyuru ?></textarea>
                                     </div>
                                </div>

                            <div class="form-group">
                                <div class="col-lg-12 col-lg-offset-2">
                                    <button type="submit" name="ayarguncelle" class="btn btn-primary"> Ayarları Güncelle!</button>
                                </div>
                            </div>
                            </form>


                <?php
                    }
                break;

















                case 'onaykaldir':
                if (isset($_SESSION['oturum'])){
                    $id=@get('id');
                    $sil=$db->prepare("UPDATE  yorumlar SET yorum_durum=:durum WHERE yorum_id=:id");
                    $sil->execute(array(':id'=>$id, ':durum'=>2));
                    if ($sil){
                        echo "<div class='alert alert-success'>Yorum Onayı Kaldırıldı, bekleyiniz</div>";
                        header('refresh:3;url=yorumlar.php');
                    }else{
                        echo "<div class='alert alert-danger'>hata oluştu, bekleyiniz</div>";
                        header('refresh:2;url=index.php');
                    }
                }
                break;
                case 'onayla':
                    if (isset($_SESSION['oturum'])){
                        $id=@get('id');
                        $sil=$db->prepare("UPDATE  yorumlar SET yorum_durum=:durum WHERE yorum_id=:id");
                        $sil->execute(array(':id'=>$id, ':durum'=>1));
                        if ($sil){
                            echo "<div class='alert alert-success'>Yorum Onaylandı, bekleyiniz</div>";
                            header('refresh:3;url=yorumlar.php');
                        }else{
                            echo "<div class='alert alert-danger'>hata oluştu, bekleyiniz</div>";
                            header('refresh:2;url=index.php');
                        }
                    }
                    break;

                case 'videosil':
                    if (isset($_SESSION['oturum'])){
                        $id=@get('id');
                        $sil=$db->prepare('DELETE FROM videolar WHERE video_id=:id');
                        $sil->execute(array(':id'=>$id));
                        if ($sil){
                            echo "<div class='alert alert-success'>Video silindi, bekleyiniz</div>";
                            header('refresh:3;url=index.php');
                        }else{
                            echo "<div class='alert alert-danger'>hata oluştu, bekleyiniz</div>";
                            header('refresh:2;url=index.php');
                        }
                    }
                    break;

                     case 'onerisil':
                    if (isset($_SESSION['oturum'])){
                        $id=@get('id');
                        $sil=$db->prepare('DELETE FROM oneriler WHERE oneri_id=:id');
                        $sil->execute(array(':id'=>$id));
                        if ($sil){
                            echo "<div class='alert alert-success'>Oneri silindi, bekleyiniz</div>";
                            header('refresh:3;url=oneriler.php');
                        }else{
                            echo "<div class='alert alert-danger'>hata oluştu, bekleyiniz</div>";
                            header('refresh:2;url=oneriler.php');
                        }
                    }
                    break;


             case 'adminsil':
                    if (isset($_SESSION['oturum'])){
                            $id=@get('id');
                            if ($id!=$uid){

                                $id=@get('id');
                                $sil=$db->prepare('DELETE FROM admin WHERE admin_id=:id');
                                $sil->execute(array(':id'=>$id));
                                if ($sil){
                                echo "<div class='alert alert-success'>Yönetici silindi, bekleyiniz</div>";
                                header('refresh:3;url=yoneticiler.php');
                    } }else{
                                echo "<div class='alert alert-danger'>Kendinizi Silemezsiniz. bekleyiniz</div>";
                                header('refresh:2;url=yoneticiler.php');
                            }
                    }
                    break;

              case 'yorumsil':
                    if (isset($_SESSION['oturum'])){
                        $id=@get('id');
                        $sil=$db->prepare('DELETE FROM yorumlar WHERE yorum_id=:id');
                        $sil->execute(array(':id'=>$id));
                        if ($sil){
                            echo "<div class='alert alert-success'>Yorum silindi, bekleyiniz</div>";
                            header('refresh:3;url=yorumlar.php');
                        }else{
                            echo "<div class='alert alert-danger'>hata oluştu, bekleyiniz</div>";
                            header('refresh:2;url=yorumlar.php');
                        }
                    }
                    break;


            #case sonu
            }


          ?>


	  		



	  </div>
				  
			
    </div>

  <?php require_once "alt.php"; ?>