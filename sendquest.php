<? 
	if ($_GET["id"]) {
		if ($a[0]=='1') {$s='1. Откуда Вы узнали о нашей компании: <b> Яндекс</b><br>';}
		if ($a[0]=='2') {$s='1. Откуда Вы узнали о нашей компании: <b> Google</b><br>';}
		if ($a[0]=='3') {$s='1. Откуда Вы узнали о нашей компании: <b> Реклама на сайтах</b><br>';}
		if ($a[0]=='4') {$s='1. Откуда Вы узнали о нашей компании: <b> Рекомендация знакомых</b><br>';}
		if ($a[1]=='1') {$s.='2. Как часто Вы пользуетесь услугами багетных мастерских: <b> раз в месяц</b><br>';}
		if ($a[1]=='2') {$s.='2. Как часто Вы пользуетесь услугами багетных мастерских: <b> раз в год</b><br>';}
		if ($a[1]=='3') {$s.='2. Как часто Вы пользуетесь услугами багетных мастерских: <b> 3-4 раза в год</b><br>';}
		if ($a[1]=='4') {$s.='2. Как часто Вы пользуетесь услугами багетных мастерских: <b> постоянно пользуюсь</b><br>';}
		if ($a[1]=='5') {$s.='2. Как часто Вы пользуетесь услугами багетных мастерских: <b> первый и последний раз в жизни</b><br>';}
		if ($a[2]=='1') {$s.='3. Для каких целей Вы обычно делаете заказы в Багетной мастерской: <b> оформляю собственное творчество</b><br>';}
		if ($a[2]=='2') {$s.='3. Для каких целей Вы обычно делаете заказы в Багетной мастерской: <b> заказываю в качестве подарка для друзей и родственников</b><br>';}
		if ($a[2]=='3') {$s.='3. Для каких целей Вы обычно делаете заказы в Багетной мастерской: <b> в связи с потребностями в таких услугах нашей компании</b><br>';}
		if ($a[3]=='1') {$s.='4. Какой услугой нашей мастерской Вы воспользовались в этот раз: <b> оформление картины или фотографии в багет</b><br>';}
		if ($a[3]=='2') {$s.='4. Какой услугой нашей мастерской Вы воспользовались в этот раз: <b> печать изображения на холсте</b><br>';}
		if ($a[3]=='3') {$s.='4. Какой услугой нашей мастерской Вы воспользовались в этот раз: <b> оформление вышивки (хэндмейда) в багет</b><br>';}
		if ($a[3]=='4') {$s.='4. Какой услугой нашей мастерской Вы воспользовались в этот раз: <b> заказывал модульную картину</b><br>';}
		if ($a[3]=='5') {$s.='4. Какой услугой нашей мастерской Вы воспользовались в этот раз: <b> оформление иконы в багет</b><br>';}
		if ($a[3]=='6') {$s.='4. Какой услугой нашей мастерской Вы воспользовались в этот раз: <b> накатка на пенокартон</b><br>';}
		if ($a[4]=='1') {$s.='5. Что Вам не понравилось в работе нашей мастерской: <b> все отлично и все понравилось</b><br>';}
		if ($a[4]=='2') {$s.='5. Что Вам не понравилось в работе нашей мастерской: <b> некачественно выполнен заказ</b><br>';}
		if ($a[4]=='3') {$s.='5. Что Вам не понравилось в работе нашей мастерской: <b> не слишком вежливое и внимательное отношение сотрудников</b><br>';}
		if ($a[4]=='4') {$s.='5. Что Вам не понравилось в работе нашей мастерской: <b> неудобное расположение мастерской</b><br>';}
		if ($a[4]=='5') {$s.='5. Что Вам не понравилось в работе нашей мастерской: <b> высокая цена на оказываемые услуги</b><br>';}
		if ($a[5]=='1') {$s.='6. Оцените по 5-ти балльной шкале удобство нашего сайта: <b> 1</b><br>';}
		if ($a[5]=='2') {$s.='6. Оцените по 5-ти балльной шкале удобство нашего сайта: <b> 2</b><br>';}
		if ($a[5]=='3') {$s.='6. Оцените по 5-ти балльной шкале удобство нашего сайта: <b> 3</b><br>';}
		if ($a[5]=='4') {$s.='6. Оцените по 5-ти балльной шкале удобство нашего сайта: <b> 4</b><br>';}
		if ($a[5]=='5') {$s.='6. Оцените по 5-ти балльной шкале удобство нашего сайта: <b> 5</b><br>';}
		if ($a[6]=='1') {$s.='7. Воспользовались ли Вы скидкой предоставляемой на нашем сайте: <b> да</b><br>';}
		if ($a[6]=='2') {$s.='7. Воспользовались ли Вы скидкой предоставляемой на нашем сайте: <b> нет</b><br>';}
		if ($a[6]=='3') {$s.='7. Воспользовались ли Вы скидкой предоставляемой на нашем сайте: <b> что-то не заметил, где тут у вас дают скидку</b><br>';}
		if ($a[7]=='1') {$s.='8. Готовы ли Вы еще раз воспользоваться услугами нашей Багетной мастерской: <b> да</b><br>';}
		if ($a[7]=='2') {$s.='8. Готовы ли Вы еще раз воспользоваться услугами нашей Багетной мастерской: <b> нет</b><br>';}
		if ($a[7]=='3') {$s.='8. Готовы ли Вы еще раз воспользоваться услугами нашей Багетной мастерской: <b> сначала проверю, как работают другие мастерские</b><br>';}
		mail("director@bagetnaya-masterskaya.com",'Пройден тест на багетке',"IP: $ipaddr<br>$s","From: Site <site@bagetnaya-masterskaya.com>\r\nReply-To: site@bagetnaya-masterskaya.com\r\nContent-type:text/html; charset=utf-8\r\n");
	}
