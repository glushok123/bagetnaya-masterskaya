<?php
header('Content-Type: application/json; charset=utf-8');

$xml = simplexml_load_file('../../sitemap.xml');
$json = json_encode($xml);
$data = json_decode($json, TRUE);

$ar = [];

foreach ($data['url'] as $item) {
    $originUrl = $item['loc'];
    $localUrl = str_replace('https://bagetnaya-masterskaya.com', 'http://virtual-baget-curent', $item['loc']);
    $tags = get_meta_tags($localUrl);

    $ar[] = [
        "url" => $originUrl,
        "title" => page_title($localUrl),
        "description" => $tags['description'],
        "keywords" => $tags['keywords']
    ];
    //echo '<pre>';
    //print_r($ar);
    //echo '</pre>';

}
echo json_encode($ar);
function page_title($url) {
    $fp = file_get_contents($url);
    if (!$fp)
        return null;
    $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
    if (!$res)
        return null;
    // Clean up title: remove EOL's and excessive whitespace.
    $title = preg_replace('/\s+/', ' ', $title_matches[1]);
    $title = trim($title);
    return $title;
}

function parsePrintedArray($s){
    $lines = explode("\n",$s);
    $a = array();
    foreach ($lines as $line){
        if (strpos($line,"=>") === false)
            continue;
        $parts = explode('=>',$line);
        $a[trim($parts[0],'[] ')] = trim($parts[1]);
    }
    return $a;
}