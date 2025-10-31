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
                                                                href="/картины%20багетной%20мастерской.php">Картины и репродукции</a></div>
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
    /* Цветочки (эмодзи) */
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

    /* Линия (сегменты) */
    .trail-segment{
        position: fixed;
        pointer-events: none;
        z-index: 9998;
        will-change: opacity, transform;
        transform-origin: 0 0;
        transition: opacity .3s ease;
    }

    @media (prefers-reduced-motion: reduce){
        .trail-flower{ animation: none !important; opacity: .85; }
    }

    /* Плавающий переключатель режима (для удобства) */
    .cursor-mode-toggle{
        position: fixed;
        right: 12px;
        top: 12px;
        z-index: 10000;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(0,0,0,.6);
        color: #fff;
        font: 14px/1 system-ui, Segoe UI, Roboto, Arial, sans-serif;
        cursor: pointer;
        user-select: none;
        backdrop-filter: blur(6px);
    }

</style>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const trailSettings = {
            // 'flowers' или 'line'
            mode: 'line',

            // Общие
            maxElements: 120,        // лимит DOM-узлов (актуально для "цветочков")
            minDistance: 4,          // минимальное движение курсора (px) для обновления
            inactivityTimeout: 4000, // очистка после простоя (мс)

            // Цветочки
            emoji: ["🌸","✨","💫","🌼","🫧","🍀"],
            size: { min: 14, max: 28 },
            anim: { min: 600, max: 3000 },
            spacing: 40,
            jitter: 6,

            // ЛИНИЯ (canvas) — гладко и без изломов
            line: {
                color: "#ad1f2d",
                thickness: 2.5,
                spacing: 3,          // меньше = плавнее/плотнее дискретизация
                fade: 0.20,          // 0.10–0.40: скорость «таянья» (меньше = длиннее хвост)
                tension: 1.0,        // 1.0 = классический Catmull–Rom; 0.8–0.95 сгладит сильнее
                inputSmoothing: 0.18 // EMA 0..0.35: сглаживание входных точек
            }
        };

        const rnd = (a,b)=> Math.random()*(b-a)+a;
        const pick = arr => arr[Math.floor(Math.random()*arr.length)];

        // ========= Цветочки (DOM) =========
        const pool = [];
        function trimPoolIfNeeded(){
            const overflow = pool.length - trailSettings.maxElements;
            if (overflow > 0){
                for (let i = 0; i < overflow; i++){
                    const el = pool.shift();
                    el?.remove();
                }
            }
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
            trimPoolIfNeeded();
            el.addEventListener("animationend", () => {
                const i = pool.indexOf(el);
                if (i > -1) pool.splice(i, 1);
                el.remove();
            }, { once: true });
        }
        function sprinkleFlowers(x1, y1, x2, y2){
            const dx = x2 - x1, dy = y2 - y1;
            const dist = Math.hypot(dx, dy);
            const step = Math.max(1, trailSettings.spacing);
            if (dist <= step){ createFlower(x2, y2); return; }
            const steps = Math.floor(dist / step);
            const nx = dist ? (-dy / dist) : 0;
            const ny = dist ? ( dx / dist) : 0;
            for (let i = 1; i <= steps; i++){
                const t = (i * step) / dist;
                const jitter = rnd(-trailSettings.jitter, trailSettings.jitter);
                createFlower(x1 + dx * t + nx * jitter, y1 + dy * t + ny * jitter);
            }
        }

        // ========= Линия (CANVAS, Catmull–Rom → Bézier + EMA) =========
        let canvas, ctx, cw = 0, ch = 0, rafStarted = false;
        const pts = [];       // буфер точек
        let fx = null, fy = null; // фильтрованные координаты (EMA)

        function ensureCanvas(){
            if (canvas) return;
            canvas = document.createElement('canvas');
            canvas.id = 'cursorTrailCanvas';
            Object.assign(canvas.style, {
                position: 'fixed',
                inset: '0',
                width: '100vw',
                height: '100vh',
                pointerEvents: 'none',
                zIndex: 9997 // ниже «цветочков»
            });
            document.body.appendChild(canvas);
            ctx = canvas.getContext('2d');
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);
            if (!rafStarted){ rafStarted = true; requestAnimationFrame(loop); }
        }
        function resizeCanvas(){
            const dpr = Math.max(1, window.devicePixelRatio || 1);
            cw = window.innerWidth; ch = window.innerHeight;
            canvas.width = Math.ceil(cw * dpr);
            canvas.height = Math.ceil(ch * dpr);
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0); // рисуем в CSS-пикселях
        }
        function fadeCanvas(){
            // Плавно "стираем" предыдущие штрихи
            ctx.save();
            ctx.globalCompositeOperation = 'destination-out';
            ctx.fillStyle = `rgba(0,0,0,${trailSettings.line.fade})`;
            ctx.fillRect(0, 0, cw, ch);
            ctx.restore();
        }
        function drawCRLastSegment(){
            const n = pts.length;
            if (n < 2) return;

            ctx.strokeStyle = trailSettings.line.color;
            ctx.lineWidth = trailSettings.line.thickness;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';

            if (n === 2){
                ctx.beginPath();
                ctx.moveTo(pts[0].x, pts[0].y);
                ctx.lineTo(pts[1].x, pts[1].y);
                ctx.stroke();
                return;
            }

            if (n >= 4){
                // сегмент p1 -> p2 с опорой на p0,p1,p2,p3
                const p0 = pts[n-4], p1 = pts[n-3], p2 = pts[n-2], p3 = pts[n-1];
                const k = (trailSettings.line.tension ?? 1) / 6; // классический CR

                const c1x = p1.x + (p2.x - p0.x) * k;
                const c1y = p1.y + (p2.y - p0.y) * k;
                const c2x = p2.x - (p3.x - p1.x) * k;
                const c2y = p2.y - (p3.y - p1.y) * k;

                ctx.beginPath();
                ctx.moveTo(p1.x, p1.y);
                ctx.bezierCurveTo(c1x, c1y, c2x, c2y, p2.x, p2.y);
                ctx.stroke();
            } else {
                // n === 3 — аккуратный квадратичный участок
                const p0 = pts[0], p1 = pts[1], p2 = pts[2];
                const m0x = (p0.x + p1.x)/2, m0y = (p0.y + p1.y)/2;
                const m1x = (p1.x + p2.x)/2, m1y = (p1.y + p2.y)/2;
                ctx.beginPath();
                ctx.moveTo(m0x, m0y);
                ctx.quadraticCurveTo(p1.x, p1.y, m1x, m1y);
                ctx.stroke();
            }
        }
        function addLinePointsBetween(x1, y1, x2, y2){
            const dx = x2 - x1, dy = y2 - y1;
            const dist = Math.hypot(dx, dy) || 0.0001;
            const step = Math.max(1, trailSettings.line.spacing);
            const steps = Math.max(1, Math.floor(dist / step));

            for (let i = 1; i <= steps; i++){
                const t = (i * step) / dist;
                let sx = x1 + dx * t;
                let sy = y1 + dy * t;

                // EMA: сглаживаем входные точки, чтобы убрать мелкие «ламаности»
                const a = Math.max(0, Math.min(1, trailSettings.line.inputSmoothing ?? 0));
                if (fx == null){ fx = sx; fy = sy; }
                else { fx += (sx - fx) * a; fy += (sy - fy) * a; }

                pts.push({ x: fx, y: fy });
                if (pts.length > 240) pts.splice(0, pts.length - 240);
                drawCRLastSegment();
            }
        }
        function clearLine(){
            if (!ctx) return;
            ctx.clearRect(0, 0, cw, ch);
            pts.length = 0;
            fx = fy = null;
        }
        function loop(){
            // Постоянный fade, чтобы хвост «таял»
            if (ctx && canvas && canvas.style.display !== 'none'){
                fadeCanvas();
            }
            requestAnimationFrame(loop);
        }

        // ========= Общий ввод указателя =========
        let x = null, y = null, firstMove = true, idleTimer = null;
        let tx = null, ty = null, firstTouch = true;

        function scheduleIdleClear(){
            clearTimeout(idleTimer);
            idleTimer = setTimeout(() => {
                if (trailSettings.mode === 'line') {
                    clearLine();
                } else {
                    pool.forEach(el => el.style.opacity = '0');
                    setTimeout(() => { pool.splice(0).forEach(el => el.remove()); }, 250);
                }
            }, trailSettings.inactivityTimeout);
        }

        function onPointerMove(px, py){
            scheduleIdleClear();
            if (firstMove){ x = px; y = py; firstMove = false; return; }
            const dx = px - x, dy = py - y;
            if (Math.hypot(dx, dy) < trailSettings.minDistance) return;

            if (trailSettings.mode === 'line'){
                ensureCanvas();
                canvas.style.display = 'block';
                addLinePointsBetween(x, y, px, py);
            } else {
                sprinkleFlowers(x, y, px, py);
            }
            x = px; y = py;
        }

        document.addEventListener("mousemove", e => onPointerMove(e.clientX, e.clientY));
        document.addEventListener("touchmove", e => {
            const t = e.touches[0];
            if (!t) return;
            scheduleIdleClear();
            if (firstTouch){ tx = t.clientX; ty = t.clientY; firstTouch = false; return; }
            const dx = t.clientX - tx, dy = t.clientY - ty;
            if (Math.hypot(dx, dy) >= trailSettings.minDistance){
                if (trailSettings.mode === 'line'){
                    ensureCanvas();
                    canvas.style.display = 'block';
                    addLinePointsBetween(tx, ty, t.clientX, t.clientY);
                } else {
                    sprinkleFlowers(tx, ty, t.clientX, t.clientY);
                }
                tx = t.clientX; ty = t.clientY;
            }
        }, { passive: true });

        // ========= Переключатель режима (если есть #cursorModeToggle) =========
        const toggle = document.getElementById('cursorModeToggle');
        function updateToggleLabel(){
            if (!toggle) return;
            toggle.textContent = 'Режим: ' + (trailSettings.mode === 'flowers' ? 'Цветочки' : 'Линия');
        }
        function setMode(mode){
            if (mode !== 'flowers' && mode !== 'line') return;
            trailSettings.mode = mode;
            updateToggleLabel();
            // очистим текущий след
            firstMove = true; firstTouch = true;
            if (mode === 'line'){ ensureCanvas(); canvas.style.display = 'block'; clearLine(); }
            else { if (canvas) canvas.style.display = 'none'; pool.splice(0).forEach(el => el.remove()); }
        }
        if (toggle){
            toggle.addEventListener('click', () => setMode(trailSettings.mode === 'flowers' ? 'line' : 'flowers'));
            updateToggleLabel();
        }

        // Экспорт в консоль
        window.cursorTrail = {
            setMode,
            settings: trailSettings,
            clear: () => { trailSettings.mode==='line' ? clearLine() : pool.splice(0).forEach(el=>el.remove()); }
        };
    });


</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(m,e,t,r,i,k,a){
        m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        k=e.createElement(t), a=e.getElementsByTagName(t)[0],
            k.async=1; k.src=r; a.parentNode.insertBefore(k,a);
    })(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(60934651, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript>
    <div>
        <img src="https://mc.yandex.ru/watch/60934651" style="position:absolute; left:-9999px;" alt="">
    </div>
</noscript>
<!-- /Yandex.Metrika counter -->


</body>

</html>