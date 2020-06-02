<?php 
error_reporting(0);
include 'function.php';;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<title>resimcek</title>
</head>
<body>

<section align="center">

<form style="margin: 0 auto; width:400px;" action="index.php" method="post" class="">
<select class="form-control" name="social">
	<option value="default">Seç..</option>	
	<option value="instagram">İnstagram</option>
	<option value="youtube">Youtube</option>
<!-- 	<option value="twitter">Twitter</option> -->
	<option value="facebook">Facebook</option>
	<option value="tiktok">Tiktok</option>	
</select>	
<input type="text" class="form-control" name="urlgir" placeholder="link gir">
<input type="submit" class="form-control btn btn-primary" name="buton" value="Görüntüle">
<input type="submit" class="form-control btn btn-danger" name="reset" value="Reset">
</form>


<?php 
$social=$_POST['social'];

if (isset($_POST['social'])) {

	if ($_POST['urlgir'] !== '') {

//İNSTAGRAM BAŞLANGIÇ-------------------------------------------------------------------------------------------------
		if ($social==='instagram') {
		
				if ($_POST['buton']) {


					echo "<br>";
					

					$link = $_POST['urlgir'];

					$icerik = file_get_contents($link);

					$instaresim = ara('content="','"',$icerik);

					// echo "<pre>";
					// echo print_r($resim);
					// echo "</pre>";

					if ($instaresim[9] == null) {
						echo "Link geçersiz";
					} else {

					echo '<img class="img-fluid" width="400" height="50%" src="'.$instaresim[9].'">';
					
					}

				} else {

					echo "Kutucuğa link gir";
					
				}

				if ($_POST['reset']) {
					reset();		
				}
//İNSTAGRAM BİTİŞ-----------------------------------------------------------------------------------------------------	

//YOUTUBE BAŞLANGIÇ---------------------------------------------------------------------------------------------------
		} elseif ($social ==='youtube') {
			
			echo "<br>";

			$link = $_POST['urlgir'];
			$icerik = file_get_contents($link);

			$youtubevideo = ara('content="','"',$icerik);

			// echo "<pre>";
			// echo print_r($video);
			// echo "</pre>";

			echo '<iframe width="400" height="467" src="'.$youtubevideo[19].'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

//YOUTUBE BİTİŞ-------------------------------------------------------------------------------------------------------

//TWİTTER BAŞLANGIÇ---------------------------------------------------------------------------------------------------
		// } elseif ($social ==='twitter') {
		// 	echo "twitter";
//TWİTTER BİTİŞ-------------------------------------------------------------------------------------------------------

//FACEBOOK BAŞLANGIÇ (SİTEYE ULAŞAMAYINCA CURL İLE YAPMAK ZORUDA KALDIM function.php'den bağımsız olarak gör bu kısmı)
		} elseif ($social ==='facebook') {

			echo "<br>";
			
			function Baglan($url){

				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
				$cikti = curl_exec($curl);
				curl_close($curl);
				return str_replace(array("\n" ,"\t" ,"\r"), null, $cikti);
			}


		$Baglan = Baglan($_POST['urlgir']);

		preg_match_all('@data-plsi="(.*?)"@si', $Baglan, $facebookresim);


		echo '<img class="img-fluid" width="400" height="50%" src="'.$facebookresim[1][0].'">';

//FACEBOOK BİTİŞ------------------------------------------------------------------------------------------------------

//TİKTOK BAŞLANGIÇ (SİTEYE ULAŞAMAYINCA CURL İLE YAPMAK ZORUDA KALDIM function.php'den bağımsız olarak gör bu kısmı)--
		} elseif ($social ==='tiktok') {

			echo "<br>";

			function Baglan($url){

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
		$cikti = curl_exec($curl);
		curl_close($curl);
		return str_replace(array("\n" ,"\t" ,"\r"), null, $cikti);
		}


		$Baglan = Baglan($_POST['urlgir']);

		preg_match_all('@"contentUrl":"(.*?)"@si', $Baglan, $tiktokvideo);



		echo '<iframe width=400 height="467" src="'.substr($tiktokvideo[0][1], 14,-1).'" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
					
//TİKTOK BİTİŞ--------------------------------------------------------------------------------------------------------
		} elseif ($social ==='default') {

			echo "sosyal medya seç";

		} else {

			echo "Hadi başla";
		}


	} else {

		echo "Bir link gir";
	}

} else {
	echo "Bir Link gir";
}

 ?>


	<div style="margin-top: 5px;">

		<h5> Facebook (birçok sayfanın ve profilin resmi çekilmiyor) </h5>
		<p>deneme : https://www.facebook.com/ronaldinho/photos/pb.142523572511686.-2207520000../2767690529994964/?type=3&theater</p>

		<h5> Tiktok </h5>
		<p>deneme : https://www.tiktok.com/@cznburak/video/6805488003562147077?lang=tr</p>

		<h5> Youtube </h5>
		<p>deneme : https://www.youtube.com/watch?v=rThjDgw-sBM</p>

		<br>
		<h5> Instagram </h5>
		<p>deneme : https://www.instagram.com/p/CAtGPEPnlK2/</p>

	 </div>

 </section>

</body>
</html>
