<?php
	session_start();
	include_once 'dtb.php';
	$idUzivatele=$_POST['idUzivatele'];

	if(isset($_POST['unBan'])){
	 $sql = "UPDATE uzivatele SET ban=0 WHERE id_uzivatele=$idUzivatele;";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../php_stranky/adminNastroj.php?unBan==uspesny");
	 exit();
	}
	else{
	 header("Location: ../php_stranky/adminNastroj.php?unBan==neuspesny");
	 exit();
	}
?>
