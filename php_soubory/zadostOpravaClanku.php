<?php
session_start();
include_once 'dtb.php';
$jmeno = $_SESSION['jmenoUzivatele'];

$id=$_POST['idClanku'];
$titulek=$_POST['titulekClanku'];
$datVyt=$_POST['datumVytvoreniClanku'];
$komentar=$_POST['content'];

if(isset($_POST['submitProblem']))
{
  $do = "kuceral.99@spst.eu";

  $predmet = 'Žádost o opravení článku zaslána uživatelem '.$jmeno.'';

  $zprava='<p>Uživatel '.$jmeno.', zaslal žádost o opravu článku.</p>';
  $zprava .= '<p>Informace, které uživatel zaslal: </br>';
  $zprava .= '<ul>
                <li>ID článku: '.$id.'</li>
				<li>Titulek článku: '.$titulek.'</li>
				<li>Datum vytvoření článku: '.$datVyt.'</li>
                <li>Uživatel popsal problém takto: '.$komentar.'</li>
              </ul>';
  $zprava .= '</p>';

  $header = "Od: Lubos Kucera <www.kucera-lubos.mzf.cz>\r\n";
  $header .= "Odpovědět: kuceral.99@spst.eu\r\n";
  $header .= "Content-type: text/html\r\n";

  mail($do, $predmet, $zprava, $header);

  header("Location: ../php_stranky/clanky.php?clanek".$id."#zadostOdeslana");
  exit();
}
?>
