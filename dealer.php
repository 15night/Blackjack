<?php

class Dealer {
    
    public function getDealerCard($num, $arr){
        $dealercard = [];
        for ($i=0; $i<$num; $i++) {
            $dealercard[] = array_shift($arr);
        }
        return $dealercard;
    }

    public function expectDealerSum($dfp, $_arr){
        $ace=0;
        $ex_dealer=[];
        foreach ($_arr as $value){
            switch ($value) {
                case strpos($value, 'J')!==false:
                    $ex_dealer[]= $dfp+10;
                    break;
                case strpos($value, 'Q')!==false:
                    $ex_dealer[]= $dfp+10;
                    break;
                case strpos($value, 'K')!==false:
                    $ex_dealer[]= $dfp+10;
                    break;
                case strpos($value, 'A')!==false:
                    $ex_dealer[]= $dfp+1;
                    $this->a=$this->ace+1;
                    echo $this->ace;
                    break;
                default:
                    $ex_dealer[]= $dfp+ preg_replace('/[^0-9]/', '', $value);
                    break;
             }
        }
        return $ex_dealer;
    }
    public function expectDealerCount($__arr){
        $_dealerallcount= count($__arr);
        return $_dealerallcount;
    }

    public function expectDealerBurst($___arr){
        $dealerburst = array_filter($___arr, function($burst) {
        return $burst >= 22;
        });
        $_dealerburstcount= count($dealerburst);
        return $_dealerburstcount;
    }
}



?>