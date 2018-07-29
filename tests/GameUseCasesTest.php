<?php

use GoGame\Game;
use GoGame\BoardFactory;
use GoGame\SessionStore as Store;
use PHPUnit\Framework\TestCase;

class GameUseCasesTest extends TestCase
{
    public function setUp()
    {
      $_SESSION = array(  );
    }    

    public function testStartGame()
    {
        $board = BoardFactory::createSmallBoard();
        $game = new Game($board);
        $this->assertEquals(BoardFactory::createSmallBoard(), $game->getBoard());
    }

    public function testContinueGame()
    {
        $board = BoardFactory::createSmallBoard();
        $game = new Game($board);
        $game->addBlackStone(0, 2);
        $this->assertEquals(1, $game->getBlackScore());

        $store = new Store();
        $store->save($game);

        $storedGame = $store->load();
        $this->assertEquals(1, $game->getBlackScore());
    }

    public function testResetGame()
    {        
        $game = new Game(BoardFactory::createSmallBoard());
        $game->addBlackStone(2, 0);
        
        $store = new Store();        
        $store->save($game);
        $store->reset();
        
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $this->assertEquals(0, $game->getBlackScore());
    }

    public function testAddStone()
    {
        $store = new Store();
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $game->addBlackStone(2, 0);
        $this->assertEquals('black', $game->getStone(2, 0));
    }

    public function testGameReturnsWhoPlaysNext()
    {
        $store = new Store();
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $game->addBlackStone(2, 0);
        $this->assertEquals('white', $game->getNextColor());
    }
}
