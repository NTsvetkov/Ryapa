<?php

// RSS XML output for RSS readers

require("db.inc.php");

$orders = array();
$sql = "SELECT * FROM `orders` ORDER BY `priority` DESC, `id` ASC";
$q = $dblink->query($sql);
$i = 0;
if (count($q) > 0) {
    $data = '<?xml version="1.0" encoding="UTF-8" ?>';
    $data .= '<rss version="2.0">';
    $data .= '<channel>';
    $data .= '<title>Erepublik bulgarian battle orders</title>';
    $data .= '<link>https://erepublik.com/en</link>';
    $data .= '<description>Battle orders for bulgarian airforces unit</description>';
    while ($row = $q->fetchArray(SQLITE3_ASSOC)) {
        $link = empty($row['link']) ? "" : ', Връзка: ' . $row['link'];
        $data .= '<item>';
        $data .= '<title>' . $row['caption'] . '</title>';
        $data .= '<link>' . $link . '</link>';
        $data .= '<description>Дата: ' . $row['date'] . ', Приоритет: ' . $row['priority'] . $link . '</description>';
        $data .= '</item>';
    }
    $data .= '</channel>';
    $data .= '</rss> ';
}

header('Content-Type: application/xml');
echo $data;
