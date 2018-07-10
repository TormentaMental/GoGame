<?php 
namespace GoGame;

class Game
{

	private $board = [
		['', '' , ''],
		['', '' , ''],
		['', '' , '']
	];
	private $lastColor = null;

	public function addBlackStone(Array$position): void
	{
		$this->addStone('black', $position);
	}

	public function addWhiteStone(Array$position): void
	{
		if($this->isFirstMove())
			throw new WrongColorException();
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

	private function isFirstMove(){
		return is_null($this->lastColor);
	}

	private function addStone($color, Array $position): void
	{
		if(!$this->isPositionOnBoard($position))
			throw new OutOfBoardException();

		if(!$this->isPositionEmpty($position))
			throw new PositionNotEmptyException();

		if($this->lastColor == $color)
			throw new WrongColorException();

		$this->board[$position[0]][$position[1]] = $color;
		$this->lastColor = $color;
	}

	private function isPositionOnBoard($position): bool
	{
		return isset($this->board[$position[0]][$position[1]]);
	}

	private function isPositionEmpty($position): bool
	{
		return empty($this->board[$position[0]][$position[1]]);
	}

}

class OutOfBoardException extends \Exception{}
class PositionNotEmptyException extends \Exception{}
class WrongColorException extends \Exception{}