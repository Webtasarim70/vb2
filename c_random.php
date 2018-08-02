<div class="box">
                    <div class="box-header">
                        <h2><i class="fa fa-play-circle-o"></i> Rastgele Videolar</h2>
                    </div>
                    <div class="box-content">
                        <div class="row">
                         <?php 
                         for ($i = 1; $i <= 3; $i++) { ?>

                         <div class="col-md-4">
                            <?php 

                           $videolar=$db->prepare("SELECT * FROM  videolar WHERE video_durum=:d  ORDER BY rand() DESC LIMIT 3");
                            $videolar->execute(array(':d'=>1));
                            if ($videolar->rowCount()) {
                                foreach ($videolar as $row) {

                            ?>

                                <div class="wrap-vid">
                                    <div class="zoom-container">
                                        <div class="zoom-caption">
                                            <span><?php echo $row['video_etiketler']; ?></span>
                                            <a href="single.html">
                                                <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                            </a>
                                            <p><?php echo $row['video_baslik']; ?></p>
                                        </div>
                                        <img src="<?php echo $row['video_resim']; ?>" />
                                    </div>
                                    <h3 class="vid-name"><a href="#"><?php echo $row['video_baslik']; ?></a></h3>
                                    <div class="info">
                                        <h5>By <a href="#"><?php echo $row['video_sahibi']; ?></a></h5>
                                        <span><i class="fa fa-calendar"></i><?php echo $row['video_eklenmetarihi']; ?></span>
                                        <span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                         <?php } ?>
                           
                        </div>
                    </div>
                    <div class="line"></div>
                </div>