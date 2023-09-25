<footer class="">
    <div class="row">
        <div class="col-12 col-md-7 align-middle">
            <a class="navbar-brand align-middle" href="/">Багетная мастерская </a>
            <img src="/img/logo 2.png" alt="" class='img-brand-footer align-middle'>
        </div>
        <div class="col-12 col-md-5">
            <div class='row 
                    <? if (!isMobile()) { ?>
                        text-end
                    <? } ?>
                    mob-pt-15'>

                <div class='footer-phone'>
                    <? require $_SERVER['DOCUMENT_ROOT'] . '/assets/svg/footer-phone.php';?>

                    <span class='pl-10'>
                        8 (926) 865-92-95 салон на Арбатскойㅤㅤ
                    </span>
                </div>

                <div class='footer-phone my-1'>
                    <? require $_SERVER['DOCUMENT_ROOT'] . '/assets/svg/footer-phone.php';?>

                    <span class='pl-10'>
                        8 (977) 824-42-12 салон на Новокузнецкой
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-7 align-middle">
            <div class='row mt-5 mb-3'>
                <div class='col-6'>
                    <div class="footer-name-razdel">
                        клиентам
                    </div>
                    <div class='mt-4'>
                        <div class='div-nav-link-footer'><a class='nav-link-footer'
                                href="/сatalog-of-finished-works.php">Работы</a></div>
                        <div class='div-nav-link-footer'><a class='nav-link-footer' href="/actions.html">Акции</a></div>
                        <div class='div-nav-link-footer'><a class='nav-link-footer' href="/oplata_uslug.php">Оплата и
                                доставка</a></div>
                        <div class='div-nav-link-footer'><a class='nav-link-footer'
                                href="/картины%20багетной%20мастерской.php">Купить картину</a></div>
                        <div class='div-nav-link-footer'><a class='nav-link-footer'
                                href="/сatalog-of-finished-works.php">Галерея работ</a></div>
                        <div class='div-nav-link-footer'><a class='nav-link-footer' href="/baget_online">Рассчитать
                                стоимость багета</a></div>
                    </div>
                </div>
                <div class='col-6'>
                    <div class="footer-name-razdel">
                        о компании
                    </div>
                    <div class='mt-4'>
                        <div class='div-nav-link-footer'><a class='nav-link-footer' href="/contacts.php">Контакты</a>
                        </div>
                        <div class='div-nav-link-footer'><a class='nav-link-footer'
                                href="/oplata_uslug.php">Реквизиты</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
        </div>
    </div>
    <hr>

    <div class='row'>
        <div class='col-6'>
            <div class='footer-a footer-name-company'><a href="/">© 2013 Багетная мастерская №1</a></div>
            <div class='footer-a footer-site-map my-2'><a href="/sitemap.html">Карта сайта</a></div>
        </div>
        <div class='col-6 text-end'>
            <div class='footer-a footer-name-company'><a href="/privacy.pdf">Политика конфиденциальности</a></div>
            <div class='footer-a footer-site-map my-2'><a href="/terms.pdf">Пользовательское соглашение</a></div>
        </div>
    </div>
</footer>

<script>

// <!-- Отправка GET-запроса для "ЯНДЕКС.ПОИСК", через FORM -->
jQuery(document).ready(function($) {

    // Получаем ссылку для атрибута 'action'
    const link = 'http://' + window.location.hostname + '/search';
    $('.custom-search').attr('action', link);

    // Получаем ключ Яндекс для того чтобы работал поиск
    let idSearch = $('.ya-site-form').attr('data-bem');
    let arr = JSON.parse(idSearch);
    $('[name="searchid"]').val(arr['searchid']);
});

</script>
</body>

</html>