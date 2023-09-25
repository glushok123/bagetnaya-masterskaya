<?
    require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/header.php';

    $elementsSlider1 = [
        [
            'src' => '/assets/img/index/swiper-1/IMG_3263.webp',
            'desc' => 'Оформление классической акварели',
        ],
        [
            'src' => '/assets/img/index/swiper-1/IMG_2039.webp',
            'desc' => 'Постер в багетной раме',
        ],
        [
            'src' => '/assets/img/index/swiper-1/IMG_9232.webp',
            'desc' => 'Оформление гравюры',
        ],
        [
            'src' => '/assets/img/index/swiper-1/IMG_0260.webp',
            'desc' => 'Картина в двойном деревянном багете',
        ],
        [
            'src' => '/assets/img/index/swiper-1/IMG_0469.webp',
            'desc' => 'Натюрморт в овальном паспарту и раме',
        ],
        [
            'src' => '/assets/img/index/swiper-1/IMG_0482.webp',
            'desc' => 'Живопись в деревянном багете',
        ],
    ];

    $elementsSlider2 = [
        [
            'src' => '/assets/img/index/swiper-2/IMG_2265.webp',
            'desc' => 'Нестандартное оформление живописи',
        ],
        [
            'src' => '/assets/img/index/swiper-2/IMG_6566.webp',
            'desc' => 'Современный постер в раме',
        ],
        [
            'src' => '/assets/img/index/swiper-2/IMG_6644.webp',
            'desc' => 'Серия репродукций',
        ],
        [
            'src' => '/assets/img/index/swiper-2/IMG_7410.webp',
            'desc' => 'Оформление вышивки',
        ],
        [
            'src' => '/assets/img/index/swiper-2/IMG_9718.webp',
            'desc' => 'Подготовка домашней галереи',
        ],
        [
            'src' => '/assets/img/index/swiper-2/IMG_9708.webp',
            'desc' => 'Оформление фотографии',
        ],
    ];

    if (isMobile()) {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/mobile/index.php';
    }else{
        require_once $_SERVER['DOCUMENT_ROOT'] . '/template/section/desktop/index.php';
    }

    require_once $_SERVER['DOCUMENT_ROOT'] . '/template/layout/footer.php';
?>