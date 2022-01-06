<?php
	
	include("ayar.php");

	$cevapid = isset($_POST['cevap']) ?  $_POST['cevap'] : ''; 
	$soruid = isset($_POST['soru']) ?  $_POST['soru'] : ''; 

	$sil = mysqli_query($baglan, "delete from veteriner_cevaplar where id = '$cevapid ' and soru_id = '$soruid'");
	$sil2 = mysqli_query($baglan, "delete from veteriner_sorular where id = '$soruid'");

	class deleteRecord{

		public $text;
		public $tf;
	}
	$del = new deleteRecord();

	if($sil && $sil2)
	{
		$del->text = "Silme işlemi başarıyla gerçekleşti...";
		$del->tf = true;
		echo(json_encode($del));

	}
	else
	{
		$del->text = "Silme işlemi gerçekleşmedi...";
		$del->tf = false;			
		echo(json_encode($del));

	}
?>