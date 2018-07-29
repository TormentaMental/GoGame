<?php

use GoGame\Game;
use GoGame\BoardFactory;
use GoGame\GameStoreMemory;
use PHPUnit\Framework\TestCase;

class GameUseCasesTest extends TestCase
{
    public function testStartGame()
    {
        $board = BoardFactory::createSmallBoard();
        $game = new Game($board);
    }

    public function testContinueGame()
    {
        $board = BoardFactory::createSmallBoard();
        $game = new Game($board);
        $game->addBlackStone(0, 2);
        $this->assertEquals(1, $game->getBlackScore());

        $store = new GameStoreMemory();
        $store->save($game);

        $storedGame = $store->load();
        $this->assertEquals(1, $game->getBlackScore());
    }

    public function testResetGame()
    {
        $board = BoardFactory::createSmallBoard();
        $game = new Game($board);
        $game->addBlackStone(0, 2);
        $this->assertEquals(1, $game->getBlackScore());

        $store = new GameStoreMemory();
        $store->save($game);

        $storedGame = $store->load();
        $this->assertEquals(1, $game->getBlackScore());

        $store->reset();
        $this->assertTrue($store->isEmpty());
    }

    public function testAddStone()
    {
        $store = new GameStoreMemory();
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $game->addBlackStone(2, 0);
        $this->assertEquals('black', $game->getStone(2, 0));
    }

    public function testGameReturnsWhoPlaysNext()
    {
        $store = new GameStoreMemory();
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $game->addBlackStone(2, 0);
        $this->assertEquals('white', $game->getNextColor());
    }
}
