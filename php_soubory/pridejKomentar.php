<?php
session_start();
include_once 'dtb.php';

$idUziv=$_SESSION['idUzivatele'];
$idDisk=$_SESSION['idDiskuze'];
$komentar = $_POST['content'];
$datum = date("Y-m-d");

if(isset($_POST['submitKomentar'])){
      

	  $sql="INSERT INTO komentarePrispevku (id_diskuze,idUzivateleKomentar,komentar,datum) VALUES (?,?,?,?)";
	  $stmt = mysqli_stmt_init($pripojeni);
	  if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../index.php?error=sqlerror");
			exit();
	  }
	  else{
		mysqli_stmt_bind_param($stmt, "ssss",$idDisk, $idUziv,$komentar,$datum);
		mysqli_stmt_execute($stmt);
		header("Location: ../php_stranky/forum.php?diskuze".$idDisk);
		exit();
	  }
	}
?>
