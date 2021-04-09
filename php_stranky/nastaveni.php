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
    <title>Nastavení účtu</title>
    <!-- Bootstrap -->
	<link href="../foto/piston.png" rel="shortcut icon" type="image/png">
    <link href="../Bootstrap_knihovny/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../Bootstrap_knihovny/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md bg-inverse  navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNastaveni" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="../index.php">
      <img src="../foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarNastaveni">
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
		  $fileactualext=$fileext[3];

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
			echo '<form action="../php_soubory/odhlaseni.php" method="post" style="margin-top:auto;margin-bottom:0;">
			  		 <a href="../php_stranky/nastaveni.php">
                   	 <img src="../profilove_foto/default.jpg" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     <a href="../php_stranky/nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>
					 
					 <button type="submit" class="btn btn-success ml-auto" name=odhlaseni id="tlacitkoOdhlaseni">
	              		Odhlásit se
	            	 </button>
				  </form>';
		  }
          ?>
        </div>
    </nav>
	 
	<h1 class="nadpisNastaveni">Nastavení účtu</h1>
	<h5 class="nadpisNastaveni">Nejste spokojení s nastavením vašeho účtu? Změnte si ho zde!</h5>
	<?php
		$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if(strpos($celaURL,"error=prazdnakolonka") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Nezadali jste žádné jméno!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=spatnezadejmeno") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Zadané jméno má špatný tvar!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=problemspripojenim") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Problém s připojením k databázi</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=jmenojezabrane") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Zadané jméno již někdo vlastní</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"nahrani=uspesne") == true){
			echo '<div class = "successHlaska">';
			echo "<p class='success'>Změna jména proběhla v pořádku</p>";
			echo '</div>';
		}
		//******************************************************************************************************
		else if(strpos($celaURL,"error=nezadanyemail") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Nezadali jste žádnou e-mail adresu!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=spatnezadanyemail") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Zadaný e-mail má špatný tvar!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=problemspripojenim") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Problém s připojením k databázi</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=emailjezabrany") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Zadaný e-mail je obsazený</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"zmenaMailu=uspesna") == true){
			echo '<div class = "successHlaska">';
			echo "<p class='success'>Změna e-mailu proběhla v pořádku</p>";
			echo '</div>';
		}
		//*****************************************************************************************************
		else if(strpos($celaURL,"smazaniFoto=uspesne") == true){
			echo '<div class = "successHlaska">';
			echo "<p class='success'>Smazání profilové fotky bylo úspěšné</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"uploadFoto=uspesne") == true){
			echo '<div class = "successHlaska">';
			echo "<p class='success'>Profilová fotka byla úspěšné nahrána</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"uploadFoto=fotografiejeprilisvelka") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Fotografie je příliš velká!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"uploadFoto=problemprinahravani") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Problém, prosím nahrajte fotografii znovu</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"uploadFoto=spatnytypfotografie") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Špatný typ fotografie!</p>";
			echo '</div>';
		}
	?>
	<div id="vybratFoto">
	<?php
		$sessionid=$_SESSION['idUzivatele'];
		$filename="../profilove_foto/profile".$sessionid."*";
		$fileinfo=glob($filename);
		$fileext=explode(".",$fileinfo[0]);
		$fileactualext=$fileext[3];
		
		if($_SESSION['statusUzivatele'] == 0){
		echo '<h4 id = "jmenoUFoto"><strong>'.$_SESSION['jmenoUzivatele'].'</strong></h4>';
		echo '<p id="upozorneniFoto"><img src="../profilove_foto/profile'.$sessionid.'.'.$fileext[3].'" id="profilFotoNastaveni" width="200" height="200" alt="Profilová fotka">
			  Profilová fotka musí být menší než 1mb. Podporovanými formáty jsou <strong>jpg, jpeg a png</strong>. Nahrané fotky nesmějí obsahovat rasový podtext,
			  případně xenofobní nebo urážlivé obrázky. Jakkoliv závádné fotky budou bez upozornění mazány.</p>';
		}if($_SESSION['statusUzivatele'] == 1){
		echo '<h4 id = "jmenoUFoto"><strong>'.$_SESSION['jmenoUzivatele'].'</strong></h4>';
		echo '<p id="upozorneniFoto"><img src="../profilove_foto/default.jpg" id="profilFotoNastaveni" width="200" height="200" alt="Profilová fotka">
			  Profilová fotka musí být menší než 1mb. Podporovanými formáty jsou <strong>jpg, jpeg a png</strong>. Nahrané fotky nesmějí obsahovat rasový podtext,
			  případně xenofobní nebo urážlivé obrázky. Jakkoliv závádné fotky budou bez upozornění mazány.</p>';
		}
	  ?>
	<?php
	if($_SESSION['statusUzivatele'] == 1)
	{
		echo '<form action="../php_soubory/uploadProfilovky.php" method="post" enctype="multipart/form-data" id="vybratFot">
      			<input class = "buttonFoto" type="file" name="foto">
	  			<button class = "buttonFotoo" type = "submit" name="submit">Změnit profilovou fotku</button>
    	  	  </form>';
	}
	?>
	<form action="../php_soubory/smazaniProfilovky.php" method="post" id="smazatFoto">
	  <button class = "buttonSmazatFoto" type = "submit" name="submitSmazat">Smazat profilovou fotku</button>
    </form>
	</div>
	<form action="../php_soubory/zmenaJmena.php" method="post" id="zmenaJmena">
		<input type="text" class="form-control" name="noveJmeno">
        <label class="form-control-placeholder">Zadejte nové jméno</label>
		<input type="submit" class="tlacUlozit" name="submitJmena" value="Změnit jméno">
	</form>
	<form action="../php_soubory/zmenaEmailu.php" method="post" id="zmenaEmailu">
		<input type="text" class="form-control" name="novyEmail">
        <label class="form-control-placeholder">Zadejte nový e-mail</label>
		<input type="submit" id="tlacUlozitEmail" name="submitEmailu" value="Změnit e-mail">
	</form>
  </body>
</html>
