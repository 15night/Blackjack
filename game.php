<?php

require_once('cards.php');
require_once('index.php');


class Game {
    private $display = [];
    private $i = 1;    

    public function firstCard() {
        $this->display[] = 'あなたが引いたカード１枚目は' . $_SESSION['Playercard'][0] . 'です';
        $this->display[] = 'あなたが引いたカード２枚目は' . $_SESSION['Playercard'][1] . 'です';
        $this->display[] = 'ディーラーが引いたカードの１枚目は' . $_SESSION['Dealercard'][0] . 'です';
        return $this->display;
    }

    public function playerNextCard(int $p){
        $this->display[] = 'あなたが引いたカードは' . $_SESSION['Playercard'][$p] . 'です';
        return $this->display;
    }

}


?>
