

<div class="header-slide">
    <div id="owl-demo" class="owl-carousel">


<?php

$videolar=$db->prepare("SELECT * FROM  videolar INNER JOIN kategori ON 
                        kategori.kategori_id=videolar.video_kat  WHERE video_durum=:v ORDER BY video_eklemetarihi DESC LIMIT 20 ");
$videolar->execute(array(':v'=>1));
if ($videolar->rowCount()) {

    foreach ($videolar as $row) { ?>



        <div class="item">
            <div class="zoom-container">
                <div class="zoom-caption">
                    <span><?php echo $row['kategori_adi'] ?></span>
                    <a href="single.html">
                        <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                    </a>
                    <p><small><?php echo $row['video_baslik'] ?></small></p>
                </div>
                <img src="<?php echo  $row['video_resim']; ?>" />
            </div>
        </div>



<?php

    }
}

?>




    </div>
</div>