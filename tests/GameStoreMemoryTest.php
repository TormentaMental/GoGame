<?php

use GoGame\Game;
use GoGame\BoardFactory;
use GoGame\GameStoreMemory;
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
  
}
