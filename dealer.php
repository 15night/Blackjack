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
                    break;
                default:
                    $ex_dealer[]= $dfp+ preg_replace('/[^0-9]/', '', $value);
                    break;
             }
        }
        return $ex_dealer;
    }
    public function aCheck($__arr, $dsp){
        $dealeracount= count(array_filter($__arr, function($ace) {
        return strpos($ace, 'A')!==false;
        }));
        $dsp=$dsp-$dealeracount*9;
        return $dsp;
    }

    public function expectDealerCount($___arr){
        $_dealerallcount= count($___arr);
        return $_dealerallcount;
    }

    public function expectDealerBurst($____arr){
        $dealerburst = array_filter($____arr, function($burst) {
        return $burst >= 22;
        });
        $_dealerburstcount= count($dealerburst);
        return $_dealerburstcount;
    }

    public function getNextDealerCard($_____arr){
        $dealernextcard  = array_shift($_____arr);
        return $dealernextcard;
    }

}
?>