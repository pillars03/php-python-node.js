<?php
$filename='E:/heros/res';
$fileArr=scandir($filename);
$jsonArr=array();

//扫描文件名大小写
foreach($fileArr as $item){
    if($item!=strtolower($item)){
        var_dump($item);
    }
}
exit();
//扫描json中的大小写
foreach($fileArr as $value){
    if(stripos($value,'.json')!==FALSE){
        $jsonArr[]=$value;
    }
}
foreach ($jsonArr as $key => $value) {
    $json=file_get_contents($filename.'/'.$value);
    $json=json_decode($json,TRUE);
    if(isset($json['Content']['Content']['ObjectData']['Children'])){
        $obj=$json['Content']['Content']['ObjectData']['Children'];
        checkCase($obj);
    }else{
        // var_dump($value);
    }
}
function checkCase($obj){
    foreach ($obj as $value) {
        if(isset($value['Children'])){
            //递归
            checkCase($value['Children']);
        }else{
            if(isset($value['FileData']['Plist'])){
                if(strpos($value['FileData']['Plist'],'P')!==FALSE){
                    var_dump($value['FileData']['Plist']);
                    // return 1;
                }
            }
        }
    }
}
?>