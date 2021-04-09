<?php
	session_start();
	include_once 'dtb.php';
	$idKomentare=$_POST['idUzivatele'];

	$sqlKom="SELECT * FROM komentarePrispevku WHERE id_komentare='$idKomentare'";
	$vysKom=mysqli_query($pripojeni,$sqlKom);

	$rowKom = mysqli_fetch_assoc($vysKom);
	$idUzivatele=$rowKom['idUzivateleKomentar'];

	if(isset($_POST['ban'])){
	 $sql = "UPDATE uzivatele SET ban=1 WHERE id_uzivatele=$idKomentare;";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../php_stranky/forum.php?diskuze".$_SESSION['idDiskuze']);
	 exit();
	}

	$idUziv=$_POST['idUzivatele'];

	if(isset($_POST['banNastroj'])){
	 $sql = "UPDATE uzivatele SET ban=1 WHERE id_uzivatele=$idUziv;";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
	 header("Location: ../php_stranky/adminNastroj.php?uzivatel==zabanovan");
	 exit();
	}
?>