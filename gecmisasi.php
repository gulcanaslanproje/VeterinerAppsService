<?php

	include("ayar.php");

	$mus_id = isset($_POST['id']) ?  $_POST['id'] : ''; 
	$pet_id = isset($_POST['petid']) ?  $_POST['petid'] : ''; 

	$sor = mysqli_query($baglan,"select a.pet_isim, a.pet_tur, a.pet_cins, a.pet_resim,b.asi_tarih, b.asi_isim from veteriner_pet_listesi a INNER JOIN veteriner_takipasi b on a.id = b.pet_id WHERE a.mus_id = '$mus_id' and b.mus_id =  '$mus_id' and b.asi_durum = 1 and b.pet_id ='$pet_id'");

	$count = mysqli_num_rows($sor);
	
	class asiTakip
	{
		public $petisim;
		public $pettur;
		public $petcins;
		public $petresim;
		public $asitarih;
		public $asiisim;
		public $tf;
	}

	$asi = new asiTakip();
	$sayac = 0;

	if(	$count > 0)
	{
		echo("[");
		while ($bilgi = mysqli_fetch_assoc($sor)) 
		{
			$sayac = $sayac + 1;
			$asi->petisim = $bilgi["pet_isim"];
			$asi->pettur = $bilgi["pet_tur"];
			$asi->petcins = $bilgi["pet_cins"];
			$asi->petresim = $bilgi["pet_resim"];
			$asi->asitarih = $bilgi["asi_tarih"];
			$asi->asiisim = $bilgi["asi_isim"];
			$asi->tf = true;

			echo(json_encode($asi));

			if($count > $sayac)
				echo(",");
		}

		echo("]");
	}
	else
	{
		echo("[");
			$asi->petisim = null;
			$asi->pettur = null;
			$asi->petcins = null;
			$asi->petresim = null;
			$asi->asitarih = null;
			$asi->asiisim = null;
			$asi->tf = false;

		echo(json_encode($asi));
		echo("]");
	}

?>