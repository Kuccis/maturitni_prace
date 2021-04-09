<?php 
    session_start();
	include_once 'dtb.php';
    
    $sql = "SELECT * FROM clanky";
    $vys=mysqli_query($pripojeni,$sql);
	$vsechnyClankyPocet = mysqli_num_rows($vys);

    
	if($vsechnyClankyPocet < 10)
	{
		$_SESSION['pocetStran']=($vsechnyClankyPocet/10) + 1;
	}
	else
	{
		$_SESSION['pocetStran']=($vsechnyClankyPocet/10) +1;
	}
?>