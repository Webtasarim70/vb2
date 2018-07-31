<?php
define("emre",true);

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
          if (!$s){$s=1;}


          $oneriler = $db->prepare("SELECT * FROM oneriler");
          $oneriler->execute(array());
          $toplam =$oneriler->rowCount();
          ?>

        <li class="breadcrumb-item active">Öneri Listesi (<?php echo $toplam;?>)</li>
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
            $yorumlar=$db->prepare("SELECT * FROM oneriler  ORDER BY oneri_id DESC LIMIT :goster, :lim");
            $oneriler->bindValue(":goster",(int) $goster, PDO::PARAM_INT);
            $oneriler->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
            $oneriler->execute();

          if ($oneriler->rowCount()){ ?>

              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Öneren</th>
                  <th scope="col">Öneren e-posta</th>
                  <th scope="col">Öneri Video</th>
                  <th scope="col">İşlemler</th>


              </tr>
              </thead>

          <?php

              foreach($oneriler as $row){

                  $videobilgi= mb_substr($row['oneri_video'],32,50);

                  ?>


            <tbody>
            <tr>
                <td><?php echo $row['oneri_id']?></td>
                <td><?php echo $row['oneri_isim']?></td>
                <td><?php echo $row['oneri_posta']?></td>
                <td><a href="https://www.youtube.com/watch?v=<?php echo $videobilgi;?>"><?php echo $row['oneri_video']?></a></td>

                <td>

                 <a href="videodetay.php?info=<?php echo $videobilgi;?>"><i class="fa fa-plus"></i></a>
                    | <a href="islemler.php?islem=onerisil&id=<?php echo $row['oneri_id']?>" onclick="return confirm('Silmek istiyor musunuz ?');"><i class="fa fa-remove"></i></a> </td>

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