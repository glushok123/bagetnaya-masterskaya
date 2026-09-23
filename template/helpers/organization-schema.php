<?php
/**
 * Микроразметка schema.org организации и трёх салонов (JSON-LD).
 * Помогает Яндексу связать сайт с карточками салонов на Картах и показать
 * адреса, телефоны и часы работы прямо в сниппете.
 *
 * Выводится на главной и в контактах: страница задаёт $organizationSchema = true
 * до подключения шапки. Данные должны совпадать со страницей /contacts.
 */

$openingHours = [[
    '@type' => 'OpeningHoursSpecification',
    'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
    'opens' => '09:00',
    'closes' => '21:00',
]];

$salon = function (string $metro, string $street, string $phone, array $extra = []) use ($openingHours) {
    return array_merge([
        '@type' => 'LocalBusiness',
        'name' => 'Багетная мастерская №1 — м. ' . $metro,
        'url' => SITE_ORIGIN . '/contacts',
        'image' => SITE_ORIGIN . '/assets/img/logo.PNG',
        'telephone' => $phone,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $street,
            'addressLocality' => 'Москва',
            'addressCountry' => 'RU',
        ],
        'openingHoursSpecification' => $openingHours,
    ], $extra);
};

$organization = [
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Багетная мастерская №1',
    'url' => SITE_ORIGIN . '/',
    'logo' => SITE_ORIGIN . '/assets/img/logo.PNG',
    'email' => 'Manager@bagetnaya-masterskaya.com',
    'telephone' => '+7 977 427-44-77',
    'department' => [
        $salon('Новокузнецкая', 'Климентовский переулок, 6', '+7 977 824-42-12', [
            'geo' => ['@type' => 'GeoCoordinates', 'latitude' => 55.741182, 'longitude' => 37.630127],
        ]),
        $salon('Арбатская', 'ул. Арбат, д. 1', '+7 926 865-92-95'),
        $salon('Баррикадная', 'ул. Баррикадная, 21/34 с3', '+7 977 314-77-71'),
    ],
];
?>
<script type="application/ld+json"><?= json_encode($organization, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
