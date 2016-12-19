<?php
$filename="E:/fengshen/res";
$fileArr=scandir($filename);
$jsonArr=array();
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