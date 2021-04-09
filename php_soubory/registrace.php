<?php
if(isset($_POST['registrace'])){
	
	 require 'dtb.php';

	 $jmenoUzivatele = $_POST['jmeno'];
	 $emailAdresa = $_POST['email'];
	 $hesloJedna = $_POST['heslo1'];
	 $hesloDve=$_POST['heslo2'];

	if(empty($jmenoUzivatele) || empty($emailAdresa) || empty($hesloJedna) || empty($hesloDve)){
		header("Location: ../index.php?error=prazdnekolonky&jmeno=".$jmenoUzivatele. "&email".$emailAdresa);
		exit();	//dokud neopravi chybu, kod pod timto ifem se neprovede
	}
	else if(!filter_var($emailAdresa,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$jmenoUzivatele)){
		header("Location: ../index.php?error=spatnezadanyemail");
		exit();
	}
	else if(!filter_var($emailAdresa,FILTER_VALIDATE_EMAIL)){
		header("Location: ../index.php?error=spatnezadanyemail&jmeno=".$jmenoUzivatele);
		exit();
	}
	else if(!preg_match("/^[a-žA-Ž0-9]*$/",$jmenoUzivatele)){
		header("Location: ../index.php?error=spatnezadejmeno&email=".$emailAdresa);
		exit();
	}
	else if($hesloJedna !== $hesloDve){
		header("Location: ../index.php?error=heslanejsoustejna&jmeno=".$jmenoUzivatele. "&email".$emailAdresa);
		exit();
	}
	else if(strlen($hesloJedna) < 7){
		header("Location: ../index.php?error=heslojekratke");
		exit();
	}
	else {
		$sql="SELECT * FROM uzivatele WHERE jmeno=? OR email=?;";
		$stmt = mysqli_stmt_init($pripojeni);		//Funkce mysqli_stmt_init () inicializuje příkaz a vrátí objekt vhodný pro mysqli_stmt_prepare ().
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../index.php?error=problemspripojenim");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "ss", $jmenoUzivatele, $emailAdresa);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);	//Převede sadu výsledků z posledního dotazu
			$pocet = mysqli_stmt_num_rows($stmt);
			
			if($pocet > 0){
				header("Location: ../index.php?error=jmenoneboemailjezabrane");
				exit();
			}else{
				$sql="INSERT INTO uzivatele (jmeno,email,heslo1,status) VALUES (?,?,?,1)";	//ochrana (proti sql injection)
				$stmt = mysqli_stmt_init($pripojeni);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: ../index.php?error=sqlerror");
					exit();
				}
				else{
					$hasHesla=password_hash($hesloJedna, PASSWORD_DEFAULT);

					mysqli_stmt_bind_param($stmt, "sss", $jmenoUzivatele,$emailAdresa,$hasHesla);
					mysqli_stmt_execute($stmt);
					header("Location: ../index.php?registraceuspesna=success");
					exit();
				}
			}
		}
    }
	mysqli_stmt_close($stmt);
	mysqli_close($pripojeni);
}
else {
	header("Location: ../index.php");
	exit();
}
