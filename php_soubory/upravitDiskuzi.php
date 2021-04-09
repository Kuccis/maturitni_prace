<?php
session_start();
include_once 'dtb.php';

$id = $_SESSION['idDiskuze'];
$titulekNovy = $_POST['textNazev'];
$diskuzeNovy = $_POST['content'];

if(isset($_POST['submitUprav']))
{
	if(empty($titulekNovy)){
		header("Location: ../php_stranky/editorDiskuze.php?error=nezadanytitulek");
		exit();	//dokud neopravi chybu, kod pod timto ifem se neprovede
	}
	else if(empty($diskuzeNovy)){
		header("Location: ../php_stranky/editorDiskuze.php?error=nezadanypopis");
		exit();
	}
	else {
		$sql = "UPDATE prispevkyForum SET titulek=?,textDiskuze=? WHERE id_prispevku = '$id';";
		$stmt = mysqli_stmt_init($pripojeni);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/editorDiskuze.php?zmenaDiskuze=neuspesna");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"ss",$titulekNovy,$diskuzeNovy);
			mysqli_stmt_execute($stmt);
			header("Location: ../php_stranky/editorDiskuze.php?zmenaDiskuze=uspesna");
		}
    }
}
?>