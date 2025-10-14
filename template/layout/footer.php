<? if (!isset($hideTop)) { ?>
    <footer class="">
        <div class="row">
            <div class="col-12 col-md-7 align-middle">
                <a class="navbar-brand align-middle" href="/">Багетная мастерская №1</a>
                <img src="/img/logo 2 (1).svg" alt="" class='img-brand-footer align-middle'>
            </div>
            <div class="col-12 col-md-5">
                <div class='row
                    <? if (!isMobile()) { ?>

                    <? } ?>
                    mob-pt-15'>

                    <div class='footer-phone'>
                        <? require $_SERVER['DOCUMENT_ROOT'] . '/assets/svg/footer-phone.php'; ?>

                        <span class='pl-10'>
                        8 (926) 865-92-95 салон на Арбатскойㅤㅤ
                        </span>
                    </div>

                    <div class='footer-phone my-1'>
                        <? require $_SERVER['DOCUMENT_ROOT'] . '/assets/svg/footer-phone.php'; ?>

                        <span class='pl-10'>
                        8 (977) 824-42-12 салон на Новокузнецкой
                        </span>
                    </div>

                    <div class='footer-phone my-1'>
                        <? require $_SERVER['DOCUMENT_ROOT'] . '/assets/svg/footer-phone.php'; ?>

                        <span class='pl-10'>
                        8(977) 314-77-71 салон на Баррикадной
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
                            <div class='div-nav-link-footer'><a class='nav-link-footer' href="/actions.html">Акции</a>
                            </div>
                            <div class='div-nav-link-footer'><a class='nav-link-footer' href="/oplata_uslug.php">Оплата
                                    и
                                    доставка</a></div>
                            <div class='div-nav-link-footer'><a class='nav-link-footer'
                                                                href="/картины%20багетной%20мастерской.php">Купить
                                    картину</a></div>
                            <div class='div-nav-link-footer'><a class='nav-link-footer'
                                                                href="/сatalog-of-finished-works.php">Галерея работ</a>
                            </div>
                            <div class='div-nav-link-footer'><a class='nav-link-footer' href="/baget_online">Рассчитать
                                    стоимость багета</a></div>
                        </div>
                    </div>
                    <div class='col-6'>
                        <div class="footer-name-razdel">
                            о компании
                        </div>
                        <div class='mt-4'>
                            <div class='div-nav-link-footer'><a class='nav-link-footer'
                                                                href="/contacts.php">Контакты</a>
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
            <path d="M30.7328 15.5C30.7328 23.9128 23.9128 30.7328 15.5 30.7328C7.08718 30.7328 0.267242 23.9128 0.267242 15.5C0.267242 7.08718 7.08718 0.267242 15.5 0.267242C23.9128 0.267242 30.7328 7.08718 30.7328 15.5Z"
                  stroke="#474A51" stroke-width="0.534484"/>
            <path d="M15.3501 5.70774C15.4545 5.60338 15.6237 5.60338 15.728 5.70774L17.4287 7.40846C17.5331 7.51283 17.5331 7.68204 17.4287 7.7864C17.3244 7.89076 17.1552 7.89076 17.0508 7.7864L15.5391 6.27465L14.0273 7.7864C13.9229 7.89076 13.7537 7.89076 13.6494 7.7864C13.545 7.68204 13.545 7.51283 13.6494 7.40846L15.3501 5.70774ZM15.2718 25.1875L15.2718 5.89671L15.8063 5.89671L15.8063 25.1875L15.2718 25.1875Z"
                  fill="#474A51"/>
        </svg>
    </div>
<? } ?>

<script>
    // <!-- Отправка GET-запроса для "ЯНДЕКС.ПОИСК", через FORM -->
    jQuery(document).ready(function ($) {

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

<style>
    .trail-flower{
        position: fixed;
        pointer-events: none;
        z-index: 9999;
        user-select: none;
        will-change: transform, opacity;
        transform-origin: center center;
        animation-name: floatOut;
        animation-timing-function: ease-out;
        animation-fill-mode: forwards;
    }

    @keyframes floatOut {
        from { opacity: 1; transform: translateY(0) rotate(var(--rot)) scale(var(--scale)); }
        to   { opacity: 0; transform: translateY(-24px) rotate(var(--rot)) scale(var(--scale)); }
    }

    @media (prefers-reduced-motion: reduce){
        .trail-flower{ animation: none !important; opacity: .85; }
    }

</style>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Настройки эффекта
        const trailSettings = {
            emoji: ["✨", "🖼️"], // символы/эмодзи
            size: { min: 14, max: 28 },            // размер «частиц» в px
            anim: { min: 600, max: 3000 },         // длительность анимации (мс)
            maxElements: 60,                        // максимум элементов в DOM
            minDistance: 10,                        // минимальное движение курсора (px), чтобы обрабатывать кадр
            inactivityTimeout: 5000,                // очистка после простоя (мс)

            // НОВОЕ: разрежение следа
            spacing: 40,    // целевое расстояние между элементами вдоль пути (px)
            jitter: 12       // случайное поперечное смещение (px) для естественности
        };

        const rnd = (a,b)=> Math.random()*(b-a)+a;
        const pick = arr => arr[Math.floor(Math.random()*arr.length)];

        let pool = []; // текущие элементы
        let x = null, y = null, firstMove = true, idleTimer = null;

        function scheduleIdleClear(){
            clearTimeout(idleTimer);
            idleTimer = setTimeout(clearTrail, trailSettings.inactivityTimeout);
        }

        function clearTrail(){
            if (!pool.length) return;
            pool.forEach(el => {
                el.style.animationDuration = "300ms";
                el.style.opacity = "0";
            });
            setTimeout(() => {
                pool.forEach(el => el.remove());
                pool.length = 0;
            }, 350);
        }

        function createFlower(cx, cy){
            const el = document.createElement("span");
            el.className = "trail-flower";
            el.textContent = pick(trailSettings.emoji);

            const size = rnd(trailSettings.size.min, trailSettings.size.max);
            el.style.left = cx + "px";
            el.style.top  = cy + "px";
            el.style.fontSize = size + "px";
            el.style.setProperty("--rot",  rnd(-30, 30).toFixed(2) + "deg");
            el.style.setProperty("--scale", rnd(0.9, 1.2).toFixed(2));
            el.style.animationDuration = rnd(trailSettings.anim.min, trailSettings.anim.max) + "ms";

            document.body.appendChild(el);
            pool.push(el);

            // лимитируем количество DOM-узлов
            if (pool.length > trailSettings.maxElements){
                const old = pool.shift();
                old.remove();
            }

            el.addEventListener("animationend", () => {
                const i = pool.indexOf(el);
                if (i > -1) pool.splice(i, 1);
                el.remove();
            }, { once: true });
        }

        // Раскладывает элементы через равные промежутки «spacing»
        function sprinkleBetween(x1, y1, x2, y2){
            const dx = x2 - x1, dy = y2 - y1;
            const dist = Math.hypot(dx, dy);
            const step = Math.max(1, trailSettings.spacing);

            if (dist <= step){
                // короткий шаг — просто поставим в конечной точке
                createFlower(x2, y2);
                return;
            }

            const steps = Math.floor(dist / step);
            // единичный перпендикуляр для «разброса»
            const nx = dist ? (-dy / dist) : 0;
            const ny = dist ? ( dx / dist) : 0;

            for (let i = 1; i <= steps; i++){
                const t = (i * step) / dist;
                const jitter = rnd(-trailSettings.jitter, trailSettings.jitter);
                createFlower(
                    x1 + dx * t + nx * jitter,
                    y1 + dy * t + ny * jitter
                );
            }
        }

        document.addEventListener("mousemove", e => {
            scheduleIdleClear();
            if (firstMove){ x = e.clientX; y = e.clientY; firstMove = false; return; }
            const dx = e.clientX - x, dy = e.clientY - y;
            if (Math.hypot(dx, dy) >= trailSettings.minDistance){
                sprinkleBetween(x, y, e.clientX, e.clientY);
                x = e.clientX; y = e.clientY;
            }
        });

        // поддержка тач-устройств с тем же разрежением
        let tx = null, ty = null, firstTouch = true;
        document.addEventListener("touchmove", e => {
            const t = e.touches[0];
            if (!t) return;
            scheduleIdleClear();
            if (firstTouch){ tx = t.clientX; ty = t.clientY; firstTouch = false; return; }
            const dx = t.clientX - tx, dy = t.clientY - ty;
            if (Math.hypot(dx, dy) >= trailSettings.minDistance){
                sprinkleBetween(tx, ty, t.clientX, t.clientY);
                tx = t.clientX; ty = t.clientY;
            }
        }, { passive: true });

        scheduleIdleClear();
    });
</script>

</body>

</html>