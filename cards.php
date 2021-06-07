<?php
class Cards
{
    private $all =[];
    private $marks =array(
    "♥","♦","♣","♠"
    );
    private $numbers = ["A",2,3,4,5,6,7,8,9,10,"J","Q","K"];
    private $player= [];
    private $dealer = [];

    public function createDeck()
    {
        foreach ($this->marks as $mark) {
            foreach ($this->numbers as $number) {
                array_push($this->all, $mark . "の" . $number);
            }
        }
        shuffle($this->all);
        return $this->all;
    }
}
