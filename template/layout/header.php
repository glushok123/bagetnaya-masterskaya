<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/base/connect.php';

$title = empty($title) ? "Багетная мастерская №1 в Москве - качественно и недорого!" : $title;
$description = empty($description) ? "Понадобились услуги недорогой багетной мастерской в Москве? Наша Багетная Мастерская №1 порадует Вас доступными ценами. Мы - лучшие в качественном оформлении багетными рамками." : $description;;
$keywords = empty($keywords) ? "багетная мастерская, багетная мастерская в Москве, багетная мастерская недорого" : $keywords;;
header("Cache-Control: max-age=2592000");
$v = 2;
?>

    <!doctype html>
    <html lang="ru">

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="SHORTCUT ICON" href="/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="content-language" content="ru">

        <title>
            <? echo $title; ?>
        </title>

        <meta NAME="Description" CONTENT="<? echo $description; ?>">
        <meta NAME="Keywords" CONTENT="<? echo $keywords; ?>">

        <link rel="stylesheet" href="/assets/layout/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/layout/jquery.fancybox.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
              integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap">

        <script src="/assets/layout/jquery.min.js"></script>
        <script src="/assets/layout/jquery.mask.min.js"></script>
        <script src="/assets/layout/bootstrap/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/swiper@10.2.0/swiper-bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/swiper@10.2.0/swiper-bundle.min.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="/assets/layout/toastify.min.css">
        <script type="text/javascript" src="/assets/layout/toastify-js"></script>

        <link href="/assets/layout/toastr.css" rel="stylesheet"/>
        <script src="/assets/layout/toastr.js"></script>

        <link rel="stylesheet" href="/assets/css/main.css?v<?= $v ?>">
        <link rel="stylesheet" href="/assets/css/custom-768.css?v<?= $v ?>">

        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', 'UA-169398394-2');
        </script>

        <script type="text/javascript">
            (function (m, e, t, r, i, k, a) {
                m[i] = m[i] || function () {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                m[i].l = 1 * new Date();
                for (var j = 0; j < document.scripts.length; j++) {
                    if (document.scripts[j].src === r) {
                        return;
                    }
                }
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
            })
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(94108947, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true
            });
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/94108947" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>

        <script type="text/javascript">
            (function (m, e, t, r, i, k, a) {
                m[i] = m[i] || function () {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                m[i].l = 1 * new Date();
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
            })
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(60934651, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true,
                webvisor: true
            });
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/60934651" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>

    </head>

    <body>

    <div class="ya-site-form ya-site-form_inited_no"
         data-bem="{&quot;action&quot;:&quot;https:/virtual-baget-curent/search&quot;,&quot;arrow&quot;:false,&quot;bg&quot;:&quot;transparent&quot;,&quot;fontsize&quot;:12,&quot;fg&quot;:&quot;#000000&quot;,&quot;language&quot;:&quot;ru&quot;,&quot;logo&quot;:&quot;rb&quot;,&quot;publicname&quot;:&quot;Поиск по bagetnaya-masterskaya.com&quot;,&quot;suggest&quot;:true,&quot;target&quot;:&quot;_blank&quot;,&quot;tld&quot;:&quot;ru&quot;,&quot;type&quot;:2,&quot;usebigdictionary&quot;:true,&quot;searchid&quot;:3468587,&quot;input_fg&quot;:&quot;#000000&quot;,&quot;input_bg&quot;:&quot;#ffffff&quot;,&quot;input_fontStyle&quot;:&quot;normal&quot;,&quot;input_fontWeight&quot;:&quot;normal&quot;,&quot;input_placeholder&quot;:null,&quot;input_placeholderColor&quot;:&quot;#000000&quot;,&quot;input_borderColor&quot;:&quot;#7f9db9&quot;}">
    </div>

    <style type="text/css">
        .ya-page_js_yes .ya-site-form_inited_no {
            display: none;
        }
    </style>
    <script type="text/javascript">
        (function (w, d, c) {
            var s = d.createElement('script'),
                h = d.getElementsByTagName('script')[0],
                e = d.documentElement;
            if ((' ' + e.className + ' ').indexOf(' ya-page_js_yes ') === -1) {
                e.className += ' ya-page_js_yes';
            }
            s.type = 'text/javascript';
            s.async = true;
            s.charset = 'utf-8';
            s.src = (d.location.protocol === 'https:' ? 'https:' : 'http:') + '//site.yandex.net/v2.0/js/all.js';
            h.parentNode.insertBefore(s, h);
            (w[c] || (w[c] = [])).push(function () {
                Ya.Site.Form.init()
            })
        })(window, document, 'yandex_site_callbacks');
    </script>
<?
if (isMobile()) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/nav-bar.php';
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/nav-bar-desctop.php';
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/button-feedback.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/modal-feedback.php';
?>