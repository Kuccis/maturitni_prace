<?php
  session_start();
  include_once 'dtb.php';
  $id = $_SESSION['idUzivatele'];

  if(isset($_POST['submit']))
  {
    $foto = $_profFotky['foto'];

    $fotoJmeno = $_FILES['foto']['name'];   // $files - globalni promenna, foto - jmeno z inputu, name - nwm
    $fotoTmp = $_FILES['foto']['tmp_name'];  // tmp - jakoze umisteni
    $fotoVelikost = $_FILES['foto']['size'];
    $fotoError = $_FILES['foto']['error'];
    $fotoTyp = $_FILES['foto']['type'];

    $fotoExt = explode('.', $fotoJmeno); //rozdeleni jmena za ucelem zjisteni koncovky souboru (v mem pripade jpg). Vlastne rozdelime fotoJmeno na pole ve kterem bude jmeno a koncovku
    $fotoPismoExt = strtolower(end($fotoExt));  //pokud se nahraje foto, ktera ma koncovku psanou velkym pismem - timto prikazem se zmeni vsechna velka pismena na mala.

    $povoleno = array('jpg','jpeg','png');

    if(in_array($fotoPismoExt, $povoleno)){ //in_array zjisti zda-li pole se jmeneme a koncovkou fotky obsahuje mnou zadane koncovky v promene $povoleno
      if($fotoError === 0){ //pokud neni zadny problem u nahravani fotky {fotka neni jakkoliv vadna napr vetsi nez je pozadovana, jiny typ atd.}
        if($fotoVelikost < 1000000){  // 1 000 000 = 1mb
          $fotoNoveJmeno = "profile".$id.".".$fotoPismoExt; //vyrobi unikatni jmeno. Delame to protoze se muze stat, ze by dva uzivatele chteli nahrat stejne jmeno fotky napr. foto.jpg. Pokud by se tak stalo tak by se fotka ve slozce prepsala a zmizela.
          $fotoUmisteni = '../profilove_foto/' . $fotoNoveJmeno;
          move_uploaded_file($fotoTmp,$fotoUmisteni);
			
          $sql = "UPDATE uzivatele SET status=0 WHERE id_uzivatele = '$id';";
          $vys = mysqli_query($pripojeni,$sql);
		  $_SESSION['statusUzivatele']=$row['status'];
          header("Location: ../php_stranky/nastaveni.php?uploadFoto=uspesne");
		  exit();
        }else{
          header("Location: ../php_stranky/nastaveni.php?uploadFoto=fotografiejeprilisvelka");
        }
      }else{
        header("Location: ../php_stranky/nastaveni.php?uploadFoto=problemprinahravani");
      }
    }else{
      header("Location: ../php_stranky/nastaveni.php?uploadFoto=spatnytypfotografie");
    }
  }
?>
