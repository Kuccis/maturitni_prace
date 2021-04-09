<?php
session_start();
include_once 'dtb.php';

$id = $_SESSION['idUzivatele'];
$jmenoNEW=$_POST['noveJmeno'];

if(isset($_POST['submitJmena']))
{
	if(empty($jmenoNEW)){
		header("Location: ../php_stranky/nastaveni.php?error=prazdnakolonka");
		exit();	//dokud neopravi chybu, kod pod timto ifem se neprovede
	}
	else if(!preg_match("/^[a-žA-Ž0-9]*$/",$jmenoNEW)){
		header("Location: ../php_stranky/nastaveni.php?error=spatnezadejmeno");
		exit();
	}
	else {
		$sql="SELECT * FROM uzivatele WHERE jmeno=?;";
		$stmt = mysqli_stmt_init($pripojeni);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/nastaveni.php?error=problemspripojenim");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "s", $jmenoNEW);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$pocet = mysqli_stmt_num_rows($stmt);
			if($pocet > 0){
				header("Location: ../php_stranky/nastaveni.php?error=jmenojezabrane");
				exit();
			}else{
				$stmt = mysqli_stmt_init($pripojeni);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: ../index.php?error=sqlerror");
					exit();
				}
				else{
					//$sql = "UPDATE uzivatele SET jmeno='$jmenoNEW' WHERE id_uzivatele = '$id';";
					//$vys = mysqli_query($pripojeni,$sql);
					//nove je dole
					$sql = "UPDATE uzivatele SET jmeno=? WHERE id_uzivatele=?;";
					$stmt = mysqli_stmt_init($pripojeni);
					if(!mysqli_stmt_prepare($stmt,$sql)){
						header("Location: ../php_stranky/nastaveni.php?nahrani=neuspesne");
						exit();
					}else{
						mysqli_stmt_bind_param($stmt,"ss",$jmenoNEW,$id);
						mysqli_stmt_execute($stmt);
					}
					$_SESSION['jmenoUzivatele']=$jmenoNEW;
					header("Location: ../php_stranky/nastaveni.php?nahrani=uspesne");
				}
			}
		}
    }
}
?>
