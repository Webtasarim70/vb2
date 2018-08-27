<?php
require_once "header.php";

?>
	
	<!-- /////////////////////////////////////////Content -->
	<div id="page-content" class="archive-page">
		<div class="container">
			<div class="row">
				<div id="main-content" class="col-md-8">
<!-- etikete göre gösterim -->
<?php 

          
	if (isset($_GET['tag'])) {
		 $tag=get('tag');
          $s=@intval(get('s'));
          if (!$s){$s=1;}

          $videosay = $db->prepare("SELECT * FROM videolar WHERE video_etiketler LIKE :tag");
          $videosay->execute(array(':tag'=>'%'.$tag.'%'));
          $toplam =$videosay->rowCount();
          $lim=5;
            #sayfa başı gösterilecek video limiti
            $goster=$s * $lim - $lim;


		 $etiketcek=$db->prepare('SELECT * FROM videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_durum=:durum AND video_etiketler LIKE :tag ORDER BY video_id DESC LIMIT :goster, :lim');
		   $etiketcek->bindValue(":durum", (int) 1, PDO::PARAM_INT);
            $etiketcek->bindValue(":goster",(int) $goster, PDO::PARAM_INT);
            $etiketcek->bindValue(":lim", (int) $lim, PDO::PARAM_INT);
            $etiketcek->bindValue(":tag", '%'.$tag.'%', PDO::PARAM_STR);
            $etiketcek->execute();
		 if ($etiketcek->rowCount()) {                     
        		 foreach ($etiketcek as $row) {   ?>
				<article>
						<a href="#"><h2 class="vid-name"><?php echo $row['video_baslik']; ?></h2></a>
						<div class="info">
							<h5>By <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo $row['video_sahibi']; ?></a></h5>
							<span><i class="fa fa-calendar"></i> <?php echo $row['video_eklemetarihi']; ?></span> 
									<?php 
									$video=$row['video_id'];
									$yorumlar=$db->prepare("SELECT * FROM yorumlar WHERE yorum_video_id=:id AND yorum_durum=:durum");
		              				$yorumlar->execute(array(':id'=>$video, ':durum'=>1));
		              				$yorumsay=$yorumlar->rowCount(); ?>

							<span><i class="fa fa-comment"></i><?php echo $yorumsay;?> Yorum</span>
							<span><i class="fa fa-eye"></i><?php echo $row['video_goruntulenme']; ?></span>
							<span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span>
							<ul class="list-inline">
								<li><a href="#" style="text-decoration: underline;color:#333;">Oyla</a></li>
								<li> - </li>
								<li>
									<span class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
									</span>
								</li>
							</ul>
						</div>
						<div class="wrap-vid">
							<div class="zoom-container">
								<div class="zoom-caption">
									<span><?php echo $row['kategori_adi'] ?></span>
									<a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">
										<i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
									</a>
									<p><small><?php echo $row['video_baslik']; ?></small></p>
								</div>
								<img src="<?php echo $row['video_resim']; ?>" />
							</div>
							<p><?php echo substr($row['video_aciklama'], 0,320); ?> <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"> DEVAM...</a></p>
						</div>
					</article>
					<div class="line"></div>
		 
	<?php	} 

           #sayfalama kodu

              echo ' <center> <ul class="pagination justify-content-center">';
              $ssayi = ceil($toplam/$lim);
              $flim = 3;

              if($ssayi < 2){
                  null;
              }else{

                  if($s > 4){
                      $onceki  = $s - 1;
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s=1">�</a></li>';
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s='.$onceki.'">></a></li>';
                      //echo '...';

                  }

                  for($i = $s - $flim; $i < $s + $flim + 1; $i++){
                      if($i > 0 && $i <= $ssayi){
                          if($i == $s){
                              echo '<li class="page-item"><a class="page-link" style="background:#337ab7;color:#fff" href="#">'.$i.'</a></li>';
                          }else{

                              echo '<li class="page-item"><a class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s='.$i.'">'.$i.'</a></li>';
                          }
                      }
                  }

                  if($s <= $ssayi - 4){
                      $sonraki  = $s + 1;
                      //echo '...';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s='.$sonraki.'">></a></li>';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/archive.php?kat='.$id.'&?s='.$ssayi.'">�</a></li>';
                  }
              }
              echo '</ul>';
	 } }
          
	if (isset($_GET['kat'])) {
		 $id=get('kat');


          $s=@intval(get('s'));
          if (!$s){$s=1;}

          $videosay = $db->prepare("SELECT * FROM videolar WHERE video_kat=:id");
          $videosay->execute(array(':id'=>$id));
          $toplam =$videosay->rowCount();
          $lim=5;
            #sayfa başı gösterilecek video limiti
            $goster=$s * $lim - $lim;


		 $kategoricek=$db->prepare('SELECT * FROM videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_kat=:id');
		 $kategoricek->execute(array(':id'=>$id));
		 if ($kategoricek->rowCount()) {                     
        		 foreach ($kategoricek as $row) {   ?>
				<article>
						<a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><h2 class="vid-name"><?php echo $row['video_baslik']; ?></h2></a>
						<div class="info">
							<h5>By <a href="#"><?php echo $row['video_sahibi']; ?></a></h5>
							<span><i class="fa fa-calendar"></i> <?php echo $row['video_eklemetarihi']; ?></span> 
									<?php 
									$video=$row['video_id'];
									$yorumlar=$db->prepare("SELECT * FROM yorumlar WHERE yorum_video_id=:id AND yorum_durum=:durum");
		              				$yorumlar->execute(array(':id'=>$video, ':durum'=>1));
		              				$yorumsay=$yorumlar->rowCount(); ?>

							<span><i class="fa fa-comment"></i><?php echo $yorumsay;?> Yorum</span>
							<span><i class="fa fa-eye"></i><?php echo $row['video_goruntulenme']; ?></span>
							<span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span>
							<ul class="list-inline">
								<li><a href="#" style="text-decoration: underline;color:#333;">Oyla</a></li>
								<li> - </li>
								<li>
									<span class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
									</span>
								</li>
							</ul>
						</div>
						<div class="wrap-vid">
							<div class="zoom-container">
								<div class="zoom-caption">
									<span><?php echo $row['kategori_adi'] ?></span>
									<a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">
										<i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
									</a>
									<p><small><?php echo $row['video_baslik']; ?></small></p>
								</div>
								<img src="<?php echo $row['video_resim']; ?>" />
							</div>
							<p><?php echo substr($row['video_aciklama'], 0,320); ?> <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"> DEVAM...</a></p>
						</div>
					</article>
					<div class="line"></div>
		 
	<?php	} 

           #sayfalama kodu

              echo ' <center> <ul class="pagination justify-content-center">';
              $ssayi = ceil($toplam/$lim);
              $flim = 3;

              if($ssayi < 2){
                  null;
              }else{

                  if($s > 4){
                      $onceki  = $s - 1;
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s=1">�</a></li>';
                      echo '<li class="page-item"><a class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s='.$onceki.'">></a></li>';
                      //echo '...';

                  }

                  for($i = $s - $flim; $i < $s + $flim + 1; $i++){
                      if($i > 0 && $i <= $ssayi){
                          if($i == $s){
                              echo '<li class="page-item"><a class="page-link" style="background:#337ab7;color:#fff" href="#">'.$i.'</a></li>';
                          }else{

                              echo '<li class="page-item"><a class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s='.$i.'">'.$i.'</a></li>';
                          }
                      }
                  }

                  if($s <= $ssayi - 4){
                      $sonraki  = $s + 1;
                      //echo '...';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/archive.php?kat='.$id.'&s='.$sonraki.'">></a></li>';
                      echo '<li class="page-item"><a  class="page-link" href="'.$site.'/archive.php?kat='.$id.'&?s='.$ssayi.'">�</a></li>';
                  }
              }
              echo '</ul>';
	 } }
?>


<!-- 1 --><!--
					<article>
						<a href="#"><h2 class="vid-name">Lorem ipsum dolor sit amet</h2></a>
						<div class="info">
							<h5>By <a href="#">Kelvin</a></h5>
							<span><i class="fa fa-calendar"></i> June 12, 2015</span> 
							<span><i class="fa fa-comment"></i> 0 Comments</span>
							<span><i class="fa fa-heart"></i>1,200</span>
							<ul class="list-inline">
								<li><a href="#" style="text-decoration: underline;color:#333;">Rate</a></li>
								<li> - </li>
								<li>
									<span class="rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
									</span>
								</li>
							</ul>
						</div>
						<div class="wrap-vid">
							<div class="zoom-container">
								<div class="zoom-caption">
									<span>Video's Tag</span>
									<a href="single.html">
										<i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
									</a>
									<p>Video's Name</p>
								</div>
								<img src="images/8.jpg" />
							</div>
							<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Consetetur sadipscing elitr, sed diam nonumy eirmod tempor inviduntut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.justo duo dolores et ea rebum. Consetetur sadipscing elitr,  consetetur sadipscing elitr elitr. <a href="#">MORE...</a></p>
						</div>
					</article>
					<div class="line"></div>
					
-->

				</div>

<?php include 'sidebar.php' ?>

				
			</div>
		</div>
	</div>


	
	
<?php
require_once "footer.php";
?>


