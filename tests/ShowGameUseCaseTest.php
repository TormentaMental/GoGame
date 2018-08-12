<?php

use GoGame\Game;
use GoGame\Storage;
use GoGame\UseCases\ShowGameUseCase;
use \Mockery as m;
use PHPUnit\Framework\TestCase;

class ShowGameUseCaseTest extends TestCase
{
  public function tearDown() {
      m::close();
  }
  
  function testIfStorageEmptyStoreNewGameAndReturnGame()
  {
    $mockGame = m::mock('GoGame\Game');
    $mockStorage = m::mock('GoGame\Storage');
    $mockStorage->shouldReceive('isEmpty')->andReturn(true)->once();
    $mockStorage->shouldReceive('save')->with($mockGame)->once();
    $mockStorage->shouldReceive('load')->once();

    $useCase = new ShowGameUseCase($mockStorage);
    $this->assertInstanceOf(Game::class, $useCase->execute($mockGame));

  }

  function testIfStorageNotEmptyLoadGame()
  {
    $mockStorage = m::mock('GoGame\Storage');
    $mockStorage->shouldReceive('isEmpty')->andReturn(false)->once();
    $mockStorage->shouldReceive('load')->once();
    $mockGame = m::mock('GoGame\Game');

    $useCase = new ShowGameUseCase($mockStorage);
    $this->assertInstanceOf(Game::class, $useCase->execute($mockGame));

  }

}
