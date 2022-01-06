<?php

	include("ayar.php");

	$mailAdres =  isset($_POST['mailAdres']) ?  $_POST['mailAdres'] : ''; //$_GET["mailAdres"];//"gulcanaslan.1996@gmail.com";
	$kadi = isset( $_POST['kadi']) ?  $_POST['kadi'] : '';//$_GET["kadi"];//"test12";
	$parola =isset( $_POST['pass']) ? $_POST['pass'] : '';//$_GET["pass"];// "test12";
	$dogrulamaKodu = rand(0,10000).rand(0,10000);
	$durum = 0;

	$kontrol = mysqli_query($baglan, "select *from veteriner_kullanicilar where mailAdres = '$mailAdres' or kadi = '$kadi'");
	$count = mysqli_num_rows($kontrol);

	class User{

		public $text;
		public $tf;
	}

	$user = new User();

	if($count>0)
	{
		$user->text ="Girmiş olduğunuz bilgilere ait kullanıcı bulunmakta. Lütfen bilgilerinizi değiştiriniz...";
		$user->tf =false;
		echo(json_encode($user));
	}
	else
	{
		$addUser = mysqli_query($baglan, "insert into veteriner_kullanicilar (kadi, mailAdres, parola, dogrulamaKodu, durum ) values ('$kadi', '$mailAdres', '$parola', '$dogrulamaKodu', '$durum')");

		$git="http://localhost:8000/veterinerservis/aktifet.php?mail=".$mailAdres."&kodu=".$dogrulamaKodu."";
		$to =$mailAdres;
		$subject = "Kullanıcı hesabı aktifleştirme";
		$text ="Merhaba sayın ".$kadi."\n Sisteme giriş yapabilmeniz için onayınız gerekmektedir. <a href = '".$git."' > Onay </a> ";
		$from ="From: neyaziyim47@gmail.com";//".$mailAdres."
		$from .="MIME-Version: 1.0\r\n";
		$from .="Content-Type: text/html; charset=UTF-8\r\n";

		mail($to, $subject, $text, 	$from);
	
		//$guncelle = mysqli_query($baglan,"update veteriner_kullanicilar set durum = '1' where mailAdres = '$mailAdres'  and dogrulamaKodu = '$dogrulamaKodu' ");
		$user->text ="Hesabınız kaydedildi , ancak mail adresinizi doğrulamanız gerekiyor...";
		$user->tf = true;
		echo(json_encode($user));
	}
?>

