<?php

class Dealer {
    
    public function getDealerCard($num, $arr){
        $dealercard = [];
        for ($i=0; $i<$num; $i++) {
            array_push($dealercard, array_shift($arr));
        }
        return $dealercard;
    }
}



?>