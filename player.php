<?php

class Player {
    
    public function getPlayerCard($num, $arr){
        $playercard = [];
        for ($i=0; $i<$num; $i++) {
            $playercard[] = array_shift($arr);
        }
        return $playercard;
    }
    public function getNextPlayerCard($arr){
        $playernextcard  = array_shift($arr);
        return $playernextcard;
    }
    
}



?>