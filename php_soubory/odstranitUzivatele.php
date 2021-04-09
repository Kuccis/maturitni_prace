<?php
	session_start();
	include_once 'dtb.php';
	$idUzivatele=$_POST['idUzivatele'];

	if(isset($_POST['odstranitUzivatele'])){
	 $sql = "DELETE FROM uzivatele WHERE id_uzivatele=$idUzivatele;";
	 $vys=mysqli_query($pripojeni,$sql); //provedeme prikaz
		
     $sqlKom="DELETE FROM komentarePrispevku WHERE idUzivateleKomentar=$idUzivatele;";
	 $vysKom=mysqli_query($pripojeni,$sqlKom);
		
	 $sqlDiskuze="DELETE FROM prispevkyForum WHERE idUziv=$idUzivatele;";
	 $vysDiskuze=mysqli_query($pripojeni,$sqlDiskuze);
	
	 $jmenoFoto="../profilove_foto/profile".$idUzivatele."*";
	 $fotoinfo=glob($jmenoFoto);
	 $fotoext=explode(".",$fotoinfo[0]);
	 $fotoKonc=$fotoext[3];

	 $foto = "../profilove_foto/profile".$idUzivatele.".".$fotoKonc;
     if(!unlink($foto)){
	 }else{
	 }
	 
	 header("Location: ../php_stranky/adminNastroj.php?uzivatel==odstranen");
	 exit();
	}
	else{
	 header("Location: ../php_stranky/adminNastroj.php?uzivatel==odstraneni_neuspesne");
	 exit();
	}
?>
