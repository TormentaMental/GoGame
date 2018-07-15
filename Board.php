<?php 
namespace GoGame;

class Board
{
    private $intersections = [];

    public function __construct($intersections)
    {
        $this->intersections = $intersections;
    }

    public function getIntersections(): array
    {
        return $this->intersections;
    }

    public function setIntersection($row, $col, $stoneColor): Void
    {
        if (!$this->isIntersectionOnBoard($row, $col)) {
            throw new IntersectionNotFoundException();
        }

        if (!$this->isIntersectionEmpty($row, $col)) {
            throw new IntersectionNotEmptyException();
        }
            
        $this->intersections[$row][$col] = $stoneColor;
    }

    public function getIntersection($row, $col): String
    {
        if (!$this->isIntersectionOnBoard($row, $col)) {
            throw new IntersectionNotFoundException();
        }

        return $this->intersections[$row][$col];
    }

    private function isIntersectionOnBoard($row, $col): bool
    {
        return isset($this->intersections[$row][$col]);
    }

    private function isIntersectionEmpty($row, $col): bool
    {
        return empty($this->intersections[$row][$col]);
    }
}

class IntersectionNotFoundException extends \Exception
{
}
class IntersectionNotEmptyException extends \Exception
{
}
