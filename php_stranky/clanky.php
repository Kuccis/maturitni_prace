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
    <title>Články</title>
    <!-- Bootstrap -->
	<link href="../foto/piston.png" rel="shortcut icon" type="image/png">
    <link href="../Bootstrap_knihovny/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../Bootstrap_knihovny/js/bootstrap.min.js"></script>
  </head>
  <body>
	<script language="javascript">	//bezne dostupny skript fb developers (mam ho z overflow)
		function fbshareCurrentPage()
		{window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, '',
		'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
		return false; }
	</script>
    <nav class="navbar navbar-toggleable-md bg-inverse  navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarOdkazClanek" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="../index.php">
      <img src="../foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarOdkazClanek">
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
	        echo '<form action="../php_soubory/odhlaseni.php" method="post" style="margin-top:auto;margin-bottom:0;">
			  	     <a href="../php_stranky/nastaveni.php">
                   	 <img src="../profilove_foto/profile'.$id.'.'.$fileext[3].'" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     <a href="../php_stranky/nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>

					 <button type="submit" class="btn btn-success ml-auto" name=odhlaseni id="tlacitkoOdhlaseni">
	              		Odhlásit se
	            	 </button>
				  </form>';
		  }else{
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
		$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$idClanku = substr($celaURL, strrpos($celaURL, 'a')+1);



		if($celaURL == "http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php" || $celaURL=="http://www.kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php" || $celaURL=="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana".$idClanku){
			echo '<h1 class="nadpisNastaveni" style="margin-bottom:50px;">Články</h1>';
			if($idClanku == 1){
				$pom = 0;
			}
			else if($idClanku > 1){
				$pom = $pom + 10;
			}
			else{
				$pom = 0; //POKUD je adresa defaultni (bez cisla stranek) tak se zobrazi prvnich 10 prispevku
			}
			echo $pom;


			$sql = "SELECT * FROM clanky ORDER BY id DESC LIMIT 10 OFFSET $pom;"; 	//limit 10 clanku, OFFSET - od kolikateho prispevku bude vypisovat
			$vys = mysqli_query($pripojeni,$sql);	//provedení sql dotazu, ve kterém si beru vše od posledního id k prvnímu id

			if(mysqli_num_rows($vys)>0){	//pokud sql tabulka neco obsahuje tak se if provede
				echo '<div class="container">
						<div class="row">
							<div class="col-md-12">
							  <p>Zde naleznete všechny články</p>
							</div>
						</div>';
				while($row = mysqli_fetch_assoc($vys)){	//pomoci tohoto vlastne muzeme pouzit prikaz row. Protože si do něj bereme data z tabulky
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
					echo '<div class="row">
							<div class="col-md-9">

								<div class="row mb-2">
									<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-md-4">';
														if($row['status'] == 1){
														 echo '<img src="../clanky_foto/clanekUvod'.$id.'.'.$fileext[3].'" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
														else{
														 echo '<img src="../clanky_foto/default.jpg" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
											  echo '</div>
													<div class="col-md-8" id="textClankuCss">
														<div class="news-title">
															<a href="?clanek'.$row['id'].'"><h5>'.$row['titulek'].'</h5></a>
														</div>
														<div class="news-cats">
															<ul class="list-unstyled list-inline mb-1">
																<li class="list-inline-item">
																		<small><i class="fas fa-align-left" style="margin-right:5px;"></i>'.$row['zarazeni'].'</small>
																</li>
																 <li class="list-inline-item">
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>Autor: '.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
														</div>
														<div class="news-content">
															<p>'.$row['kratkyPopis'].'</p>
														</div>
														<div class="news-buttons">
															<a class="btn btn-outline-danger btn-sm" href="?clanek'.$row['id'].'">Zobrazit vše</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							</div>';
							$_SESSION['posledniIdStranky']=$row['id'];
				}
				echo '<div class="row mb-2">
							<div class="col-md-12">
								<nav aria-label="Page navigation example">
								  <ul class="pagination">
									<li class="page-item">';
									if($idClanku==1){
							   echo	 '<a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana'.($idClanku-1).'" aria-label="Previous" style="background-color: #ffc9c9;pointer-events: none;">
										<span aria-hidden="true">«</span>
										<span class="sr-only">Předchozí</span>
									  </a>';
									}
									else if($idClanku > 1){
							echo	 '<a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana'.($idClanku-1).'" aria-label="Previous">
										<span aria-hidden="true">«</span>
										<span class="sr-only">Předchozí</span>
									  </a>';
									}
									else{
							echo	 '<a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana'.($idClanku-1).'" aria-label="Previous" style="background-color: #ffc9c9;pointer-events: none;">
										<span aria-hidden="true">«</span>
										<span class="sr-only">Předchozí</span>
									  </a>';
									}
							   echo  '</li>';
										$sql = "SELECT * FROM clanky";
										$vys=mysqli_query($pripojeni,$sql);
										$vsechnyClankyPocet = mysqli_num_rows($vys);


										if($vsechnyClankyPocet < 10)
										{
											$_SESSION['pocetStran']=($vsechnyClankyPocet/10) + 1;
										}
										else if($vsechnyClankyPocet == 10){
											$_SESSION['pocetStran']=($vsechnyClankyPocet/10);
										}
										else{
											$_SESSION['pocetStran']=($vsechnyClankyPocet/10) + 1;
										}
										$pomKontrola=0;
										echo '<li class="page-item"><a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana1">1</a></li>';
										for ($i = 2; $i <= $_SESSION['pocetStran']; $i++) {
											echo '<li class="page-item"><a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana'.$i.'">'.$i.'</a></li>';
											$pomKontrola=$i;
										}
							echo  '<li class="page-item">';
								if($idClanku==$pomKontrola){
								   echo	 '<a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana'.($idClanku+1).'" aria-label="Next" style="background-color: #ffc9c9;pointer-events: none;">
											<span aria-hidden="true">»</span>
											<span class="sr-only">Další</span>
									  	</a>';
										}
								else if($idClanku == "nky.php")
								{
									echo	 '<a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana2" aria-label="Next">
											<span aria-hidden="true">»</span>
											<span class="sr-only">Další</span>
									  	</a>';
								}
								else{
								echo  '<a class="page-link" href="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/clanky.php?strana'.($idClanku+1).'" aria-label="Next">
											<span aria-hidden="true">»</span>
											<span class="sr-only">Další</span>
									  </a>';
								}
							echo  '</li>
								  </ul>
								</nav>
							</div>
						</div>
					</div>';
			}else{
				header("Location: clanky.php?zadneprispevky");	//pokud nemame žadné příspěvky tak vyhodíme chybu do URL, že nejsou žádné příspěvky
				exit();
			}
		}
	?>
	<?php
		$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$idClanku = substr($celaURL, strrpos($celaURL, 'k')+1);	//tímto beru všechny znaky po posledním znaku "k" clanek - k na konci



		$sqli = "SELECT * FROM clanky WHERE id='$idClanku';"; 	//limit - max int, dotazuju se na vypis vseho na urcitem id, ktere si beru z posledniho znaku v URL, kde si ho nastavuju podle id, když beru všechny řádky z datbaze
		$vysi = mysqli_query($pripojeni,$sqli);

		if(strpos($celaURL,"clanek".$idClanku."") == true){	//zjistuji jestli URL obsahuje clanek s ID, na které uživatel klikne, když chce zobrazit přispěvek
			if($row = mysqli_fetch_assoc($vysi)){
		   	$_SESSION['idClanku']=$row['id'];
			$_SESSION['titulekClanku'] = $row['titulek'];
			$_SESSION['kratkyPopisClanku'] = $row['kratkyPopis'];
			$_SESSION['clanekSamotny'] = $row['clanek'];

			$datumik = strtotime($row['datum']);
			$idcko=$row['id_autora'];
			$sqli = "SELECT * FROM uzivatele WHERE id_uzivatele=$idcko"; 	//limit - max int
			$vysi = mysqli_query($pripojeni,$sqli);
			$rowUzivatel = mysqli_fetch_assoc($vysi);

			$filename="../clanky_foto/clanekUvod".$_SESSION['idClanku']."*";
			$fileinfo=glob($filename);
			$fileext=explode(".",$fileinfo[0]);
			$fileactualext=$fileext[3];

			echo '<div class="container" style="margin-top:30px;">
					<div class="row">
						<div class="col-md-9">
							<div class="row mb-2">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body" style="padding:10px;">
											<div class="row">
												<div class="col-md-12">
													<div class="news-title">
														<h2>'.$row['titulek'].'</h2>
													</div>
													<div class="news-cats">
														<ul class="list-unstyled list-inline mb-1">
																<li class="list-inline-item">
																		<small><i class="fas fa-align-left" style="margin-right:5px;"></i>'.$row['zarazeni'].'</small>
																</li>
																 <li class="list-inline-item">
																		<i class="fa fa-folder-o text-danger"></i>
																		<small><i class="fas fa-user-alt" style="margin-right:5px;"></i>Autor: '.$rowUzivatel['jmeno'].'</small>
																</li>
																 <li class="list-inline-item">
																		<small><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</small>
																</li>
															</ul>
													</div>
													<hr>
													<div class="news-image">';
														if($row['status'] == 1){
														 echo '<img src="../clanky_foto/clanekUvod'.$_SESSION['idClanku'].'.'.$fileext[3].'" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
														else{
														 echo '<img src="../clanky_foto/default.jpg" style="width:100%;" alt="Uvodni fotografie clanku">';
														}
														echo '<p class="text-muted ">'.$row['kratkyPopis'].'</p>';
											echo   '</div>
													<div class="news-content">
														<p>'.$row['clanek'].'</p>
													</div>
													<hr>';
													if($_SESSION['adminStav'] == 1){
													echo '<div class="news-footer">
																<div class="news-likes">
																	<form action="../php_soubory/smazatPrispevek.php" method="post" style="margin-bottom:10px;">
																	 	<button type="submit" class="btn btn-danger" name=smazat style="float:left;clear:left;">Smazat</button>
																	</form>
																	<form action="../php_stranky/editorUprava.php" method="post">
																		<button type="submit" class="btn btn-warning" name=upravit style="float:left;margin-left:10px;">
																			Upravit
																		</button>
																	 </form>
																</div>
														  </div>';
													}
										echo  '</div>
											</div>

										</div>

									</div>

								</div>

							</div>

						</div>
						<div class="col-md-3">
							<div class="row mb-2">
								<div class="col-md-12">
						 			<div class="card">
										<div class="row">
										<div class="col-md-12">
											<div class="card" style="border:unset;">
												<div class="card-body" style="padding:7px;">
													<h5>Menu</h5>
												</div>
											</div>
										</div>
											</div>
												<div class="list-group">
													<a href="javascript:history.back()" class="list-group-item list-group-item-action">Zpět</a>	<!-- php skript na vraceni se zpet podle historie prohlizeni -->
													<a href="javascript:fbshareCurrentPage()" class="list-group-item list-group-item-action">Sdílet</a>
													<a href="#" data-toggle="modal" data-target="#modalBan" class="list-group-item list-group-item-danger">Nahlásit chybu</a>
													<div class="modal fade" tabindex="-1" role="dialog" id="modalBan" aria-hidden="true">
													  <div class="modal-dialog" role="document">
														<div class="modal-content">
														  <div class="modal-header">
															<h5 class="modal-title">Nahlásit chybu v příspěvku</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															  <span aria-hidden="true">&times;</span>
															</button>
														  </div>
														  <div class="modal-body">
															<p>Našli jste chybu v příspěvku?<br> Neváhejte nás kontaktovat o problému a my se s ním vypořádáme!<br>
															   Popiště váš problém do textového pole níže.<br>
															   Např.:
															</p>
															<ul>
																<li>Příspěvek se špatně zobrazuje na telefoním zařízení</li>
																<li>V textu je pravopisná chyba</li>
															</ul>


															<form action="../php_soubory/zadostOpravaClanku.php" method="post">
															<textarea style="width:100%;" name=content>
															</textarea>
															</div>
														  <div class="modal-footer">
																<input type="hidden" name="idClanku" value="'.$row['id'].'">
																<input type="hidden" name="titulekClanku" value="'.$row['titulek'].'">
																<input type="hidden" name="datumVytvoreniClanku" value="'.$row['datum'].'">
																<button type="submit" class="btn btn-danger" name=submitProblem>Odeslat žádost</button>
															</form>
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
														  </div>
														</div>
													  </div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="card">
												<div class="card-body">
													fotka
												</div>
											</div>
										</div>
									</div>
						</div>
					</div>
				</div>';
		  }
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
