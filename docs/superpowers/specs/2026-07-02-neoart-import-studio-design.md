# Neoart Import Studio — дизайн

> Дата: 2026-07-02 · Ветка: `dev` · Автор: andrey + Claude
>
> Инструмент в админке для автоматической выгрузки каталога багета от поставщика
> Neoart (API), нарезки фото на две картинки (каталог + конструктор), ручной
> проверки/правки менеджером и переноса одобренных товаров в живой каталог.

## 1. Контекст и цель

Сейчас багет от Neoart заводится либо вручную (`base/addnewbaget.php` — человек сам
режет listimg/imgconst и загружает), либо кривым авто-импортом
(`admin/request/updateCatalogBySiteNeoartImage.php`, где блок кропа закомментирован и
в `listimg`, и в `imgconst` пишется одно и то же **сырое фото угла** — поэтому
конструктор тайлит фото угла как прямой профиль).

Эксперимент `experiment/neoart-parser/` уже доказал пайплайн:
- `parse.php` — тянет JSON-фид Neoart, сверяет с БД, качает 2697 сырых фото;
- `cut.py` (Python+Pillow+numpy) — режет фото угла на `imgconst` (прямая планка,
  тайлится `repeat-x`) и `listimg` (угол 150×100, превью каталога); ~98% успех,
  ~2% во «флагах» (другая композиция фото).

Цель — превратить эксперимент в постоянный инструмент в админке: **скачать →
нарезать → проверить/поправить → одобрить → опубликовать**, всё self-service,
без Python (на хостинге его либ нет).

## 2. Как устроен каталог и конструктор (справка)

Таблица `catalog_baget`, ключевые поля: `type`(wood/plast/alum/pasp),
`publicvendor`(наш арт.), `vendor`(арт. поставщика), `width`, `widthwithout`,
`price`, `storage`, `listimg`, `imgconst`.

- **listimg** — превью каталога, вид угла рамы. Файл в `/bi/` (у pasp — `/pi/`).
  Отображается в `base/getcatalog.php`.
- **imgconst** — текстура профиля для конструктора. В
  `constructor_baget/block_2_maket.php` четыре полосы `#bgtop/#bgbot/#bgleft/#bgright`
  имеют `background:url(/bi/{imgconst}) repeat-x` → **imgconst обязан быть прямым
  сечением планки (внешний край → внутренний), бесшовно тайлящимся по длине.**

Требования к двум картинкам:

| | listimg (каталог) | imgconst (конструктор) |
|---|---|---|
| Что это | угол рамы со стыком 45° | прямой кусок планки |
| Размер | 150×100, cover | высота = ширина профиля, тайлится repeat-x |
| Путь публикации | `/bi/{publicvendor}{vendor}.jpg` | `/bi/{publicvendor}t{vendor}.jpg` |

## 3. Зафиксированные решения

- **Обработка картинок — чистый PHP+GD на хостинге.** Проверено на проде:
  PHP 8.5.0 + GD 2.3.3 есть; Python 3.8.6 есть, но Pillow/numpy НЕ установлены;
  web-SAPI exec не подтверждён. Значит алгоритм `cut.py` портируем на PHP+GD, без
  зависимости от Python/pip/exec. См. память `hosting-capabilities`.
- **Охват: дерево / пластик / алюминий** (одинаковая композиция фото «угол+окно»,
  один алгоритм нарезки, путь `/bi/`). Паспарту — вне охвата (другой тип фото,
  свой прод-импортёр).
- **Прогресс — чанковый AJAX-поллинг из браузера** (не SSE, не фоновый воркер):
  устойчиво к `max_execution_time`, возобновляемо, живые ошибки видно сразу.
- **Визуальный редактор — клиентский canvas-кроп** (Cropper.js через CDN),
  координаты уходят на сервер, GD режет из оригинала raw (макс. качество).
- **publicvendor при публикации** — правило из `base/addnewbaget.php`:
  `AUTO_INCREMENT(catalog_baget) + 6000`. *(при внедрении подтвердить, что диапазон
  не конфликтует; у паспарту исторически был свой 12000+)*
- **Качество PHP+GD-нарезки** ≈ Python-версии, но не 1:1 — пороги детекции белого
  окна подбираются заново. Допускается, что первый прогон даст чуть больше
  «флагнутых» позиций; менеджер добивает их вручную в редакторе.

## 4. Модель данных (SQL заводится вручную на хостинге — миграций нет)

Префикс `neoart_`. Кодировка/collation — как у остальных таблиц проекта.

### `neoart_import_run` — один запуск скачивания (батч)
- `id` PK AI
- `catalog` VARCHAR(8) — wood/plast/alum
- `status` ENUM('running','done','error','canceled')
- `total`, `downloaded`, `failed`, `skipped` INT DEFAULT 0
- `started_at`, `finished_at` DATETIME NULL
- `error` TEXT NULL

### `neoart_item` — строка на артикул поставщика (сердце staging)
- `id` PK AI
- `run_id` INT — последний запуск, тронувший позицию
- `catalog` VARCHAR(8)
- `vendor` VARCHAR(64) — арт. поставщика; UNIQUE (`catalog`,`vendor`)
- `name` VARCHAR(255)
- `section_id` VARCHAR(32), `section_name` VARCHAR(255)
- `width_mm`, `widthwithout_mm`, `height_mm` INT DEFAULT 0
- `price_base` DECIMAL(10,2), `price_chop` DECIMAL(10,2) NULL, `price_final` INT
- `storage` INT DEFAULT 0
- `raw_img`, `listimg`, `imgconst` VARCHAR(255) NULL — имена файлов в staging
- `cut_status` ENUM('none','auto_ok','auto_flagged','manual','error') DEFAULT 'none'
- `cut_flags` VARCHAR(128) NULL — напр. "notwhite,tiny"
- `in_catalog` TINYINT(1) DEFAULT 0 — vendor уже есть в catalog_baget
- `catalog_publicvendor` VARCHAR(32) NULL — арт. в каталоге (если есть/после публикации)
- `review_status` ENUM('pending','approved','rejected','published') DEFAULT 'pending'
- `approved_at` DATETIME NULL
- `download_error` VARCHAR(255) NULL
- `created_at`, `updated_at` DATETIME

### `neoart_import_log` — отдельная табличка ошибок/событий
- `id` PK AI
- `run_id` INT NULL
- `vendor` VARCHAR(64) NULL
- `stage` ENUM('download','cut','publish')
- `message` VARCHAR(512)
- `created_at` DATETIME

### Папки картинок (gitignore; и локально, и на проде)
```
/neoart_import/raw/<catalog>/<vendor>.jpg       — сырьё от поставщика
/neoart_import/listimg/<catalog>/<vendor>.jpg   — превью каталога
/neoart_import/imgconst/<catalog>/<vendor>.jpg  — профиль конструктора
```
Web-доступны для превью в админке. Имя файла — `safe_name(vendor)` (как в parse.php:
слэши/бэкслэши → `-`, прочее небезопасное → `_`).

## 5. Компоненты

### UI
- Новая вкладка «Импорт Neoart» в `admin/view/ul_tab.php`, тело в новом
  `admin/view/neoart_import.php` (подключается из `admin/view/div_tab.php`).
- JS — отдельный `admin/assets/js/neoart_import.js` (не раздуваем `app.js`).
- Стили — Bootstrap 5 + toastr + DataTables (уже подключены в `admin/index.php`);
  Cropper.js добавляется через CDN.

Экран делится на три зоны:
1. **Запуск** — выбор каталога, кнопки «Скачать базу» и «Нарезать картинки»,
   два прогресс-бара, панель «Ошибки» (из `neoart_import_log`).
2. **Грид ревью** — карточки/таблица товаров с фильтрами: все / флагнутые
   (требуют правки) / уже в каталоге / поиск по vendor. У каждого: 3 превью
   (raw, listimg, imgconst), бейдж статуса, бейдж «в каталоге», кнопки «править»,
   «одобрить», «отклонить». Массовый выбор + «одобрить выбранные».
3. **Карточка/редактор** (модалка) — вся инфа по товару + визуальный кроп-редактор.

### Эндпоинты `admin/request/neoart/`
Каждый — по образцу существующих: `require_once` connect + authCheck, POST, JSON-ответ.

1. **`run_start.php`** — POST `catalog`. Тянет JSON-фид (кеш
   `neoart_import/_cache/catalog_<id>.json`), считает цены как прод
   (`updateCatalogBySiteNeoart.php`: wood/alum ×auto, plast ×base), сверяет vendor с
   `catalog_baget` (→ `in_catalog`) и с `neoart_item`, создаёт `neoart_import_run`,
   upsert'ит `neoart_item`. Возвращает `run_id` + список vendor'ов на скачку.
2. **`run_download_chunk.php`** — POST `run_id`, `offset`, `size`. Качает следующие
   N сырых фото (curl_multi, ретраи как в parse.php), пишет файлы, обновляет
   счётчики run + `raw_img`/`download_error`, ошибки → лог. Возвращает
   `{done,total,ok,failed}`.
3. **`cut_chunk.php`** — POST `catalog`/`run_id`, `offset`, `size`. PHP+GD-нарезка
   следующих N raw → listimg/imgconst, ставит `cut_status`/`cut_flags`. Возвращает
   прогресс.
4. **`items_list.php`** — POST `catalog`, `filter`, `query`, `page`. Грид ревью.
5. **`item_get.php`** — POST `id`. Полная инфа + URL'ы raw/listimg/imgconst.
6. **`item_save_crop.php`** — POST `id`, `which`(listimg|imgconst), координаты кропа.
   GD режет из raw → целевой файл, `cut_status='manual'`.
7. **`item_upload.php`** — POST `id`, `which`(raw|listimg|imgconst), файл. Ручная
   загрузка своего изображения.
8. **`item_reset.php`** — POST `id`. Перезапуск авто-нарезки одной позиции.
9. **`item_approve.php`** — POST `id[]`. Публикация (см. §8).
10. **`item_reject.php`** — POST `id`. Отклонить/удалить из staging.

### Библиотека нарезки — `admin/helpers/NeoartCutter.php` (PHP+GD)
Порт `cut.py`. Публичные методы:
- `cut(string $rawPath, string $listOut, string $constOut): array` → `['cut_status','cut_flags','listimg_size','imgconst_size']`
- `cropListimg(string $rawPath, array $rect, string $out): void` — ручной кроп 150×100
- `cropImgconst(string $rawPath, array $rect, string $out): void` — ручной кроп полосы

Алгоритм (из `cut.py`, пороги заново): content-bbox (отсечь белый фон) → детекция
белого «окна» как самого длинного непрерывного блока белых строк/столбцов →
`imgconst` = верхняя планка над окном с обрезкой белых краёв; `listimg` = угол
(top-right + окно) cover 150×100. Флаги: `no-window`, `notwhite`, `tiny`, `narrow`,
`top=0`. Флагнутые попадают в фильтр «требуют правки».

## 6. Поток данных

```
[Neoart API JSON] --run_start--> neoart_import_run + neoart_item (pending, in_catalog)
                                        |
[Neoart API image] --download_chunk--> /neoart_import/raw/... + raw_img/counters
                                        |
        raw --cut_chunk (PHP+GD)--> /neoart_import/{listimg,imgconst}/... + cut_status
                                        |
менеджер: items_list -> item_get -> [редактор: save_crop / upload / reset]
                                        |
              item_approve --> /bi/{pv}{vendor}.jpg + /bi/{pv}t{vendor}.jpg
                          --> INSERT catalog_baget --> review_status='published'
```

## 7. Прогресс и обработка ошибок

- **Скачивание/нарезка**: чанковый поллинг. JS: `offset=0`; цикл
  `POST chunk {offset,size} → рисуем бар → offset+=size` пока `done<total`.
  Возобновляемо: готовые файлы (размер>1KB) пропускаются.
- **Ошибки скачивания**: ретраи (3), затем `download_error` + запись в
  `neoart_import_log`; панель «Ошибки» со списком vendor'ов и кнопкой «повторить».
- **Флаги нарезки**: `cut_flags` сохраняются; фильтр «требуют ручной правки»
  выводит такие позиции наверх.
- **Публикация**: транзакция; при ошибке rollback + лог `stage='publish'`.

## 8. Одобрение / перенос в каталог

- **«Уже есть»**: `in_catalog=1` (vendor совпал с `catalog_baget.vendor`) → бейдж
  «в каталоге (арт. {catalog_publicvendor})», кнопка переноса заблокирована.
  Обновление цен/остатков существующих — вне охвата (есть свой прод-джоб).
- **Публикация нового** (`item_approve.php`):
  1. Валидация: есть `listimg` и `imgconst`, `in_catalog=0`, `review_status!='published'`.
  2. `publicvendor = intval(AUTO_INCREMENT(catalog_baget)) + 6000`.
  3. Копия staging → `/bi/`: `listimg → {publicvendor}{safe(vendor)}.jpg`,
     `imgconst → {publicvendor}t{safe(vendor)}.jpg` (как в `addnewbaget.php`).
  4. `INSERT INTO catalog_baget(type,publicvendor,vendor,width,widthwithout,price,
     storage,listimg,imgconst)` из полей `neoart_item`.
  5. `review_status='published'`, `catalog_publicvendor=publicvendor`.
  - Массовое одобрение: цикл по выбранным id.
- **Вся доступная инфа** по товару (name, section, width/widthwithout/height, цены
  base/chop/final, остаток, флаги, статусы) видна в карточке.

## 9. Фазы реализации

1. **Фундамент**: SQL (3 таблицы), staging-папки, `.gitignore`, конфиг каталогов.
2. **Скачивание**: `run_start` + `run_download_chunk` + прогресс-UI + панель ошибок.
3. **Нарезка**: `NeoartCutter.php` (PHP+GD порт) + `cut_chunk` + флаги.
4. **Ревью**: `items_list` + `item_get` + грид/карточка + фильтры + бейдж «в каталоге».
5. **Редактор**: Cropper.js + `item_save_crop` + `item_upload` + `item_reset` +
   repeat-x-предпросмотр imgconst.
6. **Публикация**: `item_approve` (+ массово) + `item_reject`.

## 10. Вне охвата (YAGNI)

- Паспарту (catalog 104).
- Обновление цен/остатков уже существующих товаров (есть прод-джоб).
- Автопланировщик/cron — запуск только руками из админки.
- Правки в самом `experiment/neoart-parser/` — он остаётся как есть (референс).
