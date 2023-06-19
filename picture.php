<?	
	if ($align=="right") {$align="left";}
	else {$align="right";}
	$file = $_SERVER['REQUEST_URI']; 
	$imgcat='bagetnaya_masterskaya';
	$altitle='Багетная мастерская №1, примеры работ';
	if (strripos($file, 'bagetnye_ramki/')) {$imgcat='bagetnye_ramki';$altitle='Багетные рамки';} 
	else if (strripos($file, 'bagety_dlya_kartin/')) {$imgcat='bagety_dlya_kartin';$altitle='Багеты для картин';} 
	else if (strripos($file, 'modulnye_kartiny/')) {$imgcat='modulnye_kartiny';$altitle='Модульные картины, примеры работ';} 
	else if (strripos($file, 'ramki_dlya_ikon/')) {$imgcat='ramki_dlya_ikon';$altitle='Рамки для икон, примеры работ';} 
	else if (strripos($file, 'ramki_dlya_kartin/')) {$imgcat='ramki_dlya_kartin';$altitle='Рамки для картин';}
	else if (strripos($file, 'ramki_dlya_vyshivki/')) {$imgcat='ramki_dlya_vyshivki';$altitle='Рамки для вышивки';} 
	if (($imgcat!='none')) {
		$p_files=scandir('gallemax/'.$imgcat);
		$rand = $p_files[rand(2,count($p_files)-1)];
		echo '<img src="/gallemax/'.$imgcat.'/'.$rand.'" alt="'.$altitle.'" title="'.$altitle.'" align="'.$align.'">';
	}
