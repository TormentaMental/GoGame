<?php

use GoGame\Game;
use GoGame\GameSaverMemory;
use GoGame\BoardFactory;
use GoGame\OutOfBoardException;
use GoGame\WrongColorException;
use PHPUnit\Framework\TestCase;
use GoGame\IntersectionNotEmptyException;
use GoGame\IntersectionNotFoundException;

final class GameTest extends TestCase
{
  private $game;
  
  public function setUp(): void
  {    
    $this->game = new Game(
      BoardFactory::createSmallBoard()
    );
  }
  
  public function testAddTwoStones(): void
  {
    $this->game->addBlackStone(2, 0);
    $this->assertEquals('black', $this->game->getStone(2, 0));
    
    $this->game->addWhiteStone(1, 0);
    $this->assertEquals('white', $this->game->getStone(1, 0));
    
    $this->assertEquals('', $this->game->getStone(1, 1));
  }
  
  public function testStartPlayingWhiteColorShouldThrowException(): void
  {
    $this->expectException(WrongColorException::class);
    $this->game->addWhiteStone(2, 0);
  }
  
  public function testSameColorPlayTwiceInARowShouldThrowException(): void
  {
    $this->game->addBlackStone(2, 0);
    $this->expectException(WrongColorException::class);
    $this->game->addBlackStone(1, 0);
  }
  
  public function testGetScoreAfterPlacingOneStone(): void
  {
    $this->game->addBlackStone(0, 0);
    $this->assertEquals(1, $this->game->getBlackScore());
  }
  
  public function testGetScoreAfterPlacingStonesForBothColors(): void
  {
    $this->game->addBlackStone(0, 0);
    $this->game->addWhiteStone(0, 2);
    $this->game->addBlackStone(0, 1);
    $this->assertEquals(2, $this->game->getBlackScore());
    $this->assertEquals(1, $this->game->getWhiteScore());
  }
  
}