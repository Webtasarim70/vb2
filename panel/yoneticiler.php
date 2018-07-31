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

          $yoneticiler = $db->prepare("SELECT * FROM admin");
          $yoneticiler->execute(array());
          $toplam =$yoneticiler->rowCount();
          ?>

        <li class="breadcrumb-item active">Yönetici Listesi (<?php echo $toplam;?>)</li>
      </ol>
     
      
    <div class="row">
        
       
      </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	  <div class="table-responsive">
		<table class="table table-hover">

            <?php

            $lim=5;
            #sayfa başı gösterilecek video limiti
            $goster=$s * $lim - $lim;

            $yoneticiler=$db->prepare("SELECT * FROM  admin ORDER BY admin_id DESC LIMIT :goster, :lim");
            $yoneticiler->bindValue(":goster",(int) $goster, PDO::PARAM_INT);
            $yoneticiler->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
            $yoneticiler->execute();

          if ($yoneticiler->rowCount()){ ?>

              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Ad Soyad</th>
                  <th scope="col">Eposta</th>
                  <th scope="col">İşlemler</th>

              </tr>
              </thead>

          <?php

              foreach($yoneticiler as $row){ ?>


            <tbody>
            <tr>
                <td><?php echo $row['admin_id']?></td>
                <td><?php echo $row['admin_isim']?></td>
                <td><?php echo $row['admin_posta']?></td>
                <td><a href="islemler.php?islem=adminduzenle&id=<?php echo $row['admin_id']?>"><i class="fa fa-edit"></i></a> | <a href="islemler.php?islem=adminsil&id=<?php echo $row['admin_id']?>" onclick="return confirm('Silmek istiyor musunuz ?');"><i class="fa fa-remove"></i></a> </td>

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
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/yoneticiler.php?s=1">�</a></li>';
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/yoneticiler.php?s='.$onceki.'">></a></li>';
                      //echo '...';

                  }

                  for($i = $s - $flim; $i < $s + $flim + 1; $i++){
                      if($i > 0 && $i <= $ssayi){
                          if($i == $s){
                              echo '<li class="page-item"><a class="page-link" style="background:#337ab7;color:#fff" href="#">'.$i.'</a></li>';
                          }else{

                              echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/yoneticiler.php?s='.$i.'">'.$i.'</a></li>';
                          }
                      }
                  }

                  if($s <= $ssayi - 4){
                      $sonraki  = $s + 1;
                      //echo '...';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/yoneticiler.php?s='.$sonraki.'">></a></li>';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/yoneticiler.php?s='.$ssayi.'">�</a></li>';
                  }
              }
              echo '</ul>';


          }else{
              echo "<div class='alert alert-danger'>Yönetici Bulunmuyor.</div>";
          }

					  ?>
        </table>
      </div>
      </div>
    </div>
   
   
  <?php require_once "alt.php"; ?>