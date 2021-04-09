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
    <title>Fórum</title>
    <!-- Bootstrap -->
    <link href="../Bootstrap_knihovny/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../Bootstrap_knihovny/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
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
					<a href="php_stranky/resetHesla.php" class="text-primary-fau">Zapomenuté heslo</a>
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
		<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

		<script type="text/javascript" src="../tinymce_editor/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
			  selector: 'textarea',
			  height: 150,
			  theme: 'modern',
			  plugins: 'print preview fullpage powerpaste searchreplace autolink directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
			  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
			  image_advtab: true,
			  templates: [
				{ title: 'Test template 1', content: 'Test 1' },
				{ title: 'Test template 2', content: 'Test 2' }
			  ],
			  content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'//www.tinymce.com/css/codepen.min.css'
			  ]
			 });
		</script> 
		<?php
		$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if($celaURL == "http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/forum.php" || $celaURL=="http://kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/forum.php?smazaniDiskuze=uspesne" || $celaURL=="http://www.kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/forum.php" || $celaURL=="http://www.kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/forum.php?smazaniDiskuze=uspesne"){
			echo '<h1 class="nadpisNastaveni">Fórum</h1>';
			echo '<div class="container" id="navbarForum">
					<div class="row" style="margin-top:15px;margin-bottom:15px;">';
			
			if(isset($_SESSION['idUzivatele'])){
				echo '<form method="post" action="forum.php" style="float:left;margin-right:0.5%;margin-left:2%;">
							<button type="submit" name=zobrazPravidla class="btn btn-default">Pravidla</button>
					  </form>';
				echo '<form method="post" action="forum.php" style="float:left;margin-right:0.5%;margin-left:2%;">
							<button name="submitMeDiskuze" class="btn btn-default">Mé diskuze</button>
					  </form>';
				echo '<form method="post" action="forum.php" style="float:left;margin-right:2%;margin-left:0.5%;">
							<button name="submitVsechno" class="btn btn-default">Všechny diskuze</button>
					  </form>';
				if($_SESSION['stavBan'] == 0){
				echo '<form action="novaDiskuze.php" style="float:left;margin-right:2%;margin-left:2%;">
							<button class="btn btn-default"><strong><i class="far fa-plus-square" style="margin-right:5px;"></i>Založit diskuzi</strong></button>
					  </form>';
				}
				else
				{
					echo	'<button class="btn btn-default" data-toggle="modal" data-target="#modalBan" style="float:left;margin-right:2%;margin-left:2%;"><strong><i class="far fa-plus-square" style="margin-right:5px;"></i>Založit diskuzi</strong></button>';
					echo	'<div class="modal fade" tabindex="-1" role="dialog" id="modalBan" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title">Nelze přidávat diskuze</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
										<p>Byl jste zabanován administrátorem.</p>
										<ul>
											<li>Nelze přidávat diskuze</li>
											<li>Nelze přidávat komentáře k diskuzím</li>
										</ul>
									  </div>
									  <div class="modal-footer">
									  	<form action="../php_soubory/zadostUnban.php" method="post">
											<button type="submit" class="btn btn-danger" name=unban>Žádost o odbanování</button>
										</form>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít</button>
									  </div>
									</div>
								  </div>
								</div>';
				}
			}
			else{
				echo '<form method="post" action="forum.php" style="float:left;margin-right:0.5%;margin-left:2%;">
							<button type="submit" name=zobrazPravidla class="btn btn-default">Pravidla</button>
					  </form>';
				echo '<form method="post" action="forum.php" style="float:left;margin-right:0.5%;margin-left:2%;">
							<button name="submitVsechno" class="btn btn-default">Všechny diskuze</button>
					  </form>';
				echo '<button style="float:left;margin-right:2%;margin-left:2%;" type="submit" data-toggle="modal" data-target="#modalPrihlaseni" class="btn btn-default"><strong><i class="far fa-plus-square" style="margin-right:5px;"></i>Založit diskuzi</strong></button>';
			}
			echo '</div>
			</div>';
			$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			if(strpos($celaURL,"smazaniDiskuze=uspesne") == true){
				echo '<div class = "successHlaska">';
				echo "<p class='success'>Smazání diskuze proběhlo v pořádku.</p>";
				echo '</div>';
			}
		}else{
			//************VYPIS DISKUZE***********************************************************************************************************
			$idClanku = substr($celaURL, strrpos($celaURL, 'e')+1);	//tímto beru všechny znaky po posledním znaku "e" diskuze - e na konci
			
			$sqlZobraz = "SELECT * FROM prispevkyForum WHERE id_prispevku='$idClanku';"; 
			$vysZobraz = mysqli_query($pripojeni,$sqlZobraz);
			
			if(strpos($celaURL,"diskuze".$idClanku."") == true){//zjistuji jestli URL obsahuje clanek s ID, na které uživatel klikne, když chce zobrazit přispěvek
				if($row = mysqli_fetch_assoc($vysZobraz)){
					//***
					$idcko=$row['idUziv'];
					$sqli = "SELECT * FROM uzivatele WHERE id_uzivatele=$idcko"; 	//limit - max int
					$vysi = mysqli_query($pripojeni,$sqli);
					$rowUzivatel = mysqli_fetch_assoc($vysi);
					//**ZDE BERU VSE POTREBNE K ZOBRAZENI FOTKY - ID,CESTU,KONCOVKU(png,jpg...)
					$sessionid=$row['idUziv'];
					$filename="../profilove_foto/profile".$sessionid."*";
					$fileinfo=glob($filename);
					$fileext=explode(".",$fileinfo[0]);
					$fileactualext=$fileext[3];
					//**VYPIS FOTKY A JMENA
					
					//****VYPIS TEXTU
					$datumik = strtotime($row['datumPridani']);
					$_SESSION['idDiskuze'] = $row['id_prispevku'];
					$_SESSION['titulekDiskuze'] = $row['titulek'];
					$_SESSION['textDiskuze'] = $row['textDiskuze'];
					
    				echo '<div class="card gedf-card" style="margin-right: 2.7%;margin-left: 2.7%;margin-bottom:20px;margin-top:50px;">
							<div class="card-header">
								<div class="d-flex justify-content-between align-items-center">
									<div class="d-flex justify-content-between align-items-center">
										<div class="mr-2">';
											if($rowUzivatel['status'] == 0){
												echo '<img src="../profilove_foto/profile'.$sessionid.'.'.$fileext[3].'" class="rounded-circle" width="45" height="45" alt="Profilová fotka">';
											}else if($rowUzivatel['status'] == 1){
												echo '<img src="../profilove_foto/default.jpg" class="rounded-circle" width="45" height="45" alt="Profilová fotka">';
											}
								echo   '</div>
										<div class="ml-2">
											<div class="h5 m-0">'.$rowUzivatel['jmeno'].'</div>
											<div class="h7 text-muted"><i class="far fa-calendar-alt" style="margin-right:5px;"></i>'.date('d.m.Y', $datumik).'</div>
										</div>
									</div>';
								if($_SESSION['adminStav'] == 1 || $row['idUziv'] == $_SESSION['idUzivatele']){
								echo  '<div>
										<div class="dropdown">
											<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="fas fa-cog"></i>
											</button>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
												<div class="h6 dropdown-header">Konfigurace</div>
												<form action="../php_soubory/smazatDiskuzi.php" method="post">
													 <button class="dropdown-item" type="submit" style="border:0;" name=smazatDiskuzi>
														 <i class="far fa-trash-alt" style="margin-right:5px;"></i>
														 Odstranit diskuzi
													 </button>
												 </form>
												 <form action="../php_stranky/editorDiskuze.php" method="post">
													 <button class="dropdown-item" type="submit" style="border:0;" name=upravitDiskuzi>
														<i class="far fa-edit" style="margin-right:5px;"></i>
														Upravit diskuzi
													 </button>
											  	</form>';
												if($row['uzamceno']==0){
												echo '<form action="../php_soubory/uzamknoutDiskuzi.php" method="post">
														 <button class="dropdown-item" type="submit" style="border:0;" name=uzamknoutDiskuzi>
															<i class="fas fa-lock" style="margin-right:5px;"></i>
															Uzamknout diskuzi
														 </button>
													  </form>';
												}
												else{
													echo '<button style="border:0;" class="dropdown-item disabled">
															<i class="fas fa-lock" style="margin-right:5px;"></i>
															Uzamknout diskuzi
														  </button>';
												}
												if($_SESSION['adminStav'] == 1){
													echo '<form action="../php_soubory/ban.php" method="post">
																<button class="dropdown-item" type="submit" name="ban" style="border:0;">
																	<i class="fas fa-user-times" style="color:#c12e1b;margin-right:5px;"></i>
																	BAN
																</button>
																<input type="hidden" name="idUzivatele" value="'.$row['idUziv'].'">
														  </form>';
												}
									echo '</div>
										</div>
									</div>';
									}
							echo '</div>
							</div>
							<div class="card-body" style="margin-top: 10px;margin-bottom: 10px;margin-left:15px;margin-right:15px;word-break: break-all;">
								<div class="text-muted h7 mb-2"><span class="badge badge-primary">'.$row['zarazeni'].'</span></div>
								<h5 class="card-title">'.$row['titulek'].'</h5>

								<p class="card-text">'.$row['textDiskuze'].'</p>
							</div>
							<div class="card-footer">
								<a href="#" class="card-link"><i class="far fa-thumbs-up" style="margin-right:5px;"></i> Like</a>';
								if($row['uzamceno']==0){
								echo '<a href="#textAreaKoment" class="card-link"><i class="far fa-comment" style="margin-right:5px;"></i> Komentář</a>';
								}
						  echo '<a href="javascript:fbshareCurrentPage()" target="_blank" alt="Sdílet na Facebooku" class="card-link"><i class="fas fa-share" style="margin-right:5px;"></i>Sdílet</a>
							</div>
						</div>';
				}
				$idClanku = substr($celaURL, strrpos($celaURL, 'e')+1);	//tímto beru všechny znaky po posledním znaku "e" diskuze - e na konci
			
				$sqlKoment = "SELECT * FROM komentarePrispevku WHERE id_diskuze='$idClanku' order by id_komentare;"; 
				$vysKoment = mysqli_query($pripojeni,$sqlKoment);
				if(mysqli_num_rows($vysKoment)>0){	//pokud sql tabulka neco obsahuje tak se if provede
					
					
					while($rowKom = mysqli_fetch_assoc($vysKoment)){	//pomoci tohoto vlastne muzeme pouzit prikaz row. Protože si do něj bereme data z tabulky
						
						$iduziva = $rowKom['idUzivateleKomentar'];
						$sqlJmeno = "SELECT * FROM uzivatele WHERE id_uzivatele='$iduziva';";
						$vysJmeno = mysqli_query($pripojeni,$sqlJmeno);
						$rowJmeno = mysqli_fetch_assoc($vysJmeno);
						
						$idcko=$rowKom['idUzivateleKomentar'];
						$filejmeno="../profilove_foto/profile".$idcko."*";
						$fileinf=glob($filejmeno);
						$filext=explode(".",$fileinf[0]);
						
						
						$_SESSION['idKomentare']=$rowKom['id_komentare'];
						
						
						echo '<div class="container" style="margin-left:5%;">
									 <div class="media comment-box">
										<div class="media-left">';
											if($rowJmeno['status'] == 0){
											echo '<img src="../profilove_foto/profile'.$rowKom['idUzivateleKomentar'].'.'.$filext[3].'" width="50" height="50" alt="Profilová fotka">';
											
											}else{
											echo '<img src="../profilove_foto/default.jpg" width="50" height="50"alt="Profilová fotka">';
											}
						echo		   '</div>
										<div class="media-body" style="word-break: break-all;">';
											
												  if(isset($_SESSION['idUzivatele']) && $row['uzamceno'] == 0 && $_SESSION['idUzivatele']==$rowKom['idUzivateleKomentar']){
														echo '<h4 class="media-heading">'.$rowJmeno['jmeno'].'
																<div class="dropdown" style="float:right;margin-top:-4px;">
																	<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	</button>
																	<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																		echo	'<form action="../php_soubory/odstranitKomentar.php" method="post" style="margin-bottom:5px;">
																						 <button class="dropdown-item" type="submit" name="odstranitKomentar" style="margin-right:5px;outline:none;border:0;">
																							<i class="fas fa-trash-alt"></i>
																							Odstranit komentář
																						 </button>
																						 <input type="hidden" name="komentid" value="'.$rowKom['id_komentare'].'">
																					  </form>';
																		echo	'<form action="#textAreaKoment" method="post" style="margin-bottom:5px;">
																					<button class="dropdown-item" type="submit" name="upravitKomentar" style="margin-right:5px;outline:none;border:0;">
																						<i class="fas fa-edit"></i>
																						Upravit komentář
																					</button>
																					<input type="hidden" name="idKomentare" value="'.$rowKom['id_komentare'].'">
																				</form>';
															echo '</div>
																</div>
															</h4>';
													}
													else if($_SESSION['adminStav'] == 1){
														echo '<h4 class="media-heading">'.$rowJmeno['jmeno'].'
														<div class="dropdown" style="float:right;margin-top:-4px;">
															<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															</button>
															<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																	echo '<form action="../php_soubory/ban.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="ban" style="border:0;">
																					<i class="fas fa-user-times" style="color:#c12e1b;margin-right:5px;"></i>
																					BAN
																				</button>
																				<input type="hidden" name="idUzivatele" value="'.$rowKom['idUzivateleKomentar'].'">
																		  </form>';
																	echo '<form action="../php_soubory/odstranitKomentar.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitKomentar" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt"></i>
																					Odstranit komentář
																				 </button>
																				 <input type="hidden" name="komentid" value="'.$rowKom['id_komentare'].'">
																			  </form>';
													echo '</div>
														</div>
													</h4>';
													}
													else{
														echo '<h4 class="media-heading">'.$rowJmeno['jmeno'].'</h4>';
													}
											
											echo '<div style="background-color:white;">'.$rowKom['komentar'].'</div>';
										echo '</div>
									</div>
							</div>';
					}
					
				}
				if(isset($_SESSION['idUzivatele']) && $row['uzamceno'] == 0 && $_SESSION['stavBan'] == 0){
					echo '<div class="container" style="margin-left: 8.5%;margin-top:40px;">';
					echo '<p style="font-size:18px;"><strong>Vložit komentář k tématu</strong></p>';
					if(!isset($_POST['upravitKomentar'])){
					echo '<form id="textAreaKoment" method="post" action="../php_soubory/pridejKomentar.php">
						  	<textarea name="content" style="width:70%;float:left;">
							</textarea>
							<button name="submitKomentar" style="margin-top:10px;float:left;clear:left;margin-bottom:50px;" >Přidat komentář</button>
						  </form>';
					}
					else{
					$idDotKom=$_POST['idKomentare'];
					$sqlDotKom="SELECT * FROM komentarePrispevku WHERE id_komentare=$idDotKom;";
					$vysDotKom=mysqli_query($pripojeni,$sqlDotKom);
					$rowDotKom=mysqli_fetch_assoc($vysDotKom);
					echo '<form id="textAreaKoment" method="post" action="../php_soubory/upravitKomentar.php">
						  	<textarea name="content" style="width:70%;float:left;">
							'.$rowDotKom['komentar'].'
							</textarea>
							<input type="hidden" name="komentid" value="'.$rowDotKom['id_komentare'].'">
							<input type="hidden" name="diskuzeid" value="'.$rowDotKom['id_diskuze'].'">
							<button name="sumbitKomentar" style="margin-top:10px;float:left;clear:left;margin-bottom:50px;" >Upravit komentář</button>
						  </form>';
					}
					echo '</div>';
				}else if($row['uzamceno'] == 1){
					echo '<div class="container" style="margin-left: 8.5%;">';
					echo '<p style="font-size:18px;margin-right:2.7%;"><strong>Diskuze byla uzavřena!</strong></p>';
					echo '</div>';
				}
				else if($_SESSION['stavBan'] == 1){
					echo '<div class="container" style="margin-left: 8.5%;">';
					echo '<p style="font-size:18px;margin-right:2.7%;"><strong>Byl jste zabanován tudíž nemůžete komentovat!</strong></p>';
					echo '</div>';
				}
				else{
					echo '<div class="container" style="margin-left: 8.5%;">';
					echo '<p style="font-size:18px;margin-right:2.7%;"><strong>Pro přidání komenáře je třeba být přihlášen!</strong></p>';
					echo '</div>';
				}
			}
		}
		//***********************************************************************************************************************
		?>
	<?php
	//***********************************************************************************************************************
	//VYPIS PRAVIDEL FORA
	if(isset($_POST['zobrazPravidla'])){
		echo '<div class="container" style="margin-top:3%;">
					<p>
					<h3>Pravidla diskuse</h3><br>
					Pro používání diskusního fóra platí také pravidla registrace na stránkách www.kucera-lubos.mzf.cz.
					</p>
					<p>
					<strong style="color:red;">Diskutující musí dodržovat tyto pravidla:</strong><br><br>
					<strong>1) Pouze slušné a konstruktivní příspěvky</strong><br>
					a) Ve fórech prosím nenapadejte ostatní diskutující ani jiné osoby mimo diskuse. Na stránce kucera-lubos.mzf.cz je cílem přátelská atmosféra a ostatní nejsou na jakékoli osobní útoky zvědaví. Veškeré osobní spory prosím řešte mimo veřejné diskuse (icq, email, případně osobně).
					<br>b) Fórum není chat. Nemáte-li k příspěvku konstruktivní odpověď, prosím neodpovídejte. Uvědomte si, že příspěvky si přečte i několik tisíc uživatelů. Před odesláním se tedy prosím zamyslete, zda váš příspěvek má nějakou "přidanou hodnotu", tj může být pro ostatní nějakým způsobem přínosný.
					<br>c) Nevkládejte také do diskuse cizí e-maily, telefonní čísla, adresy, případně jakékoli jiné osobní údaje bez jejich souhlasu. Tyto příspěvky budeme mazat.
					<br>d) Nezakládejte témata za účelem tapetování, ze zištných úmyslů někoho poškodit (pověst apod.) nebo se snažit hromadně zakládat nesmyslná témata.
					<br>e) Texty se snažte psát česky a nepište vše velkými písmeny.
					<br>f) Nevkládejte inzerci čehokoli.
					</p>
					<p>
					<strong>2) Držte se tématu</strong><br>
					a) Je ve vašem zájmu vybrat správnou diskusi pro zadání svého příspěvku. Nesprávně umístěné příspěvky budou přesunuty.
					<br>b) Používejte výstižné nadpisy témat. Nadpisy jako "prosím poraďte", "všichni sem" nebo "jakou vybrat" jsou špatně zvolené. Vždy buďte konkrétnější a výstižnější, např. "Jakou vybrat: CBR600 nebo ZX6R?".
					</p>
					<p>
					<strong>3) Zákaz propagace</strong><br>
					a) Fórum není místo pro bezplatnou reklamu. Navštěvované diskuse jsou pochopitelně lákadlem pro řadu firem.
					<br>b) Příspěvky s komerčním podtextem v tématech od firem či obchodníků budou odstraněny nebo redukovány bez upozornění.
					<br>c) Témata nabádající k zaslání peněz k soukromým účelům budou smazány.
					</p>
					<p>
					<strong>4) Dodržujte platné zákony</strong><br>
					a) Tato diskuse neslouží ke sdílení informací a odkazů o warezu nebo o jiných ilegálních aktivitách. Takovéto příspěvky budou mazány a autoři v rámci možností vyloučeni.
					<br>b) Příspěvky porušující zákony ČR (např. rasová diskriminace atd.) budou vymazány. Údaje o pisateli navíc mohou být v případě vyžádání předány orgánům činným v trestním řízení.

					<br>c) Je zakázáno, aby se obchodník nebo firma jakkoliv vyjadřovala k jiné firmě z důvodů např. pomlouvání konkurence. Fórum je prioritně určeno pro soukromé osoby. Nikoliv na hádky firma vs firma.

					<br>d) Vyhněte se v našem diskusím fóru možným pomluvám. Všechny texty, fotografie a odkazy, které nejsou právnicky a úředně podložené jako přímá fakta mohou být odstraněny. Není v silách serveru provozovatelů, aby každý případ sám prověřoval.
					</p><p>
					<strong>5) Zakladatel tématu může vložené příspěvky skrývat za účelem udržení úrovně diskuze.</strong><br>
					</p><p>
					<strong>6) Mazání témat a příspěvků založených uživateli</strong><br>
					Založená témata se nemažou, tím spíše když máte nějaký problém a ten se podařilo vyřešit. Odpovědi můžou sloužit dalším
					</p><p>
					Snahou provozovatele a tvůrce je přátelská atmosféra. Stačí k tomu jen velmi málo - chovat se slušně a ohleduplně vůči ostatním.
					<br>
					V případě porušení těchto pravidel může provozovatel diskusního fóra uživateli omezit přístup na stránky www.kucera-lubos.mzf.cz a vložení nových příspěvků do fóra.
					<br>
					<br>
					<br>
					Více na: https://www.motorkari.cz/info/?act=pravidla-fora
					Copyright © Motorkari.cz
					<br>
					Pravidla byla zkopírována z webu motorkari.cz
					</p>
				</div>';

	}
	?>
	<?php
		//******************************************TLACITKA V MENU FORA****************************************************
		if(isset($_POST['submitMeDiskuze'])){
			$sql = "SELECT * FROM prispevkyForum ORDER BY id_prispevku DESC LIMIT 2147483647 "; 	//limit - max int
			$vys = mysqli_query($pripojeni,$sql);	//provedení sql dotazu, ve kterém si beru vše od posledního id k prvnímu id
			
			if(mysqli_num_rows($vys)>0){	//pokud sql tabulka neco obsahuje tak se if provede
				echo	'<div class="container" style="margin-top:3%;">
							<h4 style="margin-bottom:20px;">Mé diskuze</h4>
									<div class="row">   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

									<table class="table table-striped">
										<thead>
										  <tr>
											  <th>Autor a téma diskuze</th>
											  <th>Vytvořeno</th>        
											</tr>
										  </thead>';
				while($row = mysqli_fetch_assoc($vys)){	//pomoci tohoto vlastne muzeme pouzit prikaz row. Protože si do něj bereme data z tabulky
					if($row['idUziv'] == $_SESSION['idUzivatele']){
						$idcko=$row['idUziv'];
						$sqli = "SELECT jmeno FROM uzivatele WHERE id_uzivatele=$idcko"; 	//limit - max int
						$vysi = mysqli_query($pripojeni,$sqli);
						$rowJmeno = mysqli_fetch_assoc($vysi);
						
						$datum = strtotime($row['datumPridani']);	//upravime datum z databaze na klasicke datum dd.mm.yyyy (databaze ma yyyy/mm/dd)
						
						$diskuzeCislo=$row['id_prispevku'];
						$sqlPocet = "SELECT * FROM komentarePrispevku WHERE id_diskuze='$diskuzeCislo';"; 
						$vysPocet = mysqli_query($pripojeni,$sqlPocet);
						$pocetKomentaru=mysqli_num_rows($vysPocet);
						
						echo 	'<tbody>
								 <tr>
									<td><a href="?diskuze'.$row['id_prispevku'].'" style="font-size:20px;">'.$row['titulek'].'</a><br/><i class="fas fa-user" style="margin-right:5px;"></i>'.$rowJmeno['jmeno'].'<br/><i class="fas fa-comment" style="margin-right:5px;"></i>Komentářů: '.$pocetKomentaru.'<br/><span class="badge badge-primary">'.$row['zarazeni'].'</span></td>
									<td>'.date('d.m.Y', $datum).'<br/><br/>';
									if($row['uzamceno'] == 0)
									{
										echo '<i class="fas fa-comments" style="margin-right:5px;"></i>Diskuze je otevřena.';
									}
									else{
										echo '<i class="fas fa-lock" style="margin-right:5px;"></i>Diskuze byla uzamčena!';
									}
								 echo '</td>
									</tr>
								</tbody>';
						}			
					}
				echo '</table>
							 </div>
							</div>
						</div>';
			}else{
				header("Location: clanky.php?zadneprispevky");	//pokud nemame žadné příspěvky tak vyhodíme chybu do URL, že nejsou žádné příspěvky
				exit();
			}
		}
		if(isset($_POST['submitVsechno'])){
			$sqlVse = "SELECT * FROM prispevkyForum ORDER BY id_prispevku DESC LIMIT 2147483647 "; 	//limit - max int
			$vysVse = mysqli_query($pripojeni,$sqlVse);	//provedení sql dotazu, ve kterém si beru vše od posledního id k prvnímu id
			
			if(mysqli_num_rows($vysVse)>0){	//pokud sql tabulka neco obsahuje tak se if provede
				echo	'<div class="container" style="margin-top:3%;">
							<h4 style="margin-bottom:20px;">Všechny diskuze</h4>
									<div class="row">   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

									<table class="table table-striped">
										<thead>
										  <tr>
											  <th>Autor a téma diskuze</th>
											  <th>Vytvořeno</th>        
											</tr>
										  </thead>';
				while($row = mysqli_fetch_assoc($vysVse)){	//pomoci tohoto vlastne muzeme pouzit prikaz row. Protože si do něj bereme data z tabulky
						$idcko=$row['idUziv'];
						$sqli = "SELECT jmeno FROM uzivatele WHERE id_uzivatele=$idcko"; 	//limit - max int
						$vysi = mysqli_query($pripojeni,$sqli);
						$rowJmeno = mysqli_fetch_assoc($vysi);
						$datum = strtotime($row['datumPridani']);	//upravime datum z databaze na klasicke datum dd.mm.yyyy (databaze ma yyyy/mm/dd)
						$diskuzeCislo=$row['id_prispevku'];
						$sqlPocet = "SELECT * FROM komentarePrispevku WHERE id_diskuze='$diskuzeCislo';"; 
						$vysPocet = mysqli_query($pripojeni,$sqlPocet);
						$pocetKomentaru=mysqli_num_rows($vysPocet);
						echo 	'<tbody>
								 <tr>
									<td><a href="?diskuze'.$row['id_prispevku'].'" style="font-size:20px;">'.$row['titulek'].'</a><br/><i class="fas fa-user" style="margin-right:5px;"></i>'.$rowJmeno['jmeno'].'<br/><i class="fas fa-comment" style="margin-right:5px;"></i>Komentářů: '.$pocetKomentaru.'<br/><span class="badge badge-primary">'.$row['zarazeni'].'</span></td>
									<td>'.date('d.m.Y', $datum).'<br/><br/>';
									if($row['uzamceno'] == 0)
									{
										echo '<i class="fas fa-comments" style="margin-right:5px;"></i>Diskuze je otevřena.';
									}
									else{
										echo '<i class="fas fa-lock" style="margin-right:5px;"></i>Diskuze byla uzamčena!';
									}
								 echo '</td>
									</tr>
								</tbody>';
					}
				}
				echo '</table>
							 </div>
							</div>
						</div>';
				
		}
		else{
			header("Location: forum.php?zadnediskuze");	//pokud nemame žadné příspěvky tak vyhodíme chybu do URL, že nejsou žádné příspěvky
			exit();
		}
		// HLEDAT
		if(isset($_POST['submitVyhledat'])){
			$sqlVse = "SELECT * FROM prispevkyForum ORDER BY id_prispevku DESC LIMIT 2147483647 "; 	//limit - max int
			$vysVse = mysqli_query($pripojeni,$sqlVse);	//provedení sql dotazu, ve kterém si beru vše od posledního id k prvnímu id
			
			if(mysqli_num_rows($vysVse)>0){	//pokud sql tabulka neco obsahuje tak se if provede
				echo	'<div class="container" style="margin-top:3%;">
							<h4 style="margin-bottom:20px;">Všechny diskuze</h4>
									<div class="row">   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

									<table class="table table-striped">
										<thead>
										  <tr>
											  <th>Autor a téma diskuze</th>
											  <th>Vytvořeno</th>        
											</tr>
										  </thead>';
				while($row = mysqli_fetch_assoc($vysVse)){	//pomoci tohoto vlastne muzeme pouzit prikaz row. Protože si do něj bereme data z tabulky
						$idcko=$row['idUziv'];
						$sqli = "SELECT jmeno FROM uzivatele WHERE id_uzivatele=$idcko"; 	//limit - max int
						$vysi = mysqli_query($pripojeni,$sqli);
						$rowJmeno = mysqli_fetch_assoc($vysi);
						$datum = strtotime($row['datumPridani']);	//upravime datum z databaze na klasicke datum dd.mm.yyyy (databaze ma yyyy/mm/dd)
						$diskuzeCislo=$row['id_prispevku'];
						$sqlPocet = "SELECT * FROM komentarePrispevku WHERE id_diskuze='$diskuzeCislo';"; 
						$vysPocet = mysqli_query($pripojeni,$sqlPocet);
						$pocetKomentaru=mysqli_num_rows($vysPocet);
						echo 	'<tbody>
								 <tr>
									<td><a href="?diskuze'.$row['id_prispevku'].'" style="font-size:20px;">'.$row['titulek'].'</a><br/><i class="fas fa-user" style="margin-right:5px;"></i>'.$rowJmeno['jmeno'].'<br/><i class="fas fa-comment" style="margin-right:5px;"></i>Komentářů: '.$pocetKomentaru.'<br/><span class="badge badge-primary">'.$row['zarazeni'].'</span></td>
									<td>'.date('d.m.Y', $datum).'<br/><br/>';
									if($row['uzamceno'] == 0)
									{
										echo '<i class="fas fa-comments" style="margin-right:5px;"></i>Diskuze je otevřena.';
									}
									else{
										echo '<i class="fas fa-lock" style="margin-right:5px;"></i>Diskuze byla uzamčena!';
									}
								 echo '</td>
									</tr>
								</tbody>';
					}
				}
				echo '</table>
							 </div>
							</div>
						</div>';
		}
		else{
			header("Location: clanky.php?zadneprispevky");	//pokud nemame žadné příspěvky tak vyhodíme chybu do URL, že nejsou žádné příspěvky
			exit();
		} 
	?>
	<!-- ****************************************************************************************************************************** -->
	
	</body>
</html>
