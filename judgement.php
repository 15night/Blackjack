<?php
require_once('cards.php');
require_once('index.php');
require_once('game.php');
require_once('sum.php');

class Judge
{
    private $messages = [];
    public function burstOrBlackjack($_sum, $turn)
    {
        if ($_sum === 21) {
            $this->messages[] = 'BlackJack!!!!';
            $this->messages[] = 'おめでとうございます！' . $turn . 'の勝ちです！！';
            return $this->messages;
        } elseif ($_sum > 21) {
            $this->messages[] = 'バーストしました！！';
            $this->messages[] = $turn . 'の負けです！！';
            return $this->messages;
        }
    }
    public function checkTheWinner($player, $dealer)
    {
        if ($player == $dealer) {
            $this->messages[] = '両者引き分けです！！';
        } elseif ($player > $dealer) {
            $this->messages[] = 'あなたの勝ちです！！';
        } else {
            $this->messages[] = 'ディーラーの勝ちです！！';
        }
        return $this->messages;
    }
}
