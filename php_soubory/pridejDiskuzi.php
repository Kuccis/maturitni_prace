<?php
session_start();
include_once 'dtb.php';
if(isset($_POST['submitPridej'])){
      $idUziv=$_SESSION['idUzivatele'];
      $zarazeni = $_POST['zarazeniPrispevku'];
      $titulekDiskuze = $_POST['textNazev'];
	  $textDiskuze = $_POST['content'];
	  $datum = date("Y-m-d");

	  $sql="INSERT INTO prispevkyForum (idUziv,zarazeni,titulek,textDiskuze,datumPridani) VALUES (?,?,?,?,?)";
	  $stmt = mysqli_stmt_init($pripojeni);
	  if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../index.php?error=sqlerror");
			exit();
	  }
      else if($zarazeni == "nic"){
        header("Location: ../php_stranky/novaDiskuze.php?chyba");
        exit();
      }
	  else{
		mysqli_stmt_bind_param($stmt, "sssss", $idUziv,$zarazeni,$titulekDiskuze,$textDiskuze,$datum);
		mysqli_stmt_execute($stmt);
		  
		$sqlDis = "SELECT * FROM prispevkyForum ORDER BY id_prispevku DESC";
		$vysDis = mysqli_query($pripojeni,$sqlDis);
		  
		$rowDis = mysqli_fetch_assoc($vysDis);
		
		header("Location: ../php_stranky/forum.php?diskuze".$rowDis['id_prispevku']);
		exit();
	  }
	}
?>
