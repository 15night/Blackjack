<?php

require_once('cards.php');

require_once('index.php');



class Game {

    private $display = [];

    private $i = 1;

    

    public function firstcard() {

        $this->display[] = 'あなたが引いたカード１枚目は' . $_SESSION['Playercard'][0] . 'です';

        $this->display[] = 'あなたが引いたカード２枚目は' . $_SESSION['Playercard'][1] . 'です';

        $this->display[] = 'ディーラーが引いたカードの１枚目は' . $_SESSION['Dealercard'][0] . 'です';

        return $this->display;

    }

    

    public function playernextcard(){

        $this->i++;

        $this->display[] = 'あなたが追加で引いたカードは' . $_SESSION['Playercard'][1] . 'です';

        return $this->display;

    }

    

    

    

}





?>
