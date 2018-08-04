<?php

?>


<!-- /////////////////////////////////////////Content -->
<div id="page-content" class="index-page">
    <div class="container">
        <div class="row">
            <!-- üst tavsiye -->
            <?php include "c_usttavsiye.php"; ?>

        </div>


        <!-- ana sutun -->
        <div class="row">
            <div id="main-content" class="col-md-8">
             
             <?php  include "c_featured.php"; ?>

              

<!-- 2 rastgele videolar -->
                 <?php include "c_random.php"; ?>

                

<!-- 2 hot videolar -->
                     <?php include "c_hot.php"; ?>

                

<!-- 2 yeni videolar -->
                         <?php include "c_new.php"; ?>

            </div>

        <!-- sidebar -->    
                        <?php include "sidebar.php"; ?>

            
        </div>
    </div>

</div>



