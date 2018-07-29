<?php

use GoGame\Game;
use GoGame\BoardFactory;
use GoGame\SessionStore as Store;
use GoGame\EmptyStoreException;
use PHPUnit\Framework\TestCase;

class SessionStoreTest extends TestCase
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
        $store = new Store();
        $store->save($this->game);
        $this->assertInstanceOf(Game::class, $store->load());
    }
  
    public function testLoadStoredGameWhenEmptyThrowsException()
    {
        $store = new Store();
        $store->reset();
        $this->expectException(EmptyStoreException::class);
        $store->load();
    }
  
    public function testStoreReset()
    {
        $store = new Store();
        $store->save($this->game);
        $this->assertInstanceOf(Game::class, $store->load());
        $store->reset();
        $this->assertTrue($store->isEmpty());
    }
}
