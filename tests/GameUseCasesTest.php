<?php

use GoGame\Game;
use GoGame\Presenter;
use GoGame\BoardFactory;
use PHPUnit\Framework\TestCase;
use GoGame\SessionStore as Store;

class GameUseCasesTest extends TestCase
{
    public function setUp()
    {
      $_SESSION = array(  );
    }    

    public function testStartGame()
    {
        $board = BoardFactory::createSmallBoard();
        $game = new Game($board);
        $this->assertEquals(BoardFactory::createSmallBoard(), $game->getBoard());
    }

    public function testContinueGame()
    {
        $board = BoardFactory::createSmallBoard();
        $game = new Game($board);
        $game->addBlackStone(0, 2);
        $this->assertEquals(1, $game->getBlackScore());

        $store = new Store();
        $store->save($game);

        $storedGame = $store->load();
        $this->assertEquals(1, $game->getBlackScore());
    }

    public function testResetGame()
    {        
        $game = new Game(BoardFactory::createSmallBoard());
        $game->addBlackStone(2, 0);
        
        $store = new Store();        
        $store->save($game);
        $store->reset();
        
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $this->assertEquals(0, $game->getBlackScore());
    }

    public function testAddStone()
    {
        $store = new Store();
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $game->addBlackStone(2, 0);
        $this->assertEquals('black', $game->getStone(2, 0));
    }

    public function testGameReturnsWhoPlaysNext()
    {
        $store = new Store();
        $game = $store->isEmpty() ? new Game(BoardFactory::createSmallBoard()) : $store->load();
        $game->addBlackStone(2, 0);
        $this->assertEquals('white', $game->getNextColor());
    }

    public function testGameCanBePresented()
    {
      $game = new Game(BoardFactory::createSmallBoard());
        $presenter = new Presenter($game);
        
        $this->assertTrue(is_array($presenter->toArray()));
        $this->assertInstanceOf(\stdClass::class, $presenter->toObj());
    }

    public function testGamePresenterRetrievesData()
    {
        $game = new Game(BoardFactory::createSmallBoard());
        $presenter = new Presenter($game);
        $arr = $presenter->toArray();

        $this->assertEquals($this->buildIntersections(9), $arr['board_intersections']);
        $this->assertEquals(0, $arr['white_score']);
        $this->assertEquals(0, $arr['black_score']);
        $this->assertEquals('black', $arr['who_plays_next']);
        
    }

    private static function buildIntersections($size): array
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

