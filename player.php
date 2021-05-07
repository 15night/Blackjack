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
    public function expectPlayerSum($pfp, $arr){
        $ex_player=[];
        foreach ($arr as $value){
            switch ($value) {
                case strpos($value, 'J')!==false:
                    $ex_player[]= $pfp+10;
                    break;
                case strpos($value, 'Q')!==false:
                    $ex_player[]= $pfp+10;
                    break;
                case strpos($value, 'K')!==false:
                    $ex_player[]= $pfp+10;
                    break;
                case strpos($value, 'A')!==false:
                    $ex_player[]= $pfp+1;
                    break;
                default:
                    $ex_player[]= $pfp+ preg_replace('/[^0-9]/', '', $value);
                    break;
             }
        }
        return $ex_player; 
    }
    public function expectPlayerCount($arr){
        $_playerallcount= count($arr);
        return $_playerallcount;
    }
    public function playerVictoryCount($arr, $dc){
        $_playervictory = array_filter($arr, function($victory) use($dc) {
        return $victory>$dc;
        });
        $_playervictorycount= count($_playervictory);
        return $_playervictorycount;
    }
}

?>