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

	public function getStone(Array $position): string
	{
		return $this->board[$position[0]][$position[1]];
	}

	public function getScore($color): int
	{
		$score = 0;
		foreach ($this->board as $row)
			foreach ($row as $stone)
				if($stone == $color)
					$score++;
		return $score;
	}

	private function addStone($color, Array $position): void
	{
		if(!isset($this->board[$position[0]][$position[1]]))
			throw new OutOfBoardException();

		if(!empty($this->board[$position[0]][$position[1]]))
			throw new PositionNotEmptyException();

		$this->board[$position[0]][$position[1]] = $color;
	}

}

class OutOfBoardException extends \Exception{}
class PositionNotEmptyException extends \Exception{}