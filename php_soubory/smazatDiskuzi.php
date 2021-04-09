<?php
	session_start();
	include_once 'dtb.php';
	$idClanku=$_SESSION['idDiskuze'];

	if(isset($_POST['smazatDiskuzi'])){
	 //mazani prispevku
	 $sql = "DELETE FROM prispevkyForum WHERE id_prispevku=?;";
	 $stmt = mysqli_stmt_init($pripojeni);
	 //mazani komentaru prispevku 
	 $sqlKom = "DELETE FROM komentarePrispevku WHERE id_diskuze=?;";
	 $stmtKom = mysqli_stmt_init($pripojeni);
		
	 if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../php_stranky/forum.php?smazaniDiskuze=neuspesne");
		exit();
	 }
     if(!mysqli_stmt_prepare($stmtKom,$sqlKom)){
		exit();
	 }else{
		//mazani prispevku
		mysqli_stmt_bind_param($stmt,"s",$idClanku);
		mysqli_stmt_execute($stmt);
		//mazani komentaru prispevku 
		mysqli_stmt_bind_param($stmtKom,"s",$idClanku);
		mysqli_stmt_execute($stmtKom);
		header("Location: ../php_stranky/forum.php?smazaniDiskuze=uspesne");
	 	exit();
	 }
	}
	//*********************************************************************************************
	$idPrispevku=$_POST['idPrispevku'];

	if(isset($_POST['odstranitDiskuzi'])){
	 //mazani prispevku
	 $sql = "DELETE FROM prispevkyForum WHERE id_prispevku=?;";
	 $stmt = mysqli_stmt_init($pripojeni);
	 //mazani komentaru prispevku 
	 $sqlKom = "DELETE FROM komentarePrispevku WHERE id_diskuze=?;";
	 $stmtKom = mysqli_stmt_init($pripojeni);
		
	 if(!mysqli_stmt_prepare($stmt,$sql)){
		header("Location: ../php_stranky/adminNastroj.php?smazaniDiskuze=neuspesne");
		exit();
	 }
     if(!mysqli_stmt_prepare($stmtKom,$sqlKom)){
		exit();
	 }else{
		//mazani prispevku
		mysqli_stmt_bind_param($stmt,"s",$idPrispevku);
		mysqli_stmt_execute($stmt);
		//mazani komentaru prispevku 
		mysqli_stmt_bind_param($stmtKom,"s",$idPrispevku);
		mysqli_stmt_execute($stmtKom);
		header("Location: ../php_stranky/adminNastroj.php?smazaniDiskuze=uspesne");
	 	exit();
	 }
	}
?>
