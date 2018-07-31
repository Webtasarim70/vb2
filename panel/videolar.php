<?php
define('emre',true);

require_once "ust.php"; 


?>

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
        <li class="breadcrumb-item active">Video Ara</li>
      </ol>
     
      
      <div class="row">
        
       
      </div>
      <!-- Example DataTables Card-->
        <div class="card mb-3">
	  <div class="table-responsive">
		<table class="table table-hover">
            <thead>
            <tr>
                
                <th scope="col">Video Resim</th>
                <th scope="col">Video Başlık</th>
                <th scope="col">Video ID</th>
                <th scope="col">Video Sahibi</th>
                <th scope="col">İşlemler</th>

            </tr>
            </thead>

            <?php

            if (isset($_GET['view'])){
                $apikey=$arow->site_apikey;
                $q=preg_replace('/ /','+' ,$_POST['q'] );
                
                
                if (!$q){
                    header('Location:index.php');
                }else{
                    $searchUrl="https://www.googleapis.com/youtube/v3/search?part=snippet&q=".$q."&type=video&key=".$apikey."&maxResults=10";
                    $response=file_get_contents($searchUrl);
                    $searchResponse=json_decode($response,true);

                    /* echo "<pre>";
                    print_r($searchResponse);
                    echo "<pre>";
                    */
                    foreach ($searchResponse['items'] as $searchResult){

                        $a =$searchResult['id']['videoId'];
                        $title=$searchResult['snippet']['title'];
                        $img=$searchResult['snippet']['thumbnails']['medium']['url'];
                        $sahibi=$searchResult['snippet']['channelTitle'];
                        ?>

                        <tr>
                            <td> <img src="<?php echo $img;?>"class="img-responsive" width="100" height="100"> </td>
                            <td><?php echo $title; ?></td>
                 <td><a target="_blank" href="https://www.youtube.com/watch?v=<?php echo $a; ?>"><?php echo $a; ?></a></td>
                            <td><?php echo $sahibi;?></td>
                            <td><a href= "videodetay.php?info=<?php echo  $a; ?>"<i class="fa fa-plus"></i></a> </td>


                        </tr>

                        <?php
                    }
                }
           }

            ?>






                <tbody>

                </tbody>

         </table>

	  </div>

    </div>
   

  <?php require_once "alt.php"; ?>