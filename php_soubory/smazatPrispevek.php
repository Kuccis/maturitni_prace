<?php
	session_start();
	include_once 'dtb.php';
	$idClanku=$_SESSION['idClanku'];

	if(isset($_POST['smazat'])){
	 $sql = "DELETE FROM clanky WHERE id='$idClanku';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
		
	 $jmenoFoto="../clanky_foto/clanekUvod".$idClanku."*";
	 $fotoinfo=glob($jmenoFoto);
	 $fotoext=explode(".",$fotoinfo[0]);
	 $fotoKonc=$fotoext[3];

	 $foto = "../clanky_foto/clanekUvod".$idClanku.".".$fotoKonc;

	 if(!unlink($foto)){
	   $_SESSION['statusClanku']=1;
	 }else{
	   $_SESSION['statusClanku']=1;
	 }
		
	 header("Location: ../php_stranky/clanky.php#smazaniClanku=uspesne");
	 exit();
	}
	//*******************************************************************************

	$idClankuNastroj=$_POST['idClanku'];

	if(isset($_POST['odstranitClanek'])){
	 $sql = "DELETE FROM clanky WHERE id='$idClankuNastroj';";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
		
	 $jmenoFoto="../clanky_foto/clanekUvod".$idClankuNastroj."*";
	 $fotoinfo=glob($jmenoFoto);
	 $fotoext=explode(".",$fotoinfo[0]);
	 $fotoKonc=$fotoext[3];

	 $foto = "../clanky_foto/clanekUvod".$idClankuNastroj.".".$fotoKonc;

	 if(!unlink($foto)){
	 }else{
	 }
		
	 header("Location: ../php_stranky/adminNastroj.php?smazaniClanku=uspesne");
	 exit();
	}
?>
