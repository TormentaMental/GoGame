<?php

use GoGame\Game;
use GoGame\OutOfBoardException;
use GoGame\PositionNotEmptyException;
use GoGame\WrongColorException;
use PHPUnit\Framework\TestCase;

final class GameTest extends TestCase
{
	private $game;

	public function setUp(): void
	{
		$this->game = new Game(9);
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
		$this->game->addBlackStone([10,10]);
	}

	public function testAddStoneOverOtherStoneShouldThrowException(): void
	{
		$this->expectException(PositionNotEmptyException::class);
		$this->game->addBlackStone([2,0]);
		$this->game->addWhiteStone([2,0]);
	}

	public function testStartPlayingWhiteColorShouldThrowException(): void
	{
		$this->expectException(WrongColorException::class);
		$this->game->addWhiteStone([2,0]);
	}
	public function testSameColorPlayTwiceInARowShouldThrowException(): void
	{
		$this->game->addBlackStone([2,0]);
		$this->expectException(WrongColorException::class);
		$this->game->addBlackStone([1,0]);
	}

	public function testSetUpBoardSize(): void
	{
		$this->game = new Game(9);
		$this->game->addBlackStone([8,8]);

		$this->game = new Game(30);
		$this->game->addBlackStone([29,29]);

	}


}
