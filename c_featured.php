 <!-- 1 tavsiye videolar -->
                <div class="box">
                    <div class="box-header">
                        <h2><i class="fa fa-globe"></i> Tavsiye Videolar</h2>
                    </div>
                    <div class="box-content">
                        <div class="row">

                <!-- ikili kısım 1 -->

                            <div class="col-md-6">
                    <?php
                            $tavsiyecek=$db->prepare("SELECT * FROM videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_durum=:d AND video_tavsiye=:t AND video_kat=:k order by video_eklemetarihi DESC 
                   LIMIT 1");
                            $tavsiyecek->execute(array(':d'=>1, ':t'=>1, ':k'=>4));
                            if ($tavsiyecek->rowCount()){
                                foreach ($tavsiyecek as $row){
                                    ?>

                                    <div class="wrap-vid">
                                        <div class="zoom-container">
                                            <div class="zoom-caption">
                                                <span><?php echo $row['kategori_adi'] ?></span>
                                                <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">">
                                                <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                                </a>
                                                <p><?php echo $row['video_baslik']; ?></p>
                                            </div>
                                            <img src="<?php echo $row['video_resim']; ?>" />
                                    </div>
                                        <h3 class="vid-name"><a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">
                                            <?php echo $row['video_baslik']; ?></a></a></h3>
                                        <div class="info">
                                            <h5>By <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo $row['video_sahibi']; ?></a></h5>
                                            <span><i class="fa fa-calendar"></i><?php echo $row['video_eklemetarihi']; ?></span>
                                            <span><i class="fa fa-eye"></i><?php echo $row['video_goruntulenme']; ?></span>
                                            <span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span>
                                        </div>
                                    </div>
                                    <p class="more"><?php echo substr($row['video_aciklama'], 0,100); ?></p>
                                    <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>" class="btn btn-1">Devamı...</a>


                             <?php   }
                            }else {echo 'Bu kategoride daha fazla video yok';}

                            ?>
                                <div class="line"></div>


<?php
$tavsiyecek=$db->prepare("SELECT * FROM videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_durum=:d AND video_tavsiye=:t AND video_kat=:k order by video_eklemetarihi DESC 
                   LIMIT 2,3");
$tavsiyecek->execute(array(':d'=>1, ':t'=>1, ':k'=>5));
if ($tavsiyecek->rowCount()){
    foreach ($tavsiyecek as $row){
        ?>
        <div class="post wrap-vid">
            <div class="zoom-container">
                <div class="zoom-caption">
                    <span><?php echo $row['kategori_adi'] ?></span>
                    <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">">
                        <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                    </a>
                    <p><?php echo $row['video_baslik']; ?></p>
                </div>
                <img src="<?php echo $row['video_resim']; ?>" />
            </div>
            <div class="wrapper">
                <h3 class="vid-name"><a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo substr($row['video_baslik'], 0,20); ?></a></h3>
                <div class="info">
                    <h6>By <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo $row['video_sahibi']; ?></a></h6>
                    <span><i class="fa fa-eye"></i><?php echo $row['video_goruntulenme']; ?></span>
                    <span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span>
                </div>
            </div>
        </div>






                             <?php   }
}else {echo 'Bu kategoride daha fazla video yok';}

?>


                            </div>




                <!-- ikili kısım 2 -->
                            <div class="col-md-6">

                                <?php
                                $tavsiyecek=$db->prepare("SELECT * FROM videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_durum=:d AND video_tavsiye=:t AND video_kat=:k order by video_eklemetarihi DESC 
                   LIMIT 1");
                                $tavsiyecek->execute(array(':d'=>1, ':t'=>1, ':k'=>6));
                                if ($tavsiyecek->rowCount()){
                                    foreach ($tavsiyecek as $row){
                                        ?>

                                        <div class="wrap-vid">
                                            <div class="zoom-container">
                                                <div class="zoom-caption">
                                                    <span><?php echo $row['kategori_adi'] ?></span>
                                                    <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">">
                                                        <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                                    </a>
                                                    <p><?php echo $row['video_baslik']; ?></p>
                                                </div>
                                                <img src="<?php echo $row['video_resim']; ?>" />
                                            </div>
                                            <h3 class="vid-name"><a href=""<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"">
                                                <?php echo $row['video_baslik']; ?></a></a></h3>
                                            <div class="info">
                                                <h5>By <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo $row['video_sahibi']; ?></a></h5>
                                                <span><i class="fa fa-calendar"></i><?php echo $row['video_eklemetarihi']; ?></span>
                                                <span><i class="fa fa-eye"></i><?php echo $row['video_goruntulenme']; ?></span>
                                                <span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span>
                                            </div>
                                        </div>
                                        <p class="more"><?php echo substr($row['video_aciklama'], 0,100); ?></p>
                                        <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>" class="btn btn-1">Devamı...</a>








                                    <?php   }
                                }else {echo 'Bu kategoride daha fazla video yok';}

                                ?>


                                <div class="line"></div>

                                <?php
                                $tavsiyecek=$db->prepare("SELECT * FROM videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat WHERE video_durum=:d AND video_tavsiye=:t AND video_kat=:k order by video_eklemetarihi DESC 
                   LIMIT 2,3");
                                $tavsiyecek->execute(array(':d'=>1, ':t'=>1, ':k'=>6));
                                if ($tavsiyecek->rowCount()){
                                    foreach ($tavsiyecek as $row){
                                        ?>
                                        <div class="post wrap-vid">
                                            <div class="zoom-container">
                                                <div class="zoom-caption">
                                                    <span><?php echo $row['kategori_adi'] ?></span>
                                                    <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>">">
                                                        <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                                                    </a>
                                                    <p><?php echo $row['video_baslik']; ?></p>
                                                </div>
                                                <img src="<?php echo $row['video_resim']; ?>" />
                                            </div>
                                            <div class="wrapper">
                                                <h3 class="vid-name"><a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo substr($row['video_baslik'], 0,20); ?></a></h3>
                                                <div class="info">
                                                    <h6>By <a href="<?php echo $site ?>/single.php?info=<?php echo $row['video_url']; ?>"><?php echo $row['video_sahibi']; ?></a></h6>
                                                    <span><i class="fa fa-eye"></i><?php echo $row['video_goruntulenme']; ?></span>
                                                    <span><i class="fa fa-heart"></i><?php echo $row['video_goruntulenme']; ?></span>
                                                </div>
                                            </div>
                                        </div>






                                    <?php   }
                                }else {echo 'Bu kategoride daha fazla video yok';}

                                ?>


                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                </div>
