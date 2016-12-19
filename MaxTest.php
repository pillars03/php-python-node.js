<?php
function maxTest($a,$b,$c){
        return $a>$b?($a>$c?$a:$c):($b>$c?$b:$c);
}
echo maxTest(6,5,8);
?>