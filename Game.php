<?php 
namespace GoGame;

class Game
{

	private $board = [
		['', '' , ''],
		['', '' , ''],
		['', '' , '']
	];

	public function addBlackStone(Array$position): void
	{
		$this->addStone('black', $position);
	}

	public function addWhiteStone(Array$position): void
	{
		$this->addStone('white', $position);
	}

	private function addStone($color, Array $position): void
	{
		if(!isset($this->board[$position[0]][$position[1]]))
			throw new OutOfBoardException();

		if(!empty($this->board[$position[0]][$position[1]]))
			throw new PositionNotEmptyException();

		$this->board[$position[0]][$position[1]] = $color;
	}

	public function getStone(Array $position): string
	{
		return $this->board[$position[0]][$position[1]];
	}

}

class OutOfBoardException extends \Exception{}
class PositionNotEmptyException extends \Exception{}