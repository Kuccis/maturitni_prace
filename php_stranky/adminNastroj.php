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
    <title>Nástroje</title>                        
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
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarOdkaz" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="../index.php">
      <img src="../foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarOdkaz">
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
			if($_SESSION['adminStav'] == 1)
		  	{
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

          	if(isset($_SESSION['idUzivatele'])){
			  if($_SESSION['statusUzivatele'] == 0){
	          	echo '<form action="../php_soubory/odhlaseni.php" method="post">
			  		 	<a href="nastaveni.php">
                   	 	<img src="../profilove_foto/profile'.$id.'.'.$fileext[3].'" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     	<a href="nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>
					 
					 	<button type="submit" class="btn btn-success ml-auto" name=odhlaseni id="tlacitkoOdhlaseni">
	              			Odhlásit se
	            	 	</button>
						</form>';
			  }else{
				  echo '<form action="../php_soubory/odhlaseni.php" method="post">
			  		 	<a href="nastaveni.php">
                   	 	<img src="../profilove_foto/default.jpg" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     	<a href="nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>
					 
					 	<button type="submit" class="btn btn-success ml-auto" name=odhlaseni id="tlacitkoOdhlaseni">
	              			Odhlásit se
	            	 	</button>
						</form>';
			  }
        	}else {
            	echo '<button type="submit" class="btn btn-success ml-auto" data-toggle="modal" data-target="#modalPrihlaseni">
              	  		Přihlásit se
              		  </button>';
          	}
          ?>
        </div>
    </nav>
		
	<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper" style="background-color:white;">
      <div class="sidebar-heading">Menu</div>
      <div class="list-group list-group-flush">
		<form action="#" method="post" class="list-group-item list-group-item-action bg-light">
			<button type="submit" name=submitAdmin class="odkazSideBar">
			Administrátoři
			</button>
		</form>
		<form action="#" method="post" class="list-group-item list-group-item-action bg-light">
			<button type="submit" name=vsichniUziv class="odkazSideBar">
			Všichni uživatelé
			</button>
		</form>  
		<form action="#" method="post" class="list-group-item list-group-item-action bg-light">
			<button type="submit" name=bannedUziv class="odkazSideBar">
			Zabanovaní uživatelé
			</button>
		</form>
		<form action="#" method="post" class="list-group-item list-group-item-action bg-light">
			<button type="submit" name=vsechnyDisk class="odkazSideBar">
			Všechny diskuze
			</button>
		</form>
		<form action="#" method="post" class="list-group-item list-group-item-action bg-light">
			<button type="submit" name=uzamceneDisk class="odkazSideBar">
			Uzamčené diskuze
			</button>
		</form>
		<form action="#" method="post" class="list-group-item list-group-item-action bg-light">
			<button type="submit" name=vsechnyClanky class="odkazSideBar">
			Všechny články
			</button>
		</form>
      </div>
    </div>
	
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
	  <div class="row" style="background-color:white;margin-right:0;">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" style="background-color:white;" id="navbarCss">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="margin-left:10px;">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
				<form action="#" method="post" class="nav-link">
					<button type="submit" name=submitAdmin class="odkazSideBar">
					Administrátoři
					</button>
				</form>
            </li>
            <li class="nav-item">
              <form action="#" method="post" class="nav-link">
					<button type="submit" name=vsichniUziv class="odkazSideBar">
					Všichni uživatelé
					</button>
			  </form>
            </li>
			<li class="nav-item">
              <form action="#" method="post" class="nav-link">
					<button type="submit" name=bannedUziv class="odkazSideBar">
					Zabanovaní uživatelé
					</button>
				</form>
            </li>
			<li class="nav-item">
                <form action="#" method="post" class="nav-link">
					<button type="submit" name=vsechnyDisk class="odkazSideBar">
					Všechny diskuze
					</button>
				</form>
            </li>
			<li class="nav-item">
                <form action="#" method="post" class="nav-link">
					<button type="submit" name=uzamceneDisk class="odkazSideBar">
					Uzamčené diskuze
					</button>
				</form>
            </li>
			<li class="nav-item">
                <form action="#" method="post" class="nav-link">
					<button type="submit" name=vsechnyClanky class="odkazSideBar">
					Všechny články
					</button>
				</form>
            </li>
          </ul>
        </div>
      </nav>
    <!-- /#page-content-wrapper -->
  </div>
	  <?php	
		
		//ADMINISTRATORI VYPIS		

	  if(isset($_POST['submitAdmin'])){
      $sql= "SELECT * FROM uzivatele WHERE admin=1 ORDER BY id_uzivatele";
	  $vys= mysqli_query($pripojeni,$sql);

	  echo '<div class="container" style="margin-top:2%;">
				<div class="row">
					<div class="col-md-12">
						<h1>
							Vítejte na kartě administrátoři
						</h1>
						<p>
							Naleznete zde výpis všech administrátorů
						</p>
							<h3>
								Výpis:
							</h3>
						<div class="table-responsive">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>
										Id
									</th>
									<th>
										Jméno
									</th>
									<th>
										Email
									</th>
									<th>
										Profilová fotografie
									</th>
									<th>
										Administrátorská práva
									</th>
								</tr>
							</thead>
							<tbody>';
								while($row = mysqli_fetch_assoc($vys)){
									$idUziv=$row['id_uzivatele'];
									echo	'<tr>
												<td>
													'.$row['id_uzivatele'].'
												</td>
												<td>
													'.$row['jmeno'].'
												</td>
												<td>
													'.$row['email'].'
												</td>
												<td>';
												  if($row['status'] == 0)
												  {
													$fileN="../profilove_foto/profile".$idUziv."*";
													$fileI=glob($fileN);
													$fileE=explode(".",$fileI[0]);
													echo '<a href="../profilove_foto/profile'.$idUziv.'.'.$fileE[3].'">
															<img src="../profilove_foto/profile'.$idUziv.'.'.$fileE[3].'" width="50" height="45" alt="Profilová fotka">
														  </a>';
												  }
												  else{
													echo '<a href="../profilove_foto/default.jpg">
															<img src="../profilove_foto/default.jpg" width="50" height="45" alt="Profilová fotka">
														  </a>';
												  }
										echo   '</td>
												<td>';
													if($row['admin']==1)
													{
														echo "Ano";
													}
													else
													{
														echo "Ne";
													}
										echo	'</td>
												<td>
												 <div class="dropdown" style="float:right;margin-top:-4px;">
															<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															</button>
															<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																	echo '<form action="../php_soubory/ban.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="ban" style="border:0;">
																					<i class="fas fa-user-times" style="color:#c12e1b;margin-right:5px;"></i>
																					BAN
																				</button>
																				<input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																		  </form>';
																	echo '<form action="../php_soubory/odstranitUzivatele.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitUzivatele" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Odstranit uživatele
																				 </button>
																				 <input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																			  </form>';
																	echo '<form action="../php_soubory/odstranitUzivatele.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitUzivatele" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Smazat profilovou fotografii
																				 </button>
																				 <input type="hidden" name="komentid" value="'.$row['id_uzivatele'].'">
																			  </form>';
													echo '</div>
												 </td>
											</tr>';
								}
					 echo '</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>';
	  }
	?>
	<?php

		//VSICHNI UZIVATELE VYPIS

	  if(isset($_POST['vsichniUziv'])){
      $sql= "SELECT * FROM uzivatele ORDER BY id_uzivatele";
	  $vys= mysqli_query($pripojeni,$sql);

	  echo '<div class="container" style="margin-top:2%;">
				<div class="row">
					<div class="col-md-12">
						<h1>
							Vítejte na kartě všichni uživatelé
						</h1>
						<p>
							Naleznete zde výpis všech registrovaných uživatelů
						</p>
							<h3>
								Výpis:
							</h3>
						<div class="table-responsive">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>
										Id
									</th>
									<th>
										Jméno
									</th>
									<th>
										Email
									</th>
									<th>
										Profilová fotografie
									</th>
									<th>
										BAN
									</th>
								</tr>
							</thead>
							<tbody>';
								while($row = mysqli_fetch_assoc($vys)){
									$idUziv=$row['id_uzivatele'];
									
									echo	'<tr>
												<td>
													'.$row['id_uzivatele'].'
												</td>
												<td>
													'.$row['jmeno'].'
												</td>
												<td>
													'.$row['email'].'
												</td>
												<td>';
													if($row['status'] == 0)
												  {
													$fileN="../profilove_foto/profile".$idUziv."*";
													$fileI=glob($fileN);
													$fileE=explode(".",$fileI[0]);
													echo '<a href="../profilove_foto/profile'.$idUziv.'.'.$fileE[3].'">
															<img src="../profilove_foto/profile'.$idUziv.'.'.$fileE[3].'" width="50" height="45" alt="Profilová fotka">
														  </a>';
												  }
												  else{
													echo '<a href="../profilove_foto/default.jpg">
															<img src="../profilove_foto/default.jpg" width="50" height="45" alt="Profilová fotka">
														  </a>';
												  }
										echo   '</td>
												<td>';
													if($row['ban']==1)
													{
														echo "Ano";
													}
													else
													{
														echo "Ne";
													}
										echo	'</td>
												 <td>
												 <div class="dropdown" style="float:right;margin-top:-4px;">
															<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															</button>
															<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																	if($row['ban']==0){
																	echo '<form action="../php_soubory/ban.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="banNastroj" style="border:0;">
																					<i class="fas fa-user-times" style="color:#c12e1b;margin-right:5px;"></i>
																					BAN
																				</button>
																				<input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																		  </form>';
																	}
																	else{
																	echo '<form action="../php_soubory/unban.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="unBan" style="border:0;">
																					<i class="fas fa-user-check" style="margin-right:5px;color:#28a745;"></i>
																					unBAN
																				</button>
																				<input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																		  </form>';
																	}
																	echo '<form action="../php_soubory/odstranitUzivatele.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitUzivatele" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Odstranit uživatele
																				 </button>
																				 <input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																			  </form>';
																	echo '<form action="../php_soubory/smazaniProfilovky.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitProfilovouFoto" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Smazat profilovou fotografii
																				 </button>
																				 <input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																			  </form>';
													echo '</div>
												 </td>
											</tr>';
								}
					 echo '</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>';
	  }
	?>
	<?php
	
		//ZABANOVANI VYPIS

	  if(isset($_POST['bannedUziv'])){
      $sql= "SELECT * FROM uzivatele WHERE ban=1 ORDER BY id_uzivatele";
	  $vys= mysqli_query($pripojeni,$sql);

	  echo '<div class="container" style="margin-top:2%;">
				<div class="row">
					<div class="col-md-12">
						<h1>
							Vítejte na kartě zabanovaní uživatelé
						</h1>
						<p>
							Naleznete zde výpis všech zabanovaných uživatelů
						</p>
							<h3>
								Výpis:
							</h3>
						<div class="table-responsive">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>
										Id
									</th>
									<th>
										Jméno
									</th>
									<th>
										Email
									</th>
									<th>
										Profilová fotografie
									</th>
									<th>
										Administrátorská práva
									</th>
									<th>
										BAN
									</th>
								</tr>
							</thead>
							<tbody>';
								while($row = mysqli_fetch_assoc($vys)){
									$id=$row['id_uzivatele'];
									echo	'<tr>
												<td>
													'.$row['id_uzivatele'].'
												</td>
												<td>
													'.$row['jmeno'].'
												</td>
												<td>
													'.$row['email'].'
												</td>
												<td>';
												  if($row['status'] == 0)
												  {
													echo '<a href="../profilove_foto/profile'.$id.'.'.$fileext[3].'">
															<img src="../profilove_foto/profile'.$id.'.'.$fileext[3].'" width="50" height="45" alt="Profilová fotka">
														  </a>';
												  }
												  else{
													echo '<a href="../profilove_foto/default.jpg">
															<img src="../profilove_foto/default.jpg" width="50" height="45" alt="Profilová fotka">
														  </a>';
												  }
										echo   '</td>
												<td>';
													if($row['admin']==1)
													{
														echo "Ano";
													}
													else
													{
														echo "Ne";
													}
										echo	'</td>
												 <td>';
													if($row['ban']==1)
													{
														echo "Ano";
													}
													else
													{
														echo "Ne";
													}
										echo	'</td>
												<td>
												 <div class="dropdown" style="float:right;margin-top:-4px;">
															<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															</button>
															<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																	echo '<form action="../php_soubory/unban.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="unBan" style="border:0;">
																					<i class="fas fa-user-check" style="margin-right:5px;color:#28a745;"></i>
																					unBAN
																				</button>
																				<input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																		  </form>';
																	echo '<form action="../php_soubory/odstranitUzivatele.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitUzivatele" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Odstranit uživatele
																				 </button>
																				 <input type="hidden" name="idUzivatele" value="'.$row['id_uzivatele'].'">
																			  </form>';
																	echo '<form action="../php_soubory/odstranitUzivatele.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitUzivatele" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Smazat profilovou fotografii
																				 </button>
																				 <input type="hidden" name="komentid" value="'.$row['id_uzivatele'].'">
																			  </form>';
													echo '</div>
												 </td>
											</tr>';
								}
					 echo '</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>';
	  }
	?>
	<?php
	
		//VYPIS VSECH DISKUZI

	  if(isset($_POST['vsechnyDisk'])){
      $sql= "SELECT * FROM prispevkyForum ORDER BY id_prispevku";
	  $vys= mysqli_query($pripojeni,$sql);

	  echo '<div class="container" style="margin-top:2%;">
				<div class="row">
					<div class="col-md-12">
						<h1>
							Vítejte na kartě všechny diskuze
						</h1>
						<p>
							Naleznete zde výpis všech diskuzí
						</p>
							<h3>
								Výpis:
							</h3>
						<div class="table-responsive">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>
										Id
									</th>
									<th>
										Zařazení
									</th>
									<th>
										Titulek
									</th>
									<th>
										Text diskuze
									</th>
									<th>
										Datum přidání
									</th>
									<th>
										Uzamčeno
									</th>
								</tr>
							</thead>
							<tbody>';
								while($row = mysqli_fetch_assoc($vys)){
									$datum = strtotime($row['datumPridani']);
									$id=$row['id_uzivatele'];
									echo	'<tr>
												<td>
													'.$row['id_prispevku'].'
												</td>
												<td>
													'.$row['zarazeni'].'
												</td>
												<td>
													<a href="../php_stranky/forum.php?diskuze'.$row['id_prispevku'].'">
													'.$row['titulek'].'
													</a>
												</td>
												<td>
													'.$row['textDiskuze'].'';											  
										echo   '</td>
												<td>
													'.date('d.m.Y', $datum).'';	
										echo	'</td>
												 <td>';
													if($row['uzamceno']==1)
													{
														echo "Uzamčeno";
													}
													else
													{
														echo "Otevřeno";
													}
										echo	'</td>
												<td>
												 <div class="dropdown" style="float:right;margin-top:-4px;">
															<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															</button>
															<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																	echo '<form action="../php_soubory/uzamknoutDiskuzi.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="uzamknout" style="border:0;">
																					<i class="fas fa-lock" style="margin-right:5px;color:red;"></i>
																					Uzamknout diskuzi
																				</button>
																				<input type="hidden" name="idPrispevku" value="'.$row['id_prispevku'].'">
																		  </form>';
																	echo '<form action="../php_soubory/odemknoutDiskuzi.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="odemknoutDiskuzi" style="border:0;">
																					<i class="fas fa-lock-open" style="margin-right:5px;color:#28a745;"></i>
																					Odemknout diskuzi
																				</button>
																				<input type="hidden" name="idPrispevku" value="'.$row['id_prispevku'].'">
																		  </form>';
																	echo '<form action="../php_soubory/smazatDiskuzi.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitDiskuzi" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Odstranit diskuzi
																				 </button>
																				 <input type="hidden" name="idPrispevku" value="'.$row['id_prispevku'].'">
																		  </form>';
													echo '</div>
												 </td>
											</tr>';
								}
					 echo '</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>';
	  }
	?>
	<?php
	
		//VYPIS VSECH UZAMCENYCH DISKUZI

	  if(isset($_POST['uzamceneDisk'])){
      $sql= "SELECT * FROM prispevkyForum WHERE uzamceno=1 ORDER BY id_prispevku";
	  $vys= mysqli_query($pripojeni,$sql);

	  echo '<div class="container" style="margin-top:2%;">
				<div class="row">
					<div class="col-md-12">
						<h1>
							Vítejte na kartě uzamčené diskuze
						</h1>
						<p>
							Naleznete zde výpis všech uzamčených diskuzí
						</p>
							<h3>
								Výpis:
							</h3>
						<div class="table-responsive">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>
										Id
									</th>
									<th>
										Zařazení
									</th>
									<th>
										Titulek
									</th>
									<th>
										Text diskuze
									</th>
									<th>
										Datum přidání
									</th>
									<th>
										Uzamčeno
									</th>
								</tr>
							</thead>
							<tbody>';
								while($row = mysqli_fetch_assoc($vys)){
									$datum = strtotime($row['datumPridani']);
									$id=$row['id_uzivatele'];
									echo	'<tr>
												<td>
													'.$row['id_prispevku'].'
												</td>
												<td>
													'.$row['zarazeni'].'
												</td>
												<td>
													'.$row['titulek'].'
												</td>
												<td>
													'.$row['textDiskuze'].'';											  
										echo   '</td>
												<td>
													'.date('d.m.Y', $datum).'';	
										echo	'</td>
												 <td>';
													if($row['uzamceno']==1)
													{
														echo "Uzamčeno";
													}
													else
													{
														echo "Otevřeno";
													}
										echo	'</td>
												<td>
												 <div class="dropdown" style="float:right;margin-top:-4px;">
															<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															</button>
															<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																	echo '<form action="../php_soubory/odemknoutDiskuzi.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="odemknoutDiskuzi" style="border:0;">
																					<i class="fas fa-lock-open" style="margin-right:5px;color:#28a745;"></i>
																					Odemknout diskuzi
																				</button>
																				<input type="hidden" name="idPrispevku" value="'.$row['id_prispevku'].'">
																		  </form>';
																	echo '<form action="../php_soubory/smazatDiskuzi.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitDiskuzi" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Odstranit diskuzi
																				 </button>
																				 <input type="hidden" name="idPrispevku" value="'.$row['id_prispevku'].'">
																		  </form>';
													echo '</div>
												 </td>
											</tr>';
								}
					 echo '</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>';
	  }
	?>
	<?php
	
		//VYPIS VSECH CLANKU

	  if(isset($_POST['vsechnyClanky'])){
      $sql= "SELECT * FROM clanky ORDER BY id DESC;";
	  $vys= mysqli_query($pripojeni,$sql);

	  echo '<div class="container" style="margin-top:2%;">
				<div class="row">
					<div class="col-md-12">
						<h1>
							Vítejte na kartě všechny články
						</h1>
						<p>
							Naleznete zde výpis všech článků
						</p>
							<h3>
								Výpis:
							</h3>
						<div class="table-responsive">
						<table class="table table-condensed table-hover">
							<thead>
								<tr>
									<th>
										Id
									</th>
									<th>
										Zařazení
									</th>
									<th>
										Titulek
									</th>
									<th>
										Krátký popis
									</th>
									<th>
										Datum přidání
									</th>
								</tr>
							</thead>
							<tbody>';
								while($row = mysqli_fetch_assoc($vys)){
									$datum = strtotime($row['datum']);
									$id=$row['id_uzivatele'];
									echo	'<tr>
												<td>
													'.$row['id'].'
												</td>
												<td>
													'.$row['zarazeni'].'
												</td>
												<td>
													<a href="../php_stranky/clanky.php?clanek'.$row['id'].'">'.$row['titulek'].'</a>
												</td>
												<td>
													'.$row['kratkyPopis'].'
												</td>';											  
										echo   '<td>
													'.date('d.m.Y', $datum).'';	
										echo	'</td>';
												 
										echo	'</td>
												<td>
												 <div class="dropdown" style="float:right;margin-top:-4px;">
															<button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															</button>
															<div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">';
																	echo '<form action="../php_stranky/upravitClanekNastroj.php" method="post" style="margin-bottom:5px;">
																				<button class="dropdown-item" type="submit" name="upravitClanek" style="border:0;">
																					<i class="far fa-edit" style="margin-right:5px;"></i>
																					Upravit článek
																				</button>
																				<input type="hidden" name="idClanku" value="'.$row['id'].'">
																		  </form>';
																	echo '<form action="../php_soubory/smazatPrispevek.php" method="post" style="margin-bottom:5px;">
																				 <button class="dropdown-item" type="submit" name="odstranitClanek" style="margin-right:5px;outline:none;border:0;">
																					<i class="fas fa-trash-alt" style="margin-right:5px;"></i>
																					Odstranit článek
																				 </button>
																				 <input type="hidden" name="idClanku" value="'.$row['id'].'">
																		  </form>';
													echo '</div>
												 </td>
											</tr>';
								}
					 echo '</tbody>
						</table>
						</div>
					</div>
				</div>
			</div>';
	  }
	?>
	</div>
	</div>
	</body>
</html>