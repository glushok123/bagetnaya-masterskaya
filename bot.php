<h3>Наши акции</h3>
  	<div class="actio">У Вас персональная выставка? Посмотрите наше предложение по <a href="/bagetnye_raboty/obramlenie/" class="t2"> обрамлению работ багетными рамками на СПЕЦИАЛЬНЫХ УСЛОВИЯХ</a></div>
  	<a href="/actions.html" class="moreactio">Все акции</a>

  	<h3>Наша группа ВК</h3>
  	<script src="https://kit.fontawesome.com/5fc8cb6b98.js" crossorigin="anonymous"></script>
  	<div style="text-align:center;">
  		<ul class="social-icons-1">
  			<li><a href="https://vk.com/bagetnaya1"><i class="fa fa-vk"></i></a></li>
  			</h3>
  		</ul>
  	</div>


  	<style>
  		.social-icons-1 li {
  			display: inline-block;
  			position: relative;
  			font-size: 24px;
  		}

  		.social-icons-1 i,
  		.social-icons-1 img {
  			color: #fff;
  			position: absolute;
  			top: 18px;
  			left: 18px;
  			width: 24px;
  			height: 24px;
  			text-align: center;
  			transition: all 0.3s ease-out;
  		}

  		.social-icons-1 a {
  			display: inline-block;
  		}

  		.social-icons-1 a:before {
  			transform: scale(1);
  			content: "";
  			width: 60px;
  			height: 60px;
  			border-radius: 100%;
  			display: block;
  			background: linear-gradient(45deg, #337AB7, #2d6b9f);
  			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2), 0 2px 4px rgba(0, 0, 0, 0.2);
  			transition: all 0.3s ease-out;
  		}

  		.social-icons-1 a:hover:before {
  			transform: scale(0);
  			transition: all 0.3s ease-in;
  		}

  		.social-icons-1 a:hover i,
  		.social-icons-1 a:hover img {
  			transform: scale(1.8);
  			color: #337AB7;
  			transition: all 0.3s ease-in;
  		}
  	</style>


  	</div>
  	</div>

  	<?
		$file = $_SERVER['REQUEST_URI'];
		$menu1 = '';
		$menu11 = '';
		$menu111 = '';
		$menu2 = '';
		$menu22 = '';

		if (strripos((string) $file, 'pechat_na_holste/')) {
			$menu1 .= '<a href="/pechat_na_holste/" class="lm mark"> Печать на холсте</a> ';

			if (strripos((string) $file, 'pechat_na_holste_cena')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_cena.html" class="sublm mark" > Цена печати на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_cena.html" class="sublm unmark" > Цена печати на холсте</a> ';
			}

			if (strripos((string) $file, 'pechat_foto_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_foto_na_holste.html" class="sublm mark" > Печать фото на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_foto_na_holste.html" class="sublm unmark" > Печать фото на холсте</a> ';
			}

			if (strripos((string) $file, 'pechat_kartin_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_kartin_na_holste.html" class="sublm mark" > Печать картин на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_kartin_na_holste.html" class="sublm unmark" > Печать картин на холсте</a> ';
			}

			if (strripos((string) $file, 'shirokoformatnaya_pechat_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/shirokoformatnaya_pechat_na_holste.html" class="sublm mark" > Широкоформатная печать на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/shirokoformatnaya_pechat_na_holste.html" class="sublm unmark" > Широкоформатная печать на холсте</a> ';
			}

			if (strripos((string) $file, 'pechat_reprodukciy_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_reprodukciy_na_holste.html" class="sublm mark" > Печать репродукций на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_reprodukciy_na_holste.html" class="sublm unmark" > Печать репродукций на холсте</a> ';
			}

			if (strripos((string) $file, 'interyernaya_pechat_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/interyernaya_pechat_na_holste.html" class="sublm mark" > Интерьерная печать на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/interyernaya_pechat_na_holste.html" class="sublm unmark" > Интерьерная печать на холсте</a> ';
			}

			if (strripos((string) $file, 'fotopechat_posterov_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/fotopechat_posterov_na_holste.html" class="sublm mark" > Фотопечать постеров на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/fotopechat_posterov_na_holste.html" class="sublm unmark" > Фотопечать постеров на холсте</a> ';
			}

			if (strripos((string) $file, 'pechat_ikon_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_ikon_na_holste.html" class="sublm mark" > Печать икон на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_ikon_na_holste.html" class="sublm unmark" > Печать икон на холсте</a> ';
			}

			if (strripos((string) $file, 'pechat_portreta_na_holste')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_portreta_na_holste.html" class="sublm mark" > Печать портрета на холсте</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_portreta_na_holste.html" class="sublm unmark" > Печать портрета на холсте</a> ';
			}

			if (strripos((string) $file, 'pechat_na_holste_s_imitatsiey_zhivopisi')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_s_imitatsiey_zhivopisi.html" class="sublm mark" > Печать на холсте с имитацией живописи</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_s_imitatsiey_zhivopisi.html" class="sublm unmark" > Печать на холсте с имитацией живописи</a> ';
			}

			if (strripos((string) $file, 'pechat_na_holste_s_podramnikom')) {
				$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_s_podramnikom.html" class="sublm mark" > Печать на холсте с подрамником</a> ';
			} else {
				$menu11 .= '<a href="/pechat_na_holste/pechat_na_holste_s_podramnikom.html" class="sublm unmark" > Печать на холсте с подрамником</a> ';
			}
		} else {
			$menu1 .= '<a href="/pechat_na_holste/" class="lm unmark"> Печать на холсте</a> ';
		}


		if (strripos((string) $file, 'bagetnye_raboty/')) {
			$menu1 .= '<a href="/bagetnye_raboty/" class="lm mark"> Багетные работы</a> ';

			if (strripos((string) $file, 'izgotovlenie_bageta/')) {
				$menu11 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/" class="sublm mark" > Изготовление багета</a> ';

				if (strripos((string) $file, 'izgotovlenie_bagetov_dlya_kartin')) {
					$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_bagetov_dlya_kartin.html" class="ssublm mark" > Изготовление багетов для картин</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_bagetov_dlya_kartin.html" class="ssublm unmark" > Изготовление багетов для картин</a> ';
				}

				if (strripos((string) $file, 'izgotovlenie_zerkal_v_bagete')) {
					$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_zerkal_v_bagete.html" class="ssublm mark" > Изготовление зеркал в багете</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_zerkal_v_bagete.html" class="ssublm unmark" > Изготовление зеркал в багете</a> ';
				}

				if (strripos((string) $file, 'izgotovlenie_ramki_iz_bageta')) {
					$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_ramki_iz_bageta.html" class="ssublm mark" > Изготовление рамки из багета</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_ramki_iz_bageta.html" class="ssublm unmark" > Изготовление рамки из багета</a> ';
				}
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/izgotovlenie_bageta/" class="sublm unmark" > Изготовление багета</a> ';
			}

			if (strripos((string) $file, 'oformlenie_v_baget/')) {
				$menu11 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/" class="sublm mark" > Оформление в багет</a> ';

				if (strripos((string) $file, 'oformlenie_vyshivki_v_baget')) {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_vyshivki_v_baget.html" class="ssublm mark" > Оформление вышивки в багет</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_vyshivki_v_baget.html" class="ssublm unmark" > Оформление вышивки в багет</a> ';
				}

				if (strripos((string) $file, 'oformlenie_kartin_v_baget')) {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_kartin_v_baget.html" class="ssublm mark" > Оформление картин в багет</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_kartin_v_baget.html" class="ssublm unmark" > Оформление картин в багет</a> ';
				}

				if (strripos((string) $file, 'oformlenie_fotografiy_v_baget')) {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_fotografiy_v_baget.html" class="ssublm mark" > Оформление фотографий в багет</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_fotografiy_v_baget.html" class="ssublm unmark" > Оформление фотографий в багет</a> ';
				}

				if (strripos((string) $file, 'oformlenie_ikon_v_baget')) {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_ikon_v_baget.html" class="ssublm mark" > Оформление икон в багет</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_ikon_v_baget.html" class="ssublm unmark" > Оформление икон в багет</a> ';
				}

				if (strripos((string) $file, 'oformlenie_papirusa_v_baget')) {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_papirusa_v_baget.html" class="ssublm mark" > Оформление папируса в багет</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/oformlenie_papirusa_v_baget.html" class="ssublm unmark" > Оформление папируса в багет</a> ';
				}
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/oformlenie_v_baget/" class="sublm unmark" > Оформление в багет</a> ';
			}

			if (strripos((string) $file, 'obramlenie/')) {
				$menu11 .= '<a href="/bagetnye_raboty/obramlenie/" class="sublm mark" > Обрамление</a> ';

				if (strripos((string) $file, 'obramlenie_dlya_foto')) {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_dlya_foto.html" class="ssublm mark" > Обрамление для фото</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_dlya_foto.html" class="ssublm unmark" > Обрамление для фото</a> ';
				}

				if (strripos((string) $file, 'obramlenie_kartiny')) {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartiny.html" class="ssublm mark" > Обрамление картины</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartiny.html" class="ssublm unmark" > Обрамление картины</a> ';
				}

				if (strripos((string) $file, 'obramlenie_fotografiy')) {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_fotografiy.html" class="ssublm mark" > Обрамление фотографий</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_fotografiy.html" class="ssublm unmark" > Обрамление фотографий</a> ';
				}

				if (strripos((string) $file, 'obramlenie_risunka')) {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_risunka.html" class="ssublm mark" > Обрамление рисунка</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_risunka.html" class="ssublm unmark" > Обрамление рисунка</a> ';
				}

				if (strripos((string) $file, 'obramlenie_kartinki')) {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartinki.html" class="ssublm mark" > Обрамление картинки</a> ';
				} else {
					$menu111 .= '<a href="/bagetnye_raboty/obramlenie/obramlenie_kartinki.html" class="ssublm unmark" > Обрамление картинки</a> ';
				}
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/obramlenie/" class="sublm unmark" > Обрамление</a> ';
			}

			if (strripos((string) $file, 'oformlenie_detskih_risunkov_v_baget')) {
				$menu11 .= '<a href="/bagetnye_raboty/oformlenie_detskih_risunkov_v_baget.html" class="sublm mark" > Оформление детских рисунков</a> ';
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/oformlenie_detskih_risunkov_v_baget.html" class="sublm unmark" > Оформление детских рисунков</a> ';
			}

			if (strripos((string) $file, 'televizor_v_bagete')) {
				$menu11 .= '<a href="/bagetnye_raboty/televizor_v_bagete.html" class="sublm mark" > Телевизор в багете</a> ';
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/televizor_v_bagete.html" class="sublm unmark" > Телевизор в багете</a> ';
			}

			if (strripos((string) $file, 'pechat_plakatov_A0_A1_A2')) {
				$menu11 .= '<a href="/bagetnye_raboty/pechat_plakatov_A0_A1_A2.html" class="sublm mark" > Печать больших плакатов</a> ';
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/pechat_plakatov_A0_A1_A2.html" class="sublm unmark" > Печать больших плакатов</a> ';
			}

			if (strripos((string) $file, 'pechat_plakatov_A4_A3')) {
				$menu11 .= '<a href="/bagetnye_raboty/pechat_plakatov_A4_A3.html" class="sublm mark" > Печать плакатов А4 А3</a> ';
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/pechat_plakatov_A4_A3.html" class="sublm unmark" > Печать плакатов А4 А3</a> ';
			}

			if (strripos((string) $file, 'pechat_posterov')) {
				$menu11 .= '<a href="/bagetnye_raboty/pechat_posterov.html" class="sublm mark" > Печать постеров</a> ';
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/pechat_posterov.html" class="sublm unmark" > Печать постеров</a> ';
			}

			if (strripos((string) $file, 'stilizacija_pod_zhivopis')) {
				$menu11 .= '<a href="/bagetnye_raboty/stilizacija_pod_zhivopis.html" class="sublm mark" > Стилизация под живопись</a> ';
			} else {
				$menu11 .= '<a href="/bagetnye_raboty/stilizacija_pod_zhivopis.html" class="sublm unmark" > Стилизация под живопись</a> ';
			}
		} else {
			$menu1 .= '<a href="/bagetnye_raboty/" class="lm unmark"> Багетные работы</a> ';
		}


		if (strripos((string) $file, 'natyazhka_holsta/')) {
			$menu1 .= '<a href="/natyazhka_holsta/" class="lm mark"> Натяжка холста</a> ';

			if (strripos((string) $file, 'natyazhka_na_podramnik')) {
				$menu11 .= '<a href="/natyazhka_holsta/natyazhka_na_podramnik.html" class="sublm mark"> Натяжка на подрамник</a> ';
			} else {
				$menu11 .= '<a href="/natyazhka_holsta/natyazhka_na_podramnik.html" class="sublm unmark"> Натяжка на подрамник</a> ';
			}

			if (strripos((string) $file, 'holst_na_podramnike')) {
				$menu11 .= '<a href="/natyazhka_holsta/holst_na_podramnike.html" class="sublm mark"> Холст на подрамнике</a> ';
			} else {
				$menu11 .= '<a href="/natyazhka_holsta/holst_na_podramnike.html" class="sublm unmark"> Холст на подрамнике</a> ';
			}

			if (strripos((string) $file, 'kartina_na_podramnike')) {
				$menu11 .= '<a href="/natyazhka_holsta/kartina_na_podramnike.html" class="sublm mark"> Картина на подрамнике</a> ';
			} else {
				$menu11 .= '<a href="/natyazhka_holsta/kartina_na_podramnike.html" class="sublm unmark"> Картина на подрамнике</a> ';
			}
		} else {
			$menu1 .= '<a href="/natyazhka_holsta/" class="lm unmark"> Натяжка холста</a> ';
		}


		if (strripos((string) $file, 'nakatka_na_penokarton/')) {
			$menu1 .= '<a href="/nakatka_na_penokarton/" class="lm mark"> Накатка на пенокартон</a> ';

			if (strripos((string) $file, 'penokarton_5_10')) {
				$menu11 .= '<a href="/nakatka_na_penokarton/penokarton_5_10.html" class="sublm mark" > Пенокартон 5мм и 10мм</a> ';
			} else {
				$menu11 .= '<a href="/nakatka_na_penokarton/penokarton_5_10.html" class="sublm unmark" > Пенокартон 5мм и 10мм</a> ';
			}

			if (strripos((string) $file, 'kupit_penokarton')) {
				$menu11 .= '<a href="/nakatka_na_penokarton/kupit_penokarton.html" class="sublm mark" > Купить пенокартон</a> ';
			} else {
				$menu11 .= '<a href="/nakatka_na_penokarton/kupit_penokarton.html" class="sublm unmark" > Купить пенокартон</a> ';
			}
		} else {
			$menu1 .= '<a href="/nakatka_na_penokarton/" class="lm unmark"> Накатка на пенокартон</a> ';
		}

		if (strripos((string) $file, 'pechat_na_penokartone/')) {
			$menu1 .= '<a href="/pechat_na_penokartone/" class="lm mark"> Печать на пенокартоне</a> ';
		} else {
			$menu1 .= '<a href="/pechat_na_penokartone/" class="lm unmark"> Печать на пенокартоне</a> ';
		}


		if (strripos((string) $file, 'ramki_dlya_ikon/')) {
			$menu2 .= '<a href="/ramki_dlya_ikon/" class="lm mark"> Рамки для икон</a> ';

			if (strripos((string) $file, 'ramki_dlya_vyshityh_ikon')) {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_vyshityh_ikon.html" class="sublm mark" > Рамки для вышитых икон</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_vyshityh_ikon.html" class="sublm unmark" > Рамки для вышитых икон</a> ';
			}

			if (strripos((string) $file, 'derevyannye_ramki_dlya_ikon')) {
				$menu22 .= '<a href="/ramki_dlya_ikon/derevyannye_ramki_dlya_ikon.html" class="sublm mark" > Деревянные рамки для икон</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_ikon/derevyannye_ramki_dlya_ikon.html" class="sublm unmark" > Деревянные рамки для икон</a> ';
			}

			if (strripos((string) $file, 'ramka_dlya_ikony_iz_bisera')) {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramka_dlya_ikony_iz_bisera.html" class="sublm mark" > Рамка для иконы из бисера</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramka_dlya_ikony_iz_bisera.html" class="sublm unmark" > Рамка для иконы из бисера</a> ';
			}

			if (strripos((string) $file, 'ramka_pod_ikonu')) {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramka_pod_ikonu.html" class="sublm mark" > Рамка под икону</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramka_pod_ikonu.html" class="sublm unmark" > Рамка под икону</a> ';
			}

			if (strripos((string) $file, 'ramki_dlya_ikon_vyshityh_biserom')) {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_ikon_vyshityh_biserom.html" class="sublm mark" > Рамки для икон вышитых бисером</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_ikon/ramki_dlya_ikon_vyshityh_biserom.html" class="sublm unmark" > Рамки для икон вышитых бисером</a> ';
			}
		} else {
			$menu2 .= '<a href="/ramki_dlya_ikon/" class="lm unmark"> Рамки для икон</a> ';
		}

		if (strripos((string) $file, 'ramki_dlya_kartin/')) {
			$menu2 .= '<a href="/ramki_dlya_kartin/" class="lm mark"> Рамки для картин</a> ';

			if (strripos((string) $file, 'ramki_dlya_vyshityh_kartin')) {
				$menu22 .= '<a href="/ramki_dlya_kartin/ramki_dlya_vyshityh_kartin.html" class="sublm mark" > Рамки для вышитых картин</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_kartin/ramki_dlya_vyshityh_kartin.html" class="sublm unmark" > Рамки для вышитых картин</a> ';
			}

			if (strripos((string) $file, 'bolshie_aluminievye_ramki_dlya_kartin')) {
				$menu22 .= '<a href="/ramki_dlya_kartin/bolshie_aluminievye_ramki_dlya_kartin.html" class="sublm mark" > Алюминиевые рамки для картин</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_kartin/bolshie_aluminievye_ramki_dlya_kartin.html" class="sublm unmark" > Алюминиевые рамки для картин</a> ';
			}

			if (strripos((string) $file, 'krasivye_derevyannye_ramki_dlya_kartin')) {
				$menu22 .= '<a href="/ramki_dlya_kartin/krasivye_derevyannye_ramki_dlya_kartin.html" class="sublm mark" > Деревянные рамки для картин</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_kartin/krasivye_derevyannye_ramki_dlya_kartin.html" class="sublm unmark" > Деревянные рамки для картин</a> ';
			}

			if (strripos((string) $file, 'deshevye_plastikovye_ramki_dlya_kartin')) {
				$menu22 .= '<a href="/ramki_dlya_kartin/deshevye_plastikovye_ramki_dlya_kartin.html" class="sublm mark" > Пластиковые рамки для картин</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_kartin/deshevye_plastikovye_ramki_dlya_kartin.html" class="sublm unmark" > Пластиковые рамки для картин</a> ';
			}

			if (strripos((string) $file, 'gotovye_ramki_dlya_kartin')) {
				$menu22 .= '<a href="/ramki_dlya_kartin/gotovye_ramki_dlya_kartin.html" class="sublm mark" > Готовые рамки для картин</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_kartin/gotovye_ramki_dlya_kartin.html" class="sublm unmark" > Готовые рамки для картин</a> ';
			}

			if (strripos((string) $file, 'podbor_ramki_pod_kartinu')) {
				$menu22 .= '<a href="/ramki_dlya_kartin/podbor_ramki_pod_kartinu.html" class="sublm mark" > Подбор рамки под картину</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_kartin/podbor_ramki_pod_kartinu.html" class="sublm unmark" > Подбор рамки под картину</a> ';
			}

			if (strripos((string) $file, 'izgotovlenie_ramok_dlya_kartin_na_zakaz')) {
				$menu22 .= '<a href="/ramki_dlya_kartin/izgotovlenie_ramok_dlya_kartin_na_zakaz.html" class="sublm mark" > Рамки для картин на заказ</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_kartin/izgotovlenie_ramok_dlya_kartin_na_zakaz.html" class="sublm unmark" > Рамки для картин на заказ</a> ';
			}
		} else {
			$menu2 .= '<a href="/ramki_dlya_kartin/" class="lm unmark"> Рамки для картин</a> ';
		}

		if (strripos((string) $file, 'bagetnye_ramki/')) {
			$menu2 .= '<a href="/bagetnye_ramki/" class="lm mark"> Багетные рамки</a> ';

			if (strripos((string) $file, 'izgotovlenie_bagetnyh_ramok')) {
				$menu22 .= '<a href="/bagetnye_ramki/izgotovlenie_bagetnyh_ramok.html" class="sublm mark" > Изготовление багетных рамок</a> ';
			} else {
				$menu22 .= '<a href="/bagetnye_ramki/izgotovlenie_bagetnyh_ramok.html" class="sublm unmark" > Изготовление багетных рамок</a> ';
			}

			if (strripos((string) $file, 'bagetnye_ramki_dlya_ikon')) {
				$imgcat = 'none';
				$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_ikon.html" class="sublm mark" > Багетные рамки для икон</a> ';
			} else {
				$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_ikon.html" class="sublm unmark" > Багетные рамки для икон</a> ';
			}

			if (strripos((string) $file, 'bagetnye_ramki_dlya_kartin')) {
				$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_kartin.html" class="sublm mark" > Багетные рамки для картин</a> ';
			} else {
				$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_kartin.html" class="sublm unmark" > Багетные рамки для картин</a> ';
			}

			if (strripos((string) $file, 'bagetnye_ramki_dlya_foto')) {
				$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_foto.html" class="sublm mark" > Багетные рамки для фото</a> ';
			} else {
				$menu22 .= '<a href="/bagetnye_ramki/bagetnye_ramki_dlya_foto.html" class="sublm unmark" > Багетные рамки для фото</a> ';
			}
		} else {
			$menu2 .= '<a href="/bagetnye_ramki/" class="lm unmark"> Багетные рамки</a> ';
		}

		if (strripos((string) $file, 'ramki_dlya_vyshivki/')) {
			$menu2 .= '<a href="/ramki_dlya_vyshivki/" class="lm mark"> Рамки для вышивки</a> ';

			if (strripos((string) $file, 'kak_oformit_vyshivku')) {
				$menu22 .= '<a href="/ramki_dlya_vyshivki/kak_oformit_vyshivku.html" class="sublm mark" > Как оформить вышивку</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_vyshivki/kak_oformit_vyshivku.html" class="sublm unmark" > Как оформить вышивку</a> ';
			}

			if (strripos((string) $file, 'ramy_i_baget_dlya_vyshivki')) {
				$menu22 .= '<a href="/ramki_dlya_vyshivki/ramy_i_baget_dlya_vyshivki.html" class="sublm mark" > Рамы и багет для вышивки</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_vyshivki/ramy_i_baget_dlya_vyshivki.html" class="sublm unmark" > Рамы и багет для вышивки</a> ';
			}

			if (strripos((string) $file, 'oformlenie_vyshivki')) {
				$menu22 .= '<a href="/ramki_dlya_vyshivki/oformlenie_vyshivki.html" class="sublm mark" > Оформление вышивки</a> ';
			} else {
				$menu22 .= '<a href="/ramki_dlya_vyshivki/oformlenie_vyshivki.html" class="sublm unmark" > Оформление вышивки</a> ';
			}
		} else {
			$menu2 .= '<a href="/ramki_dlya_vyshivki/" class="lm unmark"> Рамки для вышивки</a> ';
		}

		if (strripos((string) $file, 'baget_dlya_ikony/')) {
			$menu2 .= '<a href="/baget_dlya_ikony/" class="lm mark"> Багет для иконы</a> ';
		} else {
			$menu2 .= '<a href="/baget_dlya_ikony/" class="lm unmark"> Багет для иконы</a> ';
		}

		if (strripos((string) $file, 'bagety_dlya_kartin/')) {
			$menu2 .= '<a href="/bagety_dlya_kartin/" class="lm mark"> Багеты для картин</a> ';

			if (strripos((string) $file, 'bagety_dlya_kartin_cena')) {
				$menu22 .= '<a href="/bagety_dlya_kartin/bagety_dlya_kartin_cena.html" class="sublm mark" > Стоимость багета для картин</a> ';
			} else {
				$menu22 .= '<a href="/bagety_dlya_kartin/bagety_dlya_kartin_cena.html" class="sublm unmark" > Стоимость багета для картин</a> ';
			}

			if (strripos((string) $file, 'zakazat_baget')) {
				$menu22 .= '<a href="/bagety_dlya_kartin/zakazat_baget.html" class="sublm mark" > Заказать багет для картины</a> ';
			} else {
				$menu22 .= '<a href="/bagety_dlya_kartin/zakazat_baget.html" class="sublm unmark" > Заказать багет для картины</a> ';
			}

			if (strripos((string) $file, 'kak_podobrat_baget_k_kartine')) {
				$menu22 .= '<a href="/bagety_dlya_kartin/kak_podobrat_baget_k_kartine.html" class="sublm mark" > Как подобрать багет к картине</a> ';
			} else {
				$menu22 .= '<a href="/bagety_dlya_kartin/kak_podobrat_baget_k_kartine.html" class="sublm unmark" > Как подобрать багет к картине</a> ';
			}

			if (strripos((string) $file, 'derevyannye_bagety_dlya_kartin')) {
				$menu22 .= '<a href="/bagety_dlya_kartin/derevyannye_bagety_dlya_kartin.html" class="sublm mark" > Деревянные багеты для картин</a> ';
			} else {
				$menu22 .= '<a href="/bagety_dlya_kartin/derevyannye_bagety_dlya_kartin.html" class="sublm unmark" > Деревянные багеты для картин</a> ';
			}

			if (strripos((string) $file, 'plastikovyi_baget_dlya_kartin')) {
				$menu22 .= '<a href="/bagety_dlya_kartin/plastikovyi_baget_dlya_kartin.html" class="sublm mark" > Пластиковый багет для картин</a> ';
			} else {
				$menu22 .= '<a href="/bagety_dlya_kartin/plastikovyi_baget_dlya_kartin.html" class="sublm unmark" > Пластиковый багет для картин</a> ';
			}

			if (strripos((string) $file, 'oformit_kartinu_v_baget')) {
				$menu22 .= '<a href="/bagety_dlya_kartin/oformit_kartinu_v_baget.html" class="sublm mark" > Оформить картину в багет</a> ';
			} else {
				$menu22 .= '<a href="/bagety_dlya_kartin/oformit_kartinu_v_baget.html" class="sublm unmark" > Оформить картину в багет</a> ';
			}
		} else {
			$menu2 .= '<a href="/bagety_dlya_kartin/" class="lm unmark"> Багеты для картин</a> ';
		}



		if (strripos((string) $file, 'zerkala_v_bagete/')) {
			$menu2 .= '<a href="/zerkala_v_bagete/" class="lm mark"> Зеркала в багете</a> ';

			if (strripos((string) $file, 'zerkalo_v_rame')) {
				$menu22 .= '<a href="/zerkala_v_bagete/zerkalo_v_rame.html" class="sublm mark" > Зеркало в раме</a> ';
			} else {
				$menu22 .= '<a href="/zerkala_v_bagete/zerkalo_v_rame.html" class="sublm unmark" > Зеркало в раме</a> ';
			}

			if (strripos((string) $file, 'oformlenie_zerkal_v_baget')) {
				$menu22 .= '<a href="/zerkala_v_bagete/oformlenie_zerkal_v_baget.html" class="ssublm mark" > Оформление зеркал в багет</a> ';
			} else {
				$menu22 .= '<a href="/zerkala_v_bagete/oformlenie_zerkal_v_baget.html" class="ssublm unmark" > Оформление зеркал в багет</a> ';
			}
		} else {
			$menu2 .= '<a href="/zerkala_v_bagete/" class="lm unmark"> Зеркала в багете</a> ';
			$menu2 .= '<a href="/ordena_i_medali/" class="lm unmark"> Панно для наград и орденов</a> ';
			$menu2 .= '<a href="/pechat_kartin_posterov_reprodukcij/" class="lm unmark"> Печать фотографий, постеров и репродукций</a> ';
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
  	<div id="botm">
  		© 2013 Багетная мастерская №1
  		<a href="/kontakty.html" class="botmhref">Контакты</a>&nbsp;<a href="/sitemap.html" class="botmhref">Карта сайта</a><br><a href="/privacy.pdf" class="botmhref">Политика конфиденциальности</a><br><a href="/terms.pdf" class="botmhref">Пользовательское соглашение</a>
  	</div>




  	</div>

  	<? if ($disco) {
			echo "<a href='/#game15' id='discount' class='discou1' onclick='this.className=\"discou1\";'></a>";
		} ?>


  	<script>
  		function getXmlHttp() {
  			var xmlhttp;
  			try {
  				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
  			} catch (e) {
  				try {
  					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  				} catch (E) {
  					xmlhttp = false;
  				}
  			}
  			if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
  				xmlhttp = new XMLHttpRequest();
  			}
  			return xmlhttp;
  		}

  		function loadJS(whatFile, whereToPut) {
  			var link = document.createElement("script");
  			link.setAttribute("type", "text/javascript");
  			link.setAttribute("src", whatFile);
  			if (whereToPut) {
  				whereToPut.appendChild(link);
  				whereToPut.onclick = function() {
  					return;
  				}
  			} else {
  				document.getElementsByTagName("head")[0].appendChild(link);
  			}
  		}

  		function vakanSw() {
  			loadJS('vakan_b.js');
  		}
  		if (location.hash == '#vacancy') {
  			vakanSw();
  		}

  		function game15start(id) {
  			loadJS('game15.js');
  			id.onclick = function() {
  				return;
  			}
  		}

  		function showinfo(id) {
  			if (id == 1) {
  				document.getElementById("info").innerHTML = '<h2>Сколько это стоит?</h2><p>Рассчитать, во что обойдется оформить изображение в багетную рамку можно, воспользовавшись нашим <a href="/baget_online" class="t2">БАГЕТНЫМ КОНСТРУКТОРОМ</a>, там же вы можно посмотреть весь каталог багетных рамок и при желании сразу оформить заказ. </p><p>Узнать цены на обычные услуги нашей багетной мастерской можно в следующем мини-калькуляторе, просто выберите интересующую вас услугу и укажите размеры изображения:</p><div id="calc-wrap"><div id="calc"><div class="calcblock"><div class="calcblockinfo">Выберите интересующую вас услугу:</div><div id="serv1" class="calcservsel" onclick="makeprice(1);"><span>Печать<br>на холсте<br>300 г/м2</span></div> <div id="serv2" class="calcservs" onclick="makeprice(2);"><span>Печать<br>на матовой<br>200 г/м2</span></div> <div id="serv3" class="calcservs" onclick="makeprice(3);"><span>Печать<br>на глянцевой<br>250 г/м2</span></div><div id="serv7" class="calcservs" onclick="makeprice(7);"><span>Накатка<br>на пенокартон<br>для студентов</span></div><div id="serv4" class="calcservs" onclick="makeprice(4);"><span>Накатка<br>на пенокартон<br>5 мм</span></div><div id="serv5" class="calcservs" onclick="makeprice(5);"><span>Накатка<br>на пенокартон<br>10 мм</span></div><div id="serv6" class="calcservs" onclick="makeprice(6);"><span>Натяжка<br>на подрамник<br>50х18 мм</span></div></div><div class="calcblock"><div class="calcblockinfo">Выберите размеры и количество:</div><form name="form" onsubmit="return false;"><input type="text" id="widinp" name="wid" onchange="makeprice(0);" value="210" autocomplete="off">х<input type="text" id="heiinp" name="hei" onchange="makeprice(0);" value="297" autocomplete="off">мм<br><input type="text" id="numinp" name="num" onchange="makeprice(0);" value="1" autocomplete="off">шт</form><div id="calcsize4" class="calcsizesel" onclick="setsize(4);">А4</div><div id="calcsize3" class="calcsize" onclick="setsize(3);">А3</div><div id="calcsize2" class="calcsize" onclick="setsize(2);">А2</div><div id="calcsize1" class="calcsize" onclick="setsize(1);">А1</div><div id="calcsize0" class="calcsize" onclick="setsize(0);">А0</div></div><div class="calcblock calchefo"><strong><span style="color: #f00;" id="price">546</span>&nbsp;руб.</strong></div></div></div><p>Если с самостоятельным подсчетом заказа возникли затруднения, тогда напишите или позвоните нам и наш багетный мастер поможет рассчитать Ваш заказ. Электронная почта, телефон и схема проезда на странице <a href="/#contacts" class="t2">контакты</a>.</p><p>Стоимость доставки Вашего заказа по Москве – 600 рублей. Звоните, пишите, приезжайте - ждем Ваших заказов!</p><div class="infoclose" onclick="hideinfo();"></div>';
  			}
  			if (id == 2) {
  				document.getElementById("info").innerHTML = '<h2>Как сделать и оплатить заказ?</h2>Сделать заказ в нашей Багетной Мастерской №1 можно несколькими способами:<ol><li>Заказ можно оформить в <a href="/baget_online" class="t2">БАГЕТНОМ КОНСТРУКТОРЕ</a>, там же можно расчитать стоимость работ, а так же посмотреть весь каталог багетных рамок.<br>В данном случае наш администратор непременно перезвонит Вам, уточнит параметры заказа и сообщит, когда можно будет подъехать и забрать его (по желанию оформляем доставку).</li><li>Можно приехать по адресу м.Новокузнецкая, Климентовский переулок, дом 6 (<a href="/#contacts" class="t2">схема проезда</a>) и оформить заказ на месте. Если у Вас небольшой заказ, то при наличии багета на складе, мы выполним его в Вашем присутствии за 20-30 минут. Только по предварительной записи по телефонам +7 (495) 951-77-51 или +7 (495) 504-73-04</li><li>Также, для Вашего удобства, у нас работает точка приема заказов по адресу: метро Октябрьская, Калужская площадь, дом 1, компания <a href="http://www.copymaster.biz/#contacts" class="t2" rel="nofollow">КОПИМАСТЕР</a> (100 метров от метро, отдельный вход прямо со стороны Ленинского проспекта)</li></ol><p>Частные лица могут оплачивать заказы наличными деньгами (в том числе банковской картой). Если Вы представитель юридического лица, то мы готовы выставить счет для оплаты по безналичному расчету.</p><div class="infoclose" onclick="hideinfo();"></div>';
  			}
  			if (id == 3) {
  				document.getElementById("info").innerHTML = '<h2>Что мы делаем?</h2><p>Мы оформляем в багетные рамки постеры, фотографии, изображения, вышивки и многое другое. Варианты багетных рамок можно посмотреть в нашем <a href="/baget_online" class="t2">БАГЕТНОМ КОНСТРУКТОРЕ</a>, там же вы cможете посчитать цену работы и при желании сразу оформить заказ.</p><p>Мы печатаем на холсте, на глянцевой и матовой бумаге любые форматы изображений.</p><p>Мы делаем красивые модульные картины для Вашего интерьера.</p><p>Мы накатываем на пенокартон, делаем натяжку на подрамник, предоставляем услуги дизайнера.</p><p>А самое главное – мы рядом с м.Новокузнецкая и м.Третьяковская. Схему проезда можно посмотреть на странице <a href="/#contacts" class="t2">контакты</a>.</p><div class="infoclose" onclick="hideinfo();"></div>';
  			}
  			document.getElementById("info").className = 'infoshow';
  			document.getElementById('info_shade').className = 'infoshow';
  		}

  		function hideinfo() {
  			document.getElementById("info").className = 'infohide';
  			document.getElementById('info_shade').className = 'infohide';
  		}
  		var lastserv = "1";
  		var lastsize = "4";
  		var questresult = '';

  		function makeprice(id, ib) {
  			finalprice = 0;
  			if (id == "0") {
  				id = lastserv;
  			}
  			if (ib) {
  				document.getElementById('serv2' + lastserv).className = 'calcservs';
  				lastserv = id;
  				document.getElementById('serv2' + lastserv).className = 'calcservsel';
  				x = Number(document.getElementById('widinp2').value);
  				y = Number(document.getElementById('heiinp2').value);
  				n = Number(document.getElementById('numinp2').value);
  			} else {
  				document.getElementById('serv' + lastserv).className = 'calcservs';
  				lastserv = id;
  				document.getElementById('serv' + lastserv).className = 'calcservsel';
  				x = Number(document.getElementById('widinp').value);
  				y = Number(document.getElementById('heiinp').value);
  				n = Number(document.getElementById('numinp').value);
  			}
  			if (x > 1000 || y > 1000) {
  				if (x >= y) {
  					z = x;
  				} else {
  					z = y;
  				}
  			} else {
  				if (x >= y) {
  					z = y;
  				} else {
  					z = x;
  				}
  			}
  			s = x * y;

  			if (id == "1") {
  				finalprice = s * 0.0036;
  			}
  			if (id == "2") {
  				finalprice = z * 0.8;
  			}
  			if (id == "3") {
  				finalprice = z * 1.2;
  			}
  			if (id == "4") {
  				finalprice = x * y * 0.0016;
  			}
  			if (id == "7") {
  				finalprice = x * y * 0.0016 * 0.9;
  			}
  			if (id == "5") {
  				finalprice = x * y * 0.002;
  			}
  			if (id == "6") {
  				finalprice = y * 0.8 + x * 0.8;
  			}
  			finalprice = n * finalprice;
  			finalprice = Math.round(finalprice);
  			if (ib) {
  				document.getElementById('price2').innerHTML = finalprice;
  			} else {
  				document.getElementById('price').innerHTML = finalprice;
  			}
  			return;
  		}

  		function setsize(id, ib) {
  			alert();
  			if (ib) {
  				document.getElementById('calcsize2' + lastsize).className = 'calcsize';
  				lastsize = id;
  				document.getElementById('calcsize2' + lastsize).className = 'calcsizesel';
  			} else {
  				document.getElementById('calcsize' + lastsize).className = 'calcsize';
  				lastsize = id;
  				document.getElementById('calcsize' + lastsize).className = 'calcsizesel';
  			}
  			if (id == "0") {
  				x = 841;
  				y = 1189;
  			}
  			if (id == "1") {
  				x = 594;
  				y = 841;
  			}
  			if (id == "2") {
  				x = 420;
  				y = 594;
  			}
  			if (id == "3") {
  				x = 297;
  				y = 420;
  			}
  			if (id == "4") {
  				x = 210;
  				y = 297;
  			}
  			if (ib) {
  				document.getElementById('widinp2').value = x;
  				document.getElementById('heiinp2').value = y;
  				makeprice(0, 1);
  			} else {
  				document.getElementById('widinp').value = x;
  				document.getElementById('heiinp').value = y;
  				makeprice(0);
  			}
  		}


  		function quest(id) {
  			var quests = document.getElementsByClassName('quest');
  			var rads = document.getElementsByName('q' + id);
  			for (var i = 0; i < rads.length; i++) {
  				if (rads[i].checked) {
  					questresult += (i + 1) + 'l';
  					quests[id - 1].style.display = "none";
  					quests[id].style.display = "block";
  					if (id == 8) {
  						var req = getXmlHttp();
  						var url = '/sendquest.php?id=' + questresult;
  						req.open('GET', url, true);
  						req.send(null);
  					}
  				}
  			};
  		}

  		<? if ($disco) {
				echo "var date = new Date(new Date().getTime() + 86400000); setTimeout(\"discount.className='discou2';document.cookie='disco=1;path=/;expires='+ date.toUTCString();\",5000);setTimeout(\"discount.className='discou3';\",6000);";
			} ?>

  		function gir() {
  			nums = document.getElementById('nums_1').innerHTML
  			if (nums == 1) {
  				document.getElementById('gir').className = 'gir_1';
  				document.getElementById('nums_1').innerHTML = '2'
  			}
  			if (nums == 2) {
  				document.getElementById('gir').className = 'gir_2';
  				document.getElementById('nums_1').innerHTML = '3'
  			}
  			if (nums == 3) {
  				document.getElementById('gir').className = 'gir_3';
  				document.getElementById('nums_1').innerHTML = '1'
  			}
  		}
  		setInterval(function() {
  			gir()
  		}, 2500)
  	</script>

  	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  	</BODY>

  	</HTML>