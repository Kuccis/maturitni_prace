<?php
	session_start();
	include_once '../php_soubory/dtb.php'
?>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fórum - nová diskuze</title>
    <!-- Bootstrap -->
    <link href="../Bootstrap_knihovny/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../Bootstrap_knihovny/js/bootstrap.min.js"></script>
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
	<h1 class="nadpisNastaveni">Nová diskuze</h1>
	<h5 class="nadpisNastaveni">Zde můžete založit novou diskuzi</h5>	
  
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../tinymce_editor/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript"> 
		tinymce.init({
		  selector: 'textarea',
		  height: 330,
		  theme: 'modern',
		  plugins: 'preview fullpage powerpaste searchreplace autolink directionality visualblocks visualchars fullscreen link template codesample charmap hr nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount contextmenu colorpicker textpattern help',
		  toolbar1: 'bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
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
	<form method="post" action="../php_soubory/pridejDiskuzi.php" style="margin-left:2.7%;float:left;margin-right:2.7%;margin-top:2.7%;width:95%;">
		<p>
		Zařazení tématu: 	
		<select id="selektorDiskuze" name="zarazeniPrispevku">
					<option value="nic">Vyberte zařazení</option>
				<optgroup label="Dle obsahu motoru">
					<option value="50ccm">50ccm</option>
					<option value="125ccm">125ccm</option>
					<option value="250ccm">250ccm</option>
					<option value="500ccm">500ccm</option>
					<option value="600ccm">600ccm</option>
					<option value="1000ccm">1000ccm</option>
					<option value="jiné">jiné</option>
				</optgroup>
				<optgroup label="Dle typu motocyklu">
					<option value="Silniční sportovní">Silniční sportovní</option>
					<option value="Silniční cestovní">Silniční cestovní</option>
					<option value="Naked">Naked</option>
					<option value="Chopper">Chopper</option>
					<option value="Enduro">Enduro</option>
					<option value="Veterán">Veterán</option>
					<option value="Skůtr">Skůtr</option>
					<option value="Jiné">Jiné</option>
				</optgroup>
				<optgroup label="Dle původu motocyklu">
					<option value="Japonsko">Japonsko</option>
					<option value="Itálie">Itálie</option>
					<option value="Čína">Čína</option>
					<option value="Něm_rak">Německo/Rakousko</option>
					<option value="Česká Republika">Česká Republika</option>
					<option value="USA">USA</option>
					<option value="Ostatní">Ostatní</option>
				</optgroup>
		</select>
		</p>
		<p>
			Název diskuze:<input type="text" id="nazevDiskuze" placeholder="Název" name="textNazev">
		</p>
		<textarea name="content" style="margin-right:2.7%;width:100%;">
      	</textarea>
		<button name="submitPridej" style="margin-top:10px;margin-bottom:20px;width:150px;">Přidat diskuzi</button>
	</form>
  </body>
</html>
