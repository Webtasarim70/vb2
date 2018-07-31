<?php
echo !defined("emre")? die(''): null;

?>



 <a class="navbar-brand" href="index.php">Yönetim Paneli </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Yönetim Paneli">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Video Paneli</span>
                        </a>
        </li>
       
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Yöneticiler">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Yönetim</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
              <li>
                  <a href="islemler.php?islem=ayarduzenle">Site Ayarlarını Düzenle</a>
              </li>
              <li>
              <a href="yoneticiler.php">Yönetici Listesi</a>
            </li>
            <li>
              <a href="islemler.php?islem=yeniyonetici">Yeni Yönetici Ekle</a>
            </li>
          </ul>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Yorumlar">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents2" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-comment-o"></i>
            <span class="nav-link-text">Yorumlar</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents2">
            <li>
              <a href="yorumlar.php">Yorum Listesi</a>
            </li>
            
          </ul>
        </li>


          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Oneriler">
              <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents3" data-parent="#exampleAccordion">
                  <i class="fa fa-fw fa-plus-square-o"></i>
                  <span class="nav-link-text">Öneriler</span>
              </a>
              <ul class="sidenav-second-level collapse" id="collapseComponents3">
                  <li>
                      <a href="oneriler.php">Öneri Listesi</a>
                  </li>

              </ul>
          </li>



		
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
	  
      <ul class="navbar-nav ml-auto">
       
        <li class="nav-item">
          <form action="videolar.php?view" method="post" class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control" type="text" name="q" placeholder="Youtube'dan video ara">
              <span class="input-group-btn">
                <button class="btn btn-primary">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
		 <li class="nav-item">
          <a class="nav-link" href="islemler.php?islem=adminduzenle&id=<?php echo $uid;?>">
            <i class="fa fa-fw fa-user"></i><?php echo $uisim;?>
			</a>
        </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo $site;?>">
                  <i class="fa fa-fw fa-ambulance"></i> Site
              </a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="cikis.php" onclick="return confirm('Çıkış yapmak istiyor musunuz ?');">
            <i class="fa fa-fw fa-sign-out"></i>Çıkış Yap
			</a>
        </li>
      </ul>
    </div>