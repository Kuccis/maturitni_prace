<?php
session_start();
include_once 'dtb.php';

$id = $_SESSION['idUzivatele'];
$emailNEW=$_POST['novyEmail'];

if(isset($_POST['submitEmailu']))
{
	if(empty($emailNEW)){
		header("Location: ../php_stranky/nastaveni.php?error=nezadanyemail");
		exit();	//dokud neopravi chybu, kod pod timto ifem se neprovede
	}
	else if(!filter_var($emailNEW,FILTER_VALIDATE_EMAIL)){
		header("Location: ../php_stranky/nastaveni.php?error=spatnezadanyemail");
		exit();
	}
	else {
		$sql="SELECT * FROM uzivatele WHERE email=?;";
		$stmt = mysqli_stmt_init($pripojeni);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/nastaveni.php?error=problemspripojenim");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt, "s", $emailNEW);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$pocet = mysqli_stmt_num_rows($stmt);
			if($pocet > 0){
				header("Location: ../php_stranky/nastaveni.php?error=emailjezabrany");
				exit();
			}else{

				$stmt = mysqli_stmt_init($pripojeni);
				if(!mysqli_stmt_prepare($stmt,$sql)){
					header("Location: ../index.php?error=sqlerror");
					exit();
				}
				else{
					$sql = "UPDATE uzivatele SET email=? WHERE id_uzivatele=?;";
					$stmt = mysqli_stmt_init($pripojeni);
					if(!mysqli_stmt_prepare($stmt,$sql)){
						header("Location: ../php_stranky/nastaveni.php?zmenaMailu=neuspesna");
						exit();
					}else{
						mysqli_stmt_bind_param($stmt,"ss",$emailNEW,$id);
						mysqli_stmt_execute($stmt);
					}
					header("Location: ../php_stranky/nastaveni.php?zmenaMailu=uspesna");
					exit();
				}
			}
		}
    }
}
?>
