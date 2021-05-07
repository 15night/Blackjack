<?php
session_start();
require_once('cards.php');
require_once('game.php');
require_once('player.php');
require_once('dealer.php');
require_once('judgement.php');
require_once('sum.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choice = $_POST['choice'];
    $game = new Game();
    $allcard = new Cards();
    $player = new Player();
    $dealer = new Dealer();
    $judge = new Judge();
    $sum = new Sum();
    switch ($choice) {
        case 'はじめから':
            $firstdeck=2;
            $deck = $allcard->createDeck();
            $_SESSION['Playercard'] = $player->getPlayerCard($firstdeck, $deck);
            array_splice($deck, 0, $firstdeck);
            $_SESSION['Dealercard'] = $dealer->getDealerCard($firstdeck, $deck);
            array_splice($deck, 0, $firstdeck);
            $_SESSION['Display'] = $game->firstCard();
            $_SESSION['Deck'] = $deck;
            $player_sum = $sum->calculateSum($_SESSION['Playercard']);
            $judgement = $judge->burstOrBlackjack($player_sum, 'あなた');
            $_SESSION['Display'][]= 'あなたのカードの合計は:' . $player_sum;
            $_SESSION['Playertimes']=2;
            session_write_close();
            break;

        case 'カードを追加':
            $_SESSION['Playercard'][] = $player->getNextPlayerCard($_SESSION['Deck']);
            array_splice($_SESSION['Deck'], 0, 1);
            $playertimes=$_SESSION['Playertimes'];
            $_SESSION['Display'] = $game->playerNextCard($playertimes);
            $playertimes++;
            $_SESSION['Playertimes']=$playertimes;
            $player_sum = $sum->calculateSum($_SESSION['Playercard']);
            $judgement = $judge->burstOrBlackjack($player_sum, 'あなた');
            $_SESSION['Display'][]= 'あなたのカードの合計は:' . $player_sum;
            break;

        case 'ステイ':
            $dealertimes=2;
            $player_sum = $sum->calculateSum($_SESSION['Playercard']);
            $dealer_sum = $sum->calculateSum($_SESSION['Dealercard']);
            $_SESSION['Display'][] = 'ディーラーの2枚目のカードは' . $_SESSION['Dealercard'][1] . 'でした';
            $_SESSION['Display'][]= 'ディーラーのカードの合計は:' . $dealer_sum;
            $dealeracheck = $dealer->aCheck($_SESSION['Dealercard'], $dealer_sum);
            $judgement = $judge->burstOrBlackjack($dealer_sum, 'ディーラー');
            $playerfirstpoint=$sum->calculateSum($_SESSION['Playercard'][0]);
            $expectplayercard = $player->expectPlayerSum($playerfirstpoint, $_SESSION['Deck']);
            $expectdealercard = $dealer->expectDealerSum($dealeracheck, $_SESSION['Deck']);
            $playerallcount=$player->expectPlayerCount($expectplayercard);
            $dealerallcount=$dealer->expectDealerCount($expectdealercard);
            $dealerburstcount=$dealer->expectDealerBurst($expectdealercard);
            $playervictorycount=$player->playerVictoryCount($expectplayercard, $dealer_sum);
            $dealercompare=$dealerburstcount/$dealerallcount;
            $playercompare=$playervictorycount/$playerallcount;
            
            while (empty($judgement)) {
                if ($dealer_sum < $player_sum && $dealercompare < $playercompare) {
                    $_SESSION['Dealercard'][] = $dealer->getNextDealerCard($_SESSION['Deck']);
                    array_splice($_SESSION['Deck'], 0, 1);
                    $_SESSION['Display'][] = 'ディーラーが追加で' . $_SESSION['Dealercard'][$dealertimes] . 'のカードを引きました';
                    $dealertimes++;
                    $dealer_sum = $sum->calculateSum($_SESSION['Dealercard']);
                    $judgement = $judge->burstOrBlackjack($dealer_sum, 'ディーラー');
                    $dealeracheck = $dealer->aCheck($_SESSION['Dealercard'], $dealer_sum);
                    $expectdealercard = $dealer->expectDealerSum($dealeracheck, $_SESSION['Deck']);
                    $dealerallcount=$dealer->expectDealerCount($expectdealercard);
                    $dealerburstcount=$dealer->expectDealerBurst($expectdealercard);
                    $_SESSION['Display'][]= 'ディーラーのカードの合計は:' . $dealer_sum;
                } else {
                    $judgement = $judge->checkTheWinner($player_sum, $dealer_sum);
                }
            }
            break;
    }
} else {
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
