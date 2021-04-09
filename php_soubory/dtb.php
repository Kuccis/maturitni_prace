<?php
	$pripojeni=mysqli_connect("localhost","kuceral99", "kucera18", "databazeproweb");

	if(!$pripojeni){
        die("Připojení selhalo: ".mysqli_connect_error());
    }
?>