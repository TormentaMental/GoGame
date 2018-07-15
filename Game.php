<?php 
namespace GoGame;

use GoGame\Board;

class Game
{
    private $board;
    private $lastStoneColorAdded;
    private $blackScore = 0;
    private $whiteScore = 0;

    public function __construct(Board $board)
    {
        $this->board = $board;
    }

    public function addBlackStone($col, $row): void
    {
        $this->addStone($col, $row, 'black');
        $this->blackScore++;
    }

    public function addWhiteStone($col, $row): void
    {
        if ($this->isFirstMove()) {
            throw new WrongColorException();
        }
        $this->addStone($col, $row, 'white');
        $this->whiteScore++;
    }

    public function getStone($col, $row): string
    {
        return $this->board->getIntersection($col, $row);
    }

    public function getBlackScore(): int
    {
        return $this->blackScore;
    }

    public function getWhiteScore(): int
    {
        return $this->whiteScore;
    }

    public function getBoard()
    {
        return $this->board;
    }

    private function addStone($col, $row, $stoneColor): void
    {
        if ($this->lastStoneColorAdded == $stoneColor) {
            throw new WrongColorException();
        }
        $this->board->setIntersection($col, $row, $stoneColor);
        $this->lastStoneColorAdded = $stoneColor;
    }

    private function isFirstMove()
    {
        return is_null($this->lastStoneColorAdded);
    }
}

class WrongColorException extends \Exception
{
}
