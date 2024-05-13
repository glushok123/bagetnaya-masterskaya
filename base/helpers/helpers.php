<?php

/**
 * Function to generate random string.
 */
function randomString($n)
{

    $generated_string = "";

    $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    $len = strlen($domain);

    // Loop to create random string
    for ($i = 0; $i < $n; $i++) {
        // Generate a random index to pick characters
        $index = random_int(0, $len - 1);

        // Concatenating the character
        // in resultant string
        $generated_string = $generated_string . $domain[$index];
    }

    return $generated_string;
}

/**
 *
 */
function getSecureRandomToken()
{
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    return $token;
}

/**
 * Clear Auth Cookie
 */
function clearAuthCookie()
{

    unset($_COOKIE['series_id']);
    unset($_COOKIE['remember_token']);
    setcookie('series_id', '', ['expires' => -1, 'path' => '/']);
    setcookie('remember_token', '', ['expires' => -1, 'path' => '/']);
}

/**
 *
 */
function clean_input($data)
{
    $data = trim((string)$data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function paginationLinks($current_page, $total_pages, $base_url)
{

    if ($total_pages <= 1) {
        return false;
    }

    $html = '';

    if (!empty($_GET)) {
        // We must unset $_GET[page] if previously built by http_build_query function
        unset($_GET['page']);
        // To keep the query sting parameters intact while navigating to next/prev page,
        $http_query = "?" . http_build_query($_GET);
    } else {
        $http_query = "?";
    }

    $html = '<ul class="pagination text-center">';

    if ($current_page == 1) {

        $html .= '<li class="disabled"><a>First</a></li>';
    } else {
        $html .= '<li><a href="' . $base_url . $http_query . '&page=1">First</a></li>';
    }

    // Show pagination links

    //var i = (Number(data.page) > 5 ? Number(data.page) - 4 : 1);

    if ($current_page > 5) {
        $i = $current_page - 4;
    } else {
        $i = 1;
    }

    for (; $i <= ($current_page + 4) && ($i <= $total_pages); $i++) {
        ($current_page == $i) ? $li_class = ' class="active"' : $li_class = '';

        $link = $base_url . $http_query;

        $html = $html . '<li' . $li_class . '><a href="' . $link . '&page=' . $i . '">' . $i . '</a></li>';

        if ($i == $current_page + 4 && $i < $total_pages) {

            $html = $html . '<li class="disabled"><a>...</a></li>';
        }
    }

    if ($current_page == $total_pages) {
        $html .= '<li class="disabled"><a>Last</a></li>';
    } else {

        $html .= '<li><a href="' . $base_url . $http_query . '&page=' . $total_pages . '">Last</a></li>';
    }

    $html = $html . '</ul>';

    return $html;
}

/**
 * to prevent xss
 */
function xss_clean($string)
{
    return htmlspecialchars((string)$string, ENT_QUOTES, 'UTF-8');
}

/**
 * Сортировка ассоциативного массива по ключу
 *
 * array_sort
 *
 * @param mixed $array
 * @param mixed $on
 * @param mixed $order
 * @return void
 */
function array_sort($array, $on, $order = SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}

// возвращает расстояние между двумя цветами
function getDistanceFromColor($a, $b)
{
    list($r1, $g1, $b1) = $a;
    list($r2, $g2, $b2) = $b;

    return sqrt(pow($r2 - $r1, 2) + pow($g2 - $g1, 2) + pow($b2 - $b1, 2));
}

function isMobile()
{
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    // return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    return preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4));
}