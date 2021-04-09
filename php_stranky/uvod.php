<?php
	session_start();
	include_once '../php_soubory/dtb.php'
?>
<!DOCTYPE html>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Úvod</title>
    <!-- Bootstrap -->
	<link href="../foto/piston.png" rel="shortcut icon" type="image/png">
    <link href="../Bootstrap_knihovny/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../Bootstrap_knihovny/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md bg-inverse  navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarOdkazDve" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="../index.php">
      <img src="../foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarOdkazDve">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="uvod.php">Úvod</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="clanky.php">Články</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="forum.php">Fórum</a>
            </li>
			<?php
				if($_SESSION['adminStav'] == 1){
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="editor.php">Editor</a>';
					echo '</li>';
					echo '<li class="nav-item">';
					echo '<a class="nav-link" href="adminNastroj.php">Admin nástroje</a>';
					echo '</li>';
		  		}
			?>
          </ul>
		  <?php
		  $id=$_SESSION['idUzivatele'];
		  $filename="../profilove_foto/profile".$id."*";
		  $fileinfo=glob($filename);
		  $fileext=explode(".",$fileinfo[0]);
		  $fileactualext=$fileext[3];
		  if(isset($_SESSION['idUzivatele'])){
		  if($_SESSION['statusUzivatele'] == 0){
	        echo '<form action="../php_soubory/odhlaseni.php" method="post" style="margin-top:auto;margin-bottom:0;>
			  	     <a href="../php_stranky/nastaveni.php">
                   	 <img src="../profilove_foto/profile'.$id.'.'.$fileext[3].'" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     <a href="../php_stranky/nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>

					 <button type="submit" class="btn btn-success ml-auto" name=odhlaseni id="tlacitkoOdhlaseni">
	              		Odhlásit se
	            	 </button>
				  </form>';
		  }else if($_SESSION['statusUzivatele'] == 1){
			echo '<form action="../php_soubory/odhlaseni.php" method="post" style="margin-top:auto;margin-bottom:0;>
			  		 <a href="../php_stranky/nastaveni.php">
                   	 <img src="../profilove_foto/default.jpg" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     <a href="../php_stranky/nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>

					 <button type="submit" class="btn btn-success ml-auto" name=odhlaseni id="tlacitkoOdhlaseni">
	              		Odhlásit se
	            	 </button>
				  </form>';
		  }
		  }
		  else{
		  	echo '<button type="submit" class="btn btn-success ml-auto" data-toggle="modal" data-target="#modalPrihlaseni">
              	  		Přihlásit se
              		  </button>';
		  }
          ?>
        </div>
    </nav>
	<!-- ****************************************************************************************************************************** -->
    <!-- Modal pro přihlášení -->
    <div class="modal fade seminor-login-modal" data-backdrop="static" id="modalRegistr">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          
          <!-- Modal hlavička -->
          <div class="modal-header">
           <h5 class="modal-title">Zaregistrujte se</h5>
          </div>
          <!-- Modal body --> 
          <br>          
          <form class="modal-body seminor-login-form" method="post" action="../php_soubory/registrace.php">
            <div class="form-group">
              <input type="text" class="form-control" name="jmeno">
              <label class="form-control-placeholder">Uživatelské jméno</label>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email">
              <label class="form-control-placeholder">E-mail</label>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="heslo1">
              <label class="form-control-placeholder">Heslo</label>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="heslo2">
              <label class="form-control-placeholder">Potvrzení hesla</label>
            </div>
            <br>
            <!-- tlačítko k registraci -->
            <input type="submit" name="registrace" class="registerButton" value="Registrovat se">
          </form>
          <br>
          <!-- Modal footer -->
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
            </div>
          </div>
        </div>
      </div>
    
    
    
    
      <!-- Modal pro login -->
      <div class="modal fade seminor-login-modal" data-backdrop="static" id="modalPrihlaseni">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <!-- Modal hlavička -->
            <div class="modal-header">
             <h5 class="modal-title">Přihlašte se</h5>
            </div>
            <br>
              <!-- Modal body -->
              <form class="modal-body" method="post" action="../php_soubory/login.php">
                <div class="form-group">
                  <input type="email" class="form-control" name="email">
                  <label class="form-control-placeholder">E-mail</label>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="heslo1">
                  <label class="form-control-placeholder">Heslo</label>
                </div>
				<div class="create-new-fau text-center pt-3">
					<a href="resetHesla.php" class="text-primary-fau">Zapomenuté heslo</a>
                </div>
                <input type="submit" name="login" class="loginButton" value="Login">
                <div class="create-new-fau text-center pt-3">
                    <a href="#" class="text-primary-fau"><span data-toggle="modal" data-target="#modalRegistr" data-dismiss="modal">Nejste zaregistrovaný? Zaregistrujte se zde!</span></a>
                </div>
                <br>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    <!-- ****************************************************************************************************************************** -->
	<?php
		$sql = "SELECT * FROM clanky ORDER BY id DESC LIMIT 4 OFFSET 0";
		$vys = mysqli_query($pripojeni,$sql);
		
		if(mysqli_num_rows($vys)>0){
			
			echo '<div class="container">
					<div class="row mb-2">
						<div class="col-12 text-center pt-3">
							<h1>Vítejte na motofóru.cz!</h1>
							<p>Web o motocyklech a vše kolem nich</p>
							<h4>Úvodní strana</h4>
						</div>
					</div>
					<div class="row">
						<!--Start include wrapper-->
						<div class="include-wrapper pb-5 col-12">
							<!--SECTION START-->
							<section class="row">
								<!--Start slider news-->
								<div class="col-12 col-md-6 pb-0 pb-md-3 pt-2 pr-md-1">
									<div id="featured" class="carousel slide carousel" data-ride="carousel">
										<!--slider navigate-->
										<ol class="carousel-indicators top-indicator">
											<li data-target="#featured" data-slide-to="0" class="active"></li>
											<li data-target="#featured" data-slide-to="1"></li>
											<li data-target="#featured" data-slide-to="2"></li>
											<li data-target="#featured" data-slide-to="3"></li>
										</ol>

										<!--carousel inner-->
										<div class="carousel-inner">';
										if($row = mysqli_fetch_assoc($vys)){
											$idcko=$row['id_autora'];
											$sqli = "SELECT * FROM uzivatele WHERE id_uzivatele=$idcko"; 	//limit - max int
											$vysi = mysqli_query($pripojeni,$sqli);
											$rowUzivatel = mysqli_fetch_assoc($vysi);
											$datumik = strtotime($row['datum']);	//upravime datum z databaze na klasicke datum dd.mm.yyyy (databaze ma yyyy/mm/dd)
											
											$id=$row['id'];
											$filename="../clanky_foto/clanekUvod".$id."*";
											$fileinfo=glob($filename);
											$fileext=explode(".",$fileinfo[0]);
											$fileactualext=$fileext[3];
											
											echo '<!--Item slider-->
											<div class="carousel-item active">
												<div class="card border-0 rounded-0 text-light overflow zoom">
													<!--thumbnail-->
													<div class="position-relative">
														<!--thumbnail img-->
														<div class="ratio_left-cover-1 image-wrapper">
															<a href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?clanek'.$row['id'].'">';
																if($row['status'] == 1){
																 echo '<img src="../clanky_foto/clanekUvod'.$id.'.'.$fileext[3].'" id="fotoCarousel" class="img-fluid w-100" alt="Uvodni fotografie clanku">';
																}
																else{
																 echo '<img src="../clanky_foto/default.jpg" class="img-fluid w-100" id="fotoCarouselDve" alt="Uvodni fotografie clanku">';	
																}
													echo   '</a>
														</div>

														<!--title-->
														<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow"  style="position:absolute;">
															<!--title and description-->
															<a href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?clanek'.$row['id'].'">
																<h2 class="h3 post-title text-white my-1">'.$row['titulek'].'</h2>
															</a>

															<!-- meta title -->
															<div class="news-meta">
																<span class="news-author text-white">Autor: <a class="text-white font-weight-bold">'.$rowUzivatel['jmeno'].'</a></span>
																<span class="news-date text-white">'.date('d.m.Y', $datumik).'</span>
															</div>
														</div>
														<!--end title-->
													</div>
													<!--end thumbnail-->
												</div>
											</div>';
										}
										while($row = mysqli_fetch_assoc($vys)){
											$id=$row['id'];
											$filename="../clanky_foto/clanekUvod".$id."*";
											$fileinfo=glob($filename);
											$fileext=explode(".",$fileinfo[0]);
											$fileactualext=$fileext[3];
											echo '<!--Item slider-->
											<div class="carousel-item">
												<div class="card border-0 rounded-0 text-light overflow zoom">
													<!--thumbnail-->
													<div class="position-relative">
														<!--thumbnail img-->
														<div class="ratio_left-cover-1 image-wrapper">
															<a href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?clanek'.$row['id'].'">';
																if($row['status'] == 1){
																 echo '<img src="../clanky_foto/clanekUvod'.$id.'.'.$fileext[3].'" class="img-fluid w-100" id="fotoCarousel" alt="Uvodni fotografie clanku">';
																}
																else{
																 echo '<img src="../clanky_foto/default.jpg" class="img-fluid w-100" id="fotoCarouselDve" alt="Uvodni fotografie clanku">';
																}
													echo    '</a>
														</div>

														<!--title-->
														<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow" style="position:absolute;">
															<!--title and description-->
															<a href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?clanek'.$row['id'].'">
																<h2 class="h3 post-title text-white my-1">'.$row['titulek'].'</h2>
															</a>

															<!-- meta title -->
															<div class="news-meta">
																<span class="news-author text-white">Autor: <a class="text-white font-weight-bold">'.$rowUzivatel['jmeno'].'</a></span>
																<span class="news-date text-white">'.date('d.m.Y', $datumik).'</span>
															</div>
														</div>
														<!--end title-->
													</div>
													<!--end thumbnail-->
												</div>
											</div>';
										}
									echo'
											<!--end item slider-->
										</div>
										<!--end carousel inner-->
									</div>
									<!--navigation-->
									<a class="carousel-control-prev" href="#featured" role="button" data-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="carousel-control-next" href="#featured" role="button" data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
								<!--End slider news-->

								<!--Start box news-->
								<div class="col-12 col-md-6 pt-2 pl-md-1 mb-3 mb-lg-4">
									<div class="row">
										<!--news box-->';
										$sqlBox = "SELECT * FROM clanky ORDER BY id DESC LIMIT 4 OFFSET 4";
										$vysBox = mysqli_query($pripojeni,$sqlBox);
										while($rowBox = mysqli_fetch_assoc($vysBox)){
											$idBox=$rowBox['id'];
											$fileN="../clanky_foto/clanekUvod".$idBox."*";
											$fileI=glob($fileN);
											$fileX=explode(".",$fileI[0]);
											echo '
											<div class="col-6 pb-1 pt-0 pr-1" style="margin-right:-10px;">
												<div class="card border-0 rounded-0 text-white overflow zoom">
													<!--thumbnail-->
													<div class="position-relative">
														<!--thumbnail img-->
														<div class="ratio_right-cover-2 image-wrapper">
															<a href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?clanek'.$rowBox['id'].'">';
																if($rowBox['status'] == 1){
																 echo '<img src="../clanky_foto/clanekUvod'.$idBox.'.'.$fileX[3].'" class="img-fluid w-100" id="fotoPostr" alt="Uvodni fotografie clanku">';
																}
																else{
																 echo '<img src="../clanky_foto/default.jpg" class="img-fluid w-100" id="fotoPostrDve" alt="Uvodni fotografie clanku">';
																}
												echo		'</a>
														</div>

														<!--title-->
														<div class="position-absolute p-2 p-lg-3 b-0 w-100 bg-shadow" style="position:absolute;">
															<!-- category -->
															<a class="p-1 badge badge-primary rounded-0" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?clanek'.$rowBox['id'].'">'.$rowBox['zarazeni'].'</a>

															<!--title and description-->
															<a href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?clanek'.$rowBox['id'].'">
																<h2 class="h5 text-white my-1">'.$rowBox['titulek'].'</h2>
															</a>
														</div>
														<!--end title-->
													</div>
													<!--end thumbnail-->
												</div>
											</div>';
										}
										
										echo '
										</div>
										<!--end news box-->
									</div>
								</div>
								<!--End box news-->
							</section>
							<!--END SECTION-->
						</div>
					</div>
				</div>';
		}
	?>
	<style>
		li a:hover{
		color:black;
		}
	</style>
	<?php 
	    $sqlForum = "SELECT * FROM prispevkyForum ORDER BY id_prispevku DESC LIMIT 12";
		$vysForum = mysqli_query($pripojeni,$sqlForum);

		if(mysqli_num_rows($vysForum)>0){
			echo  '<div class="container mt-5 mb-5">
				<div class="row">
					<div class="col-md-6">
						<h4>Nejnovější diskuze na fóru</h4>
						<ul class="timeline">';
			while($rowForum = mysqli_fetch_assoc($vysForum)){
						echo '<li style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;max-height:90px;">
								<a target="_blank" href="forum.php?diskuze'.$rowForum['id_prispevku'].'" style="text-align:left;padding:0;">'.$rowForum['titulek'].'</a>
								<p style="text-overflow: ellipsis;white-space: nowrap;overflow: hidden;padding-bottom:7px;">'.$rowForum['textDiskuze'].'</p>
							  </li>';
			}
				echo '</ul>
					</div>
				</div>
			</div>';
		}else{
			header("Location: uvod.php?zadneprispevky");
			exit();
		}
	?>
	<!-- Footer -->
	<footer class="page-footer font-small blue-grey lighten-5" id="footerDolu">
		<div style="background-color: #5cb85c;">
		  <div class="container">

			<!-- Grid row-->
			<div class="row py-4 d-flex align-items-center">

			  <!-- Grid column -->
			  <div class="col-md-6 col-lg-5 text-center text-md-left mb-4 mb-md-0">
				<h6 class="mb-0">Motofórum.cz</h6>
			  </div>
			  <!-- Grid column -->

			  <!-- Grid column -->
			  <div class="col-md-6 col-lg-7 text-center text-md-right">

				<!-- Facebook -->
				<a class="fb-ic">
				  <i class="fab fa-facebook-f white-text mr-4"> </i>
				</a>
				<!-- Twitter -->
				<a class="tw-ic">
				  <i class="fab fa-twitter white-text mr-4"> </i>
				</a>
				<!-- Google +-->
				<a class="gplus-ic">
				  <i class="fab fa-google-plus-g white-text mr-4"> </i>
				</a>
				<!--Linkedin -->
				<a class="li-ic">
				  <i class="fab fa-linkedin-in white-text mr-4"> </i>
				</a>
				<!--Instagram-->
				<a class="ins-ic">
				  <i class="fab fa-instagram white-text"> </i>
				</a>

			  </div>
			  <!-- Grid column -->

			</div>
			<!-- Grid row-->

		  </div>
		</div>

		<!-- Footer Links -->
		<div class="container text-center text-md-left mt-5">

		  <!-- Grid row -->
		  <div class="row mt-3 dark-grey-text">

			<!-- Grid column -->
			<div class="col-md-3 col-lg-4 col-xl-3 mb-4">

			  <!-- Content -->
			  <h6 class="text-uppercase font-weight-bold">Motofórum.cz</h6>
			  <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
			  <p>Tato stránka slouží jako ročníkový projekt. Vytvořil ji Luboš Kučera.</p>

			</div>
			<!-- Grid column -->
			<!-- Grid column -->
			<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

			  <!-- Links -->
			  <h6 class="text-uppercase font-weight-bold">Užitečné odkazy</h6>
			  <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
			  <p>
				<a class="dark-grey-text" href="../php_stranky/uvod.php">Úvodní strana</a>
			  </p>
			  <p>
				<a class="dark-grey-text" href="../php_stranky/clanky.php">Články</a>
			  </p>
			  <p>
				<a class="dark-grey-text" href="../php_stranky/forum.php">Fórum</a>
			  </p>
			  <p>
				<a class="dark-grey-text" href="../php_stranky/index.php">Domů</a>
			  </p>

			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

			  <!-- Links -->
			  <h6 class="text-uppercase font-weight-bold">Contact</h6>
			  <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
			  <p>
				<i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
			  <p>
				<i class="fas fa-envelope mr-3"></i> info@example.com</p>
			  <p>
				<i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
			  <p>
				<i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

			</div>
			<!-- Grid column -->

		  </div>
		  <!-- Grid row -->

		</div>
		<!-- Footer Links -->

		<!-- Copyright -->
		<div class="footer-copyright text-center text-black-50 py-3">© 2019 Copyright:
		  <a class="dark-grey-text" href="https://kucera-lubos.mzf.cz"> www.kucera-lubos.mzf.cz</a>
		</div>
		<!-- Copyright -->

	  </footer>      
  </body>
</html>
