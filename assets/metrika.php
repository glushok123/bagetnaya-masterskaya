<script type="text/javascript">
    /* tag.js подключается не сразу, а при первом действии посетителя или через 3 с —
       иначе он занимает основной поток как раз в момент отрисовки страницы.
       Очередь ym(...) работает и до загрузки: вызовы копятся в ym.a и обрабатываются после. */
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();

        var loaded = false;

        function load() {
            if (loaded) return;
            loaded = true;
            k = e.createElement(t);
            a = e.getElementsByTagName(t)[0];
            k.async = 1;
            k.src = r;
            a.parentNode.insertBefore(k, a);
        }

        /* только намеренные действия: mousemove и scroll срабатывают сами по себе
           (эмуляция, инерция прокрутки) и будят скрипт ещё во время отрисовки */
        ['pointerdown', 'touchstart', 'click', 'keydown', 'wheel'].forEach(function (ev) {
            e.addEventListener(ev, load, {once: true, passive: true});
        });
        setTimeout(load, 3500);
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
