<?php

require ("db.inc.php");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$orders = array();
$sql = "SELECT caption, link, date, priority, importance, country
    FROM `orders`
    ORDER BY importance DESC, priority DESC, id ASC";
$q = $dblink->query($sql);
$i = 0;
if (count($q) > 0) {
    while ($row = $q->fetchArray(SQLITE3_ASSOC)) {
        $orders[$i]['caption'] = $row['caption'];
        $orders[$i]['link'] = empty($row['link']) ? "javascript:void(0);" : $row['link'];
        $orders[$i]['date'] = $row['date'];
        $orders[$i]['priority'] = $row['priority'];
        $orders[$i]['country'] = $row['country'];
        $orders[$i]['importance'] = $row['importance'];
        $orders[$i]['countryid'] = array_search($row['country'], $countries);
        $i++;
    }
} else {
    
}
//echo json_encode($orders);
echo json_encode($orders, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
