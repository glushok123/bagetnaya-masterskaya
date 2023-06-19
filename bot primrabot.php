<?
echo "</div>";
$file = $_SERVER['REQUEST_URI'];
$imgcat = 'bagetnaya-masterskaya';
$menu1 = '';
$menu11 = '';
$menu111 = '';
$menu2 = '';
$menu22 = '';
if (strripos($file, 'kontakty.html')) {
	$imgcat = 'none';
}

if (strripos($file, 'pechat_na_holste/')) {
	$menu1 .= '<a href="/pechat_na_holste/" class="lm mark"> Печать на холсте</a> ';

	if (strripos($file, 'pechat_na_holste_cena')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_cena.html" class="sublm mark" > Цена печати на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_cena.html" class="sublm unmark" > Цена печати на холсте</a> ';
	}

	if (strripos($file, 'pechat_foto_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_foto_na_holste.html" class="sublm mark" > Печать фото на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_foto_na_holste.html" class="sublm unmark" > Печать фото на холсте</a> ';
	}

	if (strripos($file, 'pechat_kartin_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_kartin_na_holste.html" class="sublm mark" > Печать картин на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_kartin_na_holste.html" class="sublm unmark" > Печать картин на холсте</a> ';
	}

	if (strripos($file, 'shirokoformatnaya_pechat_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/shirokoformatnaya_pechat_na_holste.html" class="sublm mark" > Широкоформатная печать на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/shirokoformatnaya_pechat_na_holste.html" class="sublm unmark" > Широкоформатная печать на холсте</a> ';
	}

	if (strripos($file, 'pechat_reprodukciy_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_reprodukciy_na_holste.html" class="sublm mark" > Печать репродукций на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_reprodukciy_na_holste.html" class="sublm unmark" > Печать репродукций на холсте</a> ';
	}

	if (strripos($file, 'interyernaya_pechat_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/interyernaya_pechat_na_holste.html" class="sublm mark" > Интерьерная печать на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/interyernaya_pechat_na_holste.html" class="sublm unmark" > Интерьерная печать на холсте</a> ';
	}


	if (strripos($file, 'pechat_posterov_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_posterov_na_holste.html" class="sublm mark" > Печать постеров на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_posterov_na_holste.html" class="sublm unmark" > Печать постеров на холсте</a> ';
	}

	if (strripos($file, 'pechat_ikon_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_ikon_na_holste.html" class="sublm mark" > Печать икон на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_ikon_na_holste.html" class="sublm unmark" > Печать икон на холсте</a> ';
	}

	if (strripos($file, 'pechat_portreta_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_portreta_na_holste.html" class="sublm mark" > Печать портрета на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_portreta_na_holste.html" class="sublm unmark" > Печать портрета на холсте</a> ';
	}

	if (strripos($file, 'pechat_izobrazheniy_na_holste')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_izobrazheniy_na_holste.html" class="sublm mark" > Печать изображений на холсте</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_izobrazheniy_na_holste.html" class="sublm unmark" > Печать изображений на холсте</a> ';
	}

	if (strripos($file, 'pechat_na_holste_s_podramnikom')) {
		$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_s_podramnikom.html" class="sublm mark" > Печать на холсте с подрамником</a> ';
	} else {
		$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_s_podramnikom.html" class="sublm unmark" > Печать на холсте с подрамником</a> ';
	}
} else {
	$menu1 .= '<a href="/pechat_na_holste/" class="lm unmark"> Печать на холсте</a> ';
}


if (strripos($file, 'bagetnye_raboty/')) {
	$menu1 .= '<a href="/bagetnye_raboty/" class="lm mark"> Багетные работы</a> ';

	if (strripos($file, 'izgotovlenie_bageta/')) {
		$menu11 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/" class="sublm mark" > Изготовление багета</a> ';

		if (strripos($file, 'izgotovlenie_bagetov_dlya_kartin')) {
			$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_bagetov_dlya_kartin.html" class="ssublm mark" > Изготовление багетов для картин</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_bagetov_dlya_kartin.html" class="ssublm unmark" > Изготовление багетов для картин</a> ';
		}
		if (strripos($file, 'izgotovlenie_zerkal_v_bagete')) {
			$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_zerkal_v_bagete.html" class="ssublm mark" > Изготовление зеркал в багете</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_zerkal_v_bagete.html" class="ssublm unmark" > Изготовление зеркал в багете</a> ';
		}
		if (strripos($file, 'izgotovlenie_ramki_iz_bageta')) {
			$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_ramki_iz_bageta.html" class="ssublm mark" > Изготовление рамки из багета</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_ramki_iz_bageta.html" class="ssublm unmark" > Изготовление рамки из багета</a> ';
		}
	} else {
		$menu11 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/" class="sublm unmark" > Изготовление багета</a> ';
	}

	if (strripos($file, 'oformlenie_v_baget/')) {
		$menu11 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/" class="sublm mark" > Оформление в багет</a> ';

		if (strripos($file, 'oformlenie_vyshivki_v_baget')) {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_vyshivki_v_baget.html" class="ssublm mark" > Оформление вышивки в багет</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_vyshivki_v_baget.html" class="ssublm unmark" > Оформление вышивки в багет</a> ';
		}

		if (strripos($file, 'oformlenie_kartin_v_baget')) {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_kartin_v_baget.html" class="ssublm mark" > Оформление картин в багет</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_kartin_v_baget.html" class="ssublm unmark" > Оформление картин в багет</a> ';
		}

		if (strripos($file, 'oformlenie_fotografiy_v_baget')) {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_fotografiy_v_baget.html" class="ssublm mark" > Оформление фотографий в багет</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_fotografiy_v_baget.html" class="ssublm unmark" > Оформление фотографий в багет</a> ';
		}

		if (strripos($file, 'oformlenie_zerkal_v_baget')) {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_zerkal_v_baget.html" class="ssublm mark" > Оформление зеркал в багет</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_zerkal_v_baget.html" class="ssublm unmark" > Оформление зеркал в багет</a> ';
		}

		if (strripos($file, 'oformlenie_ikon_v_baget')) {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_ikon_v_baget.html" class="ssublm mark" > Оформление икон в багет</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_ikon_v_baget.html" class="ssublm unmark" > Оформление икон в багет</a> ';
		}

		if (strripos($file, 'oformlenie_papirusa_v_baget')) {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_papirusa_v_baget.html" class="ssublm mark" > Оформление папируса в багет</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_papirusa_v_baget.html" class="ssublm unmark" > Оформление папируса в багет</a> ';
		}
	} else {
		$menu11 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/" class="sublm unmark" > Оформление в багет</a> ';
	}

	if (strripos($file, 'obramlenie/')) {
		$menu11 .= '<a href="/bagetnye_raboty/obramlenie/" class="sublm mark" > Обрамление</a> ';

		if (strripos($file, 'obramlenie_dlya_foto')) {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_dlya_foto.html" class="ssublm mark" > Обрамление для фото</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_dlya_foto.html" class="ssublm unmark" > Обрамление для фото</a> ';
		}
		if (strripos($file, 'obramlenie_zerkal')) {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_zerkal.html" class="ssublm mark" > Обрамление зеркал</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_zerkal.html" class="ssublm unmark" > Обрамление зеркал</a> ';
		}
		if (strripos($file, 'obramlenie_kartiny')) {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartiny.html" class="ssublm mark" > Обрамление картины</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartiny.html" class="ssublm unmark" > Обрамление картины</a> ';
		}
		if (strripos($file, 'obramlenie_fotografiy')) {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_fotografiy.html" class="ssublm mark" > Обрамление фотографий</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_fotografiy.html" class="ssublm unmark" > Обрамление фотографий</a> ';
		}
		if (strripos($file, 'obramlenie_risunka')) {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_risunka.html" class="ssublm mark" > Обрамление рисунка</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_risunka.html" class="ssublm unmark" > Обрамление рисунка</a> ';
		}
		if (strripos($file, 'obramlenie_kartinki')) {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartinki.html" class="ssublm mark" > Обрамление картинки</a> ';
		} else {
			$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartinki.html" class="ssublm unmark" > Обрамление картинки</a> ';
		}
	} else {
		$menu11 .= '<a href="/bagetnye_raboty/obramlenie/" class="sublm unmark" > Обрамление</a> ';
	}
} else {
	$menu1 .= '<a href="/bagetnye_raboty/" class="lm unmark"> Багетные работы</a> ';
}


if (strripos($file, 'natyazhka_holsta/')) {
	$menu1 .= '<a href="/natyazhka_holsta/" class="lm mark"> Натяжка холста</a> ';
	if (strripos($file, 'natyazhka_na_podramnik')) {
		$menu11 .= '<a href="/natyazhka_holsta/natyazhka_na_podramnik.html" class="sublm mark"> Натяжка на подрамник</a> ';
	} else {
		$menu11 .= '<a href="/natyazhka_holsta/natyazhka_na_podramnik.html" class="sublm unmark"> Натяжка на подрамник</a> ';
	}

	if (strripos($file, 'holst_na_podramnike')) {
		$menu11 .= '<a href="/natyazhka_holsta/holst_na_podramnike.html" class="sublm mark"> Холст на подрамнике</a> ';
	} else {
		$menu11 .= '<a href="/natyazhka_holsta/holst_na_podramnike.html" class="sublm unmark"> Холст на подрамнике</a> ';
	}

	if (strripos($file, 'natyazhka_kartiny_na_podramnik')) {
		$menu11 .= '<a href="/natyazhka_holsta/natyazhka_kartiny_na_podramnik.html" class="sublm mark"> Натяжка картины на подрамник</a> ';
	} else {
		$menu11 .= '<a href="/natyazhka_holsta/natyazhka_kartiny_na_podramnik.html" class="sublm unmark"> Натяжка картины на подрамник</a> ';
	}
} else {
	$menu1 .= '<a href="/natyazhka_holsta/" class="lm unmark"> Натяжка холста</a> ';
}


if (strripos($file, 'nakatka_na_penokarton/')) {
	$menu1 .= '<a href="/nakatka_na_penokarton/" class="lm mark"> Накатка на пенокартон</a> ';

	if (strripos($file, 'nakatka_izobrazheniy')) {
		$menu11 .= '<a href="/nakatka_na_penokarton/nakatka_izobrazheniy.html" class="sublm mark" > Накатка изображений</a> ';
	} else {
		$menu11 .= '<a href="/nakatka_na_penokarton/nakatka_izobrazheniy.html" class="sublm unmark" > Накатка изображений</a> ';
	}

	if (strripos($file, 'nakatka_fotografiy')) {
		$menu11 .= '<a href="/nakatka_na_penokarton/nakatka_fotografiy.html" class="sublm mark" > Накатка фотографий</a> ';
	} else {
		$menu11 .= '<a href="/nakatka_na_penokarton/nakatka_fotografiy.html" class="sublm unmark" > Накатка фотографий</a> ';
	}

	if (strripos($file, 'pechat_na_penokartone')) {
		$menu11 .= '<a href="/nakatka_na_penokarton/pechat_na_penokartone.html" class="sublm mark" > Печать на пенокартоне</a> ';
	} else {
		$menu11 .= '<a href="/nakatka_na_penokarton/pechat_na_penokartone.html" class="sublm unmark" > Печать на пенокартоне</a> ';
	}
} else {
	$menu1 .= '<a href="/nakatka_na_penokarton/" class="lm unmark"> Накатка на пенокартон</a> ';
}

if (strripos($file, 'modulnye_kartiny/')) {
	$imgcat = 'modulnye-kartiny';
	$menu1 .= '<a href="/modulnye_kartiny/" class="lm mark"> Модульные картины</a>';

	if (strripos($file, 'katalog_modulnyh_kartin')) {
		$menu11 .= '<a href="/modulnye_kartiny/katalog_modulnyh_kartin/" class="sublm mark" > Каталог модульных картин</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/katalog_modulnyh_kartin/" class="sublm unmark" > Каталог модульных картин</a> ';
	}

	if (strripos($file, 'triptih')) {
		$menu11 .= '<a href="/modulnye_kartiny/triptih_kartiny.html" class="sublm mark" > Триптих картины</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/triptih_kartiny.html" class="sublm unmark" > Триптих картины</a> ';
	}
	if (strripos($file, 'diptih')) {
		$menu11 .= '<a href="/modulnye_kartiny/diptih_kartiny.html" class="sublm mark" > Диптих картины</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/diptih_kartiny.html" class="sublm unmark" > Диптих картины</a> ';
	}
	if (strripos($file, 'poliptih')) {
		$menu11 .= '<a href="/modulnye_kartiny/poliptih_kartiny.html" class="sublm mark" > Полиптих картины</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/poliptih_kartiny.html" class="sublm unmark" > Полиптих картины</a> ';
	}
	if (strripos($file, 'modulnye_kartiny_v_moskve')) {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_v_moskve.html" class="sublm mark" > Модульные картины в Москве</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_v_moskve.html" class="sublm unmark" > Модульные картины в Москве</a> ';
	}
	if (strripos($file, 'modulnye_kartiny_nedorogo')) {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_nedorogo.html" class="sublm mark" > Модульные картины недорого</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_nedorogo.html" class="sublm unmark" > Модульные картины недорого</a> ';
	}
	if (strripos($file, 'modulnye_kartiny_na_holste')) {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_na_holste.html" class="sublm mark" > Модульные картины на холсте</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_na_holste.html" class="sublm unmark" > Модульные картины на холсте</a> ';
	}
	if (strripos($file, 'kartiny_iz_chastey')) {
		$menu11 .= '<a href="/modulnye_kartiny/kartiny_iz_chastey.html" class="sublm mark" > Картины из частей</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/kartiny_iz_chastey.html" class="sublm unmark" > Картины из частей</a> ';
	}
	if (strripos($file, 'sostavnye_kartiny')) {
		$menu11 .= '<a href="/modulnye_kartiny/sostavnye_kartiny.html" class="sublm mark" > Составные картины</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/sostavnye_kartiny.html" class="sublm unmark" > Составные картины</a> ';
	}
	if (strripos($file, 'modulnye_kartiny_abstrakciya')) {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_abstrakciya.html" class="sublm mark" > Модульные картины абстракция</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_abstrakciya.html" class="sublm unmark" > Модульные картины абстракция</a> ';
	}
	if (strripos($file, 'modulnye_kartiny_goroda')) {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_goroda.html" class="sublm mark" > Модульные картины города</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_goroda.html" class="sublm unmark" > Модульные картины города</a> ';
	}
	if (strripos($file, 'modulnye_kartiny_dlya_kuhni')) {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_dlya_kuhni.html" class="sublm mark" > Модульные картины для кухни</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_dlya_kuhni.html" class="sublm unmark" > Модульные картины для кухни</a> ';
	}
	if (strripos($file, 'modulnye_kartiny_cvety')) {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_cvety.html" class="sublm mark" > Модульные картины цветы</a> ';
	} else {
		$menu11 .= '<a href="/modulnye_kartiny/modulnye_kartiny_cvety.html" class="sublm unmark" > Модульные картины цветы</a> ';
	}
} else {
	$menu1 .= '<a href="/modulnye_kartiny/" class="lm unmark"> Модульные картины</a>';
}

if (strripos($file, 'ramki_dlya_ikon/')) {
	$imgcat = 'none';
	$menu2 .= '<a href="/ramki_dlya_ikon/" class="lm mark"> Рамки для икон</a> ';

	if (strripos($file, 'ramki_dlya_vyshityh_ikon')) {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_vyshityh_ikon.html" class="sublm mark" > Рамки для вышитых икон</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_vyshityh_ikon.html" class="sublm unmark" > Рамки для вышитых икон</a> ';
	}

	if (strripos($file, 'derevyannye_ramki_dlya_ikon')) {
		$menu22 .= '<a href="/ramki_dlya_ikon/derevyannye_ramki_dlya_ikon.html" class="sublm mark" > Деревянные рамки для икон</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_ikon/derevyannye_ramki_dlya_ikon.html" class="sublm unmark" > Деревянные рамки для икон</a> ';
	}

	if (strripos($file, 'ramka_dlya_ikony_iz_bisera')) {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramka_dlya_ikony_iz_bisera.html" class="sublm mark" > Рамка для иконы из бисера</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramka_dlya_ikony_iz_bisera.html" class="sublm unmark" > Рамка для иконы из бисера</a> ';
	}

	if (strripos($file, 'ramka_pod_ikonu')) {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramka_pod_ikonu.html" class="sublm mark" > Рамка под икону</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramka_pod_ikonu.html" class="sublm unmark" > Рамка под икону</a> ';
	}

	if (strripos($file, 'ramki_dlya_ikon_vyshityh_biserom')) {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_ikon_vyshityh_biserom.html" class="sublm mark" > Рамки для икон вышитых бисером</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_ikon_vyshityh_biserom.html" class="sublm unmark" > Рамки для икон вышитых бисером</a> ';
	}
} else {
	$menu2 .= '<a href="/ramki_dlya_ikon/" class="lm unmark"> Рамки для икон</a> ';
}

if (strripos($file, 'ramki_dlya_kartin/')) {
	$imgcat = 'ramki-dlya-kartin';
	$menu2 .= '<a href="/ramki_dlya_kartin/" class="lm mark"> Рамки для картин</a> ';

	if (strripos($file, 'bolshie_aluminievye_ramki_dlya_kartin')) {
		$menu22 .= '<a href="/ramki_dlya_kartin/bolshie_aluminievye_ramki_dlya_kartin.html" class="sublm mark" > Алюминиевые рамки для картин</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_kartin/bolshie_aluminievye_ramki_dlya_kartin.html" class="sublm unmark" > Алюминиевые рамки для картин</a> ';
	}
	if (strripos($file, 'krasivye_derevyannye_ramki_dlya_kartin')) {
		$menu22 .= '<a href="/ramki_dlya_kartin/krasivye_derevyannye_ramki_dlya_kartin.html" class="sublm mark" > Деревянные рамки для картин</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_kartin/krasivye_derevyannye_ramki_dlya_kartin.html" class="sublm unmark" > Деревянные рамки для картин</a> ';
	}
	if (strripos($file, 'deshevye_plastikovye_ramki_dlya_kartin')) {
		$menu22 .= '<a href="/ramki_dlya_kartin/deshevye_plastikovye_ramki_dlya_kartin.html" class="sublm mark" > Пластиковые рамки для картин</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_kartin/deshevye_plastikovye_ramki_dlya_kartin.html" class="sublm unmark" > Пластиковые рамки для картин</a> ';
	}
	if (strripos($file, 'gotovye_ramki_dlya_kartin')) {
		$menu22 .= '<a href="/ramki_dlya_kartin/gotovye_ramki_dlya_kartin.html" class="sublm mark" > Готовые рамки для картин</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_kartin/gotovye_ramki_dlya_kartin.html" class="sublm unmark" > Готовые рамки для картин</a> ';
	}
	if (strripos($file, 'podbor_ramki_pod_kartinu')) {
		$menu22 .= '<a href="/ramki_dlya_kartin/podbor_ramki_pod_kartinu.html" class="sublm mark" > Подбор рамки под картину</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_kartin/podbor_ramki_pod_kartinu.html" class="sublm unmark" > Подбор рамки под картину</a> ';
	}
	if (strripos($file, 'izgotovlenie_ramok_dlya_kartin_na_zakaz')) {
		$menu22 .= '<a href="/ramki_dlya_kartin/izgotovlenie_ramok_dlya_kartin_na_zakaz.html" class="sublm mark" > Рамки для картин на заказ</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_kartin/izgotovlenie_ramok_dlya_kartin_na_zakaz.html" class="sublm unmark" > Рамки для картин на заказ</a> ';
	}
} else {
	$menu2 .= '<a href="/ramki_dlya_kartin/" class="lm unmark"> Рамки для картин</a> ';
}

if (strripos($file, 'bagetnye_ramki/')) {
	$imgcat = 'bagetnye-ramki';
	$menu2 .= '<a href="/bagetnye_ramki/" class="lm mark"> Багетные рамки</a> ';

	if (strripos($file, 'izgotovlenie_bagetnyh_ramok')) {
		$menu22 .= '<a href="/bagetnye_ramki/izgotovlenie_bagetnyh_ramok.html" class="sublm mark" > Изготовление багетных рамок</a> ';
	} else {
		$menu22 .= '<a href="/bagetnye_ramki/izgotovlenie_bagetnyh_ramok.html" class="sublm unmark" > Изготовление багетных рамок</a> ';
	}
	if (strripos($file, 'bagetnye_ramki_dlya_ikon')) {
		$imgcat = 'none';
		$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_ikon.html" class="sublm mark" > Багетные рамки для икон</a> ';
	} else {
		$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_ikon.html" class="sublm unmark" > Багетные рамки для икон</a> ';
	}
	if (strripos($file, 'bagetnye_ramki_dlya_kartin')) {
		$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_kartin.html" class="sublm mark" > Багетные рамки для картин</a> ';
	} else {
		$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_kartin.html" class="sublm unmark" > Багетные рамки для картин</a> ';
	}
	if (strripos($file, 'bagetnye_ramki_dlya_foto')) {
		$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_foto.html" class="sublm mark" > Багетные рамки для фото</a> ';
	} else {
		$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_foto.html" class="sublm unmark" > Багетные рамки для фото</a> ';
	}
} else {
	$menu2 .= '<a href="/bagetnye_ramki/" class="lm unmark"> Багетные рамки</a> ';
}

if (strripos($file, 'ramki_dlya_vyshivki/')) {
	$imgcat = 'none';
	$menu2 .= '<a href="/ramki_dlya_vyshivki/" class="lm mark"> Рамки для вышивки</a> ';

	if (strripos($file, 'kak_oformit_vyshivku')) {
		$menu22 .= '<a href="/ramki_dlya_vyshivki/kak_oformit_vyshivku.html" class="sublm mark" > Как оформить вышивку</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_vyshivki/kak_oformit_vyshivku.html" class="sublm unmark" > Как оформить вышивку</a> ';
	}
	if (strripos($file, 'ramy_i_baget_dlya_vyshivki')) {
		$menu22 .= '<a href="/ramki_dlya_vyshivki/ramy_i_baget_dlya_vyshivki.html" class="sublm mark" > Рамы и багет для вышивки</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_vyshivki/ramy_i_baget_dlya_vyshivki.html" class="sublm unmark" > Рамы и багет для вышивки</a> ';
	}
	if (strripos($file, 'oformlenie_vyshivki')) {
		$menu22 .= '<a href="/ramki_dlya_vyshivki/oformlenie_vyshivki.html" class="sublm mark" > Оформление вышивки</a> ';
	} else {
		$menu22 .= '<a href="/ramki_dlya_vyshivki/oformlenie_vyshivki.html" class="sublm unmark" > Оформление вышивки</a> ';
	}
} else {
	$menu2 .= '<a href="/ramki_dlya_vyshivki/" class="lm unmark"> Рамки для вышивки</a> ';
}

if (strripos($file, 'baget_dlya_ikony/')) {
	$imgcat = 'baget-dlya-ikony';
	$menu2 .= '<a href="/baget_dlya_ikony/" class="lm mark"> Багет для иконы</a> ';
} else {
	$menu2 .= '<a href="/baget_dlya_ikony/" class="lm unmark"> Багет для иконы</a> ';
}

if (strripos($file, 'bagety_dlya_kartin/')) {
	$imgcat = 'bagety-dlya-kartin';
	$menu2 .= '<a href="/bagety_dlya_kartin/" class="lm mark"> Багеты для картин</a> ';

	if (strripos($file, 'bagety_dlya_kartin_cena')) {
		$menu22 .= '<a href="/bagety_dlya_kartin/bagety_dlya_kartin_cena.html" class="sublm mark" > Стоимость багета для картин</a> ';
	} else {
		$menu22 .= '<a href="/bagety_dlya_kartin/bagety_dlya_kartin_cena.html" class="sublm unmark" > Стоимость багета для картин</a> ';
	}

	if (strripos($file, 'zakazat_baget')) {
		$menu22 .= '<a href="/bagety_dlya_kartin/zakazat_baget.html" class="sublm mark" > Заказать багет для картины</a> ';
	} else {
		$menu22 .= '<a href="/bagety_dlya_kartin/zakazat_baget.html" class="sublm unmark" > Заказать багет для картины</a> ';
	}

	if (strripos($file, 'kak_podobrat_baget_k_kartine')) {
		$menu22 .= '<a href="/bagety_dlya_kartin/kak_podobrat_baget_k_kartine.html" class="sublm mark" > Как подобрать багет к картине</a> ';
	} else {
		$menu22 .= '<a href="/bagety_dlya_kartin/kak_podobrat_baget_k_kartine.html" class="sublm unmark" > Как подобрать багет к картине</a> ';
	}

	if (strripos($file, 'derevyannye_bagety_dlya_kartin')) {
		$menu22 .= '<a href="/bagety_dlya_kartin/derevyannye_bagety_dlya_kartin.html" class="sublm mark" > Деревянные багеты для картин</a> ';
	} else {
		$menu22 .= '<a href="/bagety_dlya_kartin/derevyannye_bagety_dlya_kartin.html" class="sublm unmark" > Деревянные багеты для картин</a> ';
	}

	if (strripos($file, 'plastikovyi_baget_dlya_kartin')) {
		$menu22 .= '<a href="/bagety_dlya_kartin/plastikovyi_baget_dlya_kartin.html" class="sublm mark" > Пластиковый багет для картин</a> ';
	} else {
		$menu22 .= '<a href="/bagety_dlya_kartin/plastikovyi_baget_dlya_kartin.html" class="sublm unmark" > Пластиковый багет для картин</a> ';
	}

	if (strripos($file, 'oformit_kartinu_v_baget')) {
		$menu22 .= '<a href="/bagety_dlya_kartin/oformit_kartinu_v_baget.html" class="sublm mark" > Оформить картину в багет</a> ';
	} else {
		$menu22 .= '<a href="/bagety_dlya_kartin/oformit_kartinu_v_baget.html" class="sublm unmark" > Оформить картину в багет</a> ';
	}
} else {
	$menu2 .= '<a href="/bagety_dlya_kartin/" class="lm unmark"> Багеты для картин</a> ';
}


if ($imgcat != 'none') {
	echo "<div id=\"right\">";
	$bagmax = (count(scandir($imgcat)) - 2) / 2;
	$rand[0] = rand(1, $bagmax);
	do {
		$rand[1] = rand(1, $bagmax);
	} while ($rand[1] == $rand[0]);
	do {
		$rand[2] = rand(1, $bagmax);
	} while ($rand[2] == $rand[1] || $rand[2] == $rand[0]);
	do {
		$rand[3] = rand(1, $bagmax);
	} while ($rand[3] == $rand[2] || $rand[3] == $rand[1] || $rand[3] == $rand[0]);


	for ($i = 0; $i < 4; $i++) {
		if ($imgcat == 'modulnye-kartiny') {
			echo '<a href="/' . $imgcat . '/' . $imgcat . '-' . $rand[$i] . '-l.jpg" id="thumb' . ($i + 1) . '" class="highslide" title="Модульная картина, артикул M-0' . $rand[$i] . '" onclick="return hs.expand(this, config' . ($i + 1) . ')"><img src="/' . $imgcat . '/' . $imgcat . '-' . $rand[$i] . '.jpg" alt="Багетная мастерская №1, примеры работ"></a>';
		} else {
			echo '<a href="/' . $imgcat . '/' . $imgcat . '-' . $rand[$i] . '-l.jpg" id="thumb' . ($i + 1) . '" class="highslide" title="Примеры работ" onclick="return hs.expand(this, config' . ($i + 1) . ')"><img src="/' . $imgcat . '/' . $imgcat . '-' . $rand[$i] . '.jpg" alt="Багетная мастерская №1, примеры работ"></a>';
		}
	}


	echo "</div>";
}

if ($menu11) {
	$menu11 .= '<br>';
}
if ($menu111) {
	$menu111 .= '<br>';
}
if ($menu22) {
	$menu2 .= '<br>';
}
echo '<div id="left">' . $menu1 . '<br>' . $menu11 . $menu111 . $menu2 . $menu22 . '</div>';
?>

<div id="info_shade" class="infohide" onclick="hideinfo();"></div>
<div id="info" class="infohide"></div>


<?
if (($_SERVER["REMOTE_ADDR"] == '127.0.0.1')) {
	echo '
			<div id="botm">
				© 2013 Багетная мастерская №1
				<a href="/kontakty.html" class="botmhref">Контакты</a>&nbsp;<a href="/dostavka.html" class="botmhref">Доставка</a>&nbsp;<a href="/sitemap.html" class="botmhref">Карта сайта</a>
			</div>
			';
} else {
	echo '
			<div id="botm">
				© 2013 Багетная мастерская №1

				<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
				<div class="yashare-auto-init" style="display:inline; margin:0px 0px 0px 30px;" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"></div>
				

				<!--<a href="/vakansii.html" class="botmhref">Вакансии</a>-->
				<a href="/kontakty.html" class="botmhref">Контакты</a>&nbsp;<a href="/dostavka.html" class="botmhref">Доставка</a>&nbsp;<a href="/sitemap.html" class="botmhref">Карта сайта</a>
			</div>
			
			<script type="text/javascript">
			(function (d, w, c) {
			    (w[c] = w[c] || []).push(function() {
			        try {
			            w.yaCounter22860166 = new Ya.Metrika({id:22860166,
			                    webvisor:true,
			                    clickmap:true,
			                    trackLinks:true,
			                    accurateTrackBounce:true,
			                    trackHash:true});
			        } catch(e) { }
			    });

			    var n = d.getElementsByTagName("script")[0],
			        s = d.createElement("script"),
			        f = function () { n.parentNode.insertBefore(s, n); };
			    s.type = "text/javascript";
			    s.async = true;
			    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

			    if (w.opera == "[object Opera]") {
			        d.addEventListener("DOMContentLoaded", f, false);
			    } else { f(); }
			})(document, window, "yandex_metrika_callbacks");
			</script>
			<noscript><div><img src="//mc.yandex.ru/watch/22860166" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		';
}
?>
</div>
</BODY>

</HTML>
<script type="text/javascript" src="/calc.js"></script>
<script type="text/javascript" src="/highslide/highslide-with-gallery.js"></script>
<script type="text/javascript" src="/highslide/highslide.config.js" charset="utf-8"></script>

<script>
	function showinfo(id) {
		if (id == 1) {
			document.getElementById("info").innerHTML = '<h2>Сколько это стоит?</h2><p>Рассчитать, во что обойдется оформить изображение в багетную рамку можно, воспользовавшись нашим <a href="/baget_online" class="t2">БАГЕТНЫМ КОНСТРУКТОРОМ</a>, там же вы можно посмотреть весь каталог багетных рамок и при желании сразу оформить заказ. </p><p>Узнать цены на обычные услуги нашей багетной мастерской можно в следующем мини-калькуляторе, просто выберите интересующую вас услугу и укажите размеры изображения:</p><div id="calc-wrap"><div id="calc"><div class="calcblock"><div class="calcblockinfo">Выберите интересующую вас услугу:</div><div id="serv1" class="calcservsel" onclick="makeprice(1);"><span>Печать<br>на холсте<br>300 г/м2</span></div> <div id="serv2" class="calcservs" onclick="makeprice(2);"><span>Печать<br>на матовой<br>200 г/м2</span></div> <div id="serv3" class="calcservs" onclick="makeprice(3);"><span>Печать<br>на глянцевой<br>250 г/м2</span></div><div id="serv4" class="calcservs" onclick="makeprice(4);"><span>Накатка<br>на пенокартон<br>5 мм</span></div><div id="serv5" class="calcservs" onclick="makeprice(5);"><span>Накатка<br>на пенокартон<br>10 мм</span></div><div id="serv6" class="calcservs" onclick="makeprice(6);"><span>Натяжка<br>на подрамник<br>50х18 мм</span></div></div><div class="calcblock"><div class="calcblockinfo">Выберите размеры и количество:</div><form name="form" onsubmit="return false;"><input type="text" id="widinp" name="wid" onchange="makeprice(0);" value="210" autocomplete="off">х<input type="text" id="heiinp" name="hei" onchange="makeprice(0);" value="300" autocomplete="off">мм<br><input type="text" name="num" onchange="makeprice(0);" value="1" autocomplete="off">шт</form><div id="calcsize4" class="calcsizesel" onclick="setsize(4);">А4</div><div id="calcsize3" class="calcsize" onclick="setsize(3);">А3</div><div id="calcsize2" class="calcsize" onclick="setsize(2);">А2</div><div id="calcsize1" class="calcsize" onclick="setsize(1);">А1</div><div id="calcsize0" class="calcsize" onclick="setsize(0);">А0</div></div><div class="calcblock calchefo"><strong><span style="color: #f00;" id="price">546</span>&nbsp;руб.</strong></div></div></div><p>Если с самостоятельным подсчетом заказа возникли затруднения, тогда напишите или позвоните нам и наш багетный мастер поможет рассчитать Ваш заказ. Электронная почта, телефон и схема проезда на странице <a href="/kontakty.html" class="t2">контакты</a>.</p><p>Стоимость доставки Вашего заказа по Москве – 600 рублей. Звоните, пишите, приезжайте - ждем Ваших заказов!</p><div class="infoclose" onclick="hideinfo();"></div>';
		}
		if (id == 2) {
			document.getElementById("info").innerHTML = '<h2>Как сделать и оплатить заказ?</h2>Сделать заказ в нашей Багетной Мастерской №1 можно несколькими способами:<ol><li>Заказ можно оформить в <a href="/baget_online" class="t2">БАГЕТНОМ КОНСТРУКТОРЕ</a>, там же можно расчитать стоимость работ, а так же посмотреть весь каталог багетных рамок.<br>В данном случае наш администратор непременно перезвонит Вам, уточнит параметры заказа и сообщит, когда можно будет подъехать и забрать его (по желанию оформляем доставку).</li><li>Можно приехать по адресу м.Новокузнецкая, Климентовский переулок, дом 6 (<a href="/kontakty.html" class="t2">схема проезда</a>) и оформить заказ на месте. Если у Вас небольшой заказ, то при наличии багета на складе, мы выполним его в Вашем присутствии за 20-30 минут.</li><li>Можно позвонить и оформить заказ по телефону: +7 (495) 951-77-51 или +7 (495) 504-73-04</li><li>Также, для Вашего удобства, у нас работает точка приема заказов по адресу: метро Октябрьская, Калужская площадь, дом 1, компания <a href="http://www.copymaster.biz/contacts" class="t2" rel="nofollow">КОПИМАСТЕР</a> (100 метров от метро, отдельный вход прямо со стороны Ленинского проспекта)</li></ol><p>Частные лица могут оплачивать заказы наличными деньгами (в том числе банковской картой). Если Вы представитель юридического лица, то мы готовы выставить счет для оплаты по безналичному расчету.</p><div class="infoclose" onclick="hideinfo();"></div>';
		}
		if (id == 3) {
			document.getElementById("info").innerHTML = '<h2>Что мы делаем?</h2><p>Мы оформляем в багетные рамки постеры, фотографии, изображения, вышивки и многое другое. Варианты багетных рамок можно посмотреть в нашем <a href="/baget_online" class="t2">БАГЕТНОМ КОНСТРУКТОРЕ</a>, там же вы cможете посчитать цену работы и при желании сразу оформить заказ.</p><p>Мы печатаем на холсте, на глянцевой и матовой бумаге любые форматы изображений.</p><p>Мы делаем красивые модульные картины для Вашего интерьера.</p><p>Мы накатываем на пенокартон, делаем натяжку на подрамник, предоставляем услуги дизайнера.</p><p>А самое главное – мы рядом с м.Новокузнецкая и м.Третьяковская. Схему проезда можно посмотреть на странице <a href="/kontakty.html" class="t2">контакты</a>.</p><div class="infoclose" onclick="hideinfo();"></div>';
		}
		document.getElementById("info").className = 'infoshow';
		document.getElementById('info_shade').className = 'infoshow';
	}

	function hideinfo() {
		document.getElementById("info").className = 'infohide';
		document.getElementById('info_shade').className = 'infohide';
	}
</script>