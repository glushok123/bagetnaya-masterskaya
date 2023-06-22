<?
if ( $_SERVER["REMOTE_ADDR"]=='' || $_SERVER["REMOTE_ADDR"]=='' || $_SERVER["REMOTE_ADDR"]=='127.0.0.1' ) {
 	if (isset($_COOKIE['Skid'])) {$skidka=$_COOKIE['Skid'];}
 	else {$skidka=0;}
	$ident=$_GET['id'];
	if (preg_match("/^[\dl]+$/",(string) $ident)) {	$z=explode('l',(string) $ident);}
	else {
		$fp = fopen('lo/g.txt', 'a');
		$towrite=date("j.m.Y G:i").' ! '.$_SERVER["REMOTE_ADDR"].' ! '.$ident.' ! zakaz_chekout bad id';
		fwrite($fp, $towrite);
		fwrite($fp, "\r\n");
		fclose($fp);
		exit ('<META HTTP-EQUIV=Refresh Content="0;URL=/baget_online">');
	}

	$chekoutnum=(is_countable(scandir('bgchkout')) ? count(scandir('bgchkout')) : 0)+100;
	copy('bagechek/'.$z[16], 'bgchkout/'.time());



		$data=date ("j");
		if (date("n")==1) {$data=$data." января ";}
			elseif (date("n")==2) {$data=$data." февраля ";}
				elseif (date("n")==3) {$data=$data." марта ";}
					elseif (date("n")==4) {$data=$data." апреля ";}
						elseif (date("n")==5) {$data=$data." мая ";}
							elseif (date("n")==6) {$data=$data." июня ";}
								elseif (date("n")==7) {$data=$data." июля ";}
									elseif (date("n")==8) {$data=$data." августа ";}
										elseif (date("n")==9) {$data=$data." сентября ";}
											elseif (date("n")==10) {$data=$data." октября ";}
												elseif (date("n")==11) {$data=$data." ноября ";}
													else {$data=$data." декабря ";}
		$data=$data.date("o").' г.';
		echo '
				<body style="color:#000; font:normal 17px/22px Tahoma;" onload="window.print();" onclick="window.close();">
				<div style="position:absolute; top:100px;  ">
				<div style="width:800px; height:30px; text-align:right;">'.$data.'</div>
				<div style="width:800px; height:60px; text-align:center;">Товарный чек №'.$chekoutnum.'<br>За наличный расчет</div>

					<table cellpadding="5" cellspacing="0" border="1" bordercolor="#444" style="width:800px; color:#000; font:normal 17px/20px Tahoma;">
						<tr style="font-weight:700;"><td>Наименование товара</td><td>Кол-во</td><td>Цена</td><td>Стоимость</td></tr>';

		$finalprice=0;
		$chekcont=file('bagechek/'.$z[16]);
		for ($jj = 0; $jj < (is_countable($chekcont) ? count($chekcont) : 0); $jj++)  {
			$ident=rtrim($chekcont[$jj]);
			$z=explode('l',$ident);
			$price1=$price2=$price3=$price4=$price6=0;
			if ($z[17]==0)
				{

				$s=($z[9]+$z[5]+$z[5])*($z[10]+$z[5]+$z[5])/1_000_000;
				$p=($z[9]+$z[10])/500;
				$pout=($z[9]+$z[2]+$z[2]+$z[5]+$z[5]+$z[10]+$z[2]+$z[2]+$z[5]+$z[5])/500;
				$price1=floor($pout*$z[1]);
				echo '<tr><td>Багет, арт: '.$z[0].'</td><td>'.$pout.' м</td><td>'.$z[1].'</td><td>'.$price1.'р.</td></tr>';
				if ($z[3]) {
					$price2=floor($s*$z[4]);
                    if ($price2<450) {
                    	$price2=450;
                    	echo '<tr><td>Паспарту, арт: '.$z[3].'</td><td></td><td></td><td>'.$price2.'р.</td></tr>';
                    }
                    else {
						echo '<tr><td>Паспарту, арт: '.$z[3].'</td><td>'.round($s,3).' м<sup>2</sup></td><td>'.$z[4].'</td><td>'.$price2.'р.</td></tr>';
					}
				}
				if ($z[6] == 1) {$price3=floor($s*540); echo '<tr><td>Обычное стекло</td><td>'.round($s,3).' м<sup>2</sup></td><td>540р.</td><td>'.$price3.'р.</td></tr>';}
				if ($z[6] == 2) {$price3=floor($s*1080); echo '<tr><td>Матовое стекло</td><td>'.round($s,3).' м<sup>2</sup></td><td>1080р.</td><td>'.$price3.'р.</td></tr>';}
				if ($z[6] == 3) {$price3=floor($s*10400); echo '<tr><td>Стекло Антиблик</td><td>'.round($s,3).' м<sup>2</sup></td><td>10400р.</td><td>'.$price3.'р.</td></tr>';}
				if ($z[6] == 4) {$price3=floor($s*1040); echo '<tr><td>Пластиковое стекло</td><td>'.round($s,3).' м<sup>2</sup></td><td>1040р.</td><td>'.$price3.'р.</td></tr>';}
				if ($z[7] == 1) {$price4=floor($s*310); echo '<tr><td>Картон</td><td>'.round($s,3).' м<sup>2</sup></td><td>274р.</td><td>'.$price4.'р.</td></tr>';}
				if ($z[7] == 2) {$price4=floor($s*1600); echo '<tr><td>Пенокартон 5мм</td><td>'.round($s,3).' м<sup>2</sup></td><td>1600р.</td><td>'.$price4.'р.</td></tr>';}
				if ($z[7] == 3) {$price4=floor($s*2000); echo '<tr><td>Пенокартон 10мм</td><td>'.round($s,3).' м<sup>2</sup></td><td>2000р.</td><td>'.$price4.'р.</td></tr>';}
				if ($z[7] == 4) {$price4=floor($p*400); echo '<tr><td>Подрамник</td><td>'.$p.' м</td><td>400р.</td><td>'.$price4.'р.</td></tr>';}
				$price=$price1+$price2+$price3+$price4;
				if ($price<2280) {$price6=570;} else {$price6=floor($price*0.25);}
				echo '<tr><td>Работа по сборке</td><td>1</td><td>'.$price6.'р.</td><td>'.$price6.'р.</td></tr>';
				$finalprice=$finalprice+$price+$price6;
				}
			else
				{
				$s=($z[9])*($z[10])/1_000_000;
                $peri=($z[9]+$z[10])/500;
                if ($z[9]>=1000 || $z[10]>=1000)
                {
                    if ($z[9]>$z[10])
                    {
                        $lmax=floor($z[9]/10);
                    }
                    else
                    {
                        $lmax=floor($z[10]/10);
                    }
                }
                else
                {
                    if ($z[9]<$z[10])
                    {
                        $lmax=floor($z[9]/10);
                    }
                    else
                    {
                        $lmax=floor($z[10]/10);
                    }
                }
				if ($z[17] == 1) {echo '<tr><td>Накатка на пенокартон 5мм</td><td>'.round($s,3).' м<sup>2</sup></td><td>1600р.</td><td>'.$z[13].'р.</td></tr>';}
				if ($z[17] == 11) {echo '<tr><td>Накатка на пенокартон 10мм</td><td>'.round($s,3).' м<sup>2</sup></td><td>2000р.</td><td>'.$z[13].'р.</td></tr>';}
				if ($z[17] == 2) {echo '<tr><td>Натяжка на подрамник</td><td>'.$peri.' м</td><td>400р.</td><td>'.$z[13].'р.</td></tr>';}
				if ($z[17] == 3) {echo '<tr><td>Печать на холсте</td><td>'.round($s,3).' м<sup>2</sup></td><td>3600р.</td><td>'.$z[13].'р.</td></tr>';}
				if ($z[17] == 4) {echo '<tr><td>Печать на матовой бумаге</td><td>'.$lmax.' пог. см</td><td>8р.</td><td>'.$z[13].'р.</td></tr>';}
				if ($z[17] == 5) {echo '<tr><td>Печать на глянце бумаге</td><td>'.$lmax.' пог. см</td><td>13р.</td><td>'.$z[13].'р.</td></tr>';}
				if ($z[17] == 6) {echo '<tr><td>Покрытие лаком</td><td>'.round($s,3).' м<sup>2</sup></td><td>9р.</td><td>'.$z[13].'р.</td></tr>';}
				if ($z[17] == 7) {
                    if ($z[18]==0) {
                        echo '<tr><td>Доставка по Москве</td><td>1</td><td>600р.</td><td>'.$z[13].'р.</td></tr>';
                    }
                    else
                    {
                        echo '<tr><td>Доставка '.$z[18].'км. от МКАД</td><td>1</td><td>'.$z[13].'р.</td><td>'.$z[13].'р.</td></tr>';
                    }
                }
                if ($z[17] > 800) {
                	$zs=$z[17];
                	echo '<tr><td>';
                	if ($zs[0]==8) {echo 'Обычное зеркало, ';}else{echo 'Зеркало Clear Vision, ';}
					if ($zs[1]==1) {echo '4мм';}else{echo '6мм';}
					if ($zs[2]==0) {echo ', без фацета';}
					else if ($zs[2]==1) {echo ', фацет 10мм';}
					else if ($zs[2]==2) {echo ', фацет 20мм';}
					else if ($zs[2]==3) {echo ', фацет 30мм';}
					else if ($zs[2]==4) {echo ', фацет 40мм';}
					$sprice=floor($z[13]/$s);
					echo '</td><td>'.$s.' м<sup>2</sup></td><td>'.$sprice.'</td><td>'.$z[13].'р.</td></tr>';
                }
				$finalprice=$finalprice+$z[13];


				}
		}
		if ($skidka>0) {
			$skidka1=floor($finalprice*$skidka/100);
			echo '<tr><td colspan="3">Скидка ('.$skidka.'%):</td><td>-'.$skidka1.'р.</td></tr>';
			$finalprice-=$skidka1;
		}
		echo '<tr><td colspan="3">Итого:</td><td>'.$finalprice.'р.</td></tr>';
		echo '		</table>
				<div style="width:800px; margin-top:30px; height:30px; text-align:left;">Итого <span style="text-decoration:underline;">'.$finalprice.' руб. 00 коп.</span> ('.num2str($finalprice).')</div>

				<div style="width:800px; margin-top:30px; height:60px; text-align:left;">___________________<br>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp(подпись)</div>
				</div>';



	echo "</body>";
}
else {
	exit ('<body style="color:#000; font:normal 17px/22px Tahoma;" onload="window.close();"> ');
}

	function num2str($num) {
		$nul='ноль';
		$ten=[['', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'], ['', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять']];
		$a20=['десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать'];
		$tens=[2=>'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто'];
		$hundred=['', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот'];
		$unit=[
      // Units
      ['копейка', 'копейки', 'копеек', 1],
      ['рубль', 'рубля', 'рублей', 0],
      ['тысяча', 'тысячи', 'тысяч', 1],
      ['миллион', 'миллиона', 'миллионов', 0],
      ['миллиард', 'милиарда', 'миллиардов', 0],
  ];
		//
		[$rub, $kop] = explode('.',sprintf("%015.2f", floatval($num)));
		$kop='ноль';
		$out = [];
		if (intval($rub)>0) {
			foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
				if (!intval($v)) continue;
				$uk = sizeof($unit)-$uk-1; // unit key
				$gender = $unit[$uk][3];
				[$i1, $i2, $i3] = array_map('intval',str_split($v,1));
				// mega-logic
				$out[] = $hundred[$i1]; # 1xx-9xx
				if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
				else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
				// units without rub & kop
				if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
			} //foreach
		}
		else $out[] = $nul;
		$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
		$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
		return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
	}

	/**
	 * Склоняем словоформу
	 * @ author runcore
	 */
	function morph($n, $f1, $f2, $f5) {
		$n = abs(intval($n)) % 100;
		if ($n>10 && $n<20) return $f5;
		$n = $n % 10;
		if ($n>1 && $n<5) return $f2;
		if ($n==1) return $f1;
		return $f5;
	}
