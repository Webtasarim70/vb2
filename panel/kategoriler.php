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

          $kategoriler = $db->prepare("SELECT * FROM kategori");
          $kategoriler->execute(array());
          $toplam =$kategoriler->rowCount();
          ?>

        <li class="breadcrumb-item active">Kategori Listesi (<?php echo $toplam;?>)</li>
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

          $kategoriler=$db->prepare("SELECT * FROM kategori  ORDER BY ana_kategori_id ASC LIMIT :goster, :lim");
// $kategoriler=$db->prepare("SELECT * FROM kategori  INNER JOIN kategori ON  kategori.ana_kategori_id=kategori.kategori_id ORDER BY ana_kategori_id ASC LIMIT :goster, :lim");
            $kategoriler->bindValue(":goster",(int) $goster, PDO::PARAM_INT);
            $kategoriler->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
            $kategoriler->execute();

          if ($kategoriler->rowCount()){ ?>

              <thead>
              <tr>
                  <th scope="col">#</th>
                  <th scope="col">Kategori Adı</th>
                  <th scope="col">Ana Kategori Adı</th>
                  <th scope="col">Açıklama</th>
                  <th scope="col">Durum</th>
                  <th scope="col">Onay</th>
              </tr>
              </thead>

          <?php

              foreach($kategoriler as $row){ ?>


            <tbody>
            <tr>
                <td><?php echo $row['kategori_id']?></td>
                <td><?php echo $row['kategori_adi']?></td>
                <td>
                    <?php 
                    if ($row['ana_kategori_id']==0) {
                      echo("Üst Kategori");
                    }else{ 
                      echo $row['ana_kategori_id'];

                    }

                    ?>
                                      

                  </td>
                <td><?php echo $row['kategori_aciklama']?></td>
                <td>

                    <?php
                    if ($row['kategori_durum']==1){
                        echo "<div style='color:green;font-weight:bold'><i class='fa fa-check' aria-hidden='true'></i> Onaylı</div>";

                    }else {
                        echo "<div style='color:red;font-weight:bold'><i class='fa fa-close' aria-hidden='true'></i> Onay Bekliyor</div>";

                    }

                    ?>


                </td>


                <td>
                    <?php
                        if ($row['kategori_durum']==1){
 ?>
                    <a href="islemler.php?islem=kategorionaykaldir&id=<?php echo $row['kategori_id']?>"><i class="fa fa-eraser"></i></a> <?php }else{ ?>

                    <a href="islemler.php?islem=kategorionayla&id=<?php echo $row['kategori_id']?>"><i class="fa fa-edit"></i></a>
                     <?php } ?>




                    | <a href="islemler.php?islem=kategorisil&id=<?php echo $row['kategori_id']?>" onclick="return confirm('Silmek istiyor musunuz ?');"><i class="fa fa-remove"></i></a> </td>

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
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/kategoriler.php?s=1">�</a></li>';
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/kategoriler.php?s='.$onceki.'">></a></li>';
                      //echo '...';

                  }

                  for($i = $s - $flim; $i < $s + $flim + 1; $i++){
                      if($i > 0 && $i <= $ssayi){
                          if($i == $s){
                              echo '<li class="page-item"><a class="page-link" style="background:#337ab7;color:#fff" href="#">'.$i.'</a></li>';
                          }else{

                              echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/kategoriler.php?s='.$i.'">'.$i.'</a></li>';
                          }
                      }
                  }

                  if($s <= $ssayi - 4){
                      $sonraki  = $s + 1;
                      //echo '...';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/kategoriler.php?s='.$sonraki.'">></a></li>';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/kategoriler.php?s='.$ssayi.'">�</a></li>';
                  }
              }
              echo '</ul>';


          }else{
              echo "<div class='alert alert-danger'>Kategori Bulunmuyor.</div>";
          }

					  ?>
        </table>
      </div>
      </div>
    </div>
   
   
  <?php require_once "alt.php"; ?>