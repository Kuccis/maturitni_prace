<?php
session_start();
include_once 'dtb.php';

$idDiskuze=$_SESSION['idDiskuze'];

if(isset($_POST['uzamknoutDiskuzi']))
{
		$sql = "UPDATE prispevkyForum SET uzamceno=1 WHERE id_prispevku=?;";
		$stmt = mysqli_stmt_init($pripojeni);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/nastaveni.php?uzamceni=neuspesne");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"s",$idDiskuze);
			mysqli_stmt_execute($stmt);
			header("Location: ../php_stranky/forum.php?diskuze".$idDiskuze);
		}
		exit();
}
$idDiskuzeAdminNastroje=$_POST['idPrispevku'];
if(isset($_POST['uzamknout']))
{
		$sql = "UPDATE prispevkyForum SET uzamceno=1 WHERE id_prispevku=?;";
		$stmt = mysqli_stmt_init($pripojeni);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/adminNastroj.php?uzamceni=neuspesne");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"s",$idDiskuzeAdminNastroje);
			mysqli_stmt_execute($stmt);
			header("Location: ../php_stranky/adminNastroj.php?uzamceni==uspesne");
		}
		exit();
}
