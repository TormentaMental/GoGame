<?php 
namespace GoGame;

class Game
{

	private $board;
	private $lastColorAdded;

	public function __construct($size){
		$this->buildBoard($size);
	}

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

	private function buildBoard($size): void
	{
		for ($i=0; $i<$size; $i++)
			for ($g=0; $g<$size; $g++)
				$this->board[$i][$g] = '';
	}

	private function isFirstMove(){
		return is_null($this->lastColorAdded);
	}

	private function addStone($color, Array $position): void
	{
		$this->checkIfColorCanAddStoneInPosition($color, $position);
		$this->board[$position[0]][$position[1]] = $color;
		$this->lastColorAdded = $color;
	}

	private function checkIfColorCanAddStoneInPosition($color, Array $position){
		if(!$this->isPositionOnBoard($position))
			throw new OutOfBoardException();

		if(!$this->isPositionEmpty($position))
			throw new PositionNotEmptyException();

		if($this->lastColorAdded == $color)
			throw new WrongColorException();
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