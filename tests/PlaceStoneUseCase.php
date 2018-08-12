<?php

use GoGame\Game;
use GoGame\Storage;
use GoGame\UseCases\PlaceBlackStoneUseCase;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class ShowGameUseCaseTest extends TestCase
{
  public function tearDown() {
      m::close();
  }

  function testPlaceBlackStone()
  {
    $mockGame = m::mock('GoGame\Game');
    $mockStorage = m::mock('GoGame\Storage');
    $mockStorage->shouldReceive('load')->once()->andReturn($mockGame);
    $mockStorage->shouldReceive('save')->once();
    $mockGame->shouldReceive('addBlackStone')->with(1, 1)->once();
    $useCase = new PlaceBlackStoneUseCase($mockStorage);
    $this->assertNull($useCase->execute(1, 1));
  }

  function testPlaceWhiteStone()
  {
    $mockGame = m::mock('GoGame\Game');
    $mockStorage = m::mock('GoGame\Storage');
    $mockStorage->shouldReceive('load')->once()->andReturn($mockGame);
    $mockStorage->shouldReceive('save')->once();
    $mockGame->shouldReceive('addWhiteStone')->with(1, 1)->once();
    $useCase = new PlaceWhiteStoneUseCase($mockStorage);
    $this->assertNull($useCase->execute(1, 1));
  }

}
