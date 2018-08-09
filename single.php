<?php 
require_once "header.php"; ?>

<?php
                $veri=@get('info');
                if (!$veri){
                    header('Location:'.$site.'');
                } else{
                    $sec=$db->prepare('SELECT * FROM videolar WHERE video_url=:url AND video_durum=:durum');
                    $sec->execute(array(':url'=>$veri, ':durum'=>1));
                    if ($sec->rowCount()) {
                        $row = $sec->fetch(PDO::FETCH_OBJ);

                        $video= $row->video_id;
                        $cookie=@$_COOKIE[$video];

                        if (!isset($cookie)){

                            $okunmasayisi=$db->prepare("UPDATE videolar SET  video_goruntulenme=:g  WHERE video_id=:id");
                            $artir= $row->video_goruntulenme;
                            $okunmasayisi->execute(array(':g'=> $artir + 1,':id'=>$video));
                            setcookie($video,'1', time()+3600);
                        }

                        ?>




<div id="page-content" class="single-page">
		<div class="container">
			<div class="row">
				<div id="main-content" class="col-md-8">
					<div class="wrap-vid">
<!-- embed -->
						<iframe width="100%" height="400" src="https://www.youtube.com/embed/<?php echo $row->video_url ?>" frameborder="0" allowfullscreen></iframe>
					</div>
<!-- paylaş -->
					<div class="share">
						<ul class="list-inline center">
							<li><a href="#" class="btn btn-facebook"><i class="fa fa-facebook"></i> Share</a></li>
							<li><a href="#" class="btn btn-twitter"><i class="fa fa-twitter"></i> Tweet</a></li>
							<li><a href="#" class="btn btn-pinterest"><i class="fa fa-pinterest"></i> Tweet</a></li>
							<li><a href="#" class="btn btn-google"><i class="fa fa-google-plus-square"></i> Google+</a></li>
							<li><a href="#" class="btn btn-mail"><i class="fa fa-envelope-o"></i> E-mail</a></li>
						</ul>
					</div>
					<div class="line"></div>
<!-- video detay -->
					<h1 class="vid-name"><a href="#"><?php echo $row->video_baslik ?></a></h1>
					<div class="info">
						<h5>By <a href="#"><?php echo $row->video_sahibi ?></a></h5>
						<span><i class="fa fa-calendar"><?php echo $row->video_eklemetarihi ?></i></span> 
						<span><i class="fa fa-heart"></i><?php echo $row->video_goruntulenme ?></span>
						<span><i class="fa fa-eye"></i><?php echo $row->video_goruntulenme ?></span>
					</div>
					<p style="margin-top: 20px">
				<?php echo nl2br($row->video_aciklama); ?>

					</p>
					<div class="vid-tags">
					<?php				
					$metin= $row->video_etiketler; 
					$yenimetin = explode(',',$metin);
					foreach($yenimetin as $yazdir){
					echo "<a href='archive.php?tag=$yazdir'>$yazdir</a>";
					}  ?>
						
					</div>

				 <?php 
				}else{
                        header('Location:'.$site.'');
                    }
                } ?>

					<div class="line"></div>

<?php


              $yorumlar=$db->prepare("SELECT * FROM yorumlar WHERE yorum_video_id=:id AND yorum_durum=:durum");
              $yorumlar->execute(array(':id'=>$video, ':durum'=>1));
              $yorumsay=$yorumlar->rowCount();

            if ($yorumlar->rowCount()){ ?> 

 <div class="heading"><h6><i class="fa fa-comments"></i>Yorumlar (<?php echo $yorumsay; ?>)</h6></div>
 <?php
                foreach ($yorumlar as $yorumrow){ ?>

   <!---- Start Widget  Comment---->
                <div class="widget wid-post">
                   
                    <div class="content">
                        <div class="post">
							
                              
                                
                                <div class="col-md-12"><img style="width:50px;height: auto;margin-right: 10px; margin-bottom: 10px" src="<?php echo $site;?>/css/user.jpg" />
                                	<a href="http://<?php echo  $yorumrow['yorum_website']?>"><h5><?php echo  $yorumrow['yorum_isim']?></h5></a><?php echo $yorumrow['yorum_icerik']?></div>
                                
                           
                        </div>
                        
                       
                    </div>
                </div>


                    <?php
                }

            }else{
                echo "<div class='alert alert-info' >Henüz yorum yapılmamış ilk yorumu siz yapın.</div>";
            }

			?>

<div class="line"></div>





<!-- yorumlar -->
					<div class="comment">
						<h3>Yorum Bırak</h3>


                <?php
                if (isset($_POST['yorumgonder'])){
                    $isim= post('isim');
                    $eposta=post('eposta');
                    $website=post('website');
                    $yorum=post('yorum');

                    if (!$isim || !$eposta || !$yorum ){
                        echo "<div class='alert alert-danger'>İsim, eposta yada yorum kısmı boş bırakılamaz </div>";
                    }else{
                        if (!filter_var($eposta, FILTER_VALIDATE_EMAIL)){
                            echo "<div class='alert alert-danger'>Geçerli bir eposta adresi giriniz. </div>";
                        }else{
                            $yorumekle= $db->prepare("INSERT INTO yorumlar  SET 
                                yorum_video_id    = :video,
                                yorum_isim       =:isim,
                                yorum_eposta    =:posta,
                                yorum_website   =:web,
                                yorum_icerik    =:icerik,
                                yorum_durum     =:durum 
                                                        ");
                            $yorumekle->execute(array(
                                ':video' => $video,
                                ':isim'=>   $isim,
                                ':posta'=>   $eposta,
                                ':web'=>    $website,
                                ':icerik'=>  $yorum,
                                ':durum' => 2
                            ));

                            if ($yorumekle){
                                echo "<div class='alert alert-success'>Yorumunuz onaylandıktan sonra yayınlanacak.</div>";
                            }else{
                                echo  "<div class='alert alert-danger'>Tüh bir şeyler ters gitti!. </div>";

                            }
                        }
                    }


                }

                ?>


						<form name="form1" method="post" action="">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
									<input type="text" class="form-control input-lg" name="isim" id="name" placeholder="İsminiz" required="required" />
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input type="email" class="form-control input-lg" name="eposta" id="email" placeholder="Mail Adresiniz" required="required" />
									</div>
								</div>

								<div class="col-md-4">
									<div class="form-group">
										<input type="text" class="form-control input-lg" name="website" id="email" placeholder="Websiteniz" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<textarea name="yorum" id="message" class="form-control" rows="4" cols="25" required="required"
										placeholder="Yorumunuz"></textarea>
									</div>						
									<button type="submit" class="btn btn-4 btn-block" name="yorumgonder" id="btnSend">
								Yorumumu Ekle!</button>
								</div>
							</div>
						</form>
					</div>
					<div class="line"></div>



					<div class="box">
<!-- benzer videolar -->
						<div class="box-header">
							<h2><i class="fa fa-globe"></i> RELATED VIDEOS</h2>
						</div>
						<div class="box-content">
							<div class="row">
<!-- 1 -->
								<div class="col-md-4">
									<div class="wrap-vid">
										<div class="zoom-container">
											<div class="zoom-caption">
												<span>Video's Tag</span>
												<a href="single.html">
													<i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
												</a>
												<p>Video's Name</p>
											</div>
											<img src="images/7.jpg" />
										</div>
										<h3 class="vid-name"><a href="#">Video's Name</a></h3>
										<div class="info">
											<h5>By <a href="#">Kelvin</a></h5>
											<span><i class="fa fa-calendar"></i>25/3/2015</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
<!-- 1 -->
								<div class="col-md-4">
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
										<h3 class="vid-name"><a href="#">Video's Name</a></h3>
										<div class="info">
											<h5>By <a href="#">Kelvin</a></h5>
											<span><i class="fa fa-calendar"></i>25/3/2015</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
<!-- 1 -->
								<div class="col-md-4">
									<div class="wrap-vid">
										<div class="zoom-container">
											<div class="zoom-caption">
												<span>Video's Tag</span>
												<a href="single.html">
													<i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
												</a>
												<p>Video's Name</p>
											</div>
											<img src="images/9.jpg" />
										</div>
										<h3 class="vid-name"><a href="#">Video's Name</a></h3>
										<div class="info">
											<h5>By <a href="#">Kelvin</a></h5>
											<span><i class="fa fa-calendar"></i>25/3/2015</span> 
											<span><i class="fa fa-heart"></i>1,200</span>
										</div>
									</div>
								</div>
<!-- 1 -->
							</div>
						</div>
					</div>
				</div>
				
					
					<?php include 'sidebar.php'; ?>
					
			
			</div>
		</div>
	</div>





<?php

require_once "footer.php";


?>
