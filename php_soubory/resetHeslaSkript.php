<?php
 if(isset($_POST["resetHeslaSubmit"])){
   $selektor = $_POST["selektor"];
   $validator = $_POST["validator"];
   $heslo = $_POST["heslo"];
   $hesloZnovu = $_POST["hesloZnovu"];

   if (empty($heslo) || empty($hesloZnovu)) {
     header("Location: ../php_stranky/vytvoreniNovehoHesla.php?hesla=prazdna");
     exit();
   }else if($heslo != $hesloZnovu){
     header("Location: ../php_stranky/vytvoreniNovehoHesla.php?rozdilna=hesla");
     exit();
   }
   else if(strlen($heslo) < 7){
		header("Location: ../php_stranky/vytvoreniNovehoHesla.php?error=heslojekratke");
		exit();
   }
   $dnesniDatum = date("U");

   require 'dtb.php';

   $sql = "SELECT * FROM resethesla WHERE hesloResetSelektor=? AND hesloResetVyprseni >= ?";
   $stmt = mysqli_stmt_init($pripojeni); //zjisteni jestli funguje pripojeni a lze vykonat
   if(!mysqli_stmt_prepare($stmt,$sql)){
     echo "Error!!";
     exit();
   }else{
     mysqli_stmt_bind_param($stmt,"ss",$selektor,$dnesniDatum);   //rekne cim se zameni hesloResetEmail=? pred provedenim stmt
     mysqli_stmt_execute($stmt); // vykona stmt

     $vys = mysqli_stmt_get_result($stmt);
     if (!$row = mysqli_fetch_assoc($vys)) {  //vezmeme data z vys a pridame je do asociativniho pole
       echo "Prosím odešlete žádost o obnovení ještě jednou!";
       exit();
     }else{

       $tokenBin = hex2bin($validator);
       $tokenCheck = password_verify($tokenBin,$row["hesloResetToken"]);

       if ($tokenCheck === false) { //kontrolujeme jestli token check je true nebo false
         echo "Prosím odešlete žádost o obnovení ještě jednou!";
         exit();
       }else if($tokenCheck === true){//kontrola jestli je true. Kontroluji pomoc else if kdyby se nahodou pokazil kod a vysledek by nebyl true/false.
         $tokenEmail = $row['hesloResetEmail'];
         $sql = "SELECT * FROM uzivatele WHERE email=?;";
         $stmt = mysqli_stmt_init($pripojeni);
         if(!mysqli_stmt_prepare($stmt,$sql)){
           echo "Error!!";
           exit();
         }else{
           mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
           mysqli_stmt_execute($stmt);
           $vys = mysqli_stmt_get_result($stmt);
           if(!$row = mysqli_fetch_assoc($vys)){
             echo "Error!";
             exit();
           }else{
              $sql = "UPDATE uzivatele SET heslo1=? WHERE email=?";
              $stmt = mysqli_stmt_init($pripojeni);
              if(!mysqli_stmt_prepare($stmt,$sql)){
                echo "Error!!";
                exit();
              }else{
                $noveHasHeslo = password_hash($heslo, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt,"ss",$noveHasHeslo,$tokenEmail);
                mysqli_stmt_execute($stmt);

                $sql = "DELETE FROM resethesla WHERE hesloResetEmail=?";
                $stmt = mysqli_stmt_init($pripojeni);
                if(!mysqli_stmt_prepare($stmt,$sql)){
                  echo "Error!!!!!!!!!";
                  exit();
                }else{
                  mysqli_stmt_bind_param($stmt,"s",$tokenEmail);
                  mysqli_stmt_execute($stmt);
                  header("Location: ../php_stranky/resetHesla.php?updatehesla=uspesny");
                }
              }
           }
         }
       }
     }
   }

 }else{
   header("Location: ../index.php");
 }
