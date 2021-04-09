<?php
session_start();
include_once 'dtb.php';
$jmeno = $_SESSION['jmenoUzivatele'];
$id=$_SESSION['idUzivatele']; 
$email=$_SESSION['emailUzivatele'];
	
if(isset($_POST['unban']))
{
  $do = "kuceral.99@spst.eu";

  $predmet = 'Žádost o odbanování uživatele '.$jmeno.'';

  $zprava='<p>Uživatel '.$jmeno.', který byl zabanován žádá o odbanování.</p>';
  $zprava .= '<p>Informace o uživateli: </br>';
  $zprava .= '<ul>
                <li>ID: '.$id.'</li>
                <li>Jmeno: '.$jmeno.'</li>
                <li>Email: '.$email.'</li>
              </ul>';
  $zprava .= '</p>';

  $header = "Od: Lubos Kucera <www.kucera-lubos.mzf.cz>\r\n";
  $header .= "Odpovědět: kuceral.99@spst.eu\r\n";
  $header .= "Content-type: text/html\r\n";

  mail($do, $predmet, $zprava, $header);
	
  header("Location: ../php_stranky/forum.php?zadostOdeslana");
  exit();
}
?>
