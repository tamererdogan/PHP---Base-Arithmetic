<!DOCTYPE html>
<html>
<head>
	<title>Taban Aritmetiği</title>
	<meta charset="utf-8">
</head>
<body>

	<!-- HTML Form Kısmı -->
	<form action="" method="post">
		Sayi: <input type="text" name="sayi"> 
		Taban:
		<select name="taban">
			<?php 
				for ($i=2; $i <= 16 ; $i++)
				{ 
					echo '<option value="'. $i .'"> '. $i .'</option>';
				}
			?>
		</select>
		D.Taban: 
		<select name="dtaban">
			<?php 
				for ($i=2; $i <= 16 ; $i++)
				{ 
					echo '<option value="'. $i .'"> '. $i .'</option>';
				}
			?>
		</select>

		<input type="submit" name="gonder">	
	</form>
	

	<?php 

		//Sayfa post edilmişse
		if($_POST)
		{
			//Post'la gelen verileri al
			$sayi = $_POST['sayi'];
			$taban = (int)$_POST['taban'];
			$dtaban = (int)$_POST['dtaban'];

			$sayiUzunluk = strlen($sayi);
			$kuvvet = 0;
			$onlukSayi = 0;

			//Onluk tabana dönüştürme
			for ($i = $sayiUzunluk-1; $i >= 0; $i--)
			{ 
				$bit = (int)$sayi[$i];

				//Eğer girilen taban 10 ve 10'dan büyük ise (yani içerisinde harf barındırıyorsa)
				if($taban >= 10)
				{
					//Harfin karşılığı olan sayıyı $bit değişkenine ata
					switch ($sayi[$i])
					{
						case 'a':
						case 'A':
							$bit = 10;
							break;
						case 'b':
						case 'B':
							$bit = 11;
							break;
						case 'c':
						case 'C':
							$bit = 12;
							break;
						case 'd':
						case 'D':
							$bit = 13;
							break;
						case 'e':
						case 'E':
							$bit = 14;
							break;
						case 'f':
						case 'F':
							$bit = 15;
							break;
						default:
							break;
					}
				}

				// ÖR: $onlukSayi += 2*5^3 işlemi ile sayıyı ondalık tabana çeviriyoruz
				$onlukSayi += ($bit * pow($taban,$kuvvet));
				$kuvvet++;
			}

			echo $taban . " Tabanındaki Sayı: " . $sayi . "<br>";
			echo "10 Tabanındaki Karşılığı: " . $onlukSayi . "<br>";

			$bolunen = $onlukSayi;
			$bolen 	 = $dtaban;
			$dSayi = '';

			//İstenen tabana dönüştürme
			while ($bolunen != 0)
			{
				// ÖR: 15/2 işleminde Kalan:1 Bölüm:7'dir
				//Programda yazarken 15/2'den bölüm 7.5'tir
				//Bölümün ondalık kısmını bölen ile çarpar ise kalanı buluruz
				//Kalan: 0.5*2 = 1
				//Bölüm ise tam kısım olarak kalır
				//Bölüm: 7
				
				$bolum = $bolunen/$bolen;
				$kalan = ( $bolum - floor($bolum) ) * $bolen;
				$bolunen = floor($bolum);

				// TEST
				// echo "Bölüm: " . $bolunen . "/" . $bolen . " = " . $bolum . "<br>" ;
				// echo "Kalan: (" . $bolum . " - " . floor($bolum) . " ) * " . $bolen . " = " . $kalan . "<br>" ;
				// echo "Bölünen: " . $bolunen . "<br><br>";

				//Kalan değerinin 4.999999997 veya 3.000000012 gibi bir değerde kalmasına
				//karşın yuvarlama işlemi yapıyoruz 
				$tmp = round($kalan);

				//Eğer dönüştürülecek taban 10 ve 10'dan büyük ise (yani yazdıracağımız yeni sayı harf barındırıyorsa)
				if($dtaban >= 10)
				{
					//Sayının karşılığı olan harfi $tmp değişkenine ata
					switch ($kalan)
					{
						case 10:
							$tmp = 'A';
							break;
						case 11:
							$tmp = 'B';
							break;
						case 12:
							$tmp = 'C';
							break;
						case 13:
							$tmp = 'D';
							break;
						case 14:
							$tmp = 'E';
							break;
						case 15:
							$tmp = 'F';
							break;
						default:
							break;
					}
				}

				//$tmp'deki kalan değerini asıl sayımıza ekliyoruz
				$dSayi .= $tmp;
			}

			//Bölmeden kalanları sondan başa doğru yanyana yazmamız gerekiyor
			//fakat biz kalanları baştan sona yanyana yazdığımız için $dSayi değişkenini ters çeviriyoruz.
			$dSayi = strrev($dSayi);
			echo $dtaban . " Tabanındaki Karşılığı: " . $dSayi . "<br>";
		}
	?>
</body>
</html>