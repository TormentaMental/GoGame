<?php

use GoGame\Game;
use GoGame\OutOfBoardException;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
	private $game;

	public function setUp(): void
	{
		$this->game = new Game();
	}

	public function testAddOneStone(): void
	{
		$this->game->addBlackStone([0,0]);
		$this->assertEquals('black', $this->game->getStone([0,0])); 
	}

	public function testAddTwoStones(): void
	{
		$this->game->addBlackStone([2,0]);
		$this->game->addWhiteStone([1,0]);

		$this->assertEquals('black', $this->game->getStone([2,0]));
		$this->assertEquals('white', $this->game->getStone([1,0]));
	}

	public function testAddStoneOutOfBoundShouldThrowException(): void
	{
		$this->expectException(OutOfBoardException::class);
		$this->game->addBlackStone([1000,1000]);
	}


}
