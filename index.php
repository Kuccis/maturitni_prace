<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="cs">              
  <head>                        
    <meta charset="utf-8">                        
    <meta http-equiv="X-UA-Compatible" content="IE=edge">                        
    <meta name="viewport" content="width=device-width, initial-scale=1">                                                    
    <title>Úvodní stránka</title>                        
    <!-- Bootstrap -->  
	<link href="foto/piston.png" rel="shortcut icon" type="image/png">
    <link href="Bootstrap_knihovny/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">     
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>         
    <script src="Bootstrap_knihovny/js/bootstrap.min.js"></script> 
  </head>              
  <body>  
    <nav class="navbar navbar-toggleable-md bg-inverse  navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarOdkaz" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="index.php">
      <img src="foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarOdkaz">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="php_stranky/uvod.php">Úvod</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="php_stranky/clanky.php">Články</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="php_stranky/forum.php">Fórum</a>
            </li>  
			<?php
			if($_SESSION['adminStav'] == 1)
		  	{
				echo '<li class="nav-item">';
				echo '<a class="nav-link" href="php_stranky/editor.php">Editor</a>';
				echo '</li>';
				echo '<li class="nav-item">';
				echo '<a class="nav-link" href="php_stranky/adminNastroj.php">Admin nástroje</a>';
				echo '</li>';
			}
		  	?>
          </ul>
		  <?php

			$id=$_SESSION['idUzivatele'];
		  	$filename="profilove_foto/profile".$id."*";
		  	$fileinfo=glob($filename);
		  	$fileext=explode(".",$fileinfo[0]);
		  	$fileactualext=$fileext[1];
			
			echo $fileext[2];

          	if(isset($_SESSION['idUzivatele'])){
			  if($_SESSION['statusUzivatele'] == 0){
	          	echo '<form action="php_soubory/odhlaseni.php" method="post">
			  		 	<a href="php_stranky/nastaveni.php">
                   	 	<img src="profilove_foto/profile'.$id.'.'.$fileext[1].'" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     	<a href="php_stranky/nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>
					 
					 	<button type="submit" class="btn btn-success ml-auto" name=odhlaseni id="tlacitkoOdhlaseni">
	              			Odhlásit se
	            	 	</button>
						</form>';
			  }else{
				  echo '<form action="php_soubory/odhlaseni.php" method="post">
			  		 	<a href="php_stranky/nastaveni.php">
                   	 	<img src="profilove_foto/default.jpg" id="profilFoto" width="50" height="45" alt="Profilová fotka"></a>
			  	     	<a href="php_stranky/nastaveni.php" id="jmenoUzivateleNavbar">'.$_SESSION['jmenoUzivatele'].'</a>
					 
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
          <form class="modal-body seminor-login-form" method="post" action="php_soubory/registrace.php">
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
              <form class="modal-body" method="post" action="php_soubory/login.php">
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
	  <?php
	  	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$emailGet=$_GET['jmeno=&'];
		$jmenoGet=$_GET['&jmeno='];
		
		if(strpos($celaURL,"login=uspesny") == true){
			echo '<div class = "successHlaska">';
			echo "<p class='success'>Přihlášení bylo úspěšné</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=nespravneheslo") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Špatné heslo!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=ucetneexistuje") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Účet s těmito údaji neexistuje!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=prazdnekolonky") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Nevyplněné kolonky!</p>";
			echo '</div>';
		}
		else if(strpos($celaURL,"error=heslanejsoustejna") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Hesla se neshodují!</p>";
			echo '</div>';
		}
	  ?>
  </body>
</html>