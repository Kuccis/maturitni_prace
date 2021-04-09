<?php
session_start();
include_once 'dtb.php';

$idKomentare=$_POST['komentid'];
$idDiskuze=$_POST['diskuzeid'];

if(isset($_POST['sumbitKomentar']))
{
	$komentar=$_POST['content'];
	$sql = "UPDATE komentarePrispevku SET komentar=? WHERE id_komentare='$idKomentare';";
	$stmt = mysqli_stmt_init($pripojeni);
	if(!mysqli_stmt_prepare($stmt,$sql)){	//mysqli_stmt_prepare pripravuje sql prikaz k provedeni ale pokud nelze z nejakeho duvodu provest - vyhodime error
		header("Location: ../php_stranky/forum.php?diskuze".$idDiskuze."#zmena=neuspesna");
		exit();
	}else{
		mysqli_stmt_bind_param($stmt,"s",$komentar);	//urceni parametru, ktere chceme updatovat
		mysqli_stmt_execute($stmt);	//provedeni dotazu
		header("Location: ../php_stranky/forum.php?diskuze".$idDiskuze."#zmena=uspesna");
		exit();
	}
}
?>
