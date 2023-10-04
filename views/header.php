
	<?php
		
		$accueil="";
		$stagiaire="";
		$projet="";
		$porteur_projet="";
		
		
		if($urlArray[0]=="" || $urlArray[0]=="index"){
			$accueil="active";
		}
		
		if($urlArray[0]=="stagiaire"){
			$stagiaire="active";
		}
		
		if($urlArray[0]=="projet" ){
			$projet="active";
		}
		if($urlArray[0]=="porteur_projet") {
			$porteur_projet="active";
		}
		
		?>

<!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="./index/" class="app-brand-link">
              <img src="./assets/assets/img/logo-cmc2.png" alt="Logo CMC Agadir" class="" />
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item <?php echo $accueil;?>">
              <a href="./index/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Tableau de bord</div>
              </a>
            </li>


            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Gestion Stagiaires</span>
            </li>
			<li class="menu-item <?php echo $stagiaire;?>">
              <a href="./stagiaire/" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                <div data-i18n="Basic">Stagiaires en formation</div>
              </a>
            </li>
            <!--li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Stagiaire en formation</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="pages-account-settings-account.html" class="menu-link">
                    <div data-i18n="Account">Account</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-account-settings-notifications.html" class="menu-link">
                    <div data-i18n="Notifications">Notifications</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="pages-account-settings-connections.html" class="menu-link">
                    <div data-i18n="Connections">Connections</div>
                  </a>
                </li>
              </ul>
            </li-->
            
            <!-- Gestion projets -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Projets</span></li>
            <!-- Projet -->
            <li class="menu-item <?php echo $projet;?>">
              <a href="./projet/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Gérer un projet</div>
              </a>
            </li>
            

            <li class="menu-item  <?php echo $porteur_projet;?>">
              <a href="./porteur-projet/" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Porteurs de Projets</div>
              </a>
            </li>

            
            
           
          </ul>
        </aside>
        <!-- / Menu -->
		
		
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper" >
					
					<div id="contentHolder">