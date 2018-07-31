

<div class="header-slide">
    <div id="owl-demo" class="owl-carousel">


<?php
/**
 * Created by PhpStorm.
 * User: Win7
 * Date: 31.07.2018
 * Time: 16:19
 */

$videolar=$db->prepare("SELECT * FROM  videolar WHERE video_durum=:v ORDER BY video_eklemetarihi DESC LIMIT 20 ");
$videolar->execute(array(':v'=>1));
if ($videolar->rowCount()) {

    foreach ($videolar as $row) { ?>



        <div class="item">
            <div class="zoom-container">
                <div class="zoom-caption">
                    <span><?php echo "etiket"; ?></span>
                    <a href="single.html">
                        <i class="fa fa-play-circle-o fa-5x" style="color: #fff"></i>
                    </a>
                    <p><?php echo $row['video_baslik'] ?> d</p>
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