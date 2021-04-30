<?php

class Player {
    
    public function getPlayerCard($num, $arr){
        $playercard = [];
        for ($i=0; $i<$num; $i++) {
            array_push($playercard, array_shift($arr));
        }
        return $playercard;
    }
    
    
}



?>