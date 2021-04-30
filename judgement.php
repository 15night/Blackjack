<?php

require_once('cards.php');
require_once('index.php');
require_once('game.php');
require_once('sum.php');

class Judge {
    private $messages = [];
    public function burstorblackjack($_sum){
        if ($_sum == 21){
            $this->messages[] = 'BlackJack!!!!';
            $this->messages[] = 'おめでとうございます！Playerの勝ちです！！';
        }elseif ($_sum > 21){
            $this->messages[] = 'バーストしました！！';
            $this->messages[] = 'あなたの負けです！！';
            return $this->messages;
        }
    }
}


?>

