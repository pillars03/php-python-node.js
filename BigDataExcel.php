<?php
/*
用mysql_unbuffered_query查询数据，减少内存占用
fputcsv 的时候刷新输出缓冲区
*/
$con = mysql_connect($host,$db_user,$db_pwd);
mysql_select_db($db_name);
$rh=mysql_unbuffered_query($sql,$con);

// 设定http输出头
$filename = time() . rand(10000, 99999) . '.csv';
header('Content-Type: application/vnd.ms-excel;charset=utf8');
header('Content-Disposition: attachment; filename=' . $filename);
header('Pragma: no-cache');
header('Expires: 0');
$fp = fopen('php://output', 'w');
//输出BOM头
fwrite($fp, chr(0XEF) . chr(0xBB) . chr(0XBF));
//输出头
fputcsv($fp, array('id', '角色名'));
$cnt = 0;
while ($value = mysql_fetch_assoc($rh)) {
    $cnt++;
    if ($cnt % 10000 == 0) { //刷新一下输出buffer，防止由于数据过多造成问题
        ob_flush();
        flush();
    }
    $cell = array(
    $value['id'],
    $value['name']
    );
    fputcsv($fp, $cell);
}
fclose($fp);
mysql_close($con);