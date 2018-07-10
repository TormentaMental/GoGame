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
		$this->game = new Game();
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

	// public function testGetScoreAfterPlacingOneStone(): void
	// {
	// 	$this->game->addBlackStone([0,0]);
	// 	$this->assertEquals(1, $this->game->getScore('black'));
	// }

	// public function testGetScoreAfterPlacingTwoStones(): void
	// {
	// 	$this->game->addBlackStone([0,0]);
	// 	$this->game->addBlackStone([0,1]);
	// 	$this->assertEquals(2, $this->game->getScore('black'));
	// }

	// public function testGetScoreAfterPlacingStonesForBothColors(): void
	// {
	// 	$this->game->addBlackStone([0,0]);
	// 	$this->game->addBlackStone([0,1]);
	// 	$this->assertEquals(2, $this->game->getScore('black'));

	// 	$this->game->addWhiteStone([0,2]);
	// 	$this->assertEquals(1, $this->game->getScore('white'));
	// }


}
