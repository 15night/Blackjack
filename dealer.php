<?php

class Dealer {
    
    public function getDealerCard($num, $arr){
        $dealercard = [];
        for ($i=0; $i<$num; $i++) {
            $dealercard[] = array_shift($arr);
        }
        return $dealercard;
    }
    

}



?>