<?php
	
	include("ayar.php");

	$mus_id =isset($_POST['id']) ?  $_POST['id'] : ''; 
	$soru = isset($_POST['soru']) ?  $_POST['soru'] : ''; 

	$ekle = mysqli_query($baglan, "insert into veteriner_sorular(mus_id,soru,durum) values('$mus_id','$soru','0' )");

	class Ekleme{

		public $text;
		public $tf;
	}
	$ekleme = new Ekleme();

	if($ekle)
	{
		$ekleme->text = "Sorunuz ilgili veterinere ulsşmıştır. Cevabını bir zaman sonra cevablar alanında göreilirsiniz...";
		$ekleme->tf = true;
		echo(json_encode($ekleme));

	}
	else
	{
		$ekleme->text = "Sorunuz gönderilirken hata oluştu sonra tekrar deneyin...";
		$ekleme->tf = false;			
		echo(json_encode($ekleme));

	}
?>