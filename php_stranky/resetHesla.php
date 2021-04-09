<?php

?>
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
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResetHesla" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <a class="navbar-brand" href="../index.php">
      <img src="../foto/logo.png" width="110" height="90" class="d-inline-block align-top" alt="Logo"></a>
        <div class="collapse navbar-collapse" id="navbarResetHesla">
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
	
	<h1 class="nadpisNastaveni">Zapomenuté heslo? Nevadí, zde si ho můžete změnit!</h1>
	<p class="nadpisNastaveni">Prosím zadejte vaší e-mailovou adresu, na kterou bude zaslán e-mail s odkazem pro obnovení hesla.</p>
	<?php
		 $celaURL="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		 if(strpos($celaURL,"resethesla=uspesny")){
				 echo '<div class = "successHlaska">';
				 echo "<p class='success'>Žádost úspěšně odeslána!</p>";
				 echo '</div>';
		 }else if(strpos($celaURL,"updatehesla=uspesny")){
				 echo '<div class = "successHlaska">';
				 echo "<p class='success'>Vaše heslo bylo úspěšně aktualizováno!</p>";
				 echo '</div>';
		 }
		 else if(strpos($celaURL,"resetnevyplnenepole=email")){
				 echo '<div class = "errorHlaska">';
				 echo "<p class='error'>Nezadali jste e-mail!</p>";
				 echo '</div>';
		 }
	?>
	<div class = "resetHesla">
	  <form action="../php_soubory/zadostResetHesla.php" method="post" id="zmenaHeslaReset">
		<input class="form-control" type="text" name="email">
		<label class="form-control-placeholder">Zadejte vaší e-mailovou adresu</label>
		<button type="submit" name="resetHeslaSubmit">Odeslat žádost o obnovu hesla</button>
	  </form>
	</div>
</body>
