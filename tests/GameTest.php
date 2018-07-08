<?php

use PHPUnit\Framework\TestCase;
use GoGame\Game;

final class GameTest extends TestCase
{
	private $game;

	public function setUp(): void
	{
		$this->game = new Game();
	}

	public function testAddOneStone(): void
	{
		$this->game->addStone('black', [0,0]);
		$this->assertEquals('black', $this->game->getStone([0,0])); 
	}

	public function testAddTwoStones(): void
	{
		$this->game->addStone('black', [0,0]);
		$this->game->addStone('white', [1,0]);
		$this->assertEquals('white', $this->game->getStone([1,0]));
	}


}
