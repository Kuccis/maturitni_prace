<?php
	session_start();
	include_once '../php_soubory/dtb.php'
?>
<html lang="cs">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editor textu</title>
    <!-- Bootstrap -->
    <link href="../Bootstrap_knihovny/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../Bootstrap_knihovny/js/bootstrap.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-toggleable-md bg-inverse  navbar-inverse navbar-fixed-top">
      <div class="navbar-header">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarOdkazEditor" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="../index.php">
      <img src="../foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarOdkazEditor">
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
				else{
					header("Location: ../index.php");
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
          ?>
        </div>
    </nav>

	<h1 class="nadpisNastaveni">Textový editor</h1>
	<h5 class="nadpisNastaveni">Potřebujete upravit příspěvek? Zde si ho můžete upravit!</h5>

	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

	<script type="text/javascript" src="../tinymce_editor/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
		tinymce.init({
		  selector: 'textarea',
		  height: 330,
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
	$idClanku = $_POST['idClanku'];
	$sql = "SELECT * FROM clanky WHERE id=$idClanku;";
	$vys = mysqli_query($pripojeni,$sql);
	if(isset($_POST['upravitClanek'])){
		if($row = mysqli_fetch_assoc($vys))
		echo   '<form method="post" action="../php_soubory/upravitClanek.php" id="textEditor">
				  <input type="text" class="form-control" style="margin-bottom:10px; width:300px;" placeholder="Titulek" name="textTitulek" id="titulek" value="'.$row['titulek'].'">
				  <input type="text" class="form-control" style="margin-bottom:10px; width:500px;" placeholder="Krátký popis" name="textPopis" id="popis" value="'.$row['kratkyPopis'].'">
				  <textarea name="content" style="width:100%">
				  '.$row['clanek'].'
				  </textarea>
				  <input type="hidden" name="idClanku" value="'.$row['id'].'">
				  <button type="submit" name=upravitClanekNastroj style="margin-top:10px;margin-bottom:20px;width:150px;">Upravit</button>
				</form>';
	}
	?>
  </body>
</html>
