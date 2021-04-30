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
                case 'J':
                    $points += 10;
                    break;
                case 'Q':
                    $points += 10;
                    break;
                case 'K':
                    $points += 10;
                    break;
                case 'A':
                    $points += 10;
                    $a += 1;
                    break;
                default:
                    $points += intval($pattern);
                    break;
            }
        }
        if ($points > 21 && $__ace >= 1) {
            $points -= 9;
        }
        return $points;
    }
}



?>
