<?php

$connect = mysqli_connect("localhost", "root", "", "testing1");
$connect->set_charset("utf8");
$query = "
 SELECT * FROM organogram   
"; //order by ordering desc  ordering=-1 desc, order by  ordering
$result = mysqli_query($connect, $query);
$output = array();
$json_data = array();

//print_r($output);
while ($row = mysqli_fetch_array($result)) {
    $sub_data["id"] = $row["id"];
    $json_sub_data["id"] = $row["id"];
    $sub_data["parent"] = $row["parent_id"];
    $json_sub_data["parent"] = $row["parent_id"] == 0 ? "#" :  $row["parent_id"];
    $sub_data["text"] = $row["name"];
    $json_sub_data["text"] = $row["name"];
    $sub_data["parent_id"] = $row["parent_id"];
    $data[] = $sub_data;
    $json_data[] = $json_sub_data;
}


//foreach ($data as $key => &$value) {
//    $output[$value["id"]] = &$value;
//}
//foreach ($data as $key => &$value) {
//    if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
//        $output[$value["parent_id"]]["nodes"][] = &$value;
//    }
//}
//foreach ($data as $key => &$value) {
//    if ($value["parent_id"] && isset($output[$value["parent_id"]])) {
//        unset($data[$key]);
//    }
//}


//echo '<pre>';
//print_r($json_data);
//echo '</pre>';


echo json_encode($json_data);

