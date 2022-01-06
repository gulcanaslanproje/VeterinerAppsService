<?php
	include("ayar.php");

	$mail = $_GET["mail"];// isset($_POST['mail']) ? $_POST['mail'] : ''; //$_GET["mailAdres"];//"gulcanaslan.1996@gmail.com";
	$kod =$_GET["kodu"];// isset($_POST['kodu']) ?  $_POST['kodu'] : '';

	$guncelle = mysqli_query($baglan,"update veteriner_kullanicilar set durum = '1' where mailAdres = '$mail' and dogrulamaKodu = '$kod' ");

	if($guncelle)
	{
		?>
		<h1> Tebrikler Hesabınız Doğrulandı... </h1>
		<?php
	}
?>