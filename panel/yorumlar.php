<?php
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
          <?php
          $s=@intval(get('s'));
          #sayi gelebilir  @intival
          if (!$s){$s=1;}

          #INNER JOIN videolar ON videolar.video_id=yorumlar.yorum_video_id

          $yorumlar = $db->prepare("SELECT * FROM yorumlar INNER JOIN videolar ON videolar.video_id=yorumlar.yorum_video_id");
          $yorumlar->execute(array());
          $toplam =$yorumlar->rowCount();
          ?>

        <li class="breadcrumb-item active">Yorum Listesi (<?php echo $toplam;?>)</li>
      </ol>
     
      
    <div class="row">
        
       
      </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	  <div class="table-responsive">
		<table class="table table-hover">

            <?php

            $lim=10;
            #sayfa başı gösterilecek video limiti
            $goster=$s * $lim - $lim;

            # INNER JOIN videolar ON videolar.video_id=yorumlar.yorum_id
            $yorumlar=$db->prepare("SELECT * FROM yorumlar INNER JOIN videolar ON videolar.video_id=yorum_video_id
              ORDER BY yorum_id DESC LIMIT :goster, :lim");
            $yorumlar->bindValue(":goster",(int) $goster, PDO::PARAM_INT);
            $yorumlar->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
            $yorumlar->execute();

          if ($yorumlar->rowCount()){ ?>

              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Video Başlık</th>
                  <th scope="col">Yorumcu</th>
                  <th scope="col">E posta</th>
                  <th scope="col">Website</th>
                  <th scope="col">Onay</th>
                  <th scope="col">İçerik</th>
              </tr>
              </thead>

          <?php

              foreach($yorumlar as $row){ ?>


            <tbody>
            <tr>
                <td><?php echo $row['yorum_id']?></td>
                <td><a href="<?php echo $site; ?>/detay.php?info=<?php echo $row['video_url'] ?>"><?php echo $row['video_baslik']?></a></td>
                <td><?php echo $row['yorum_isim']?></td>
                <td><?php echo $row['yorum_eposta']?></td>
                <td><?php echo $row['yorum_website']?></td>
                <td>

                    <?php
                    if ($row['yorum_durum']==1){
                        echo "<div style='color:green;font-weight:bold'><i class='fa fa-check' aria-hidden='true'></i> Onaylı</div>";

                    }else {
                        echo "<div style='color:red;font-weight:bold'><i class='fa fa-close' aria-hidden='true'></i> Onay Bekliyor</div>";

                    }

                    ?>


                </td>
                <td><?php echo $row['yorum_icerik']?></td>


                <td>
                    <?php
                        if ($row['yorum_durum']==1){
 ?>
                    <a href="islemler.php?islem=onaykaldir&id=<?php echo $row['yorum_id']?>"><i class="fa fa-eraser"></i></a> <?php }else{ ?>

                    <a href="islemler.php?islem=onayla&id=<?php echo $row['yorum_id']?>"><i class="fa fa-edit"></i></a>
                     <?php } ?>




                    | <a href="islemler.php?islem=yorumsil&id=<?php echo $row['yorum_id']?>" onclick="return confirm('Silmek istiyor musunuz ?');"><i class="fa fa-remove"></i></a> </td>

            </tr>

            </tbody>


             <?php }


             #sayfalama kodu

              echo '<ul class="pagination justify-content-center">';
              $ssayi = ceil($toplam/$lim);
              $flim = 3;

              if($ssayi < 2){
                  null;
              }else{

                  if($s > 4){
                      $onceki  = $s - 1;
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/yorumlar.php?s=1">�</a></li>';
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/yorumlar.php?s='.$onceki.'">></a></li>';
                      //echo '...';

                  }

                  for($i = $s - $flim; $i < $s + $flim + 1; $i++){
                      if($i > 0 && $i <= $ssayi){
                          if($i == $s){
                              echo '<li class="page-item"><a class="page-link" style="background:#337ab7;color:#fff" href="#">'.$i.'</a></li>';
                          }else{

                              echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/yorumlar.php?s='.$i.'">'.$i.'</a></li>';
                          }
                      }
                  }

                  if($s <= $ssayi - 4){
                      $sonraki  = $s + 1;
                      //echo '...';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/yorumlar.php?s='.$sonraki.'">></a></li>';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/yorumlar.php?s='.$ssayi.'">�</a></li>';
                  }
              }
              echo '</ul>';


          }else{
              echo "<div class='alert alert-danger'>Yorum Bulunmuyor.</div>";
          }

					  ?>
        </table>
      </div>
      </div>
    </div>
   
   
  <?php require_once "alt.php"; ?>