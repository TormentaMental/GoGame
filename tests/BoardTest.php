<?php

use GoGame\Board;
use GoGame\IntersectionNotEmptyException;
use GoGame\IntersectionNotFoundException;
use PHPUnit\Framework\TestCase;

final class BoardTest extends TestCase
{
    private $board;

    public function setUp(): void
    {
        $this->board = new Board($this->buildIntersections(9));
    }

    public function testCanCreateBoard(): void
    {
        $this->assertEquals(9, count($this->board->getIntersections()));
    }

    public function testAddTwoStones(): void
    {
        $this->board->setIntersection(2, 0, 'black');
        $this->board->setIntersection(1, 0, 'white');
        $this->assertEquals('black', $this->board->getIntersection(2, 0));
        $this->assertEquals('white', $this->board->getIntersection(1, 0));
        $this->assertEquals('', $this->board->getIntersection(1, 1));
    }

    public function testSetNonExistentIntersectionShouldThrowException(): void
    {
        $this->expectException(IntersectionNotFoundException::class);
        $this->board->setIntersection(10, 10, 'black');
    }

    public function testGetNonExistentIntersectionShouldThrowException(): void
    {
        $this->expectException(IntersectionNotFoundException::class);
        $this->board->getIntersection(10, 10);
    }

    public function testSetNotEmptyIntersectionShouldThrowException(): void
    {
        $this->board->setIntersection(2, 0, 'black');
        $this->expectException(IntersectionNotEmptyException::class);
        $this->board->setIntersection(2, 0, 'white');
    }

    private function buildIntersections($size): array
    {
        $intersections = [];
        for ($i=0; $i<$size; $i++) {
            for ($g=0; $g<$size; $g++) {
                $intersections[$i][$g] = '';
            }
        }
            
        return $intersections;
    }
}
