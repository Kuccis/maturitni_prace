<?php
	session_start();
	include_once 'dtb.php';
	$id = $_SESSION['idUzivatele'];

	if(isset($_POST['submitSmazat'])){
		 $sql = "UPDATE uzivatele SET status=1 WHERE id_uzivatele=?;";
		 $stmt = mysqli_stmt_init($pripojeni);
		 if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/nastaveni.php?smazani=neuspesne");
			exit();
		 }else{
			mysqli_stmt_bind_param($stmt,"s",$id);
			mysqli_stmt_execute($stmt);
			$_SESSION['statusUzivatele']=$row['status'];

			 $jmenoFoto="../profilove_foto/profile".$id."*";
			 $fotoinfo=glob($jmenoFoto);
			 $fotoext=explode(".",$fotoinfo[0]);
			 $fotoKonc=$fotoext[3];

			 $foto = "../profilove_foto/profile".$id.".".$fotoKonc;

			 if(!unlink($foto)){
				$_SESSION['statusUzivatele']=1;
			 }else{
				$_SESSION['statusUzivatele']=1;
			 }
			 header("Location: ../php_stranky/nastaveni.php?smazaniFoto=uspesne");	
			 exit();
		}
	}
	$idUzivateleNastroj=$_POST['idUzivatele'];

	if(isset($_POST['odstranitProfilovouFoto'])){
		 $sql = "UPDATE uzivatele SET status=1 WHERE id_uzivatele=?;";
		 $stmt = mysqli_stmt_init($pripojeni);
		 if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: ../php_stranky/adminNastroj.php?smazani=neuspesne");
			exit();
		 }else{
			 mysqli_stmt_bind_param($stmt,"s",$idUzivateleNastroj);
			 mysqli_stmt_execute($stmt);
			 $jmenoFoto="../profilove_foto/profile".$idUzivateleNastroj."*";
			 $fotoinfo=glob($jmenoFoto);
			 $fotoext=explode(".",$fotoinfo[0]);
			 $fotoKonc=$fotoext[3];

			 $foto = "../profilove_foto/profile".$idUzivateleNastroj.".".$fotoKonc;
			
			 $sqlDot="SELECT * FROM uzivatele WHERE admin=1;";
			 $vysDot=mysqli_query($pripojeni,$sqlDot);
			 $rowDot=mysqli_fetch_assoc($vysDot);
			 
			 if(!unlink($foto)){
			 }else{
				 if($rowDot['id_uzivatele'] == $idUzivateleNastroj){
				 	$_SESSION['statusUzivatele']=1;
				 }

			 }
			 header("Location: ../php_stranky/adminNastroj.php?smazaniFoto=uspesne");	
			 exit();
		}
	}
?>