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

          $videolar = $db->prepare("SELECT * FROM videolar");
          $videolar->execute(array());
          $toplam =$videolar->rowCount();
          $lim=5;
          #sayfa başı gösterilecek video limiti
          $goster=$s * $lim - $lim;


          #asıl sorgumuz
          $videolar=$db->prepare("SELECT * FROM  videolar ORDER BY video_id DESC LIMIT :goster, :lim");
          $videolar->bindValue(":goster",(int) $goster, PDO::PARAM_INT);
          $videolar->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
          $videolar->execute();

          if ($videolar->rowCount()){
          ?>





        <li class="breadcrumb-item active">Video Listesi (<?php echo $toplam ?>)</li>
      </ol>
     
      
      <div class="row">



       
      </div>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
	  <div class="table-responsive">
		<table class="table table-hover">



                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Video Resim</th>
                    <th scope="col">Video Başlık</th>
                    <th scope="col">Video Url</th>
                    <th scope="col">Video Sahibi</th>
                    <th scope="col">Durum</th>
                    <th scope="col">İşlemler</th>

                </tr>
                </thead>


                <?php

                foreach ($videolar as $row) {
                ?>

                <tbody>
                <tr>
                    <td><?php echo $row['video_id'] ?></td>
                    <td><img src="<?php echo $row['video_resim'] ?>" width="100" height="100" /></td>
                    <td><a target="_blank" data-toggle="tooltip" data-placement="top" title="Sitede İzle" href="<?php echo $site ?>/detay.php?info=<?php echo $row['video_url'] ?>"><?php echo $row['video_baslik'] ?></a></td>

                    <td><a target="_blank" data-toggle="tooltip" data-placement="top" title="Youtubede İzle" href="https://www.youtube.com/watch?v=<?php echo $row['video_url'] ?>"><?php echo $row['video_url'] ?></a></td>
                    <td><?php echo $row['video_sahibi'] ?></td>
                    <td>


                        <?php
                            if ($row['video_durum']==1){
                                echo "<div style='color:green;font-weight:bold'><i class='fa fa-check' aria-hidden='true'></i> Onaylı</div>";

                            }else {
                                echo "<div style='color:red;font-weight:bold'><i class='fa fa-close' aria-hidden='true'></i> Onay Bekliyor</div>";

                            }



                        ?>




                    </td>



                    <td><a href="islemler.php?islem=videoduzenle&id=<?php echo $row['video_id'] ?>"><i class="fa fa-edit"></i></a> | <a href="islemler.php?islem=videosil&id=<?php echo $row['video_id'] ?>" onclick="return confirm('Silmek istiyor musunuz ?');"><i class="fa fa-remove"></i></a> </td>

                </tr>

                </tbody>


                <?php }

            }else{
                echo "<div class='alert alert-danger'> Video Bulunmuyor </div>";
            }





            #sayfalama kısmı
                echo '<ul class="pagination justify-content-center">';
                $ssayi = ceil($toplam/$lim);
                $flim = 3;

                if($ssayi < 2){
                    null;
                }else{

                    if($s > 4){
                        $onceki  = $s - 1;
                        echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/index.php?s=1">�</a></li>';
                        echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/index.php?s='.$onceki.'">></a></li>';
                        //echo '...';

                    }

                    for($i = $s - $flim; $i < $s + $flim + 1; $i++){
                        if($i > 0 && $i <= $ssayi){
                            if($i == $s){
                                echo '<li class="page-item"><a class="page-link" style="background:#337ab7;color:#fff" href="#">'.$i.'</a></li>';
                            }else{

                                echo '<li class="page-item"><a class="page-link" href="'.$site.'/panel/index.php?s='.$i.'">'.$i.'</a></li>';
                            }
                        }
                    }

                    if($s <= $ssayi - 4){
                        $sonraki  = $s + 1;
                        //echo '...';
                        echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/index.php?s='.$sonraki.'">></a></li>';
                        echo '<li class="page-item"><a  class="page-link" href="'.$site.'/panel/index.php?s='.$ssayi.'">�</a></li>';
                    }
                }
                echo '</ul>';

               ?>

        </table>
      </div>
      </div>
      
    </div>
   
   
  <?php require_once "alt.php"; ?>