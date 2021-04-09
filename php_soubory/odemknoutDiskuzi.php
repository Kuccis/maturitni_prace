<?php
session_start();
include_once 'dtb.php';

$idDiskuze=$_POST['idPrispevku'];

if(isset($_POST['odemknoutDiskuzi']))
{
		$sql = "UPDATE prispevkyForum SET uzamceno=0 WHERE id_prispevku=?;";
		$stmt = mysqli_stmt_init($pripojeni);

		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/adminNastroj.php?odemceni=neuspesne");
			exit();
		}else{
			mysqli_stmt_bind_param($stmt,"s",$idDiskuze);
			mysqli_stmt_execute($stmt);
			header("Location: ../php_stranky/adminNastroj.php?odemceni==uspesne");
			exit();
		}
}
?>
