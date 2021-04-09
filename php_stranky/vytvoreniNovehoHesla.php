<head>
	<meta charset="utf-8">                        
	<meta http-equiv="X-UA-Compatible" content="IE=edge">                        
	<meta name="viewport" content="width=device-width, initial-scale=1">                                                    
	<title>Změna hesla</title>                        
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
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNoveHeslo" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="../index.php">
      <img src="../foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarNoveHeslo">
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
          </ul>
        </div>
    </nav>
	<div class = "resetHesla">
	  <h1 class="nadpisNastaveni">Zapomenuté heslo? Nevadí, zde si ho můžete změnit!</h1>
	  <p class="nadpisNastaveni">Prosím zadejte nové heslo: </p>
	  <?php
		 $celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		 if(strpos($celaURL,"updatehesla=uspesny")){
				 echo '<div class = "successHlaska">';
				 echo "<p class='success'>Změna hesla proběhla v pořádku!</p>";
				 echo '</div>';
		 }
		 else if(strpos($celaURL,"hesla=prazdna")){
				 echo '<div class = "errorHlaska">';
				 echo "<p class='error'>Nezadali jste heslo!</p>";
				 echo '</div>';
		 }
		 else if(strpos($celaURL,"rozdilna=hesla")){
				 echo '<div class = "errorHlaska">';
				 echo "<p class='error'>Zadaná hesla jsou rozdílná!</p>";
				 echo '</div>';
		 }
		 else if(strpos($celaURL,"error=heslojekratke")){
				 echo '<div class = "errorHlaska">';
				 echo "<p class='error'>Zadané heslo je příliš krátké!</p>";
				 echo '</div>';
		 }
	  ?>
	  <?php
		$selektor = $_GET["selektor"];
		$validator = $_GET["validator"];  //pomoci techto promenych budeme kontrolovat jesli uz existuji

		if (empty($selektor) || empty($validator)) {   //kontrola jestli muzeme validovat.pokud nemame v URL selektor a validator, vyhodime error
		}else{  //musime zkontrolovat jesli jsou zde spravne tokeny
		  if (ctype_xdigit($selektor) !== false && ctype_xdigit($validator) !== false) {    //kontorla jestli hexadec tokeny jsou opravdu hexadecimalni
			?>

			<form action="../php_soubory/resetHeslaSkript.php" method="post" id="zmenaHeslaZaNove">
			  <input type="hidden" name="selektor" value="<?php echo $selektor ?>">
			  <input type="hidden" name="validator" value="<?php echo $validator ?>">
			  <input class="form-control" type="password" name="heslo">
			  <label class="form-control-placeholder">Zadejte nové heslo</label>
		   	  <br>
			  <input class="form-control" type="password" name="hesloZnovu">
			  <label class="form-control-placeholder">Zadejte znovu nové heslo</label>
			  <br>
			  <button type="submit" name="resetHeslaSubmit">Změnit heslo</button>
			</form>

			<?php
		  }
		}
	  ?>
	</div>
</body> 