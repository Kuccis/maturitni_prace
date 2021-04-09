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
	<h5 class="nadpisNastaveni">Čas pro nový příspěvek? Zde si ho můžete napsat!</h5>	
	  
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
		if(isset($_POST['submitBtn']))
		{
			$idAutora=$_SESSION['idUzivatele'];
   		 	$titulekText = $_POST['textTitulek'];
			$clanekText = $_POST['content'];
			$popisText=$_POST['textPopis'];
			$datum = date("Y-m-d"); 
			$zarazeni=$_POST['zarazeniPrispevku'];
			
			$foto = $_POST['foto'];

			$fotoJmeno = $_FILES['foto']['name'];   // $files - globalni promenna, foto - jmeno z inputu, name - nwm
			$fotoTmp = $_FILES['foto']['tmp_name'];  // tmp - jakoze umisteni
			$fotoVelikost = $_FILES['foto']['size'];
			$fotoError = $_FILES['foto']['error'];
			$fotoTyp = $_FILES['foto']['type'];

			$fotoExt = explode('.', $fotoJmeno); //rozdeleni jmena za ucelem zjisteni koncovky souboru (v mem pripade jpg). Vlastne rozdelime fotoJmeno na pole ve kterem bude jmeno a koncovku
			$fotoPismoExt = strtolower(end($fotoExt));  //pokud se nahraje foto, ktera ma koncovku psanou velkym pismem - timto prikazem se zmeni vsechna velka pismena na mala.
			
			$povoleno = array('jpg','jpeg','png');

			
			$sql="INSERT INTO clanky (id_autora,zarazeni,titulek,kratkyPopis,clanek,datum) VALUES (?,?,?,?,?,?)";
			$stmt = mysqli_stmt_init($pripojeni);
			if(!mysqli_stmt_prepare($stmt,$sql)){
				header("Location: ../index.php?error=sqlerror");
				exit();
			}
			else if(empty($titulekText)){
				header("Location: editor.php?error=nezadanyTitulek");
				exit();
			}
			else if(empty($popisText)){
				header("Location: editor.php?error=nezadanyPopis");
				exit();
			}
			else if($zarazeni == "nic"){
				header("Location: editor.php?error=nezadaneZarazeni");
				exit();
			}
			else{
				mysqli_stmt_bind_param($stmt, "ssssss", $idAutora,$zarazeni,$titulekText,$popisText,$clanekText,$datum);
				mysqli_stmt_execute($stmt);
				//************************************************************************************
				$sqlPom="SELECT * FROM clanky ORDER BY id DESC";
				$vysPom = mysqli_query($pripojeni,$sqlPom);
				
				$rowPom = mysqli_fetch_assoc($vysPom);
				$idClanku=$rowPom['id'];
				
				if(in_array($fotoPismoExt, $povoleno)){ //in_array zjisti zda-li pole se jmeneme a koncovkou fotky obsahuje mnou zadane koncovky v promene $povoleno
				  if($fotoError === 0){ //pokud neni zadny problem u nahravani fotky {fotka neni jakkoliv vadna napr vetsi nez je pozadovana, jiny typ atd.}
					if($fotoVelikost < 5000000){  // 5 000 000 = 5mb
					  $fotoNoveJmeno = "clanekUvod".$idClanku.".".$fotoPismoExt; //vyrobi unikatni jmeno. Delame to protoze se muze stat, ze by dva uzivatele chteli nahrat stejne jmeno fotky napr. foto.jpg. Pokud by se tak stalo tak by se fotka ve slozce prepsala a zmizela.
					  $fotoUmisteni = '../clanky_foto/' . $fotoNoveJmeno;
					  move_uploaded_file($fotoTmp,$fotoUmisteni);

					  $sqlStatus = "UPDATE clanky SET status=1 WHERE id = '$idClanku';";
					  $vysStatus = mysqli_query($pripojeni,$sqlStatus);
					  $_SESSION['statusClanku']=$rowPom['status'];
					  header("Location: editor.php?nahranitextu=uspesne");
					  exit();
					}else{
					  header("Location: editor.php?uploadFoto=fotografiejeprilisvelka");
					  exit();
					}
				  }else{
					header("Location: editor.php?uploadFoto=problemprinahravani");
					exit();
				  }
				}else{
				  header("Location: editor.php?uploadFoto=spatnytypfotografie");
			      exit();
				}
				//***************************************************************************************
			}
		}
	?>
	<?php
	$celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if(strpos($celaURL,"uploadFoto=spatnytypfotografie") == true){
		echo '<div class = "errorHlaska">';
		echo "<p class='error'>Špatný formát fotografie!</p>";
		echo '</div>';
	}
	else if(strpos($celaURL,"error=nezadaneZarazeni") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Nevybrali jste zařazení článku!</p>";
			echo '</div>';
	}
	else if(strpos($celaURL,"error=nezadanyTitulek") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Nezadali jste titulek!</p>";
			echo '</div>';
	}
	else if(strpos($celaURL,"error=nezadanyPopis") == true){
			echo '<div class = "errorHlaska">';
			echo "<p class='error'>Nezadali jste popis článku!</p>";
			echo '</div>';
	}
	else if(strpos($celaURL,"nahranitextu=uspesne") == true){
			echo '<div class = "successHlaska">';
			echo "<p class='success'>Článek byl úspěšně vytvořen</p>";
			echo '</div>';
		}
	?>
	<form method="post" action="editor.php" id="textEditor" enctype="multipart/form-data">
		<p>
			<select id="selektor" name="zarazeniPrispevku">
					<option value="nic">Vyberte zařazení</option>
				<optgroup label="Dle obsahu motoru">
					<option value="50ccm">50ccm</option>
					<option value="125ccm">125ccm</option>
					<option value="250ccm">250ccm</option>
					<option value="500ccm">500ccm</option>
					<option value="600ccm">600ccm</option>
					<option value="1000ccm">1000ccm</option>
					<option value="Jiné obsahy motorů">jiné</option>
				</optgroup>
				<optgroup label="Dle typu motocyklu">
					<option value="Silniční sportovní">Silniční sportovní</option>
					<option value="Silniční cestovní">Silniční cestovní</option>
					<option value="Naked">Naked</option>
					<option value="Chopper">Chopper</option>
					<option value="Enduro">Enduro</option>
					<option value="Veterán">Veterán</option>
					<option value="Skútr">Skůtr</option>
					<option value="Jiné typy motocyklů">Jiné</option>
				</optgroup>
				<optgroup label="Dle původu motocyklu">
					<option value="Japonsko">Japonsko</option>
					<option value="Itálie">Itálie</option>
					<option value="Čína">Čína</option>
					<option value="Něm_rak">Německo/Rakousko</option>
					<option value="Česká Republika">Česká Republika</option>
					<option value="USA">USA</option>
					<option value="Ostatní země původu">Ostatní</option>
				</optgroup>
			</select>
		</p>
      <input type="file" name="foto" style="margin-bottom:10px;">
	  <input type="text" class="form-control" id="titulekEditor" placeholder="Titulek" name="textTitulek" id="titulek">
	  <input type="text" class="form-control" id="kratkyPopisEditor" placeholder="Krátký popis" name="textPopis" id="popis">
	  <textarea name="content" style="width:100%">
      </textarea>
	  <button name="submitBtn" style="margin-top:10px;width:150px;">Uložit</button>
	</form>  
  </body>
</html>
