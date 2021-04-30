<?php

require_once('cards.php');
require_once('index.php');
require_once('game.php');
require_once('judgement.php');

class Sum {
    
    public function calculateSum($number) {
        $points = 0;
        $a = 0;
        foreach ($number as $pattern) {
            switch ($pattern) {
                case strpos($pattern, 'J')!==false:
                    $points += 10;
                    break;
                case strpos($pattern, 'Q')!==false:
                    $points += 10;
                    break;
                case strpos($pattern, 'K')!==false:
                    $points += 10;
                    break;
                case strpos($pattern, 'A')!==false:
                    $points += 10;
                    $a += 1;
                    break;
                default:
                    $points += preg_replace('/[^0-9]/', '', $pattern);
                    break;
            }
        }
        if ($points > 21 && $a >= 1) {
            $points -= 9;
        }
        return $points;
    }
}



?>
