<?php 
namespace GoGame;

class Game
{

	private $board = [
		['', '' , ''],
		['', '' , ''],
		['', '' , '']
	];

	public function addStone($color, Array $position): void
	{
		$this->board[$position[0]][$position[1]] = $color;
	}

	public function getStone(Array $position): string
	{
		return $this->board[$position[0]][$position[1]];
	}

}
