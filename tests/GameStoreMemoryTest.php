<?php

use GoGame\Game;
use GoGame\BoardFactory;
use GoGame\GameStoreMemory;
use GoGame\EmptyStoreException;
use PHPUnit\Framework\TestCase;

class GameStoreMemoryTest extends TestCase
{
    private $game;
  
    public function setUp(): void
    {
        $this->game = new Game(
      BoardFactory::createSmallBoard()
    );
    }
  
    public function testStoreCanSaveGame()
    {
        $store = new GameStoreMemory();
        $store->save($this->game);
        $this->assertInstanceOf(Game::class, $store->load());
    }

    public function testLoadStoredGameWhenEmptyThrowsException()
    {
        $store = new GameStoreMemory();
        $this->expectException(EmptyStoreException::class);
        $store->load();
    }

    public function testStoreReset()
    {
        $store = new GameStoreMemory();
        $store->save($this->game);
        $this->assertInstanceOf(Game::class, $store->load());
        $store->reset();
        $this->assertTrue($store->isEmpty());
    }
}
