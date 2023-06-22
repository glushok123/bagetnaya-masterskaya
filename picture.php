<?	
	if ($align=="right") {$align="left";}
	else {$align="right";}
	$file = $_SERVER['REQUEST_URI']; 
	$imgcat='bagetnaya_masterskaya';
	$altitle='Багетная мастерская №1, примеры работ';
	if (strripos((string) $file, 'bagetnye_ramki/')) {$imgcat='bagetnye_ramki';$altitle='Багетные рамки';} 
	else if (strripos((string) $file, 'bagety_dlya_kartin/')) {$imgcat='bagety_dlya_kartin';$altitle='Багеты для картин';} 
	else if (strripos((string) $file, 'ramki_dlya_ikon/')) {$imgcat='ramki_dlya_ikon';$altitle='Рамки для икон, примеры работ';} 
	else if (strripos((string) $file, 'ramki_dlya_kartin/')) {$imgcat='ramki_dlya_kartin';$altitle='Рамки для картин';}
	else if (strripos((string) $file, 'ramki_dlya_vyshivki/')) {$imgcat='ramki_dlya_vyshivki';$altitle='Рамки для вышивки';} 
	if (($imgcat!='none')) {
		$p_files=scandir('gallemax/'.$imgcat);
		$rand = $p_files[random_int(2,(is_countable($p_files) ? count($p_files) : 0)-1)];
		echo '<img src="/gallemax/'.$imgcat.'/'.$rand.'" alt="'.$altitle.'" title="'.$altitle.'" align="'.$align.'">';
	}
