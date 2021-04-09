<?php
session_start();
include_once 'dtb.php';

$id = $_SESSION['idClanku'];
$titulekNovy = $_POST['textTitulek'];
$clanekNovy = $_POST['content'];
$popisNovy = $_POST['textPopis'];

if(isset($_POST['submitUpravu']))
{
	if(empty($titulekNovy)){
		header("Location: ../php_stranky/editorUprava.php?error=nezadanytitulek");
		exit();	//dokud neopravi chybu, kod pod timto ifem se neprovede
	}
	else if(empty($popisNovy)){
		header("Location: ../php_stranky/editorUprava.php?error=nezadanypopis");
		exit();
	}
	else if(empty($clanekNovy)){
		header("Location: ../php_stranky/editorUprava.php?error=nezadanyclanek");
		exit();
	}
	else {
		$sql = "UPDATE clanky SET titulek=?,kratkyPopis=?,clanek=? WHERE id = $id;";
		$stmt = mysqli_stmt_init($pripojeni);
		if(!mysqli_stmt_prepare($stmt,$sql)){	//mysqli_stmt_prepare pripravuje sql prikaz k provedeni ale pokud nelze z nejakeho duvodu provest - vyhodime error
			header("Location: ../php_stranky/editorUprava.php?zmenaClanku=neuspesna");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"sss",$titulekNovy,$popisNovy,$clanekNovy);	//urceni parametru, ktere chceme updatovat
			mysqli_stmt_execute($stmt);	//provedeni dotazu
			header("Location: ../php_stranky/editorUprava.php?zmenaClanku=uspesna");
			exit();
		}
    }
}
$idClanku=$_POST['idClanku'];
if(isset($_POST['upravitClanekNastroj']))
{
	$titulek = $_POST['textTitulek'];
	$clanek = $_POST['content'];
	$popis = $_POST['textPopis'];
	if(empty($titulek)){
		header("Location: ../php_stranky/adminNastroj.php?error=nezadanytitulek");
		exit();	//dokud neopravi chybu, kod pod timto ifem se neprovede
	}
	else if(empty($popis)){
		header("Location: ../php_stranky/adminNastroj.php?error=nezadanypopis");
		exit();
	}
	else if(empty($clanek)){
		header("Location: ../php_stranky/adminNastroj.php?error=nezadanyclanek");
		exit();
	}
	else {
		$sql = "UPDATE clanky SET titulek=?,kratkyPopis=?,clanek=? WHERE id = $idClanku;";
		$stmt = mysqli_stmt_init($pripojeni);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/adminNastroj.php?zmenaClanku=neuspesna");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"sss",$titulek,$popis,$clanek);	//urceni parametru, ktere chceme updatovat
			mysqli_stmt_execute($stmt);	//provedeni dotazu
			header("Location: ../php_stranky/adminNastroj.php?zmenaClanku=uspesna");
			exit();
		}
    }
}
