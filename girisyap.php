<?php

	include("ayar.php");

	$mailA = isset($_POST['mailadres']) ?  $_POST['mailadres'] : ''; 
	$sifre = isset($_POST['sifre']) ?  $_POST['sifre'] : ''; 

	$control = mysqli_query($baglan,"select * from veteriner_kullanicilar where mailAdres = '$mailA' or parola = '$sifre'");
	$count = mysqli_num_rows($control);

	class UserLogin
	{
		public $id;
		public $username;
		public $mailadres;
		public $parola;
		public $tf;
		public $text;
	}

	$user = new UserLogin();

	if($count > 0)
	{
		$parse = mysqli_fetch_assoc($control);
		$durum =$parse["durum"];
		$id = $parse["id"];;
		$username = $parse["kadi"];
		$mailadres = $parse["mailAdres"];
		$parola = $parse["parola"];

		if($durum == 1)
		{
			$user->tf = true;
			$user->text = "Sisteme giriş başarılı....";
			$user->id =$id ;
			$user->username = $username;
			$user->mailadres = $mailadres;
			$user->parola = $parola;

			echo(json_encode($user));
		}
		else 
		{
			$user->tf = false;
			$user->text = "Sisteme giriş yapabilmeniz için, mail adresinizi onaylamanız gerekmektedir...";
			$user->id =null;
			$user->username =null;
			$user->mailadres =null;
			$user->parola =null;

			echo(json_encode($user));
		}
	}
	else
	{
		$user->tf = false;
		$user->text = "Sistemde girmiş olduğunuz bilgilere göre kullanıcı bulunmamaktadır...";
		$user->id =null;
		$user->username =null;
		$user->mailadres =null;
		$user->parola =null;

		echo(json_encode($user));
	}


?>