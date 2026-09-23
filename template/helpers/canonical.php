<?php
/**
 * Канонический адрес текущей страницы — для <link rel="canonical"> и og:url.
 *
 * У многих страниц несколько рабочих адресов: например, /televizor_v_bagete и
 * /bagetnye_raboty/televizor_v_bagete.html отдают один и тот же файл через правила
 * .htaccess. Поисковику нужно явно сказать, какой из них основной, иначе он
 * считает их дублями и делит между ними вес.
 *
 * Основным для таких файлов считается адрес, который уже в индексе (.html или
 * раздел со слешем) — карта ниже повторяет внутренние правила .htaccess.
 * При добавлении нового правила «адрес -> файл.php» в .htaccess добавьте пару сюда.
 *
 * Страница может задать адрес сама: $canonical = '/путь'; до подключения шапки.
 */

const SITE_ORIGIN = 'https://bagetnaya-masterskaya.com';

const CANONICAL_PATHS = [
    '/actions.php'                                   => '/actions.html',
    '/bagetnye_ramki_dlya_foto.php'                  => '/bagetnye_ramki/bagetnye_ramki_dlya_foto.html',
    '/bagetnye_ramki_dlya_ikon.php'                  => '/bagetnye_ramki/bagetnye_ramki_dlya_ikon.html',
    '/bagetnye_ramki_dlya_kartin.php'                => '/bagetnye_ramki/bagetnye_ramki_dlya_kartin.html',
    '/bagety_dlya_kartin_cena.php'                   => '/bagety_dlya_kartin/bagety_dlya_kartin_cena.html',
    '/bolshie_aluminievye_ramki_dlya_kartin.php'     => '/ramki_dlya_kartin/bolshie_aluminievye_ramki_dlya_kartin.html',
    '/derevyannye_bagety_dlya_kartin.php'            => '/bagety_dlya_kartin/derevyannye_bagety_dlya_kartin.html',
    '/derevyannye_ramki_dlya_ikon.php'               => '/ramki_dlya_ikon/derevyannye_ramki_dlya_ikon.html',
    '/deshevye_plastikovye_ramki_dlya_kartin.php'    => '/ramki_dlya_kartin/deshevye_plastikovye_ramki_dlya_kartin.html',
    '/dostavka.php'                                  => '/dostavka.html',
    '/fotopechat_posterov_na_holste.php'             => '/pechat_na_holste/fotopechat_posterov_na_holste.html',
    '/gotovye_ramki_dlya_kartin.php'                 => '/ramki_dlya_kartin/gotovye_ramki_dlya_kartin.html',
    '/holst_na_podramnike.php'                       => '/natyazhka_holsta/holst_na_podramnike.html',
    '/interyernaya_pechat_na_holste.php'             => '/pechat_na_holste/interyernaya_pechat_na_holste.html',
    '/izgotovlenie_bageta.php'                       => '/bagetnye_raboty/izgotovlenie_bageta',
    '/izgotovlenie_bagetnyh_ramok.php'               => '/bagetnye_ramki/izgotovlenie_bagetnyh_ramok.html',
    '/izgotovlenie_bagetov_dlya_kartin.php'          => '/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_bagetov_dlya_kartin.html',
    '/izgotovlenie_ramki_iz_bageta.php'              => '/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_ramki_iz_bageta.html',
    '/izgotovlenie_zerkal_v_bagete.php'              => '/bagetnye_raboty/izgotovlenie_bageta/izgotovlenie_zerkal_v_bagete.html',
    '/kak_oformit_vyshivku.php'                      => '/ramki_dlya_vyshivki/kak_oformit_vyshivku.html',
    '/kartina_na_podramnike.php'                     => '/natyazhka_holsta/kartina_na_podramnike.html',
    '/krasivye_derevyannye_ramki_dlya_kartin.php'    => '/ramki_dlya_kartin/krasivye_derevyannye_ramki_dlya_kartin.html',
    '/kupit_penokarton.php'                          => '/nakatka_na_penokarton/kupit_penokarton.html',
    '/nakatka_na_penokarton.php'                     => '/nakatka_na_penokarton/',
    '/natyazhka_holsta.php'                          => '/natyazhka_holsta/',
    '/natyazhka_na_podramnik.php'                    => '/natyazhka_holsta/natyazhka_na_podramnik.html',
    '/obramlenie.php'                                => '/bagetnye_raboty/obramlenie/',
    '/obramlenie_dlya_foto.php'                      => '/bagetnye_raboty/obramlenie/obramlenie_dlya_foto.html',
    '/obramlenie_fotografiy.php'                     => '/bagetnye_raboty/obramlenie/obramlenie_fotografiy.html',
    '/obramlenie_kartinki.php'                       => '/bagetnye_raboty/obramlenie/obramlenie_kartinki.html',
    '/obramlenie_risunka.php'                        => '/bagetnye_raboty/obramlenie/obramlenie_risunka.html',
    '/oformlenie_detskih_risunkov_v_baget.php'       => '/bagetnye_raboty/oformlenie_detskih_risunkov_v_baget.html',
    '/oformlenie_fotografiy_v_baget.php'             => '/bagetnye_raboty/oformlenie_v_baget/oformlenie_fotografiy_v_baget.html',
    '/oformlenie_ikon_v_baget.php'                   => '/bagetnye_raboty/oformlenie_v_baget/oformlenie_ikon_v_baget.html',
    '/oformlenie_kartin_v_baget.php'                 => '/bagetnye_raboty/oformlenie_v_baget/oformlenie_kartin_v_baget.html',
    '/oformlenie_papirusa_v_baget.php'               => '/bagetnye_raboty/oformlenie_v_baget/oformlenie_papirusa_v_baget.html',
    '/oformlenie_v_baget.php'                        => '/bagetnye_raboty/oformlenie_v_baget/',
    '/oformlenie_vyshivki.php'                       => '/ramki_dlya_vyshivki/oformlenie_vyshivki.html',
    '/oformlenie_vyshivki_v_baget.php'               => '/bagetnye_raboty/oformlenie_v_baget/oformlenie_vyshivki_v_baget.html',
    '/oformlenie_zerkal_v_baget.php'                 => '/zerkala_v_bagete/oformlenie_zerkal_v_baget.html',
    '/ourteam.php'                                   => '/ourteam.html',
    '/pechat_foto_na_holste.php'                     => '/pechat_na_holste/pechat_foto_na_holste',
    '/pechat_ikon_na_holste.php'                     => '/pechat_na_holste/pechat_ikon_na_holste.html',
    '/pechat_kartin_na_holste.php'                   => '/pechat_na_holste/pechat_kartin_na_holste.html',
    '/pechat_na_holste_s_imitatsiey_zhivopisi.php'   => '/pechat_na_holste/pechat_na_holste_s_imitatsiey_zhivopisi.html',
    '/pechat_na_holste_s_podramnikom.php'            => '/pechat_na_holste/pechat_na_holste_s_podramnikom.html',
    '/pechat_plakatov_A0_A1_A2.php'                  => '/bagetnye_raboty/pechat_plakatov_A0_A1_A2.html',
    '/pechat_plakatov_A4_A3.php'                     => '/bagetnye_raboty/pechat_plakatov_A4_A3.html',
    '/pechat_portreta_na_holste.php'                 => '/pechat_na_holste/pechat_portreta_na_holste.html',
    '/pechat_posterov.php'                           => '/bagetnye_raboty/pechat_posterov.html',
    '/pechat_reprodukciy_na_holste.php'              => '/pechat_na_holste/pechat_reprodukciy_na_holste.html',
    '/penokarton_5_10.php'                           => '/nakatka_na_penokarton/penokarton_5_10.html',
    '/plastikovyi_baget_dlya_kartin.php'             => '/bagety_dlya_kartin/plastikovyi_baget_dlya_kartin.html',
    '/podbor_ramki_pod_kartinu.php'                  => '/ramki_dlya_kartin/podbor_ramki_pod_kartinu.html',
    '/ramka_dlya_ikony_iz_bisera.php'                => '/ramki_dlya_ikon/ramka_dlya_ikony_iz_bisera.html',
    '/ramka_pod_ikonu.php'                           => '/ramki_dlya_ikon/ramka_pod_ikonu.html',
    '/ramki_dlya_ikon.php'                           => '/ramki_dlya_ikon/',
    '/ramki_dlya_ikon_vyshityh_biserom.php'          => '/ramki_dlya_ikon/ramki_dlya_ikon_vyshityh_biserom.html',
    '/ramki_dlya_kartin.php'                         => '/ramki_dlya_kartin/',
    '/ramki_dlya_vyshityh_ikon.php'                  => '/ramki_dlya_ikon/ramki_dlya_vyshityh_ikon.html',
    '/ramki_dlya_vyshityh_kartin.php'                => '/ramki_dlya_kartin/ramki_dlya_vyshityh_kartin.html',
    '/ramki_dlya_vyshivki.php'                       => '/ramki_dlya_vyshivki/',
    '/ramy_i_baget_dlya_vyshivki.php'                => '/ramki_dlya_vyshivki/ramy_i_baget_dlya_vyshivki.html',
    '/shirokoformatnaya_pechat_na_holste.php'        => '/pechat_na_holste/shirokoformatnaya_pechat_na_holste.html',
    '/sitemap.php'                                   => '/sitemap.html',
    '/stilizacija_pod_zhivopis.php'                  => '/bagetnye_raboty/stilizacija_pod_zhivopis.html',
    '/televizor_v_bagete.php'                        => '/bagetnye_raboty/televizor_v_bagete.html',
    '/zakazat_baget.php'                             => '/bagety_dlya_kartin/zakazat_baget.html',
    '/zerkala_v_bagete.php'                          => '/zerkala_v_bagete/',
    '/zerkalo_v_rame.php'                            => '/zerkala_v_bagete/zerkalo_v_rame.html',
];

function canonicalUrl(?string $override = null): string
{
    if ($override) {
        return SITE_ORIGIN . $override;
    }

    $script = $_SERVER['SCRIPT_NAME'] ?? '';
    if (isset(CANONICAL_PATHS[$script])) {
        return SITE_ORIGIN . CANONICAL_PATHS[$script];
    }

    // До рендера лишние слеши, .php и /index уже убраны редиректами .htaccess,
    // поэтому путь запроса и есть канонический — отрезаем только параметры
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $url = SITE_ORIGIN . $path;

    // категория галереи — единственный параметр, который меняет содержимое страницы
    if (!empty($_GET['category']) && is_string($_GET['category'])) {
        $url .= '?category=' . rawurlencode($_GET['category']);
    }

    return $url;
}
