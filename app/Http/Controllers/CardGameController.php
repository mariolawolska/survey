<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardGameController extends Controller {

    const Card_Deck_Limit = 32;

    /**
     * Start Card Game
     * 
     * @return view
     */
    public function index() {
        return view('cardGame.welcome');
    }

    /**
     * Load Deck and 
     * @param Request $request
     * 
     * @return type
     */
    public function startGame(Request $request) {
        $request->session()->flush();

        $deck = $this->getDeck();
        $players = $this->dealCards($deck);
        $this->setSessionValues($players);

        return view('cardGame.games.startGame', compact('players'));
    }

    /**
     * Method prepares Deck to start the game
     * 
     * @return array
     */
    public function getDeck() {
        $colourArray = array('Red', 'Blue', 'Green', 'Yellow');
        $shapeArray = array('Square', 'Circle', 'Triangle', 'Oval');

        $deck = [];

        for ($i = 0; $i < self::Card_Deck_Limit; $i++) {

            $colour = array_rand($colourArray, 1);
            $shape = array_rand($shapeArray, 1);

            $card = [$colourArray[$colour], $shapeArray[$shape]];
            array_push($deck, $card);
        }

        return $deck;
    }

    /**
     * Method distributes cards between players
     * 
     * @param array $deck
     * 
     * @return array
     */
    public function dealCards($deck) {
        shuffle($deck);

        $players = [[], []];
        for ($i = 0; $i < count($deck); $i++) {
            $players[$i % 2][] = $deck[$i];
        }

        return $players;
    }

    /**
     * Method performs consecutive stages of the game
     * 
     * @return view
     */
    public function nextTurn() {
        $player1 = session('player1');
        $player2 = session('player2');

        $player1_card = $player1[0];
        $player2_card = $player2[0];

        $this->addPointsToScore($this->getValueOfCard($player1_card[0]), $this->getValueOfCard($player2_card[0]));

        if (!empty($player1)) {
            session(['player1' => array_slice($player1, 1)]);
        }
        if (!empty($player2)) {
            session(['player2' => array_slice($player2, 1)]);
        }
        return view('cardGame.games.showCards', compact('player1_card', 'player2_card'));
    }

    /**
     * Method for keeping results in a session
     * 
     * @param type $players
     */
    public function setSessionValues($players) {
        session(['player1' => $players[0]]);
        session(['player2' => $players[1]]);
        session(['player1_score' => 0]);
        session(['player2_score' => 0]);
    }

    /**
     * Adding points for players
     * 
     * @param array $player1_cardValue
     * @param array $player2_cardValue
     */
    public function addPointsToScore($player1_cardValue, $player2_cardValue) {
        $player1_score = session('player1_score');
        $player2_score = session('player2_score');

        if ($player1_cardValue !== $player2_cardValue) {
            $player1_cardValue > $player2_cardValue ?
                            session(['player1_score' => $player1_score + 1]) : session(['player2_score' => $player2_score + 1]);
        }
    }

    public function getValueOfCard($card) {

        switch ($card) {
            case 'Green':
                $value = 14;
                break;
            case 'Red';
                $value = 11;
                break;
            case 'Green':
                $value = 12;
                break;
            case 'Yellow':
                $value = 13;
                break;
            default:
                $value = $card;
        }

        return $value;
    }

}
