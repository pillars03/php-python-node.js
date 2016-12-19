<?php
//遍历目录下的所有子目录和文件
function my_scandir($dir){
    $files=array();
    if(is_dir($dir)){
        if($handle=opendir($dir)){
            while(($file=readdir($handle))!==false){
                if($file!="." && $file!=".."){
                    if(is_dir($dir."/".$file)){
                        $files[$file]=my_scandir($dir."/".$file);
                    }
                    else{
                        $files[]=$dir."/".$file;
                    }
                }
            }
        }
        closedir($handle);
        return $files;
    }
}
print_r(my_scandir('D:/data'));
?>