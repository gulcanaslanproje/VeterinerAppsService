<?php

	include("ayar.php");

	$mus_id = isset($_POST['mus_id']) ?  $_POST['mus_id'] : ''; ;
	$sor = mysqli_query($baglan,"select a.id as soruid , a.soru , b.cevap , b.id as cevapid , b.soru_id from veteriner_sorular a inner join veteriner_cevaplar b on a.id = b.soru_id where a.durum =1 and a.mus_id = '$mus_id' and b.mus_id = '$mus_id'");

	$count = mysqli_num_rows($sor);
	
	class soruClass
	{
		public $soru;
		public $cevap;
		public $cevapid;
		public $soruid;
		public $tf;
	}

	$soru = new soruClass();
	$sayac = 0;

	if(	$count > 0)
	{
		echo("[");
		while ($bilgi = mysqli_fetch_assoc($sor)) 
		{
			$sayac = $sayac + 1;
			$soru->soru = $bilgi["soru"];
			$soru->cevap = $bilgi["cevap"];
			$soru->cevapid = $bilgi["cevapid"];
			$soru->soruid = $bilgi["soru_id"];
			$soru->tf = true;

			echo(json_encode($soru));

			if($count > $sayac)
				echo(",");
		}

		echo("]");
	}
	else
	{
		echo("[");
			$soru->soru = null;
			$soru->cevap = null;
			$soru->cevapid = null;
			$soru->soruid = null;
			$soru->tf = false;
		echo(json_encode($soru));
		echo("]");
	}

?>