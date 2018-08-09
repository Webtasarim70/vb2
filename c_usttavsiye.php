<!-- üst tavsiye -->
            <div class="featured">
                <div class="main-vid">
                    <div class="col-md-6">

                     <?php
                       $videolar=$db->prepare("SELECT * FROM  videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat
                        WHERE video_durum=:d AND video_tavsiye=:t  ORDER BY video_id DESC LIMIT 1");
                       $videolar->execute(array(':d'=>1, ':t'=>1 ));
                          if ($videolar->rowCount()) {
                          foreach ($videolar as $row) {
                                        ?>


                        <div class="zoom-container">
                            <div class="zoom-caption">
                                <span><?php echo $row['kategori_adi'] ?></span>
                                <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">
                                    <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                </a>
                                <p><small><?php echo $row['video_baslik'] ?> </small></p>
                            </div>
                            <img style="height:auto; width:610px" src="<?php echo $row['video_resim'] ?>" />
                        </div>

                    <?php }} ?>
                    </div>
                </div>

                <div class="sub-vid">
                    

                        <?php
                       $videolar=$db->prepare("SELECT * FROM  videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_durum=:d AND video_tavsiye=:t  ORDER BY video_id DESC LIMIT 4");
                       $videolar->execute(array(':d'=>1, ':t'=>1 ));
                          if ($videolar->rowCount()) {
                          foreach ($videolar as $row) {
                                        ?>

                        <div class="col-md-3">
                            <div class="zoom-container">
                                <div class="zoom-caption">
                                    <span><?php echo $row['kategori_adi'] ?></span>
                                    <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">
                                        <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                    </a>
                                    <p><small><?php echo $row['video_baslik'] ?> </small></p>
                                </div>
                                <img src="<?php echo $row['video_resim'] ?>" />
                            </div>
                                                    </div>

                        <?php }} ?>

                    
                </div>
                <div class="clear"></div>
            </div>