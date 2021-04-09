<?php

if (isset($_POST["resetHeslaSubmit"])){
  
  $selektor = bin2hex(random_bytes(8)); //pro bezpecnost proti hackerum
  $token = random_bytes(32);

  $url = "www.kucera-lubos.mzf.cz/ROCNIKOVY_PROJEKT/php_stranky/vytvoreniNovehoHesla.php?selektor=" . $selektor ."&validator=". bin2hex($token);

  $vyprseniPlatnosti = date("U") + 1800; //dnesni datum + 1800 sekund

  require 'dtb.php';

  $emailUzivatele = $_POST["email"];
  if(empty($emailUzivatele)){
	  header("Location: ../php_stranky/resetHesla.php?resetnevyplnenepole=email");
	  exit();
  }
  $sql = "DELETE FROM resethesla WHERE hesloResetEmail=?";    //smazani existujicich tokenu
  $stmt = mysqli_stmt_init($pripojeni); //zjisteni jestli funguje pripojeni a lze vykonat
  if(!mysqli_stmt_prepare($stmt,$sql)){
    echo "Error!!";
    exit();
  }else{
    mysqli_stmt_bind_param($stmt,"s",$emailUzivatele);   //rekne cim se zameni hesloResetEmail=? pred provedenim stmt
    mysqli_stmt_execute($stmt); // vykona stmt
  }

  $sql = "INSERT INTO resethesla (hesloResetEmail,hesloResetSelektor,hesloResetToken,hesloResetVyprseni) VALUES (?,?,?,?);";  //zavorky slouzi k upresneni kam presne pridat value
  $stmt = mysqli_stmt_init($pripojeni); //zjisteni jestli funguje pripojeni
  if(!mysqli_stmt_prepare($stmt,$sql)){
    echo "Error!!";
    exit();
  }else{
    $hasToken = password_hash($token,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"ssss",$emailUzivatele,$selektor,$hasToken,$vyprseniPlatnosti);   //rekne cim se zameni hesloResetEmail=? pred provedenim stmt
    mysqli_stmt_execute($stmt); // vykona stmt
  }

  mysqli_stmt_close($stmt); //uzavreni $stmt
  mysqli_close(); //ukonceni pripojeni

  $do=$emailUzivatele;

  $predmet = 'Obnovení hesla pro Motofórum.cz';

  $zprava='<p>Dostali jsme zprávu, že jste zapomněl/a vaše heslo na stránce Motofórum.cz. Následující link vás zavede na stránku pro obnovení hesla.</p>';
  $zprava .= '<p>Link: </br>';
  $zprava .= '<a href="' . $url . '">' . $url . '</a></p>';

  $header = "Od: Lubos Kucera <www.kucera-lubos.mzf.cz>\r\n";
  $header .= "Odpovědět: kuceral.99@spst.eu\r\n";
  $header .= "Content-type: text/html\r\n";

  mail($do, $predmet, $zprava, $header);

  header("Location: ../php_stranky/resetHesla.php?resethesla=uspesny");

}else{
  header("Location: ../index.php");
}
