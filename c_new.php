


                <div class="box">
                    <div class="box-header">
                        <h2><i class="fa fa-vimeo-square"></i> Yeni Videolar</h2>
                    </div>
                    <div class="box-content">
                        <div class="row">

                            <?php 
                            $videolar=$db->prepare("SELECT * FROM  videolar  INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_durum=:v ORDER BY video_eklemetarihi ASC LIMIT 3 ");
                            $videolar->execute(array(':v'=>1));
                            if ($videolar->rowCount()) {
                                foreach ($videolar as $row) {
                                  
                            ?>


                            <div class="col-md-4">
                                <div class="wrap-vid">
                                    <div class="zoom-container">
                                        <div class="zoom-caption">
                                            <span><?php echo $row['kategori_adi'] ?></span>
                                            <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">
                                                <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                            </a>
                                           <!-- <p><?php echo substr($row['video_baslik'], 0,30); ?></p> -->
                                        </div>
                                        <img src="<?php echo $row['video_resim']; ?>" />
                                    </div>
                                    <h3 class="vid-name"><a href="#"><?php echo $row['video_baslik']; ?></a></h3>
                                    <div class="info">
                                        <h5>By <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo $row['video_sahibi']; ?></a></h5>
                                        <span><i class="fa fa-calendar"></i><?php echo $row['video_eklemetarihi']; ?></span><br>
                                        <span><i class="fa fa-eye"></i><?php echo $row['video_goruntulenme']; ?></span>
                                        <span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span> 
                                    </div>
                                </div>
                            </div>
                        <?php }
                        } ?>
                           
                        </div>
                    </div>
                </div>