<?php

class Dealer
{
    public function getDealerCard($num, $arr)
    {
        $dealercard = [];
        for ($i=0; $i<$num; $i++) {
            $dealercard[] = array_shift($arr);
        }
        return $dealercard;
    }
    public function expectDealerSum($dfp, $arr)
    {
        $ex_dealer=[];
        foreach ($arr as $value) {
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
    public function aCheck($arr, $dsp)
    {
        $dealeracount= count(array_filter($arr, function ($ace) {
            return strpos($ace, 'A')!==false;
        }));
        $dsp=$dsp-$dealeracount*9;
        return $dsp;
    }
    public function expectDealerCount($arr)
    {
        $_dealerallcount= count($arr);
        return $_dealerallcount;
    }
    public function expectDealerBurst($arr)
    {
        $dealerburst = array_filter($arr, function ($burst) {
            return $burst >= 22;
        });
        $_dealerburstcount= count($dealerburst);
        return $_dealerburstcount;
    }
    public function getNextDealerCard($arr)
    {
        $dealernextcard  = array_shift($arr);
        return $dealernextcard;
    }
}
