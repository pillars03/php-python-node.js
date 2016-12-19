<?php
 
$host       = '';
$user       = '';
$password   = '';
$database   = '';
 
$time_start=microtime(true);
$result = array('1'=>0,'1'=>0,'1'=>0);
 
//异步方式[并发请求]
foreach ($result as $key=>$value) {
    $obj = new mysqli($host, $user, $password, $database);
    $links[spl_object_hash($obj)] = array('value'=>$key, 'link'=>$obj);
}
foreach ($links as $value) {
    $tmp[] = $value['link'];
    $value['link']->query("SELECT * FROM gm_user WHERE game='{$value['value']}' limit 30", MYSQLI_ASYNC);
}
//检查
// $read = $errors = $reject = $tmp;
// $re = mysqli_poll($read, $errors, $reject, 1);
// if (false === $re) {
//     die('mysqli_poll failed');
// }
foreach ($tmp as $obj) {
    $sql_result = $obj->reap_async_query();
    if (is_object($sql_result)) {
        $sql_result_array = $sql_result->fetch_all(MYSQLI_ASSOC);//只有一行
        $sql_result->free();
        var_dump($sql_result_array);
        // $hash = spl_object_hash($obj);
        // $key_in_result = $links[$hash]['value'];
        // $result[$key_in_result] = $sql_result_array['total'];
    } else {
        echo $obj->error, "\n";
    }
}
// var_dump($result);
