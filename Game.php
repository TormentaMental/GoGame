<?php 
namespace GoGame;

class Game
{

	private $board;
	private $lastStoneColorAdded;
	private $blackScore = 0;
	private $whiteScore = 0;

	public function __construct($size){
		$this->buildBoard($size);
	}

	public function addBlackStone(Array $intersection): void
	{
		$this->addStone('black', $intersection);
		$this->blackScore++;
	}

	public function addWhiteStone(Array $intersection): void
	{
		if($this->isFirstMove())
			throw new WrongColorException();
		$this->addStone('white', $intersection);
		$this->whiteScore++;
	}

	public function getStone(Array $intersection): string
	{
		if(!$this->isIntersectionOnBoard($intersection))
			throw new OutOfBoardException();
		return $this->board[$intersection[0]][$intersection[1]];
	}

	public function getBlackScore(): int
	{
		return $this->blackScore;
	}

	public function getWhiteScore(): int
	{
		return $this->whiteScore;
	}

	public function getBoard(){
		return $this->board;
	}

	private function buildBoard($size): void
	{
		for ($i=0; $i<$size; $i++)
			for ($g=0; $g<$size; $g++)
				$this->board[$i][$g] = '';
	}

	private function addStone($color, Array $intersection): void
	{
		$this->checkIfStoneCanBeAddedInIntersection($color, $intersection);
		$this->board[$intersection[0]][$intersection[1]] = $color;
		$this->lastStoneColorAdded = $color;
	}

	private function isFirstMove(){
		return is_null($this->lastStoneColorAdded);
		$this->lastColor = $color;
	}

	private function checkIfStoneCanBeAddedInIntersection($color, Array $intersection){
		if(!$this->isIntersectionOnBoard($intersection))
			throw new OutOfBoardException();

		if(!$this->isIntersectionEmpty($intersection))
			throw new IntersectionNotEmptyException();

		if($this->lastStoneColorAdded == $color)
			throw new WrongColorException();
	}

	private function isIntersectionOnBoard($intersection): bool
	{
		return isset($this->board[$intersection[0]][$intersection[1]]);
	}

	private function isIntersectionEmpty($intersection): bool
	{
		return empty($this->board[$intersection[0]][$intersection[1]]);
	}

}

class OutOfBoardException extends \Exception{}
class IntersectionNotEmptyException extends \Exception{}
class WrongColorException extends \Exception{}