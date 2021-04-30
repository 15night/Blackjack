<?php

session_start();

require_once('cards.php');

require_once('game.php');

require_once('player.php');

require_once('dealer.php');




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $choice = $_POST['choice'];

    $game = new Game();

    $allcards = new Cards();

    $player = new Player();

    $dealer = new Dealer();

    switch ($choice) {

        case 'はじめから':

            $deck = $allcards->createDeck();

            $_SESSION['Playercard'] = $player->getPlayerCard(2,$deck);

            array_splice($deck, 0, 2); 

            $_SESSION['Dealercard'] = $dealer->getDealerCard(2,$deck);

            array_splice($deck, 0, 2); 

            $_SESSION['Display'] = $game->firstcard();
      
            $_SESSION['Deck'] = $deck;

            session_write_close();

            break;

    

        case 'カードを追加':
	   
            echo '<pre>';
                var_dump($_SESSION['Deck']);
            echo '</pre>';

            $_SESSION['Playercard'] = array_shift($_SESSION['Allcard']);

            $_SESSION['Display'] = $game->playernextcard();

            

            break;

        

        case 'ステイ':

            

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

            <input type="submit" name='button' value='はじめから'>

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
