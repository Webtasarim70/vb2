<?php
require_once '../sistem/fonksiyon.php';

if (isset($_SESSION['oturum'])){
    header('Location:index.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Yönetim Paneli | Giriş</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Yönetim Paneli</div>
      <div class="card-body">

          <?php

             # echo sha1(md5('123'));

          if (isset($_POST['girisyap'])){
              $eposta=post('eposta');
              $sifre=post('sifre');
              $sifreli=sha1(md5($sifre));

              if (!$eposta || !$sifre){
                  echo "<div class='alert alert-danger'>Boş alan bırakmayınız</div>";
                  }else{

                        $giris = $db->prepare("SELECT * FROM admin WHERE admin_posta=:p AND admin_sifre=:s");
                        $giris->execute(array(':p' =>$eposta, ':s' =>$sifreli));

                      if ($giris->rowCount()){
                          $row=$giris->fetch(PDO::FETCH_OBJ);
                          @$_SESSION['oturum']=true;
                          @$_SESSION['adminid']=$row->admin_id;

                          echo "<div class='alert alert-success'>Hoşgeldiniz Yönetici</div>";
                          header('Refresh:3,url=index.php');

                      }else{
                          echo "<div class='alert alert-danger'>Böyle bir yönetici bulunmuyor.</div>";

                      }
                  }

          }

          ?>

        <form action="" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">E-posta</label>
            <input class="form-control" name="eposta" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="E-posta adresi">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Şifreniz</label>
            <input class="form-control" name="sifre" id="exampleInputPassword1" type="password" placeholder="Şifreniz">
          </div>
          
          <button type="submit" name="girisyap" class="btn btn-primary btn-block">Giriş Yap</button>
        </form>
       
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
