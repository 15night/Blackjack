<?php

session_start();
require_once('cards.php');
require_once('game.php');
require_once('player.php');
require_once('dealer.php');
require_once('judgement.php');
require_once('sum.php');
//10
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choice = $_POST['choice'];
    $game = new Game();
    $allcard = new Cards();
    $player = new Player();
    $dealer = new Dealer();
    $judgement = new Judge();
    $sum = new Sum();
    switch ($choice) {
        case 'はじめから':
            $deck = $allcard->createDeck();
            $_SESSION['Playercard'] = $player->getPlayerCard(2,$deck);
            array_splice($deck, 0, 2); 
            $_SESSION['Dealercard'] = $dealer->getDealerCard(2,$deck); 
            array_splice($deck, 0, 2); 
            $_SESSION['Display'] = $game->firstCard();
            $_SESSION['Deck'] = $deck;
            $player_sum = $sum->calculateSum($_SESSION['Playercard']);
            $judgement = $judgement->burstOrBlackjack($player_sum);
            $_SESSION['Display'][]= 'あなたのカードの合計は:' . $player_sum;
            $_SESSION['times']=2;
            session_write_close();
            break;

        case 'カードを追加':	   
            $_SESSION['Playercard'][] = $player->getNextPlayerCard($_SESSION['Deck']);
            array_splice($_SESSION['Deck'], 0, 1);
            //echo '<pre>';
                //var_dump($_SESSION['Playercard']);
            //echo '</pre>';
            $times=$_SESSION['times'];
            $_SESSION['Display'] = $game->playerNextCard($times);
            $times++;
            $_SESSION['times']=$times;
            $player_sum = $sum->calculateSum($_SESSION['Playercard']);
            $judgement = $judgement->burstOrBlackjack($player_sum);
            $_SESSION['Display'][]= 'あなたのカードの合計は:' . $player_sum;
            break;

        case 'ステイ':
            $player_sum = $sum->calculateSum($_SESSION['Playercard']);
            $dealer_sum = $sum->calculateSum($_SESSION['Dealercard']);
            $judgement = $judgement->burstOrBlackjack($dealer_sum);
            $playerfirstpoint=$sum->calculateSum($_SESSION['Playercard'][0]);
            $expectplayercard = $player->expectPlayerSum($playerfirstpoint, $_SESSION['Deck']);
            $expectdealercard = $dealer->expectDealerSum($dealer_sum, $_SESSION['Deck']);
            $playerallcount=$player->expectPlayerCount($expectplayercard);
            $dealerallcount=$dealer->expectDealerCount($expectdealercard);
            $dealerburstcount=$dealer->expectDealerBurst($expectdealercard);
            echo '<pre>';
                var_dump($dealerburstcount);
            echo '</pre>';
            echo '<pre>';
                var_dump($expectdealercard);
            echo '</pre>';
            break;
    }

}else {

    exit();

}



?>







<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>Blackjack</title>
        <!-- CSSの読み込み -->
        <link rel="stylesheet" href="">
    </head>
    <body class="body">
        <!-- 最初のカード確認 -->
        <h1 class="text-color">Blackjackへようこそ</h1>
   
        <?php foreach ($_SESSION['Display'] as $message) : ?>
        <p class="text-color"><?php echo $message ?></p>
        <?php endforeach; ?>
        <?php if (!empty($judgement)) : ?>
        <?php foreach ($judgement as $judge) : ?>
        <p><?= $judge; ?></p>
        <?php endforeach ?>

        <form action='' method='post'>
            <input type="submit" name='choice' value='はじめから'>
        </form>
        <?php else : ?>

        <p>カードをひきますか？</p>
        <form action='' method='post'>
            <input type='submit' name='choice' value='カードを追加'>
            <input type='submit' name='choice' value='ステイ'>
            <input type='submit' name='choice' value='はじめから'>
        </form>
        <?php endif; ?>

    </body>

</html>
