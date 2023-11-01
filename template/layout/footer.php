<footer class="">
    <div class="row">
        <div class="col-12 col-md-7 align-middle">
            <a class="navbar-brand align-middle" href="/">Багетная мастерская</a>
            <img src="/img/logo 2 (1).svg" alt="" class='img-brand-footer align-middle'>
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
<div class="btn-up btn-up_hide">
    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 31 31" fill="none">
        <path d="M30.7328 15.5C30.7328 23.9128 23.9128 30.7328 15.5 30.7328C7.08718 30.7328 0.267242 23.9128 0.267242 15.5C0.267242 7.08718 7.08718 0.267242 15.5 0.267242C23.9128 0.267242 30.7328 7.08718 30.7328 15.5Z" stroke="#474A51" stroke-width="0.534484"/>
        <path d="M15.3501 5.70774C15.4545 5.60338 15.6237 5.60338 15.728 5.70774L17.4287 7.40846C17.5331 7.51283 17.5331 7.68204 17.4287 7.7864C17.3244 7.89076 17.1552 7.89076 17.0508 7.7864L15.5391 6.27465L14.0273 7.7864C13.9229 7.89076 13.7537 7.89076 13.6494 7.7864C13.545 7.68204 13.545 7.51283 13.6494 7.40846L15.3501 5.70774ZM15.2718 25.1875L15.2718 5.89671L15.8063 5.89671L15.8063 25.1875L15.2718 25.1875Z" fill="#474A51"/>
    </svg>
</div>

<script>
// <!-- Отправка GET-запроса для "ЯНДЕКС.ПОИСК", через FORM -->
jQuery(document).ready(function($) {

    // Получаем ссылку для атрибута 'action'
    const link = 'https://' + window.location.hostname + '/search';
    $('.custom-search').attr('action', link);

    // Получаем ключ Яндекс для того чтобы работал поиск
    let idSearch = $('.ya-site-form').attr('data-bem');
    let arr = JSON.parse(idSearch);
    $('[name="searchid"]').val(arr['searchid']);


    function onEntry(entry) {
        entry.forEach(change => {
            if (change.isIntersecting) {
                change.target.classList.add('element-show');
            }
        });
    }

    let options = {
        threshold: [0.5]
    };
    let observer = new IntersectionObserver(onEntry, options);
    let elements = document.querySelectorAll('.element-animation');

    for (let elm of elements) {
        observer.observe(elm);
    }
});

const btnUp = {
    el: document.querySelector('.btn-up'),
    scrolling: false,
    show() {
        if (this.el.classList.contains('btn-up_hide') && !this.el.classList.contains('btn-up_hiding')) {
            this.el.classList.remove('btn-up_hide');
            this.el.classList.add('btn-up_hiding');
            window.setTimeout(() => {
                this.el.classList.remove('btn-up_hiding');
            }, 300);
        }
    },
    hide() {
        if (!this.el.classList.contains('btn-up_hide') && !this.el.classList.contains('btn-up_hiding')) {
            this.el.classList.add('btn-up_hiding');
            window.setTimeout(() => {
                this.el.classList.add('btn-up_hide');
                this.el.classList.remove('btn-up_hiding');
            }, 300);
        }
    },
    addEventListener() {
        // при прокрутке окна (window)
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY || document.documentElement.scrollTop;
            if (this.scrolling && scrollY > 0) {
                return;
            }
            this.scrolling = false;
            // если пользователь прокрутил страницу более чем на 200px
            if (scrollY > 400) {
                // сделаем кнопку .btn-up видимой
                this.show();
            } else {
                // иначе скроем кнопку .btn-up
                this.hide();
            }
        });
        // при нажатии на кнопку .btn-up
        document.querySelector('.btn-up').onclick = () => {
            this.scrolling = true;
            this.hide();
            // переместиться в верхнюю часть страницы
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });
        }
    }
}

btnUp.addEventListener();
</script>
</body>

</html>